import { Request, Response } from 'express';
import { loginAndGenerateOtp, verifyOtp } from '../services/securityService';

export function login(req: Request, res: Response): void {
  const { username, password } = req.body;
  const ipAddress = req.ip || req.socket.remoteAddress || '0.0.0.0';

  if (!username || !password) {
    res.status(400).json({ error: 'username and password are required' });
    return;
  }

  const result = loginAndGenerateOtp({ username, password, ipAddress });
  if (!result.ok) {
    const statusCode = result.message.startsWith('IP blocked') ? 403 : 401;
    res.status(statusCode).json({ error: result.message });
    return;
  }

  res.status(200).json({ message: result.message, ...(result.debugOtp ? { debugOtp: result.debugOtp } : {}) });
}

export function verify(req: Request, res: Response): void {
  const { username, otp } = req.body;
  const ipAddress = req.ip || req.socket.remoteAddress || '0.0.0.0';

  if (!username || !otp) {
    res.status(400).json({ error: 'username and otp are required' });
    return;
  }

  const result = verifyOtp(username, otp, ipAddress);
  if (!result.ok) {
    const statusCode = result.message.startsWith('IP blocked') ? 403 : 401;
    res.status(statusCode).json({ error: result.message });
    return;
  }

  res.status(200).json({ message: result.message });
}
