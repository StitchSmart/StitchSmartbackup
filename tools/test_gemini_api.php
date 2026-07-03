<?php
require 'config/config.php';

echo "🤖 Gemini API Configuration Check\n";
echo "==================================\n\n";

echo "✓ API Key: " . substr(env('GOOGLE_API_KEY'), 0, 10) . "...\n";
echo "✓ Model: " . GEMINI_MODEL . "\n";
echo "✓ API Endpoint: https://generativelanguage.googleapis.com/v1/models/" . GEMINI_MODEL . ":generateContent\n\n";

echo "📝 Supported Features:\n";
echo "- " . GEMINI_MODEL . " supports image analysis ✓\n";
echo "- Can analyze product images\n";
echo "- Can generate product names, descriptions, pricing\n";
echo "- Can generate SEO metadata\n\n";

// Test API connection
$apiKey = GOOGLE_API_KEY;
$model = GEMINI_MODEL;
$url = "https://generativelanguage.googleapis.com/v1/models/$model:generateContent?key=$apiKey";

$testBody = json_encode([
    "contents" => [[
        "parts" => [[
            "text" => "Hello, are you working? Respond with YES or NO."
        ]]
    ]]
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $testBody);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "🔌 API Connection Test:\n";
echo "HTTP Status: $httpCode\n";

if ($httpCode === 200) {
    echo "✅ API is working!\n";
    $data = json_decode($response, true);
    if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        echo "Response: " . $data['candidates'][0]['content']['parts'][0]['text'] . "\n";
    }
} else {
    echo "❌ API Error!\n";
    echo "Response: " . substr($response, 0, 300) . "\n";
}
?>
