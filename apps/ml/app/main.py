from fastapi import FastAPI, HTTPException
from .schemas import ActivitySample, ActivityTimeSample, TrainRequest
from .model_service import predict_activity, predict_activity_time, train_model

app = FastAPI(
    title="Smart Home Activity ML Service",
    description="Research-aligned activity prediction service for smart home simulation",
    version="1.0.0",
)


@app.get("/health")
def health() -> dict:
    return {"status": "ok"}


@app.post("/train-model")
def train(request: TrainRequest) -> dict:
    try:
        result = train_model(request.dataset_path)
        return {"message": "Model trained", **result}
    except Exception as exc:  # noqa: BLE001
        raise HTTPException(status_code=400, detail=str(exc)) from exc


@app.post("/predict-activity")
def predict(sample: ActivitySample) -> dict:
    try:
        return predict_activity(sample.model_dump())
    except Exception as exc:  # noqa: BLE001
        raise HTTPException(status_code=500, detail=str(exc)) from exc


@app.post("/predict-activity-time")
def predict_time(sample: ActivityTimeSample) -> dict:
    try:
        return predict_activity_time(sample.model_dump())
    except Exception as exc:  # noqa: BLE001
        raise HTTPException(status_code=500, detail=str(exc)) from exc
