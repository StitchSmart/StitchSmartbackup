<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$conn = $db->connect();
$result = $conn->query('SELECT * FROM admin');
$admin = $result->fetch_assoc();
echo "Email: " . $admin['email'] . "\n";
echo "Password: " . $admin['password'] . "\n";
echo "Password Length: " . strlen($admin['password']) . "\n";
?>
