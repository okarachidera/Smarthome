export type DeviceName = 'light' | 'ac' | 'door' | 'tv' | 'refrigerator';

export interface LoginRequest {
  username: string;
  password: string;
  ipAddress?: string;
}

export interface OtpSession {
  username: string;
  otp: string;
  expiresAt: number;
  verified: boolean;
}

export interface DeviceEvent {
  timestamp: string;
  username: string;
  location: string;
  device: DeviceName;
  state: 0 | 1;
  context: string;
  occupancy?: 0 | 1;
}

export interface PredictionRequest {
  location: string;
  hour: number;
  device: DeviceName;
  day_of_week: number;
  occupancy: number;
}

export interface SecurityDecisionInput {
  ipAddress: string;
  username: string;
  passwordOrOtp: string;
  attemptCount: number;
  weakPhraseHits: number;
  repeatedPattern: boolean;
  phase: 'username' | 'otp';
  maxAttempts: number;
}

export interface SecurityDecision {
  action: 'ALLOW' | 'NOTIFY' | 'BLOCK_NOTIFY';
  reason: string;
  dictionaryPhrase?: string;
}
