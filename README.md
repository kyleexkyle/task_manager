## About Task Manager
Task Manager is a web application that allows project managers to manage their tasks efficiently

## How to install
1. clone the project
2. composer install
3. cp .env.example .env
4. php artisan key:generate
5. php artisan migrate (remember to modify you .env file first before migrating)
6. npm install
7. npm run dev (compile for development) OR npm run build (compile for production)

## Directory Structure
This project is built following DDD. you can find the Application & Domain logics inside the src directory






