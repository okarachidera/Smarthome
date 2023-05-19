import request from 'supertest';
import app from '../src/app';
import { deviceEvents } from '../src/models/store';

jest.mock('../src/services/mlService', () => ({
  predictActivity: jest.fn(),
  predictActivityTime: jest.fn().mockResolvedValue({ predicted_hour: 10, predicted_time: '10.00', confidence: 0.8 })
}));

describe('prediction deviation report', () => {
  beforeEach(() => {
    deviceEvents.length = 0;
  });

  test('returns report rows with deterministic deviation values', async () => {
    deviceEvents.push(
      {
        timestamp: new Date().toISOString(),
        username: 'researcher',
        location: 'living_room',
        device: 'light',
        state: 1,
        context: 'reading',
        occupancy: 1
      },
      {
        timestamp: new Date().toISOString(),
        username: 'researcher',
        location: 'bedroom',
        device: 'ac',
        state: 0,
        context: 'sleep',
        occupancy: 0
      }
    );

    const res = await request(app).get('/prediction/deviation-report').query({ username: 'researcher', limit: 10 });

    expect(res.status).toBe(200);
    expect(res.body.samples).toBe(2);
    expect(Array.isArray(res.body.rows)).toBe(true);
    expect(res.body.rows).toHaveLength(2);

    for (const row of res.body.rows) {
      expect(typeof row.actual_time).toBe('number');
      expect(row.predicted_time).toBe(10);
      expect(row.standard_deviation).toBe(Math.abs(row.actual_time - row.predicted_time));
    }

    expect(typeof res.body.population_standard_deviation).toBe('number');
  });
});
