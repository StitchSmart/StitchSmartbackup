<?php
require 'config/config.php';
require 'config/database.php';
require 'app/models/Admin.php';

$db = new Database();
$admin_model = new Admin($db);

// Test login with the admin email and password
$result = $admin_model->checkLogin('moizmalikofficiall@gmail.com', 'admin123');

if ($result) {
    echo "✓ Login successful!\n";
    echo "Admin ID: " . $result['id'] . "\n";
    echo "Admin Email: " . $result['email'] . "\n";
} else {
    echo "✗ Login failed\n";
    
    // Debug: Check what's in the database
    $db_conn = $db->connect();
    $stmt = $db_conn->prepare("SELECT id, email, password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $email = 'moizmalikofficiall@gmail.com';
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "\nDebug info:\n";
        echo "Email found: " . $row['email'] . "\n";
        echo "Stored password hash: " . substr($row['password'], 0, 50) . "...\n";
        echo "Hash is valid: " . (password_verify('admin123', $row['password']) ? "YES" : "NO") . "\n";
    } else {
        echo "\n✗ Admin user not found in database\n";
    }
}
?>
