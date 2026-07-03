<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$conn = $db->connect();

// Update admin password to hashed "admin123"
$password = "admin123";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$email = "moizmalikofficiall@gmail.com";

$stmt = $conn->prepare("UPDATE admin SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $hashedPassword, $email);
$result = $stmt->execute();

if ($result) {
    echo "✓ Admin password updated to: admin123\n";
    echo "Email: moizmalikofficiall@gmail.com\n";
} else {
    echo "✗ Failed to update password\n";
}
?>
