<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["message"])) {
  echo json_encode(["error" => "No input provided."]);
  exit;
}

// ✅ Your actual Gemini API key
$apiKey = "AIzaSyBjAu2ahniBQNTUD4wDTFvsSn-VEsKWeHI";

$message = $data["message"];

// Prepare payload
$payload = [
  "contents" => [[
    "parts" => [[ "text" => $message ]]
  ]]
];

// Set up the HTTP POST request
$options = [
  "http" => [
    "header" => "Content-type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
    "method" => "POST",
    "content" => json_encode($payload),
  ]
];

$context = stream_context_create($options);

// Correct Gemini Flash endpoint
$endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey";

// Send request
$response = file_get_contents($endpoint, false, $context);

if ($response === FALSE) {
  echo json_encode(["reply" => "Error calling Gemini API"]);
} else {
  $json = json_decode($response, true);
  $reply = $json["candidates"][0]["content"]["parts"][0]["text"] ?? "No reply received.";
  echo json_encode(["reply" => $reply]);
}
?>
