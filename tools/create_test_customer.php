<?php
/**
 * Create Test Customer Account
 * This script creates a test customer account for login testing
 */

require_once 'config/config.php';
require_once 'config/database.php';

$database = new Database();
$conn = $database->connect();

// Test customer details
$testEmail = 'test@stitchsmart.com';
$testPassword = 'Test@123';
$testName = 'Test Customer';
$testPhone = '+92-300-1234567';

// Hash the password
$passwordHash = password_hash($testPassword, PASSWORD_DEFAULT);

// Check if customer already exists
$checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$checkStmt->bind_param("s", $testEmail);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    echo "<div style='background: #fff3cd; padding: 20px; border-radius: 5px; font-family: Arial;'>";
    echo "<h2 style='color: #856404;'>✓ Test Customer Already Exists</h2>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($testEmail) . "</p>";
    echo "<p><strong>Password:</strong> " . htmlspecialchars($testPassword) . "</p>";
    echo "<p><a href='public/index.php?page=customer_login' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px;'>Go to Login</a></p>";
    echo "</div>";
} else {
    // Insert new test customer
    $insertStmt = $conn->prepare("INSERT INTO users (name, phone, email, password_hash, is_verified, created_at) VALUES (?, ?, ?, ?, 1, NOW())");
    $insertStmt->bind_param("ssss", $testName, $testPhone, $testEmail, $passwordHash);
    
    if ($insertStmt->execute()) {
        $customerId = $conn->insert_id;
        echo "<div style='background: #d4edda; padding: 20px; border-radius: 5px; font-family: Arial;'>";
        echo "<h2 style='color: #155724;'>✓ Test Customer Created Successfully!</h2>";
        echo "<p><strong>Customer ID:</strong> " . htmlspecialchars($customerId) . "</p>";
        echo "<p><strong>Name:</strong> " . htmlspecialchars($testName) . "</p>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($testEmail) . "</p>";
        echo "<p><strong>Password:</strong> " . htmlspecialchars($testPassword) . "</p>";
        echo "<p><strong>Phone:</strong> " . htmlspecialchars($testPhone) . "</p>";
        echo "<hr>";
        echo "<h3>Use these credentials to login:</h3>";
        echo "<p><a href='public/index.php?page=customer_login' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 3px; display: inline-block;'>Go to Login Page</a></p>";
        echo "</div>";
    } else {
        echo "<div style='background: #f8d7da; padding: 20px; border-radius: 5px; font-family: Arial;'>";
        echo "<h2 style='color: #721c24;'>✗ Error Creating Customer</h2>";
        echo "<p>" . htmlspecialchars($conn->error) . "</p>";
        echo "</div>";
    }
}

$conn->close();
?>
