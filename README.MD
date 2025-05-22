# SQL Database Management - ITS Steve Jobs Academy

This repository contains a PHP application for SQL database management developed during the course at ITS Steve Jobs Academy. The application implements an MVC (Model-View-Controller) architecture for user management with CRUD (Create, Read, Update, Delete) operations.

## Repository Structure

The repository is organized following a modular architecture:

- **database/**: Database connection management
  - Environment variable configuration for connection
  - Singleton pattern implementation for connection

- **user/**: User management
  - **controllers/**: Request handling and routing
  - **providers/**: Business logic services
  - **repositories/**: Direct database interaction

- **utils/**: Utility functions
  - Input validation (email, strings, phone numbers)
  - Security support functions

## Main Features

The application offers the following features:

- **User Listing**: View all registered users
- **User Registration**: Add new users with data validation
- **User Updates**: Modify existing user data
- **User Deletion**: Remove users from the database

## Project Architecture

The project follows a three-tier architecture:

1. **Controller**: Handles HTTP requests and coordinates operations
2. **Service**: Implements business logic and validation
3. **Repository**: Manages data access and database operations

### Controller Example

```php:src/user/controllers/user.controller.php
<?php

include_once __DIR__ . '/../../user/providers/user.service.php';

class UserController
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    // ... existing code ...
}
```

### Service Example

```php:src/user/providers/user.service.php
<?php

require_once __DIR__ . '/../../database/connection.provider.php';
require_once __DIR__ . '/../repositories/user.repository.php';
require_once __DIR__ . '/../../utils/regex.utilis.php';

class UserService
{
    // ... existing code ...

    public function createUser($nome, $cognome, $email, $telefono)
    {
        validateEmail($email);
        validateString($nome);
        validateString($cognome);
        validatePhone($telefono);

        // ... existing code ...
    }

    // ... existing code ...
}
```

### Repository Example

```php:src/user/repositories/user.repository.php
<?php

class UserRepository
{
    private $connection;

    // ... existing code ...

    public function create($nome, $cognome, $email, $telefono)
    {
        $query = "INSERT INTO users (nome, cognome, email, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssss", $nome, $cognome, $email, $telefono);
        $stmt->execute();
        $stmt->close();
    }

    // ... existing code ...
}
```

## How to Use the Application

### Requirements

- PHP 7.4 or higher
- MySQL/MariaDB
- Composer for dependency management

### Configuration

1. Clone the repository
2. Run `composer install` to install dependencies
3. Create an `.env` file in the project root with the following variables:

   ```
   DB_HOST=localhost
   DB_USER=username
   DB_PASSWORD=password
   DB_NAME=database_name
   ```

4. Create a `users` table in the database with fields: id, nome, cognome, email, telefono

### Starting the Application

To start the application locally:

```bash
php -S localhost:8000 -t src
```

Then access `http://localhost:8000` in your browser.

## Security Features

The application implements several security measures:

- Prepared statements to prevent SQL injection
- Server-side input validation
- Exception handling for database connection errors

## Educational Objectives

This project was designed to:
- Understand MVC architecture in PHP
- Implement CRUD operations on MySQL databases
- Apply security principles in web applications
- Develop skills in structuring modular PHP projects

---

*This repository was created as part of the educational journey at ITS Steve Jobs Academy.*