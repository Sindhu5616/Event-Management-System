<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$conn->real_escape_string($_POST['name']);
    $email=$conn->real_escape_string($_POST['email']);
    $pass=password_hash($_POST['password'], PASSWORD_BCRYPT);
    // create table if not exists
    $conn->query("CREATE TABLE IF NOT EXISTS users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(150) UNIQUE,
        password VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $stmt = $conn->prepare('INSERT INTO users (name,email,password) VALUES (?,?,?)');
    $stmt->bind_param('sss',$name,$email,$pass);
    if($stmt->execute()){
        $_SESSION['user_id']=$stmt->insert_id;
        $_SESSION['user_name']=$name;
        header('Location: home.php');
        exit;
    } else {
        $error = 'Registration failed: '.$conn->error;
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Signup</title><link rel="stylesheet" href="assets/css/styles.css"></head>
<body>
  <div class="container center">
    <h1>Create account</h1>
    <?php if(isset($error)) echo '<p class="error">'.htmlspecialchars($error).'</p>'; ?>
    <form method="post">
      <input name="name" placeholder="Full name" required>
      <input name="email" type="email" placeholder="Email" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Sign up</button>
    </form>
    <p>Already have account? <a href="index.php">Login</a></p>
  </div>
</body>
</html>
