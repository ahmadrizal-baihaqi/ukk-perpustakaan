# Libera School Library System

Libera is a web-based school library (book borrowing) management system built on the [Laravel](https://laravel.com/) framework. It provides distinct interfaces for Students (to borrow/return books) and Administrators (to manage inventory, categories, users, and view reports).

## 📚 Technical Documentation

Comprehensive documentation has been generated in the `docs/` folder:

*   [Database Schema & ERD](docs/database_schema.md)
*   [API Routes & Backend Logic](docs/api_routes.md)
*   [Frontend UI & Views](docs/frontend_ui.md)

## ✨ Features

*   **Role-Based Access Control**: Secure login distinguishing between Admin and User roles using Laravel Breeze.
*   **Inventory Management**: Admins can full-CRUD Books (including cover uploads) and Categories.
*   **Borrowing Flow**: Students can borrow books dynamically (1-14 days). Stock limits are enforced.
*   **Return Flow**: Automated stock replenishment upon book return.
*   **Reporting**: Detailed transaction history accessible to Administrators.
*   **Tailwind UI**: Fully responsive frontend views.

## 🚀 Installation & Setup Guide

### Prerequisites

*   PHP >= 8.2
*   Composer
*   Node.js & npm
*   SQLite / MySQL (SQLite by default)

### Step-by-step Installation

1. **Clone the repository** (if applicable) or navigate to the project directory:

    ```bash
    cd libera
    ```

2. **Install PHP dependencies**:

    ```bash
    composer install
    ```

3. **Install NPM dependencies**:

    ```bash
    npm install
    ```

4. **Environment Setup**:

    Copy the example environment file:
    ```bash
    cp .env.example .env
    ```
    
    Generate the application key:
    ```bash
    php artisan key:generate
    ```

5. **Database Configuration**:

    By default, the project uses SQLite. You can create the database file manually:
    ```bash
    touch database/database.sqlite
    ```
    *(Note: If you're on Windows, simply create an empty `database.sqlite` file in the `database` folder).*
    
    Alternatively, if you wish to use MySQL, update the `.env` file accordingly:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=libera_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Run Migrations & Seeders**:

    Migrate the database schema (and seed if applicable):
    ```bash
    php artisan migrate
    ```
    *(Use `php artisan migrate --seed` if a database seeder for admin accounts is present).*

7. **Link Storage**:

    This step is required because book covers are saved into the `storage/app/public` directory.
    ```bash
    php artisan storage:link
    ```

8. **Start the localized servers**:

    Run the frontend compiler (Vite) in terminal 1:
    ```bash
    npm run dev
    ```
    
    Run the Laravel server in terminal 2:
    ```bash
    php artisan serve
    ```

    The application will now be accessible at `http://127.0.0.1:8000`.

## 🔒 Default Accounts

To assign an Admin account, register a new user normally via the `http://127.0.0.1:8000/register` page, then manually update the `role` field from `user` to `admin` directly within your database manager (SQLite or MySQL). All newly registered users default to the standard student `user` role.
