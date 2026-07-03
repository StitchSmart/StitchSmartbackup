<?php
// Test chatbot API
$message = "hello";
$sessionId = "test-" . time();

$payload = json_encode([
    "query" => $message,
    "session_id" => $sessionId
]);

$ch = curl_init("http://localhost:5000/chat-simple");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
echo "Response:\n";
echo $response . "\n";

if ($error) {
    echo "Error: $error\n";
}
?>
