from app.model_service import train_model


if __name__ == "__main__":
    result = train_model("data/device_activity.csv")
    print(result)
