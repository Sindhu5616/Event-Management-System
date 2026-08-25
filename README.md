# Event Management System

An Event Management System developed using PHP, MySQL, HTML, CSS, and JavaScript. The system allows users to browse events, register/login, book events, check seat availability, and provide feedback. An admin panel is included for managing the system.

## Features

* User registration and login
* User logout
* Browse available events and services
* Event booking
* Seat availability checking
* Booking confirmation
* Feedback submission
* Admin dashboard
* Event management
* Responsive user interface
* MySQL database integration

## Technologies Used

* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Server:** XAMPP / Apache
* **Tools:** VS Code, Git, GitHub

## Project Structure

```text
event_system_full/
├── admin/
│   └── dashboard.php
├── assets/
│   ├── css/
│   │   └── styles.css
│   ├── js/
│   │   └── main.js
│   └── images/
├── db/
│   └── event_system.sql
├── book.php
├── check_seats.php
├── config.php
├── confirmation.php
├── feedback.php
├── home.php
├── index.php
├── login.php
├── logout.php
├── services.php
└── signup.php
```

## Installation and Setup

### 1. Install XAMPP

Install XAMPP and start:

* Apache
* MySQL

### 2. Copy the project

Place the project folder inside:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\event_system_full\
```

### 3. Create the database

1. Open **phpMyAdmin**
2. Create a database for the project
3. Import:

```text
db/event_system.sql
```

### 4. Configure the database

Open:

```text
config.php
```

Update the database connection details according to your local MySQL setup.

### 5. Run the project

Open your browser and visit:

```text
http://localhost/event_system_full/
```

## Admin Panel

The project includes an admin dashboard for managing event-related information.

The admin panel can be accessed through:

```text
http://localhost/event_system_full/admin/dashboard.php
```

## Database

The MySQL database structure and required SQL queries are provided in:

```text
db/event_system.sql
```

## Future Improvements

* Online payment integration
* Email/SMS booking notifications
* Event search and filtering
* Improved admin controls
* User booking history
* Cloud deployment

## Author

**Sindhu M N**

Developed as a mini project for academic purposes.
