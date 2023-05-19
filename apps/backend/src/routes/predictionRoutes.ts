import { Router } from 'express';
import { getDeviationReport, getPrediction } from '../controllers/predictionController';

const router = Router();
router.get('/prediction', getPrediction);
router.get('/prediction/deviation-report', getDeviationReport);

export default router;
