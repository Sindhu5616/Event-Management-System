<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$conn->real_escape_string($_POST['email']);
    $pass=$_POST['password'];
    $conn->query("CREATE TABLE IF NOT EXISTS users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(150) UNIQUE,
        password VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $res = $conn->query("SELECT id,name,password FROM users WHERE email='".$email."' LIMIT 1");
    if($res && $res->num_rows){
        $row = $res->fetch_assoc();
        if(password_verify($pass, $row['password'])){
            $_SESSION['user_id']=$row['id'];
            $_SESSION['user_name']=$row['name'];
            header('Location: home.php'); exit;
        } else { $error='Invalid credentials'; }
    } else { $error='Invalid credentials'; }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="assets/css/styles.css"></head>
<body>
  <div class="container center">
    <h1>Login</h1>
    <?php if(isset($error)) echo '<p class="error">'.htmlspecialchars($error).'</p>'; ?>
    <form method="post">
      <input name="email" placeholder="Email" required>
      <input name="password" type="password" placeholder="Password" required>
      <button>Login</button>
    </form>
    <p><a href="signup.php">Create an account</a> • <a href="home.php">Continue as guest</a></p>
  </div>
</body>
</html>
