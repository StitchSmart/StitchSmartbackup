<?php
// Simple working test account creator
$conn = new mysqli('localhost', 'root', '', 'StitchSmart');

if ($conn->connect_error) {
    die("Database error: " . $conn->connect_error);
}

echo "=== CREATING TEST ACCOUNT ===\n\n";

$email = 'testuser@stitchsmart.com';
$password = 'Test@123'; // Plain text - we'll store hashed
$name = 'Test User';
$phone = '+92-300-1111111';

// Delete old account if exists
$conn->query("DELETE FROM users WHERE email = '" . $conn->real_escape_string($email) . "'");
echo "✓ Old test account deleted (if existed)\n";

// Create password hash
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insert new account
$stmt = $conn->prepare("INSERT INTO users (name, phone, email, password_hash, is_verified) VALUES (?, ?, ?, ?, 1)");
if ($stmt) {
    $stmt->bind_param("ssss", $name, $phone, $email, $passwordHash);
    if ($stmt->execute()) {
        $userId = $conn->insert_id;
        echo "✓ Account created successfully!\n\n";
        
        // Verify it was created
        $verify = $conn->query("SELECT * FROM users WHERE id = $userId");
        $user = $verify->fetch_assoc();
        
        echo "=== ACCOUNT DETAILS ===\n";
        echo "User ID: " . $user['id'] . "\n";
        echo "Email: " . $user['email'] . "\n";
        echo "Name: " . $user['name'] . "\n";
        echo "Phone: " . $user['phone'] . "\n";
        echo "Password Hash: " . substr($user['password_hash'], 0, 40) . "...\n\n";
        
        // Test password verification
        echo "=== PASSWORD TEST ===\n";
        $testResult = password_verify($password, $user['password_hash']);
        echo "Test Password: " . $password . "\n";
        echo "Verification: " . ($testResult ? "✓ WORKS!" : "✗ FAILED") . "\n\n";
        
        // Test login
        echo "=== LOGIN SIMULATION ===\n";
        $loginStmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $loginStmt->bind_param("s", $email);
        $loginStmt->execute();
        $loginResult = $loginStmt->get_result();
        
        if ($loginResult->num_rows === 1) {
            $loginUser = $loginResult->fetch_assoc();
            $isPasswordValid = password_verify($password, $loginUser['password_hash']);
            
            if ($isPasswordValid) {
                echo "✓ LOGIN TEST PASSED!\n\n";
                echo "You can now login with:\n";
                echo "Email: " . $email . "\n";
                echo "Password: " . $password . "\n";
            } else {
                echo "✗ Password verification failed\n";
            }
        } else {
            echo "✗ User not found in database\n";
        }
        
    } else {
        echo "✗ Error creating account: " . $stmt->error . "\n";
    }
} else {
    echo "✗ Prepare error: " . $conn->error . "\n";
}

$conn->close();

echo "\n<br><br>";
echo "<a href='http://localhost/Stitch-Smart/public/index.php?page=customer_login' style='padding: 10px 20px; background: #c19a4e; color: white; text-decoration: none; border-radius: 5px;'>Go to Login</a>";
?>
