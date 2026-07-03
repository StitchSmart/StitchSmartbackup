<?php
require 'config/config.php';

echo "📋 Available Gemini Models\n";
echo "==========================\n\n";

$apiKey = GOOGLE_API_KEY;
$url = "https://generativelanguage.googleapis.com/v1/models?key=$apiKey";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $httpCode\n\n";

if ($httpCode === 200) {
    $data = json_decode($response, true);
    if (isset($data['models'])) {
        echo "✅ Found " . count($data['models']) . " models:\n\n";
        foreach ($data['models'] as $model) {
            echo "• " . $model['name'] . "\n";
            if (isset($model['displayName'])) {
                echo "  Display: " . $model['displayName'] . "\n";
            }
            if (isset($model['supportedGenerationMethods'])) {
                echo "  Methods: " . implode(", ", $model['supportedGenerationMethods']) . "\n";
            }
            echo "\n";
        }
    }
} else {
    echo "❌ Error listing models!\n";
    echo "Response: " . substr($response, 0, 500) . "\n";
}
?>
