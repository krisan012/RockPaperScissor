# Dockerized Laravel & Vue.js Rock-Paper-Scissors Game
![Alt text](main_app.png)
## Prerequisites
- Docker
- Docker Compose

## Project Structure
- `backend/`: Laravel API (runs on port 8000)
- `frontend/`: Vue.js application (runs on port 5173)

## How to Run
1️⃣. Clone the repository:
   ```bash
   git clone https://github.com/krisan012/RockPaperScissor
   ```

2️⃣ Composer install
```bash
cd RockPaperScissor/backend
```
```bash
composer install
```

[//]: # (   ```)

[//]: # (   cp backend/.env.example backend/.env)

[//]: # (   cp frontend/.env.example frontend/.env)

[//]: # (   ```)

>⚙️ Environment Variables

Backend (backend/.env)

```env
APP_KEY=your-app-key
REDIS_HOST=redis
```

Frontend (frontend/.env)

```dotenv
VITE_API_URL=http://localhost:8000
```

3️⃣ Run Docker Containers
Run the following command to build and start all services:
```shell
docker-compose up -d --build
```

4️⃣ Access the Application

Service	URL
```
http://localhost:5173
```

📂 Project Structure
```bash
/project
├── backend/       # Laravel API
├── frontend/      # Vue.js Frontend
├── docker/        # Docker configuration
├── docker-compose.yml
├── README.md
```

