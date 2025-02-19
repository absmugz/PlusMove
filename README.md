## PLUS MOVE API

A powerful **delivery management API** built with Laravel 11, featuring **real-time tracking using Pusher**, authentication with Sanctum, role-based access with Spatie, and Coming soon API documentation with Swagger.

## API Design and Documentation

🛡️ Security & Role-Based Access
Middleware & Controller-Based Role Checking

Role-based access is enforced at both middleware and controller levels.
Only authorized users can perform specific actions, ensuring a secure API.

👤 User Role Restrictions
Role	Permissions
Admin	- Can assign deliveries to drivers
- Can delete deliveries
- Can view all deliveries
Driver	- Can update delivery status
- Can track their assigned deliveries
Customer	- Can only view their own deliveries
- Cannot modify delivery data
🔒 API Security & Authentication
Laravel Sanctum is used for token-based authentication.
All API routes require authentication (auth:sanctum middleware).
JWT/Bearer Tokens are used to authenticate requests.
Role-based middleware (role:admin, role:driver, role:customer) restricts access to specific endpoints.


## **📌 Prerequisites**
Before running this project, ensure you have:
- **PHP 8.2+**
- **Composer**
- **Node.js (for frontend)**
- **MySQL**
- **Pusher Account** (for real-time tracking)

---

## **⚙️ Installation**
### **1️⃣ Clone the Repository**

git clone https://github.com/absmugz/PlusMove
cd PlusMove

Install Dependencies

```
composer install
```

Copy .env File & Set Up Configuration

```
cp .env.example .env
```

Then update the .env file with your database and Pusher credentials:

```
APP_NAME=PlusMove
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=plus_move
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_APP_CLUSTER=your-cluster
```