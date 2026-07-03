<?php
// Check test account and password verification
$conn = new mysqli('localhost', 'root', '', 'StitchSmart');

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

echo "=== TEST ACCOUNT CHECK ===\n\n";

// Get the test user
$result = $conn->query("SELECT id, email, password_hash FROM users WHERE email='test@stitchsmart.com' LIMIT 1");

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "✓ User found\n";
    echo "ID: " . $user['id'] . "\n";
    echo "Email: " . $user['email'] . "\n";
    echo "Password Hash Length: " . strlen($user['password_hash']) . " chars\n";
    
    // Test password verification
    $testPass = 'Test@123';
    $isValid = password_verify($testPass, $user['password_hash']);
    echo "\n=== PASSWORD VERIFICATION ===\n";
    echo "Test Password: " . $testPass . "\n";
    echo "Verification Result: " . ($isValid ? "✓ VALID" : "✗ INVALID") . "\n";
    
    if (!$isValid) {
        echo "\n⚠ Password verification failed!\n";
        echo "Hash type: " . substr($user['password_hash'], 0, 4) . "\n";
    }
} else {
    echo "✗ User NOT found!\n";
}

// Check if session file exists
echo "\n=== SESSION DATA ===\n";
$sessionFile = session_save_path() . "/sess_" . session_id();
if (file_exists($sessionFile)) {
    echo "Session file exists\n";
    $sessionData = file_get_contents($sessionFile);
    if (strpos($sessionData, 'customer_login_attempts') !== false) {
        echo "⚠ Found login attempts data in session\n";
    }
} else {
    echo "No active session file\n";
}

$conn->close();
?>
