import { users } from '../data/users';

export interface NotificationPayload {
  username: string;
  subject: string;
  message: string;
}

export function sendOtpNotification(username: string, otp: string): { emailSent: boolean; smsSent: boolean } {
  const user = users[username];
  if (!user) {
    return { emailSent: false, smsSent: false };
  }

  // Research-aligned notification hook: OTP is conceptually sent through email/SMS.
  console.log(`[OTP EMAIL] to=${user.email} otp=${otp}`);
  console.log(`[OTP SMS] to=${user.phone} otp=${otp}`);

  return { emailSent: true, smsSent: true };
}

export function sendSecurityNotification(payload: NotificationPayload): void {
  const user = users[payload.username];
  if (user) {
    console.log(`[SECURITY EMAIL] to=${user.email} subject=${payload.subject} message=${payload.message}`);
  }
  console.log(`[SECURITY ALERT] user=${payload.username} ${payload.subject} ${payload.message}`);
}
