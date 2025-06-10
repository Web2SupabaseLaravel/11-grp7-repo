
## Register a User
### **POST** /auth/register
Registers a new user (patient, practitioner, or admin) and returns an API token.

#### **Request Headers**
| Header            | Value               |
|-------------------|---------------------|
| Accept            | application/json    |
| Content-Type      | application/json    |

#### **Request Body**
| Parameter       | Type   | Required | Description                             | Example             |
|-----------------|--------|----------|-----------------------------------------|---------------------|
| `role`          | String | Yes      | The role of the user (patient, practitioner, or admin) | "patient"           |
| `full_name`     | String | Yes (if role is patient or practitioner) | The full name of the user | "Test Patient"      |
| `email`         | String | Yes      | The email address of the user (must be unique) | "patient@example.com" |
| `password`      | String | Yes      | The password (minimum 6 characters)     | "password123"       |
| `staff_id`      | String | Yes (if role is admin) | The staff ID for admin users | "STAFF123"          |

**Example Request Body:**
```json
{
    "role": "patient",
    "full_name": "Test Patient",
    "email": "patient@example.com",
    "password": "password123"
}