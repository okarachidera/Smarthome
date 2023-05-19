import axios from 'axios';
import { PredictionRequest } from '../types';
import { env } from '../utils/env';

export async function predictActivity(payload: PredictionRequest): Promise<Record<string, unknown>> {
  const response = await axios.post(`${env.mlServiceUrl}/predict-activity`, payload, {
    timeout: 5000
  });
  return response.data;
}

export async function predictActivityTime(payload: Omit<PredictionRequest, 'hour'>): Promise<Record<string, unknown>> {
  const response = await axios.post(`${env.mlServiceUrl}/predict-activity-time`, payload, {
    timeout: 5000
  });
  return response.data;
}
