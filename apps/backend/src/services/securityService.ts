import { env } from '../utils/env';
import { blockedIps, loginAttempts, otpAttempts, otpSessions } from '../models/store';
import { users } from '../data/users';
import { LoginRequest } from '../types';
import { evaluateSecurityDecision } from './securityTreeService';
import { appendSecurityEvent } from './securityLogService';
import { sendOtpNotification, sendSecurityNotification } from './notificationService';

function randomOtp(): string {
  return `${Math.floor(100000 + Math.random() * 900000)}`;
}

function getRecentAttemptStats(ipAddress: string, phase: 'username' | 'otp'): {
  attemptCount: number;
  weakPhraseHits: number;
  repeatedPattern: boolean;
} {
  const values =
    phase === 'username'
      ? loginAttempts
          .filter((attempt) => attempt.ipAddress === ipAddress)
          .slice(-env.maxDictionaryAttempts)
          .map((attempt) => attempt.password)
      : otpAttempts
          .filter((attempt) => attempt.ipAddress === ipAddress)
          .slice(-env.maxDictionaryAttempts)
          .map((attempt) => attempt.otp);

  const normalized = values.map((value) => value.toLowerCase());
  const weakPhraseHits = normalized.filter((value) =>
    ['password', 'admin', 'qwerty', '123456', 'letmein', 'welcome'].some((phrase) => value.includes(phrase))
  ).length;

  return {
    attemptCount: values.length,
    weakPhraseHits,
    repeatedPattern: values.length > 1 && new Set(values).size <= 2
  };
}

function handleSecurityAction(
  username: string,
  ipAddress: string,
  phase: 'username' | 'otp',
  action: 'ALLOW' | 'NOTIFY' | 'BLOCK_NOTIFY',
  reason: string,
  dictionaryPhrase?: string
): void {
  appendSecurityEvent({
    timestamp: new Date().toISOString(),
    username,
    ipAddress,
    phase,
    action,
    reason,
    dictionaryPhrase
  });

  if (action === 'NOTIFY' || action === 'BLOCK_NOTIFY') {
    sendSecurityNotification({
      username,
      subject: 'Dictionary attack alert',
      message: `${reason}. source_ip=${ipAddress}${dictionaryPhrase ? ` phrase=${dictionaryPhrase}` : ''}`
    });
  }

  if (action === 'BLOCK_NOTIFY') {
    blockedIps.set(ipAddress, { reason, blockedAt: new Date().toISOString() });
  }
}

export function loginAndGenerateOtp(request: LoginRequest): {
  ok: boolean;
  message: string;
  debugOtp?: string;
} {
  const ipAddress = request.ipAddress ?? '0.0.0.0';

  if (blockedIps.has(ipAddress)) {
    const reason = blockedIps.get(ipAddress)?.reason ?? 'blocked by policy';
    handleSecurityAction(request.username, ipAddress, 'username', 'BLOCK_NOTIFY', reason);
    return { ok: false, message: `IP blocked: ${reason}` };
  }

  const stats = getRecentAttemptStats(ipAddress, 'username');
  const decision = evaluateSecurityDecision({
    ipAddress,
    username: request.username,
    passwordOrOtp: request.password,
    phase: 'username',
    attemptCount: stats.attemptCount,
    weakPhraseHits: stats.weakPhraseHits,
    repeatedPattern: stats.repeatedPattern,
    maxAttempts: env.maxDictionaryAttempts
  });

  handleSecurityAction(request.username, ipAddress, 'username', decision.action, decision.reason, decision.dictionaryPhrase);

  if (decision.action === 'BLOCK_NOTIFY') {
    loginAttempts.push({
      timestamp: new Date().toISOString(),
      username: request.username,
      password: request.password,
      ipAddress,
      successful: false
    });
    return { ok: false, message: `IP blocked: ${decision.reason}` };
  }

  const user = users[request.username];
  const validPassword = Boolean(user) && user.password === request.password;

  loginAttempts.push({
    timestamp: new Date().toISOString(),
    username: request.username,
    password: request.password,
    ipAddress,
    successful: validPassword
  });

  if (!validPassword) {
    return { ok: false, message: 'Invalid username or password' };
  }

  const otp = randomOtp();
  otpSessions.set(request.username, {
    username: request.username,
    otp,
    expiresAt: Date.now() + env.otpTtlMs,
    verified: false
  });

  sendOtpNotification(request.username, otp);

  return {
    ok: true,
    message: 'OTP sent via email and SMS. Expires in 10 minutes.',
    ...(env.exposeDebugOtp ? { debugOtp: otp } : {})
  };
}

export function verifyOtp(username: string, otp: string, ipAddress: string): { ok: boolean; message: string } {
  if (blockedIps.has(ipAddress)) {
    const reason = blockedIps.get(ipAddress)?.reason ?? 'blocked by policy';
    handleSecurityAction(username, ipAddress, 'otp', 'BLOCK_NOTIFY', reason);
    return { ok: false, message: `IP blocked: ${reason}` };
  }

  const stats = getRecentAttemptStats(ipAddress, 'otp');
  const decision = evaluateSecurityDecision({
    ipAddress,
    username,
    passwordOrOtp: otp,
    phase: 'otp',
    attemptCount: stats.attemptCount,
    weakPhraseHits: stats.weakPhraseHits,
    repeatedPattern: stats.repeatedPattern,
    maxAttempts: env.maxDictionaryAttempts
  });

  handleSecurityAction(username, ipAddress, 'otp', decision.action, decision.reason, decision.dictionaryPhrase);

  if (decision.action === 'BLOCK_NOTIFY') {
    otpAttempts.push({ timestamp: new Date().toISOString(), username, otp, ipAddress, successful: false });
    return { ok: false, message: `IP blocked: ${decision.reason}` };
  }

  const session = otpSessions.get(username);
  if (!session) {
    otpAttempts.push({ timestamp: new Date().toISOString(), username, otp, ipAddress, successful: false });
    return { ok: false, message: 'No OTP session found' };
  }

  if (Date.now() > session.expiresAt) {
    otpSessions.delete(username);
    otpAttempts.push({ timestamp: new Date().toISOString(), username, otp, ipAddress, successful: false });
    return { ok: false, message: 'OTP expired' };
  }

  if (session.otp !== otp) {
    otpAttempts.push({ timestamp: new Date().toISOString(), username, otp, ipAddress, successful: false });
    return { ok: false, message: 'Invalid OTP' };
  }

  session.verified = true;
  otpSessions.set(username, session);
  otpAttempts.push({ timestamp: new Date().toISOString(), username, otp, ipAddress, successful: true });
  return { ok: true, message: 'OTP validated' };
}

export function isVerifiedUser(username: string): boolean {
  const session = otpSessions.get(username);
  return Boolean(session?.verified && Date.now() <= session.expiresAt);
}
