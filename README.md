## Prerequisites

Required software and tools
- PHP 8.0+
- MySQL
- [Composer](https://getcomposer.org/download/)

## Setup and Run The Project

1. Clone this repository to your working directory:
    ```bash
    git clone https://github.com/muadz-mr/task-api.git <whatever-folder-name-you-want>
    ```
2. Go inside the folder and run:
    ```bash
    composer install
    ```
3. Copy `.env.example` file to `.env` on the root of the folder.
4. Edit database variables according to your need:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task
    DB_USERNAME="your database username"
    DB_PASSWORD="your database password"
    ```
5. Generate application key with: `php artisan key:generate`
6. Run migration to create tables in database with: `php artisan migrate`
7. Run server with: `php artisan serve`
    - Server will run on http://localhost:8000