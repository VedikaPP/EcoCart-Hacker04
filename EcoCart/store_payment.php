<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ecocart";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$product_name = $_POST['product_name'];
$upi_id = $_POST['upi_id'];
$rating = $_POST['rating'];

$sql = "INSERT INTO payments (product_name, upi_id, rating) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $product_name, $upi_id, $rating);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  echo "Success";
} else {
  echo "Error";
}

$stmt->close();
$conn->close();
?>
