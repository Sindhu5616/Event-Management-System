<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD']!='POST') { header('Location: home.php'); exit; }
$name=$conn->real_escape_string($_POST['name']);
$email=$conn->real_escape_string($_POST['email']);
$event_type=$conn->real_escape_string($_POST['event_type']);
$package_id=intval($_POST['package_id']);
$slot_id=intval($_POST['slot_id']);
$services = isset($_POST['services']) ? implode(',', array_map(function($s){return htmlspecialchars($s);}, $_POST['services'])) : '';

// basic validations
if(!$slot_id || !$package_id){ die('Invalid input'); }

// create bookings table
$conn->query("CREATE TABLE IF NOT EXISTS bookings(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_name VARCHAR(150),
  user_email VARCHAR(150),
  event_type VARCHAR(100),
  package_id INT,
  services TEXT,
  slot_id INT,
  ticket_code VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
// check slot availability
$res = $conn->query('SELECT capacity,booked FROM slots WHERE id='.$slot_id.' FOR UPDATE');
$row = $res->fetch_assoc();
$left = $row['capacity'] - $row['booked'];
if($left<=0){ die('Slot full'); }

// mock payment step (we skip external API and assume payment OK)
$ticket_code = 'TICKET'.time().rand(100,999);
$stmt = $conn->prepare('INSERT INTO bookings (user_name,user_email,event_type,package_id,services,slot_id,ticket_code) VALUES (?,?,?,?,?,?,?)');
$stmt->bind_param('sssiiss',$name,$email,$event_type,$package_id,$services,$slot_id,$ticket_code);
if($stmt->execute()){
    // increment booked count
    $conn->query('UPDATE slots SET booked = booked + 1 WHERE id='.$slot_id);
    // send confirmation email (may not work on localhost without setup)
    $subject = 'Booking confirmation - '.$ticket_code;
    $message = "Hello $name,\nYour booking is confirmed. Ticket: $ticket_code\nEvent: $event_type\n\nShow this QR at entry.\n";
    send_email($email, $subject, $message);
    header('Location: confirmation.php?ticket='.urlencode($ticket_code));
    exit;
} else {
    die('Booking failed: '.$conn->error);
}
