<?php
require 'config.php';
$ticket = $_GET['ticket'] ?? '';
$ticket = $conn->real_escape_string($ticket);
$res = $conn->query("SELECT b.*, p.name as package_name FROM bookings b LEFT JOIN packages p ON p.id=b.package_id WHERE b.ticket_code='".$ticket."' LIMIT 1");
if(!$res || $res->num_rows==0) die('Ticket not found');
$bk = $res->fetch_assoc();
$qr_data = urlencode('Ticket: '.$bk['ticket_code'].'\nName: '.$bk['user_name']);
$qr_url = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$qr_data.'&choe=UTF-8';
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Confirmation</title><link rel="stylesheet" href="assets/css/styles.css"></head>
<body>
  <div class="container center">
    <h2>Booking Confirmed</h2>
    <p>Ticket: <?php echo htmlspecialchars($bk['ticket_code']); ?></p>
    <p>Name: <?php echo htmlspecialchars($bk['user_name']); ?></p>
    <p>Event: <?php echo htmlspecialchars($bk['event_type']); ?></p>
    <p>Package: <?php echo htmlspecialchars($bk['package_name']); ?></p>
    <p><a href="home.php">Back to events</a></p>
    <p><a href="feedback.php">Leave Feedback</a></p>
  </div>
</body>
</html>
