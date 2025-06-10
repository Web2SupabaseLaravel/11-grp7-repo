# Online Clinic Booking API Documentation

## Overview
Welcome to the API documentation for the Online Clinic Booking application. This API allows developers to manage authentication and clinic-related operations for patients, practitioners, and admins. It provides endpoints for user registration, login, password reset, and more, enabling seamless integration with clinic booking systems.

- **Target Audience**: Developers building applications for clinic management.
- **Version**: 1.0
- **Technology**: Built with Laravel 12.14.1, PHP 8.4.7, and Supabase as the database.

## Base URL
http://localhost:8000/api

## Installation and Setup
To set up the API locally, follow these steps:

1. Clone the repository:
git clone <repository-url></repository-url>

2. Navigate to the project directory:
cd online-clinic-booking



3. Install dependencies:
composer install




4. Copy the `.env.example` file to `.env`:
cp .env.example .env


5. Configure your Supabase database credentials in `.env`:
DB_CONNECTION=pgsql
DB_HOST=<supabase-host>
DB_PORT=5432
DB_DATABASE=<supabase-database>
DB_USERNAME=<supabase-username>
DB_PASSWORD=<supabase-password></supabase-password></supabase-username></supabase-database></supabase-host>




6. Generate an application key:
php artisan key:generate




7. Run migrations:
php artisan migrate

8. Start the Laravel server:
php artisan serve


## Resources
- [Authentication](authentication.md)

## Authentication
Most endpoints require an authentication token. To obtain a token, use the `/api/auth/login` endpoint.

### **Obtaining a Token**
Send a `POST` request to `/api/auth/login` with your credentials. Example:
{
 "role": "patient",
 "email": "patient@example.com",
 "password": "password123"
}
The response will include a token:
{
    "message": "Login successful",
    "user": {
        "patient_id": 1,
        "email": "patient@example.com"
    },
    "token": "1|abc123def456ghi789jkl"
}
Using the Token
Include the token in the Authorization header for authenticated requests:

Authorization: Bearer 1|abc123def456ghi789jkl
Token Expiration
Tokens do not expire in this version of the API. Future versions may introduce token expiration and refresh mechanisms.

Error Handling
The API returns standard HTTP status codes with descriptive messages.

Status Code	Meaning	Description
422	Unprocessable Entity	Validation error occurred
401	Unauthorized	Invalid credentials provided
404	Not Found	Resource not found
Example Error Response (422 Unprocessable Entity)
json

{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email has already been taken."
        ]
    }
}
Example Error Response (401 Unauthorized)
json
{
    "message": "Invalid credentials"
}
### Setting Up Environment Variables
After importing the collection, set up the following environment variables in Postman:

1. In Postman, go to "Environments" in the sidebar.
2. Create a new environment named "Development".
3. Add the following variables:
   - `baseUrl`: `http://localhost:8000/api`
   - `token`:Bearer 101|FBz8Ihk4ccl5tA7hB6uJkAxKDETCvB2JyJPnOQl72ee085d1
4. Save the environment and select it from the dropdown in Postman.