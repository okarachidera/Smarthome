import { DeviceEvent, OtpSession } from '../types';

export const otpSessions = new Map<string, OtpSession>();
export const loginAttempts: Array<{
  timestamp: string;
  username: string;
  password: string;
  ipAddress: string;
  successful: boolean;
}> = [];

export const otpAttempts: Array<{
  timestamp: string;
  username: string;
  otp: string;
  ipAddress: string;
  successful: boolean;
}> = [];

export const blockedIps = new Map<string, { reason: string; blockedAt: string }>();
export const deviceEvents: DeviceEvent[] = [];
