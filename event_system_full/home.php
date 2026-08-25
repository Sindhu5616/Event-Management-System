<?php
require 'config.php';
$user = $_SESSION['user_name'] ?? null;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Events - Choose Type</title>
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<header class="topbar">
  <div class="container">
    <h2>Event Management System</h2>
    <div>
      <?php 
        if($user){ 
          echo 'Hello, '.htmlspecialchars($user).' | <a href="logout.php">Logout</a>'; 
        } else { 
          echo '<a href="index.php">Login</a>'; 
        }
      ?>
    </div>
  </div>
</header>

<main class="container">
<h4>Contact Us - +91 1234567890 <br> ems@gmail.com</h4>
<h1>Event Types</h1>

<div class="grid">

  <a class="card" href="services.php?type=Birthday">
    <img src="assets/images/events/birthday.jpg" alt="Birthday">
    <h3>Birthday</h3>
  </a>

  <a class="card" href="services.php?type=Wedding">
    <img src="assets/images/events/wedding.jpg" alt="Wedding">
    <h3>Wedding</h3>
  </a>

  <a class="card" href="services.php?type=Corporate">
    <img src="assets/images/events/corporate.jpg" alt="Corporate">
    <h3>Corporate Event</h3>
  </a>

  <a class="card" href="services.php?type=Proposal">
    <img src="assets/images/events/proposal.jpg" alt="Proposal">
    <h3>Proposal</h3>
  </a>

  <a class="card" href="services.php?type=Photoshoot">
    <img src="assets/images/events/photoshoot.jpg" alt="Photoshoot">
    <h3>Photoshoot</h3>
  </a>

  <a class="card" href="services.php?type=Other">
    <img src="assets/images/events/other.jpg" alt="Other">
    <h3>Other</h3>
  </a>

</div>

</main>
</body>
</html>
