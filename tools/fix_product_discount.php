<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$conn = $db->connect();

// Reset all existing products' sale discount to 0
$result = $conn->query("UPDATE product SET sale_discount_percent = 0 WHERE sale_discount_percent >= 20");

if ($result) {
    // Get count of updated products
    $check = $conn->query("SELECT COUNT(*) as total FROM product");
    $row = $check->fetch_assoc();
    echo "✓ Updated all products!\n\n";
    echo "Total products in database: " . $row['total'] . "\n";
    
    // Show products
    $check = $conn->query("SELECT id, name, sale_discount_percent FROM product");
    echo "\nProducts status:\n";
    while ($product = $check->fetch_assoc()) {
        echo "  - ID: " . $product['id'] . " | Name: " . $product['name'] . " | Discount: " . $product['sale_discount_percent'] . "%\n";
    }
} else {
    echo "✗ Error updating products\n";
}
?>
