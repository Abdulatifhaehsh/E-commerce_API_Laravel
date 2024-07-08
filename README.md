<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# E-commerce API Laravel

## Overview

E-commerce API is a robust and scalable API built with the Laravel framework. This project provides a solid foundation for developing e-commerce applications, enabling seamless interaction between users and various functionalities. The project leverages Laravel's strengths to deliver a clean and maintainable codebase, ensuring ease of development and deployment.


## Features

- **User Authentication**: Secure user registration and login.
- **CRUD Operations**: Create, Read, Update, and Delete functionalities for managing resources.
- **Middleware**: Custom middleware for request validation and user authentication.
- **Error Handling**: Centralized error handling for API responses.
- **API Versioning**: Support for versioned API endpoints.
- **Documentation**: Well-documented code and API endpoints for ease of use.

## Technologies

- **Laravel**: PHP Framework for web artisans.
- **MySQL**: Relational database management system.
- **JWT**: JSON Web Tokens for secure authentication.
- **Postman**: Tool for API testing and documentation.

## Installation

### Prerequisites

- PHP >= 7.3
- Composer
- MySQL
- Laravel

### Steps

1. **Clone the repository**

   ```sh
   git clone https://github.com/Abdulatifhaehsh/Cooperation_API_Laravel.git
   cd Cooperation_API_Laravel
   ```

2. **Install dependencies**

   ```sh
   composer install
   ```

3. **Set up environment variables**

   Copy the \`.env.example\` to \`.env\` and update the necessary configuration.

   ```sh
   cp .env.example .env
   ```

4. **Generate application key**

   ```sh
   php artisan key:generate
   ```

5. **Run migrations**

   ```sh
   php artisan migrate
   ```

6. **Run seeders**

   ```sh
   php artisan db:seed
   ```

7. **Start the development server**

   ```sh
   php artisan serve
   ```

## Configuration

Ensure to update your \`.env\` file with the correct database credentials and other necessary configuration values. Here is an example of the important configurations:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cooperation_api
DB_USERNAME=root
DB_PASSWORD=

JWT_SECRET=your_jwt_secret_key
```

## Usage

After setting up the project, you can start using the API. Use tools like Postman to interact with the endpoints. Ensure to include the necessary authentication tokens in the headers where required.



## Stay in touch

- Author - [Abdulatif Hashash](https://www.linkedin.com/in/abdulatif-hashash-8aa594202/)
- Portfolio - [website](https://abdulatifhashash.site/)

