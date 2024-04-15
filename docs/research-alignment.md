# Research Alignment Matrix

## Original Thesis Objective
Predict home user activities in a secured smart home environment using IoT and deep learning.

## Implementation Mapping
- Smart home devices: simulated `light`, `ac`, `door`, `tv`, `refrigerator`.
- IoT activity logging: `POST /device/event` records timestamped usage events.
- Deep learning prediction: FastAPI service trains an MLP model from historical data and predicts ON/OFF behavior.
- Time-based activity output: `POST /predict-activity-time` and backend deviation report emulate actual-vs-predicted tables.
- OTP security: login requires OTP generation and `POST /verify-otp` validation with 10-minute expiry.
- Dictionary attack mitigation: decision-tree security logic checks username/password phase and OTP phase, stores source IP, logs phrase signals, and triggers block/notify actions.

## Scope Guardrails
- No SaaS billing, tenant management, cloud orchestration, or unrelated dashboarding.
- Focuses on research demonstrability, reproducibility, and architecture clarity.

## Demonstration Outcomes
- Reproducible local run with Docker.
- Explicit security and prediction endpoints.
- Readable architecture and flows suitable for academic and portfolio review.
