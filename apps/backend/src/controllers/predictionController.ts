import { Request, Response } from 'express';
import { deviceEvents } from '../models/store';
import { predictActivity, predictActivityTime } from '../services/mlService';

function stdDev(values: number[]): number {
  if (values.length === 0) {
    return 0;
  }

  const mean = values.reduce((sum, value) => sum + value, 0) / values.length;
  const variance = values.reduce((sum, value) => sum + (value - mean) ** 2, 0) / values.length;
  return Number(Math.sqrt(variance).toFixed(6));
}

export async function getPrediction(req: Request, res: Response): Promise<void> {
  try {
    const { location, hour, device, day_of_week, occupancy } = req.query;

    if (!location || hour === undefined || !device || day_of_week === undefined || occupancy === undefined) {
      res.status(400).json({
        error: 'location, hour, device, day_of_week, occupancy query params are required'
      });
      return;
    }

    const prediction = await predictActivity({
      location: String(location),
      hour: Number(hour),
      device: String(device) as any,
      day_of_week: Number(day_of_week),
      occupancy: Number(occupancy)
    });

    res.status(200).json(prediction);
  } catch (error) {
    res.status(502).json({ error: 'ML service unavailable', details: (error as Error).message });
  }
}

export async function getDeviationReport(req: Request, res: Response): Promise<void> {
  try {
    const username = String(req.query.username ?? '');
    const limit = Number(req.query.limit ?? 20);

    const source = username
      ? deviceEvents.filter((event) => event.username === username).slice(-limit)
      : deviceEvents.slice(-limit);

    const predictions = await Promise.all(
      source.map(async (event) => {
        const eventTime = new Date(event.timestamp);
        const actualHour = eventTime.getHours();
        const dayOfWeek = eventTime.getDay();
        const occupancy = event.occupancy ?? 1;

        const predicted = await predictActivityTime({
          location: event.location,
          device: event.device,
          day_of_week: dayOfWeek,
          occupancy
        });

        const predictedHour = Number(predicted.predicted_hour ?? 0);
        const deviation = Number(Math.abs(actualHour - predictedHour).toFixed(6));

        return {
          row: {
            date: event.timestamp.slice(0, 10),
            device: event.device,
            status: event.state === 1 ? 'on' : 'off',
            actual_time: Number(actualHour.toFixed(2)),
            predicted_time: Number(predictedHour.toFixed(2)),
            standard_deviation: deviation
          },
          deviation
        };
      })
    );

    const rows = predictions.map((item) => item.row);
    const deviations = predictions.map((item) => item.deviation);

    res.status(200).json({
      samples: rows.length,
      population_standard_deviation: stdDev(deviations),
      rows
    });
  } catch (error) {
    res.status(502).json({ error: 'ML service unavailable', details: (error as Error).message });
  }
}
