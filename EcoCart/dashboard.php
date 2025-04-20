<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>EcoCart Dashboard</title>
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
  <p>This is your EcoCart dashboard.</p>
  <a href="logout.php">Logout</a>
</body>
</html>
