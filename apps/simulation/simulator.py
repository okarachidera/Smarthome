import random
import time
from datetime import datetime
import requests

BACKEND_URL = "http://localhost:3000"

SCENARIOS = [
    {"location": "living_room", "device": "light", "context": "reading", "state": 1},
    {"location": "living_room", "device": "tv", "context": "watching_news", "state": 1},
    {"location": "bedroom", "device": "ac", "context": "sleeping", "state": 1},
    {"location": "entrance", "device": "door", "context": "arriving_home", "state": 1},
    {"location": "kitchen", "device": "refrigerator", "context": "meal_prep", "state": 1},
]


def login_and_verify(username: str, password: str) -> None:
    login_res = requests.post(f"{BACKEND_URL}/login", json={"username": username, "password": password}, timeout=5)
    login_res.raise_for_status()
    payload = login_res.json()
    otp = payload.get("debugOtp")
    if not otp:
        raise RuntimeError("OTP was not exposed in response. Set EXPOSE_DEBUG_OTP=true for local simulation.")

    verify_res = requests.post(
        f"{BACKEND_URL}/verify-otp",
        json={"username": username, "otp": otp},
        timeout=5,
    )
    verify_res.raise_for_status()


def send_events(username: str, n_events: int = 10) -> None:
    for _ in range(n_events):
        scenario = random.choice(SCENARIOS)
        payload = {
            "username": username,
            "location": scenario["location"],
            "device": scenario["device"],
            "state": scenario["state"],
            "context": scenario["context"],
            "timestamp": datetime.utcnow().isoformat(),
        }
        res = requests.post(f"{BACKEND_URL}/device/event", json=payload, timeout=5)
        print(res.status_code, res.json())
        time.sleep(0.5)


if __name__ == "__main__":
    login_and_verify("researcher", "SecureHome123!")
    send_events("researcher", n_events=12)
