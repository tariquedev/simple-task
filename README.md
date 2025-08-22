# Simple Laravel Task Manager

A straightforward task management application built with the Laravel framework.


## Prerequisites

Before you begin, ensure you have the following installed on your local machine:

  * PHP \>= 8.1
  * [Composer](https://getcomposer.org/)
  * [Node.js](https://nodejs.org/) & NPM if needed
  * A database server like MySQL


## Local Setup & Installation

Follow these steps to get the project running on your local server.

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/tariquedev/simple-task
    cd simple-task
    ```

2.  **Install PHP Dependencies:**
    Use Composer to install the required PHP packages if you haven't on your machine otherwise skip this step.

    ```bash
    composer install
    ```

3.  **Create Environment File:**
    Copy the example environment file and generate your application key.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure `.env` file:**
    Open the **`.env`** file and update the database credentials.

    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_db
    DB_USERNAME=your_user
    DB_PASSWORD=your_password
    ```

5.  **Run Database Migrations:**
    Create the necessary tables in your database.

    ```bash
    php artisan migrate
    ```

7.  **Serve the Application:**
    You can now start the local development server.

    ```bash
    php artisan serve
    ```

    The application will be available at **[http://127.0.0.1:8000]**.
