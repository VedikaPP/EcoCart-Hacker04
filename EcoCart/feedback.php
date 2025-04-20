<?php
$conn = new mysqli("localhost", "root", "", "ecocart");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$feedback = $_POST['feedback'];
$message = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO feedback (message, user_feedback) VALUES (?, ?)");
$stmt->bind_param("ss", $message, $feedback);
$stmt->execute();
$stmt->close();

echo "Feedback received!";
?>
