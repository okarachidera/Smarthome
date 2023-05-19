import dotenv from 'dotenv';

dotenv.config();

export const env = {
  port: Number(process.env.PORT ?? 3000),
  otpTtlMs: Number(process.env.OTP_TTL_MS ?? 600000),
  maxDictionaryAttempts: Number(process.env.MAX_DICTIONARY_ATTEMPTS ?? 3),
  mlServiceUrl: process.env.ML_SERVICE_URL ?? 'http://ml:8000',
  exposeDebugOtp: (process.env.EXPOSE_DEBUG_OTP ?? 'false') === 'true',
  trustProxy: (process.env.TRUST_PROXY ?? 'false') === 'true'
};
