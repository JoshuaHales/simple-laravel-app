<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Simple Laravel Application

This Laravel application demonstrates how to integrate a custom PHP package for interacting with external APIs. It includes routes and controllers for retrieving, paginating, and creating users via the [ReqRes API](https://reqres.in/). It also includes error handling and form submission for user creation.

## Key Features

- **Retrieve User by ID**: Fetch a user by their ID from the API and return a structured Data Transfer Object (DTO).
- **Paginated User List**: Retrieve a paginated list of users with flexible pagination handling.
- **Create New User**: Submit user data through a form to create new users via the API.
- **Error Handling**: Gracefully handle API connection issues, user not found, and invalid data exceptions.

## Installation

1. Clone the repository:

```bash
git clone https://github.com/JoshuaHales/simple-laravel-app.git
cd simple-laravel-app
```

2. Install Composer dependencies:

```bash
composer install
```

3. Set up environment variables:

```bash
cp .env.example .env
php artisan key:generate
```

4. Set up your local environment (e.g., using Laravel Valet, Docker, etc.) and make sure the application URL is set in `.env`.

5. Access the Laravel app on your local machine:

```bash
http://your-laravel-app.test
```

## Routes

### Retrieve User by ID

This route fetches a user by their ID from the API. If no ID is provided, it defaults to 1.

```bash
GET /user/{id?}
```

### Retrieve Paginated Users

This route fetches a paginated list of users from the API. You can specify the page number as a URL parameter.

```bash
GET /users/{page?}
```

### Create a New User

This route provides a form where you can submit user details (first name, last name, and job). Upon submission, it sends a request to the API to create a new user.

```bash
GET /create-user
POST /submit-user
```

## Example Usage

### Retrieving a User by ID

Navigate to the following URL in your browser:

```bash
http://your-laravel-app.test/user/1
```

This will return a JSON response with the details of the user with ID 1. If no ID is provided in the URL, it defaults to user ID 1.

### Retrieving a Paginated List of Users

You can retrieve a paginated list of users by visiting the following URL:

```bash
http://your-laravel-app.test/users/1
```

This will return the list of users from page 1 of the API's paginated data. You can change the page number by modifying the URL.

### Creating a New User

To create a new user, navigate to the following URL, where you can fill out a form:

```bash
http://your-laravel-app.test/create-user
```

After submitting the form with a first name, last name, and job, the user will be created via the API, and the response will be displayed on the page.

## Error Handling

The application handles various exceptions when interacting with the API:

- **UserNotFoundException**: Thrown when the requested user does not exist.
- **ApiConnectionException**: Thrown when there is an issue connecting to the API.
- **InvalidUserDataException**: Thrown when the data returned from the API is invalid or incomplete.

## License

This project is open-source software licensed under the [MIT license](https://opensource.org/license/mit).