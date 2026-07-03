<?php
// Direct database connection
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

echo "=== ALL PRODUCTS IN DATABASE ===\n\n";
$result = $conn->query("SELECT p.id, p.name, p.price, p.parent_cat, c.c_name FROM product p LEFT JOIN category c ON p.parent_cat = c.c_id ORDER BY p.id");
while($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Price: {$row['price']} | Category ID: {$row['parent_cat']} | Category: {$row['c_name']}\n";
}

echo "\n=== PRODUCTS WITH VALID CATEGORIES (What chatbot sees) ===\n\n";
$result = $conn->query("
    SELECT p.id, p.name, p.price, c.c_id, c.c_name 
    FROM product p 
    INNER JOIN category c ON p.parent_cat = c.c_id AND c.c_id IS NOT NULL
    WHERE p.name != '' AND p.name IS NOT NULL
    AND p.price > 0
    AND c.c_name != '' AND c.c_name IS NOT NULL
");
echo "Total Products with Valid Categories: " . $result->num_rows . "\n";
while($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']} | Name: {$row['name']} | Price: {$row['price']} | Category: {$row['c_name']}\n";
}

echo "\n=== ALL CATEGORIES ===\n\n";
$result = $conn->query("SELECT c_id, c_name FROM category ORDER BY c_id");
while($row = $result->fetch_assoc()) {
    echo "ID: {$row['c_id']} | Category: {$row['c_name']}\n";
}
?>
