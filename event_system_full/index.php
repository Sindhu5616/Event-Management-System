<?php
require 'config.php';
if(isset($_SESSION['user_id'])) header('Location: home.php');
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Event Management System - Welcome</title>
  
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
  <div class="container center">
    <h1>Event Management System</h1>
    <img src="assets/images/adminpage.jpg" alt="Admin page" width="800">

    <div class="card login-card">
      <h2>Login</h2>
      <form method="post" action="login.php">
        <input name="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button type="submit">Login</button>
      </form>
      <p>or <a href="signup.php">Sign up</a> • <a href="home.php">Skip & View Events</a></p>
    </div>
  </div>
</body>
</html>
