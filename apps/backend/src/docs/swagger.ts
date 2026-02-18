import { Express } from 'express';
import swaggerUi from 'swagger-ui-express';

const openApiSpec = {
  openapi: '3.0.3',
  info: {
    title: 'Smart Home Backend API',
    version: '1.0.0',
    description: 'Research-aligned backend for OTP security, dictionary attack detection, and smart home activity prediction.'
  },
  servers: [{ url: 'http://localhost:3000' }],
  tags: [{ name: 'Health' }, { name: 'Auth' }, { name: 'Devices' }, { name: 'Prediction' }],
  components: {
    schemas: {
      LoginRequest: {
        type: 'object',
        required: ['username', 'password'],
        properties: {
          username: { type: 'string', example: 'researcher' },
          password: { type: 'string', example: 'SecureHome123!' }
        }
      },
      VerifyOtpRequest: {
        type: 'object',
        required: ['username', 'otp'],
        properties: {
          username: { type: 'string', example: 'researcher' },
          otp: { type: 'string', example: '123456' }
        }
      },
      DeviceEventRequest: {
        type: 'object',
        required: ['username', 'location', 'device', 'state', 'context'],
        properties: {
          username: { type: 'string', example: 'researcher' },
          location: { type: 'string', example: 'living_room' },
          device: {
            type: 'string',
            enum: ['light', 'ac', 'door', 'tv', 'refrigerator'],
            example: 'light'
          },
          state: { type: 'integer', enum: [0, 1], example: 1 },
          context: { type: 'string', example: 'reading' },
          occupancy: { type: 'integer', enum: [0, 1], example: 1 }
        }
      }
    }
  },
  paths: {
    '/health': {
      get: {
        tags: ['Health'],
        summary: 'Backend health check',
        responses: {
          200: {
            description: 'Service healthy',
            content: {
              'application/json': {
                schema: { type: 'object', properties: { status: { type: 'string', example: 'ok' } } }
              }
            }
          }
        }
      }
    },
    '/login': {
      post: {
        tags: ['Auth'],
        summary: 'Validate credentials and issue OTP',
        requestBody: {
          required: true,
          content: {
            'application/json': {
              schema: { $ref: '#/components/schemas/LoginRequest' }
            }
          }
        },
        responses: {
          200: { description: 'OTP issued' },
          401: { description: 'Invalid credentials' },
          403: { description: 'Blocked by security policy' }
        }
      }
    },
    '/verify-otp': {
      post: {
        tags: ['Auth'],
        summary: 'Verify OTP and unlock authenticated session',
        requestBody: {
          required: true,
          content: {
            'application/json': {
              schema: { $ref: '#/components/schemas/VerifyOtpRequest' }
            }
          }
        },
        responses: {
          200: { description: 'OTP validated' },
          401: { description: 'Invalid or expired OTP' },
          403: { description: 'Blocked by security policy' }
        }
      }
    },
    '/device/event': {
      post: {
        tags: ['Devices'],
        summary: 'Record smart home device event',
        requestBody: {
          required: true,
          content: {
            'application/json': {
              schema: { $ref: '#/components/schemas/DeviceEventRequest' }
            }
          }
        },
        responses: {
          201: { description: 'Event logged' },
          400: { description: 'Validation error' },
          403: { description: 'OTP required' }
        }
      }
    },
    '/prediction': {
      get: {
        tags: ['Prediction'],
        summary: 'Predict device ON/OFF state',
        parameters: [
          { name: 'location', in: 'query', required: true, schema: { type: 'string' } },
          { name: 'hour', in: 'query', required: true, schema: { type: 'integer' } },
          {
            name: 'device',
            in: 'query',
            required: true,
            schema: { type: 'string', enum: ['light', 'ac', 'door', 'tv', 'refrigerator'] }
          },
          { name: 'day_of_week', in: 'query', required: true, schema: { type: 'integer' } },
          { name: 'occupancy', in: 'query', required: true, schema: { type: 'integer', enum: [0, 1] } }
        ],
        responses: {
          200: { description: 'Prediction response from ML service' },
          400: { description: 'Missing query params' },
          502: { description: 'ML service unavailable' }
        }
      }
    },
    '/prediction/deviation-report': {
      get: {
        tags: ['Prediction'],
        summary: 'Generate actual vs predicted time deviation report',
        parameters: [
          { name: 'username', in: 'query', required: false, schema: { type: 'string' } },
          { name: 'limit', in: 'query', required: false, schema: { type: 'integer', default: 20 } }
        ],
        responses: {
          200: { description: 'Deviation report generated' },
          502: { description: 'ML service unavailable' }
        }
      }
    }
  }
};

export function registerSwagger(app: Express): void {
  app.use('/api-docs', swaggerUi.serve, swaggerUi.setup(openApiSpec));
}
