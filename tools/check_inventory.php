<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$conn = $db->connect();

// Check product inventory
$result = $conn->query("
    SELECT id, name, category_id, quantity, price
    FROM product 
    WHERE quantity > 0
    ORDER BY quantity DESC, id DESC
    LIMIT 20
");

echo "📦 Products with Inventory (Quantity > 0):\n";
echo "========================================\n\n";

$count = 0;
while($row = $result->fetch_assoc()) {
    $count++;
    echo "{$count}. [{$row['id']}] {$row['name']}\n";
    echo "   Quantity: {$row['quantity']} units | Price: Rs. {$row['price']}\n";
    echo "   Category ID: {$row['category_id']}\n\n";
}

echo "Total in-stock products: $count\n";

// Also check total products
$total = $conn->query("SELECT COUNT(*) as cnt FROM product");
$total_row = $total->fetch_assoc();
echo "Total products in DB: " . $total_row['cnt'] . "\n";

// Check zero-stock products
$zero_stock = $conn->query("SELECT COUNT(*) as cnt FROM product WHERE quantity = 0 OR quantity IS NULL");
$zero_row = $zero_stock->fetch_assoc();
echo "Out-of-stock products: " . $zero_row['cnt'] . "\n";
?>
