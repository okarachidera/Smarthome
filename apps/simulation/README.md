# Smart Home Simulation

Simple simulated environment for research-aligned device activity generation.

## Devices
- light
- ac
- door
- tv
- refrigerator

## Run
```bash
cd apps/simulation
python3 -m venv .venv
source .venv/bin/activate
pip install -r requirements.txt
python simulator.py
```

The script logs in with OTP flow and emits device events to `POST /device/event`.
For local simulation it reads `debugOtp` from `/login`, so keep `EXPOSE_DEBUG_OTP=true` in backend env.
