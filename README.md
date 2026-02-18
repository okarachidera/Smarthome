# Smart Home Activity Prediction (MSc Research Project)

This repository is a cleaned-up rebuild of my 2021 MSc smart home research project:

**Predicting Home User Activities in a Secured Smart Home Using IoT and Deep Learning**

The goal is the same as the original work:
- predict home device usage (ON/OFF) from historical activity data
- secure access with OTP
- detect and respond to dictionary-style attacks

I kept the research direction and modernized the implementation.

## Project layout

```text
apps/
  backend/      Node.js + TypeScript API (auth, device events, security checks)
  ml/           FastAPI service for model training and prediction
  simulation/   local smart-home event simulator
docs/
  architecture.md
  research-alignment.md
```

## What is implemented

### 1) Backend API
Endpoints:
- `POST /login`
- `POST /verify-otp`
- `POST /device/event`
- `GET /prediction`
- `GET /prediction/deviation-report`
- `GET /health`

Behavior:
- OTP is generated after valid login
- OTP expires in 10 minutes
- device events are accepted only after OTP verification
- dictionary attack checks run during login and OTP phases
- suspicious activity can trigger notify/block actions
- security events are logged to `apps/backend/data/security-events.jsonl`

### 2) ML service
Endpoints:
- `POST /train-model`
- `POST /predict-activity`
- `POST /predict-activity-time`
- `GET /health`

Model:
- simple neural network classifier (`MLPClassifier`)
- trained on historical smart-home activity dataset
- predicts ON/OFF state and likely activity hour

### 3) Simulation
- simulates events for `light`, `ac`, `door`, `tv`, `refrigerator`
- runs login + OTP + event submission flow against backend

## Run locally with Docker

1. Create env file:
```bash
cp .env.example .env
```

2. For manual OTP testing, temporarily enable debug OTP in `.env`:
```bash
EXPOSE_DEBUG_OTP=true
```

3. Start services:
```bash
docker compose up --build
```

4. Train model:
```bash
curl -X POST http://localhost:8000/train-model \
  -H "Content-Type: application/json" \
  -d '{"dataset_path":"data/device_activity.csv"}'
```

## API Docs

- Backend Swagger UI: `http://localhost:3000/api-docs`
- ML Swagger UI (FastAPI): `http://localhost:8000/docs`

## Quick API check

Login:
```bash
curl -X POST http://localhost:3000/login \
  -H "Content-Type: application/json" \
  -d '{"username":"researcher","password":"SecureHome123!"}'
```

Verify OTP:
```bash
curl -X POST http://localhost:3000/verify-otp \
  -H "Content-Type: application/json" \
  -d '{"username":"researcher","otp":"<debugOtp_from_login_response>"}'
```

Create event:
```bash
curl -X POST http://localhost:3000/device/event \
  -H "Content-Type: application/json" \
  -d '{"username":"researcher","location":"living_room","device":"light","state":1,"context":"reading","occupancy":1}'
```

Get prediction:
```bash
curl "http://localhost:3000/prediction?location=living_room&hour=20&device=tv&day_of_week=5&occupancy=1"
```

Get deviation report:
```bash
curl "http://localhost:3000/prediction/deviation-report?username=researcher&limit=10"
```

## Simulator run (optional)

```bash
cd apps/simulation
python3 -m venv .venv
source .venv/bin/activate
pip install -r requirements.txt
python simulator.py
```

## Notes
- `EXPOSE_DEBUG_OTP` defaults to `false` for safety.
- `TRUST_PROXY` defaults to `false`. Set it to `true` only when running behind a trusted reverse proxy.
- For production-style deployment, disable debug OTP and plug in real email/SMS providers.
