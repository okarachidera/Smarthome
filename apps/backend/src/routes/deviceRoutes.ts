import { Router } from 'express';
import { createDeviceEvent } from '../controllers/deviceController';

const router = Router();
router.post('/device/event', createDeviceEvent);

export default router;
