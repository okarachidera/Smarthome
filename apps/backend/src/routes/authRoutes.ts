import { Router } from 'express';
import { login, verify } from '../controllers/authController';

const router = Router();
router.post('/login', login);
router.post('/verify-otp', verify);

export default router;
