# Assad-2025

## Project Overview
Assad-2025 is a web application for managing animal habitats, tours, and user reservations. The system includes admin, guide, and user functionalities, supporting animal and habitat management, tour creation, and booking.

## Folder Structure

```
Assad-2025/
├── index.php
├── login.php
├── register.php
├── includes/
│   ├── db.php
│   ├── admin/
│   ├── auth/
│   ├── guide/
├── Modelisation/
├── pages/
│   ├── animals.php
│   ├── admin/
│   ├── guide/
│   └── ...
├── sql/
│   └── install.sql
└── readme.md
```

## Main Features
- User registration and login
- Admin dashboard for managing users, animals, habitats, and tours
- Guide dashboard for managing tours and bookings
- Animal and habitat CRUD operations
- Tour creation, reservation, and management

## Setup Instructions
1. Clone the repository to your local server directory (e.g., `htdocs` for XAMPP).
2. Import the database using `sql/install.sql`.
3. Configure database connection in `includes/db.php`.
4. Start your local server and access the app via `index.php`.

## Requirements
- PHP 7.x or higher
- MySQL
- XAMPP, WAMP, or compatible local server
