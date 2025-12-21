<?php
include 'db.php';
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        // Log successful login
        $log_stmt = $conn->prepare("INSERT INTO login_logs (user_id) VALUES (?)");
        $log_stmt->bind_param("i", $user['id']);
        $log_stmt->execute();
        $log_stmt->close();

        // Redirect with success message
        header("Location: dashboard.php?login=success");
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No account found with that email.";
}

$stmt->close();
$conn->close();
?>
