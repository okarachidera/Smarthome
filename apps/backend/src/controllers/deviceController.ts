import { Request, Response } from 'express';
import { logDeviceEvent } from '../services/deviceService';
import { isVerifiedUser } from '../services/securityService';

export function createDeviceEvent(req: Request, res: Response): void {
  const { username, location, device, state, context, occupancy } = req.body;
  if (!username || !location || !device || (state !== 0 && state !== 1) || !context) {
    res.status(400).json({ error: 'username, location, device, state(0/1), context are required' });
    return;
  }

  if (occupancy !== undefined && occupancy !== 0 && occupancy !== 1) {
    res.status(400).json({ error: 'occupancy must be 0 or 1 when provided' });
    return;
  }

  if (!isVerifiedUser(username)) {
    res.status(403).json({ error: 'OTP verification required' });
    return;
  }

  const event = logDeviceEvent({
    timestamp: new Date().toISOString(),
    username,
    location,
    device,
    state,
    context,
    occupancy: occupancy ?? 1
  });

  res.status(201).json({ message: 'Device event logged', event });
}
