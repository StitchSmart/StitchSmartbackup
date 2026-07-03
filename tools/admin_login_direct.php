<?php
session_start();
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$conn = $db->connect();

// Set admin session variables directly
$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_name'] = 'Admin User';
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

echo "✓ Admin session set!\n";
echo "Redirecting to dashboard...\n";
header("Location: /Stitch-Smart/public/index.php?page=admin");
exit;
?>
