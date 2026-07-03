<?php
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

// Count products with valid categories
$result = $conn->query("
    SELECT COUNT(*) as total FROM product p 
    INNER JOIN category c ON p.parent_cat = c.c_id AND c.c_id IS NOT NULL
    WHERE p.name != '' AND p.name IS NOT NULL AND p.price > 0
    AND c.c_name != '' AND c.c_name IS NOT NULL
");
$row = $result->fetch_assoc();
echo "<strong>✅ Products with valid categories: " . $row['total'] . "</strong>\n\n";

// Show all products with valid categories
$result = $conn->query("
    SELECT p.id, p.name, p.price, c.c_name as category FROM product p 
    INNER JOIN category c ON p.parent_cat = c.c_id AND c.c_id IS NOT NULL
    WHERE p.name != '' AND p.name IS NOT NULL AND p.price > 0
    AND c.c_name != '' AND c.c_name IS NOT NULL
    ORDER BY p.id
");

echo "<table border='1' cellpadding='8'>\n";
echo "<tr><th>ID</th><th>Product Name</th><th>Price</th><th>Category</th></tr>\n";
while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>Rs. {$row['price']}</td><td>{$row['category']}</td></tr>\n";
}
echo "</table>\n";
?>
