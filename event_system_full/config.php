<?php
// config.php - DB connection and basic settings
session_start();
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'event_system';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Create DB if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS `$DB_NAME`");
$conn->select_db($DB_NAME);
$conn->set_charset('utf8mb4');

// Basic mailer function (may require local mail server setup)
function send_email($to, $subject, $message) {
    $headers = 'From: noreply@example.com' . "\r\n" .
        'Reply-To: noreply@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    return mail($to, $subject, $message, $headers);
}
?>