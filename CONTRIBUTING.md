# Contributing

Thanks for your interest in contributing.

## Scope
This repository is a research-aligned smart home project. Please keep contributions focused on:
- activity prediction from IoT-style device data
- OTP and dictionary-attack security logic
- simulator and reproducibility improvements
- tests, docs, and maintainability

Please avoid unrelated product features outside the research direction.

## Development Setup
1. Copy env:
```bash
cp .env.example .env
```
2. Run services:
```bash
docker compose up --build
```
3. Backend tests:
```bash
cd apps/backend
npm install
npm test
```

## Pull Request Checklist
- Keep changes small and focused.
- Add/update tests for behavioral changes.
- Update docs for new endpoints/config.
- Do not commit secrets or local `.env` files.
- Ensure style and naming remain consistent with existing code.

## Commit Guidance
Use clear, imperative commit messages, for example:
- `Add OTP expiry test for authentication flow`
- `Refactor prediction report to parallelize ML calls`
