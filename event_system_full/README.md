# Event Management System - Option B (PHP + MySQL + XAMPP)

## What is included
- Login / Signup
- Event Type selection
- Services, Packages, Slots
- Booking with mock payment
- Real-time seat availability (AJAX)
- Feedback system
- Email confirmation (uses PHP mail)
- QR ticket generation (Google Chart API)
- Admin dashboard (basic)
- SQL dump at `db/event_system.sql`

## Setup (XAMPP)
1. Copy the `event_system_full` folder to `htdocs`.
2. Start Apache & MySQL.
3. Import `db/event_system.sql` into phpMyAdmin (or let the app auto-create tables).
4. Open `http://localhost/event_system_full/` in browser.
5. Admin dashboard: `http://localhost/event_system_full/admin/dashboard.php` (HTTP Basic auth; password is `admin123`).

## Notes
- PHP `mail()` may not work out-of-the-box in XAMPP. For reliable email use PHPMailer + SMTP (e.g. Gmail) — I can add that if you want.
- QR images use Google Chart API (no library required).
- For production, sanitize and secure inputs properly. This is a demo project for educational use.
"# Event-Management-System--Mini-Project" 
"# Event-Management-System--Mini-Project" 
