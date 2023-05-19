import request from 'supertest';
import app from '../src/app';
import { blockedIps, loginAttempts, otpAttempts, otpSessions } from '../src/models/store';

describe('auth and security flow', () => {
  beforeEach(() => {
    blockedIps.clear();
    otpSessions.clear();
    loginAttempts.length = 0;
    otpAttempts.length = 0;
  });

  test('generates OTP after valid login and verifies it', async () => {
    const loginRes = await request(app).post('/login').send({
      username: 'researcher',
      password: 'SecureHome123!'
    });

    expect(loginRes.status).toBe(200);
    expect(loginRes.body.message).toContain('OTP sent via email and SMS');

    const otp = otpSessions.get('researcher')?.otp;
    expect(otp).toBeDefined();

    const verifyRes = await request(app).post('/verify-otp').send({
      username: 'researcher',
      otp
    });

    expect(verifyRes.status).toBe(200);
    expect(verifyRes.body.message).toBe('OTP validated');
  });

  test('rejects OTP after expiry window', async () => {
    await request(app).post('/login').send({
      username: 'researcher',
      password: 'SecureHome123!'
    });

    const session = otpSessions.get('researcher');
    expect(session).toBeDefined();

    if (!session) {
      throw new Error('OTP session was not created');
    }

    session.expiresAt = Date.now() - 1000;
    otpSessions.set('researcher', session);

    const verifyRes = await request(app).post('/verify-otp').send({
      username: 'researcher',
      otp: session.otp
    });

    expect(verifyRes.status).toBe(401);
    expect(verifyRes.body.error).toBe('OTP expired');
  });

  test('blocks likely dictionary attack from repeated weak passwords', async () => {
    for (let i = 0; i < 5; i += 1) {
      await request(app)
        .post('/login')
        .set('X-Forwarded-For', '10.0.0.50')
        .send({ username: 'researcher', password: 'password' });
    }

    const blockedAttempt = await request(app)
      .post('/login')
      .set('X-Forwarded-For', '10.0.0.50')
      .send({ username: 'researcher', password: 'SecureHome123!' });

    expect(blockedAttempt.status).toBe(403);
    expect(blockedAttempt.body.error).toContain('IP blocked');
  });

  test('requires OTP verification before device events are accepted', async () => {
    const noOtpRes = await request(app).post('/device/event').send({
      username: 'resident_a',
      location: 'living_room',
      device: 'light',
      state: 1,
      context: 'evening_reading'
    });

    expect(noOtpRes.status).toBe(403);

    await request(app).post('/login').send({
      username: 'resident_a',
      password: 'LivingRoom@2026'
    });

    const otp = otpSessions.get('resident_a')?.otp;
    await request(app).post('/verify-otp').send({ username: 'resident_a', otp });

    const eventRes = await request(app).post('/device/event').send({
      username: 'resident_a',
      location: 'living_room',
      device: 'light',
      state: 1,
      context: 'evening_reading',
      occupancy: 1
    });

    expect(eventRes.status).toBe(201);
    expect(eventRes.body.event.device).toBe('light');
  });
});
