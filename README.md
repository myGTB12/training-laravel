# Laravel Base Project with Docker

This is a base Laravel project configured to run in a Docker environment using Docker Compose, allowing for quick setup and consistent development across machines.

## Project Structure


## Requirements
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Getting Started

### 1. Clone the repository
```bash
git clone <repository-url> project-name
```

### 2. Configure Laravel environment
```bash
cp src/.env.example src/.env
```
### 3. Start Docker containers
```bash
docker-compose up -d --build
docker exec -it php bash
```
### 4. Install Laravel dependencies
```bash
composer install
php artisan key:generate
php artisan migrate
```
