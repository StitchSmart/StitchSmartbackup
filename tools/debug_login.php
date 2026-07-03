<?php
// Deep debug - check account and login flow
$conn = new mysqli('localhost', 'root', '', 'StitchSmart');

if ($conn->connect_error) {
    die("DB error: " . $conn->connect_error);
}

echo "=== CHECKING ACCOUNT IN DATABASE ===\n\n";

$email = 'testuser@stitchsmart.com';
$password = 'Test@123';

// 1. Check if account exists
$result = $conn->query("SELECT id, email, name, password_hash FROM users WHERE email = '" . $conn->real_escape_string($email) . "'");

if ($result->num_rows == 0) {
    echo "❌ ACCOUNT NOT FOUND in database!\n";
    echo "Need to create account first.\n";
} else {
    $user = $result->fetch_assoc();
    
    echo "✓ Account found\n";
    echo "ID: " . $user['id'] . "\n";
    echo "Email: " . $user['email'] . "\n";
    echo "Name: " . $user['name'] . "\n";
    echo "Password Hash: " . (empty($user['password_hash']) ? "❌ EMPTY!" : "✓ Present") . "\n";
    echo "Hash Type: " . substr($user['password_hash'], 0, 10) . "\n";
    echo "Hash Length: " . strlen($user['password_hash']) . "\n\n";
    
    // 2. Test password verification
    echo "=== TESTING PASSWORD VERIFICATION ===\n";
    echo "Stored Password: " . $password . "\n";
    
    $hashInfo = password_get_info($user['password_hash']);
    echo "Hash Info - Algo: " . $hashInfo['algo'] . "\n";
    echo "Hash Info - Options: " . json_encode($hashInfo['options']) . "\n\n";
    
    // Test 1: password_verify
    $test1 = password_verify($password, $user['password_hash']);
    echo "Test 1 - password_verify(): " . ($test1 ? "✓ PASS" : "❌ FAIL") . "\n";
    
    // Test 2: Direct comparison
    $test2 = ($password === $user['password_hash']);
    echo "Test 2 - Direct comparison: " . ($test2 ? "✓ PASS" : "❌ FAIL") . "\n";
    
    // Test 3: Plain text check
    $test3 = ($hashInfo['algo'] === 0 && $password === $user['password_hash']);
    echo "Test 3 - Plain text check: " . ($test3 ? "✓ PASS" : "❌ FAIL") . "\n\n";
    
    if (!$test1 && !$test2 && !$test3) {
        echo "❌ PASSWORD VERIFICATION FAILED ON ALL TESTS!\n";
        echo "The password hash might be corrupted or incompatible.\n";
        echo "\nLet me recreate the account with correct hash...\n";
        
        // Delete and recreate
        $conn->query("DELETE FROM users WHERE id = " . $user['id']);
        
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        echo "New hash will be: " . substr($newHash, 0, 50) . "...\n";
        
        $insertStmt = $conn->prepare("INSERT INTO users (email, name, phone, password_hash, is_verified) VALUES (?, ?, ?, ?, 1)");
        $phone = '+92-300-1111111';
        $name = 'Test User';
        
        $insertStmt->bind_param("ssss", $email, $name, $phone, $newHash);
        if ($insertStmt->execute()) {
            echo "✓ Account recreated successfully\n";
            
            // Verify new account
            $verify = $conn->query("SELECT * FROM users WHERE email = '" . $conn->real_escape_string($email) . "'");
            $newUser = $verify->fetch_assoc();
            $newVerify = password_verify($password, $newUser['password_hash']);
            echo "Password verification on new account: " . ($newVerify ? "✓ WORKS!" : "❌ STILL FAILS") . "\n";
        } else {
            echo "❌ Error recreating account\n";
        }
    } else {
        echo "✓ PASSWORD VERIFICATION PASSED!\n";
        echo "Account and password are correct.\n";
    }
}

$conn->close();

echo "\n<br><br>";
echo "<a href='http://localhost/Stitch-Smart/public/index.php?page=customer_login' style='padding: 10px 20px; background: #c19a4e; color: white; text-decoration: none; border-radius: 5px;'>Go to Login</a>";
?>
