# Security Policy

## Reporting a Vulnerability
If you discover a security issue, please report it privately by opening a private security advisory on GitHub or by contacting the maintainer directly.

Please include:
- affected component/file
- reproduction steps
- impact assessment
- suggested fix (if available)

Do not open public issues for active vulnerabilities.

## Security Notes for This Project
- OTP debug mode (`EXPOSE_DEBUG_OTP`) should remain `false` outside local testing.
- `.env` must never be committed.
- This project is a research implementation and should not be treated as production-critical infrastructure without additional hardening.
