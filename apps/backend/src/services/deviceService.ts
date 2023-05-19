import { deviceEvents } from '../models/store';
import { DeviceEvent } from '../types';

export function logDeviceEvent(event: DeviceEvent): DeviceEvent {
  deviceEvents.push(event);
  return event;
}

export function getRecentEvents(limit = 20): DeviceEvent[] {
  return deviceEvents.slice(-limit);
}
