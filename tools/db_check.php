<?php
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

// Check if products table exists and has data
$result = $conn->query("SELECT COUNT(*) as total FROM product");
$row = $result->fetch_assoc();
echo "Products in database: " . $row['total'] . "\n";

// Check if categories exist
$result = $conn->query("SELECT COUNT(*) as total FROM category");
$row = $result->fetch_assoc();
echo "Categories in database: " . $row['total'] . "\n";

// Check product_reviews table
$result = $conn->query("SELECT COUNT(*) as total FROM product_reviews");
$row = $result->fetch_assoc();
echo "Product reviews in database: " . $row['total'] . "\n";

echo "\nFirst 5 products:\n";
$result = $conn->query("SELECT id, name, parent_cat FROM product LIMIT 5");
while($row = $result->fetch_assoc()) {
    echo "- ID: {$row['id']}, Name: {$row['name']}, Category: {$row['parent_cat']}\n";
}

echo "\nAll categories:\n";
$result = $conn->query("SELECT c_id, c_name FROM category");
while($row = $result->fetch_assoc()) {
    echo "- ID: {$row['c_id']}, Name: {$row['c_name']}\n";
}
?>
