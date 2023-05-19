import express from 'express';
import helmet from 'helmet';
import morgan from 'morgan';
import authRoutes from './routes/authRoutes';
import deviceRoutes from './routes/deviceRoutes';
import predictionRoutes from './routes/predictionRoutes';
import { errorHandler, notFoundHandler } from './middleware/errorHandler';
import { env } from './utils/env';

const app = express();

if (env.trustProxy) {
  app.set('trust proxy', 1);
}

app.use(helmet());
app.use(morgan('dev'));
app.use(express.json());

app.get('/health', (_req, res) => {
  res.status(200).json({ status: 'ok' });
});

app.use(authRoutes);
app.use(deviceRoutes);
app.use(predictionRoutes);

app.use(notFoundHandler);
app.use(errorHandler);

export default app;
