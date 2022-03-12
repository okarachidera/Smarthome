from pydantic import BaseModel, Field


class ActivitySample(BaseModel):
    location: str = Field(..., examples=["living_room"])
    hour: int = Field(..., ge=0, le=23)
    device: str = Field(..., examples=["light"])
    day_of_week: int = Field(..., ge=0, le=6)
    occupancy: int = Field(..., ge=0, le=1)


class ActivityTimeSample(BaseModel):
    location: str = Field(..., examples=["living_room"])
    device: str = Field(..., examples=["light"])
    day_of_week: int = Field(..., ge=0, le=6)
    occupancy: int = Field(..., ge=0, le=1)


class TrainRequest(BaseModel):
    dataset_path: str = Field(default="data/device_activity.csv")


class PredictionResponse(BaseModel):
    predicted_state: int
    label: str
    confidence: float
