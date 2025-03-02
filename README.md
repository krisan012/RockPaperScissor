# Dockerized Laravel & Vue.js Rock-Paper-Scissors Game
![Alt text](main_app.png)
## Prerequisites
- Docker (my version v4.38)
- Docker Compose

## Project Structure
- `backend/`: Laravel API (runs on port 8000)
- `frontend/`: Vue.js application (runs on port 5173)

## How to Run
1️⃣. Clone the repository:
   ```bash
   git clone https://github.com/krisan012/RockPaperScissor
   ```
```bash
cd RockPaperScissor
```

```bash
cp backend/.env.example backend/.env
```
```bash
cp frontend/.env.example frontend/.env
```

2️⃣ Composer install
```bash
cd backend
```
```bash
composer install
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

## Running Unit Tests

Laravel provides built-in support for running tests using **PHPUnit**. The tests in this project verify the logic for playing rounds in a rock-paper-scissors game.

### 1. Running the `Game10RoundsTest`
This test plays 10 rounds using API calls and verifies the summary.

**Run the test:**
```sh
php artisan test --filter Game10RoundsTest
```
or
```sh
vendor/bin/phpunit --filter Game10RoundsTest
```

### 2. Running the `GameServiceTest`
This test directly checks the game logic using a fake player.

**Run the test:**
```sh
php artisan test --filter GameServiceTest
```

## Running All Tests
To run **all** tests in the project, use:
```sh
php artisan test
```
or
```sh
vendor/bin/phpunit
```

## Understanding the Tests

### `Game10RoundsTest`
- Simulates 10 rounds using the API.
- Ensures the response structure is correct.
- Fetches the summary and verifies that the total rounds played is 10.

### `GameServiceTest`
- Uses a `FakePlayer` to simulate different scenarios.
- Tests for:
    - **Winning** (`test_player_2_wins`)
    - **Losing** (`testPlayerLoses`)
    - **Draws** (`testDraw`)