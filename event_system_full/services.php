<?php
require 'config.php';
$type = $_GET['type'] ?? 'General';
// create events/services tables and sample data if not exist
$conn->query("CREATE TABLE IF NOT EXISTS services(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  description TEXT
)");
$conn->query("CREATE TABLE IF NOT EXISTS packages(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  price DECIMAL(10,2),
  description TEXT
)");
$conn->query("CREATE TABLE IF NOT EXISTS slots(
  id INT AUTO_INCREMENT PRIMARY KEY,
  slot_date DATE,
  slot_time TIME,
  capacity INT,
  booked INT DEFAULT 0
)");
// insert initial packages/services if empty
$rs = $conn->query('SELECT COUNT(*) c FROM services');
if($rs){ $c = $rs->fetch_assoc()['c']; if($c==0){
  $conn->query("INSERT INTO services (name,description) VALUES
    ('Photobooth','Portable photobooth with props'),
    ('Magic Show','Stage magic show'),
    ('Decoration','Venue decoration including lights')");
}}
$rs = $conn->query('SELECT COUNT(*) c FROM packages');
if($rs){ $c = $rs->fetch_assoc()['c']; if($c==0){
  $conn->query("INSERT INTO packages (name,price,description) VALUES
    ('Basic Package',1000,'Includes venue setup basic'),
    ('Standard Package',3000,'Includes photobooth and basic decoration'),
    ('Premium Package',6000,'Full service with magic show and premium decor')");
}}
$rs = $conn->query('SELECT COUNT(*) c FROM slots');
if($rs){ $c = $rs->fetch_assoc()['c']; if($c==0){
  // add some slots
  $conn->query("INSERT INTO slots (slot_date,slot_time,capacity) VALUES
    (DATE_ADD(CURDATE(), INTERVAL 1 DAY),'10:00:00',2),
    (DATE_ADD(CURDATE(), INTERVAL 1 DAY),'18:00:00',2),
    (DATE_ADD(CURDATE(), INTERVAL 2 DAY),'11:00:00',3)");
}}
$services = $conn->query('SELECT * FROM services')->fetch_all(MYSQLI_ASSOC);
$packages = $conn->query('SELECT * FROM packages')->fetch_all(MYSQLI_ASSOC);
$slots = $conn->query('SELECT * FROM slots')->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Services for <?php echo htmlspecialchars($type);?></title>
<link rel="stylesheet" href="assets/css/styles.css">
<script src="assets/js/main.js"></script>
</head>
<body>
  <div class="container">
    <h2>Services & Packages — <?php echo htmlspecialchars($type); ?></h2>
    <form id="bookingForm" method="post" action="book.php">
      <input type="hidden" name="event_type" value="<?php echo htmlspecialchars($type); ?>">
      <h3>Services Provided</h3>
      <?php foreach($services as $s): ?>
        <label><input type="checkbox" name="services[]" value="<?php echo $s['name']; ?>"> <?php echo htmlspecialchars($s['name']); ?> — <?php echo htmlspecialchars($s['description']); ?></label><br>
      <?php endforeach; ?>

      <h3>Packages</h3>
      <?php foreach($packages as $p): ?>
        <label><input type="radio" name="package_id" value="<?php echo $p['id']; ?>" required> <?php echo htmlspecialchars($p['name']); ?> — ₹<?php echo $p['price']; ?> (<?php echo htmlspecialchars($p['description']); ?>)</label><br>
      <?php endforeach; ?>

      <h3>Choose Slot</h3>
      <select id="slot" name="slot_id" required onchange="checkSeats(this.value)">
        <option value=''>Select slot</option>
        <?php foreach($slots as $sl): ?>
          <option value="<?php echo $sl['id']; ?>"><?php echo $sl['slot_date'].' '.$sl['slot_time']; ?> — Seats left: <?php echo ($sl['capacity'] - $sl['booked']); ?></option>
        <?php endforeach; ?>
      </select>
      <p id="seatInfo"></p>

      <h3>Your Details</h3>
      <input name="name" placeholder="Your name" required>
      <input name="email" placeholder="Email" required type="email">

      <button type="submit">Proceed to Book (Mock Payment)</button>
    </form>
  </div>

  <script>
  function checkSeats(slotId){
    if(!slotId) { document.getElementById('seatInfo').innerText=''; return; }
    fetch('check_seats.php?slot_id='+slotId).then(r=>r.json()).then(j=>{
      document.getElementById('seatInfo').innerText = 'Seats left: '+j.left+' / Capacity: '+j.capacity;
    });
  }
  </script>
</body>
</html>
