# ASSAD V2 - Virtual Zoo Management System

Welcome to **ASSAD V2**, the official virtual platform for the ASSAD Zoo, symbol of the 2025 Africa Cup of Nations. This project is a comprehensive web application designed to manage zoo operations, including guided tours, animal habitats, and visitor reservations.

## Technical Architecture

This project has been fully migrated to a robust **Object-Oriented Programming (OOP)** architecture using **PHP Data Objects (PDO)** for secure and efficient database interactions.

*   **Backend:** PHP 8+ (OOP, PDO)
*   **Database:** MySQL
*   **Frontend:** HTML5, TailwindCSS (CDN), JavaScript (AJAX)
*   **Architecture Pattern:** MVC-inspired (Classes for logic, Pages for views, Includes for actions)

## Key Features

### For Administrators
*   **Dashboard:** Real-time overview of revenue, total bookings, and animal statistics.
*   **User Management:** detailed user oversight with the ability to Ban/Unban accounts.
*   **Zoo Management:** Full CRUD capabilities for **Animals** and **Habitats**.
*   **Tour Oversight:** View all tours and manage cancellations.

### For Guides
*   **Tour Management:** Create, Edit, and Cancel guided tours.
*   **Itinerary Planning:** Define specific steps and timelines for each tour.
*   **Reservation Tracking:** Monitor bookings for assigned tours in real-time.

### For Visitors
*   **Immersive Experience:** Explore the legend of "Asaad" the Atlas Lion.
*   **Gallery:** View habitats and animals.
*   **Booking System:** Reserve spots in guided tours.
*   **Billing:** Automatic PDF-ready Invoice generation (`invoice.php`) for booked tours.

## Project Structure

```text
ASSAD-V2/
├── Classes/            # Core OOP Classes (User, Tour, Animal, etc.)
├── includes/           # Action scripts and API endpoints
│   ├── auth/           # Authentication guards
│   ├── admin/          # Admin-specific logic
│   ├── guide/          # Guide-specific logic
│   └── db.php          # Database Connection Wrapper
├── pages/              # View files (Frontend)
│   ├── admin/          # Admin Dashboard & Panels
│   ├── guide/          # Guide Dashboard & Tooling
│   └── ...             # Public pages (asaad.php, tours.php)
├── sql/                # Database schema interactions
├── index.php           # Landing Page
└── readme.md           # Project Documentation
```

## Installation & Setup

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/ilyas-doughmi/ASSAD-V2.git
    ```
2.  **Database Setup:**
    *   Create a MySQL database named `assad_zoo`.
    *   Import the `sql/base_de_donne.sql` file to initialize tables.
3.  **Configuration:**
    *   Verify credentials in `includes/db.php` match your local environment.
4.  **Run:**
    *   Serve the project via XAMPP/WAMP or PHP built-in server.
    *   Visit `http://localhost/ASSAD-V2/` in your browser.

## Security
*   **SQL Injection Protection:** All queries use Prepared Statements via PDO.
*   **XSS Protection:** Output escaping where applicable.
*   **Authentication:** Session-based auth with Role-Based Access Control (RBAC).
