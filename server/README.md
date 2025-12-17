# EduTrack Server (minimal scaffold)

This is a minimal Express + MySQL scaffold for the EduTrack frontend in the workspace.

Setup

1. Copy `.env.example` to `.env` and fill database credentials.
2. Install dependencies:

```bash
cd server
npm install
```

3. Start server:

```bash
npm start
```

API

- `POST /api/login` { nrp, password, role }
- `GET /api/mhs/profile?nrp=...`
- `GET /api/dosen/profile?nrp=...`
- `GET /api/admin/profile?nrp=...`

Notes

- Adjust SQL queries in `server/routes/*` to match your actual DB schema.
- Passwords are compared as plaintext in this scaffold — use bcrypt in production.
