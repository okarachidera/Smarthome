from pathlib import Path
import joblib
import pandas as pd
from sklearn.compose import ColumnTransformer
from sklearn.neural_network import MLPClassifier
from sklearn.pipeline import Pipeline
from sklearn.preprocessing import OneHotEncoder, StandardScaler

BASE_DIR = Path(__file__).resolve().parents[1]
DEFAULT_DATASET = BASE_DIR / "data" / "device_activity.csv"
MODEL_PATH = BASE_DIR / "models" / "activity_model.joblib"


def build_pipeline() -> Pipeline:
    preprocessor = ColumnTransformer(
        transformers=[
            ("categorical", OneHotEncoder(handle_unknown="ignore"), ["location", "device"]),
            ("numerical", StandardScaler(), ["hour", "day_of_week", "occupancy"]),
        ]
    )

    model = MLPClassifier(
        hidden_layer_sizes=(16, 8),
        activation="relu",
        max_iter=500,
        random_state=42,
    )

    return Pipeline([("preprocess", preprocessor), ("classifier", model)])


def train_model(dataset_path: str | None = None) -> dict:
    source_path = Path(dataset_path) if dataset_path else DEFAULT_DATASET
    if not source_path.is_absolute():
        source_path = BASE_DIR / source_path

    data = pd.read_csv(source_path)
    x = data[["location", "hour", "device", "day_of_week", "occupancy"]]
    y = data["state"]

    pipeline = build_pipeline()
    pipeline.fit(x, y)

    MODEL_PATH.parent.mkdir(parents=True, exist_ok=True)
    joblib.dump(pipeline, MODEL_PATH)

    score = float(pipeline.score(x, y))
    return {
        "dataset": str(source_path),
        "samples": int(len(data)),
        "training_accuracy": round(score, 4),
        "model_path": str(MODEL_PATH),
    }


def load_model() -> Pipeline:
    if not MODEL_PATH.exists():
        train_model(str(DEFAULT_DATASET))
    return joblib.load(MODEL_PATH)


def predict_activity(sample: dict) -> dict:
    model = load_model()
    frame = pd.DataFrame([sample])
    prediction = int(model.predict(frame)[0])

    if hasattr(model, "predict_proba"):
        proba = float(max(model.predict_proba(frame)[0]))
    else:
        proba = 0.5

    return {
        "predicted_state": prediction,
        "label": "ON" if prediction == 1 else "OFF",
        "confidence": round(proba, 4),
    }


def predict_activity_time(sample: dict) -> dict:
    model = load_model()

    candidates = []
    for hour in range(24):
        candidates.append(
            {
                "location": sample["location"],
                "hour": hour,
                "device": sample["device"],
                "day_of_week": sample["day_of_week"],
                "occupancy": sample["occupancy"],
            }
        )

    frame = pd.DataFrame(candidates)

    if hasattr(model, "predict_proba"):
        proba = model.predict_proba(frame)
        classes = list(model.classes_)
        on_index = classes.index(1) if 1 in classes else int(proba.shape[1] - 1)
        on_probs = proba[:, on_index]
    else:
        preds = model.predict(frame)
        on_probs = [1.0 if pred == 1 else 0.0 for pred in preds]

    best_hour = int(pd.Series(on_probs).idxmax())
    confidence = float(on_probs[best_hour])

    return {
        "predicted_hour": best_hour,
        "predicted_time": f"{best_hour:02d}.00",
        "confidence": round(confidence, 4),
    }
