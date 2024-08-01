# Simpel Library

Simpel Library is a comprehensive web application designed for managing library records. This platform includes features for logging in, registering, and managing data for members, books, and book loans. The application is built with Laravel as the backend framework and Vue.js as the frontend framework, integrated using Laravel Mix.

## Key Features

- **Login and Registration**: Secure and user-friendly authentication system for library members and administrators.
- **Member Management**: Efficiently record and manage data for library members.
- **Book Management**: Add, update, and delete book records with ease.
- **Loan Management**: Track book loans and returns to ensure smooth library operations.

## Technologies Used

- **Backend Framework**: Laravel
- **Frontend Framework**: Vue.js
- **Build Tool**: Laravel Mix

## Installation

### Prerequisites

- PHP 7.4 or higher
- Composer
- Node.js

### Setup

1. Clone the repository:
    ```bash
    git clone https://github.com/jeriken/Simpel-Library
    cd simpel-library
    ```

2. Install backend dependencies:
    ```bash
    composer install
    ```

3. Create a `.env` file:
    ```bash
    cp .env.example .env
    ```

4. Generate an application key:
    ```bash
    php artisan key:generate
    ```

5. Configure your database in the `.env` file.

6. Run migrations:
    ```bash
    php artisan migrate
    php artisan passport:client --personal
    ```

7. Install frontend dependencies:
    ```bash
    npm install
    ```

8. Compile the assets:
    ```bash
    npm run dev
    ```

9. Serve the application:
    ```bash
    php artisan serve
    ```

## Usage

- Access the login and registration pages to create and manage user accounts.
- Use the admin panel to manage member, book, and loan records efficiently.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or questions, please contact us at [mrazin311@gmail.com](mailto:mrazin311@gmail.com).
