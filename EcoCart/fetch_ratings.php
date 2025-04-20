<?php
header("Content-Type: application/json");

$host = "localhost";
$username = "root";
$password = ""; // adjust if needed
$database = "ecocart";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([]);
    exit();
}

$sql = "SELECT product_name, rating, timestamp FROM ratings ORDER BY timestamp DESC";
$result = $conn->query($sql);

$ratings = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ratings[] = $row;
    }
}

echo json_encode($ratings);
$conn->close();
?>
