<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $ticket = $conn->real_escape_string($_POST['ticket']);
    $rating = intval($_POST['rating']);
    $comments = $conn->real_escape_string($_POST['comments']);
    $conn->query("CREATE TABLE IF NOT EXISTS feedback(
        id INT AUTO_INCREMENT PRIMARY KEY,
        ticket_code VARCHAR(100),
        rating INT,
        comments TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $stmt = $conn->prepare('INSERT INTO feedback (ticket_code,rating,comments) VALUES (?,?,?)');
    $stmt->bind_param('sis',$ticket,$rating,$comments);
    if($stmt->execute()) { $msg='Thank you for feedback.'; } else { $err='Unable to save feedback.'; }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Feedback</title><link rel="stylesheet" href="assets/css/styles.css"></head>
<body>
  <div class="container center">
    <h2>Leave Feedback</h2>
    <?php if(isset($msg)) echo '<p class="success">'.htmlspecialchars($msg).'</p>'; ?>
    <?php if(isset($err)) echo '<p class="error">'.htmlspecialchars($err).'</p>'; ?>
    <form method="post">
      <input name="ticket" placeholder="Your Ticket Code" required>
      <label>Rating (1-5): <input name="rating" type="number" min="1" max="5" required></label>
      <textarea name="comments" placeholder="Comments"></textarea>
      <button type="submit">Submit Feedback</button>
    </form>
  </div>
</body></html>
