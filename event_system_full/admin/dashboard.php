<?php
require '../config.php';
// basic auth for admin (for demo)
$admin_pass = 'admin123';
if(!isset($_SERVER['PHP_AUTH_USER'])){
    header('WWW-Authenticate: Basic realm="Admin"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Auth required'; exit;
} else {
    if($_SERVER['PHP_AUTH_PW'] !== $admin_pass){ echo 'Forbidden'; exit; }
}
// gather stats
$tot = $conn->query('SELECT COUNT(*) c FROM bookings')->fetch_assoc()['c'] ?? 0;
$by_package = $conn->query('SELECT p.name, COUNT(*) c FROM bookings b LEFT JOIN packages p ON p.id=b.package_id GROUP BY b.package_id')->fetch_all(MYSQLI_ASSOC);
$recent = $conn->query('SELECT * FROM bookings ORDER BY created_at DESC LIMIT 10')->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Dashboard</title><link rel="stylesheet" href="/assets/css/styles.css"></head>
<body>
  <div class="container">
    <h2>Admin Dashboard</h2>
    <p>Total bookings: <?php echo $tot; ?></p>
    <h3>Bookings by Package</h3>
    <ul>
      <?php foreach($by_package as $b) echo '<li>'.htmlspecialchars($b['name']).': '.intval($b['c']).'</li>'; ?>
    </ul>
    <h3>Recent Bookings</h3>
    <table>
      <tr><th>Ticket</th><th>Name</th><th>Event</th><th>When</th></tr>
      <?php foreach($recent as $r): ?>
        <tr>
          <td><?php echo htmlspecialchars($r['ticket_code']); ?></td>
          <td><?php echo htmlspecialchars($r['user_name']); ?></td>
          <td><?php echo htmlspecialchars($r['event_type']); ?></td>
          <td><?php echo htmlspecialchars($r['created_at']); ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="/">Back to site</a></p>
  </div>
</body></html>
