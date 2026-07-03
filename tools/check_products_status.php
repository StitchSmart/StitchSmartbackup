<?php
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

echo "<h2>Products Status Report</h2>\n";

// Count total products
$result = $conn->query("SELECT COUNT(*) as total FROM product");
$row = $result->fetch_assoc();
echo "<p><strong>Total Products in Database:</strong> " . $row['total'] . "</p>\n";

// Products WITH valid categories
$result = $conn->query("
    SELECT COUNT(*) as total FROM product p 
    INNER JOIN category c ON p.parent_cat = c.c_id AND c.c_id IS NOT NULL
    WHERE p.name != '' AND p.name IS NOT NULL AND p.price > 0
    AND c.c_name != '' AND c.c_name IS NOT NULL
");
$row = $result->fetch_assoc();
echo "<p><strong style='color: green;'>✅ Products WITH valid categories:</strong> " . $row['total'] . "</p>\n";

// Products WITHOUT valid categories
$result = $conn->query("
    SELECT COUNT(*) as total FROM product p 
    WHERE (p.parent_cat IS NULL OR p.parent_cat NOT IN (SELECT c_id FROM category))
    OR p.parent_cat = '' OR p.parent_cat = 0
");
$row = $result->fetch_assoc();
echo "<p><strong style='color: red;'>❌ Products WITHOUT valid categories:</strong> " . $row['total'] . "</p>\n";

echo "<hr>\n<h3>Products that NEED category assignment:</h3>\n";
echo "<table border='1' cellpadding='8'>\n";
echo "<tr><th>ID</th><th>Product Name</th><th>Current parent_cat</th><th>Status</th></tr>\n";

$result = $conn->query("
    SELECT id, name, parent_cat FROM product p 
    WHERE (p.parent_cat IS NULL OR p.parent_cat NOT IN (SELECT c_id FROM category))
    ORDER BY id
");

while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>" . ($row['parent_cat'] ?: 'NULL') . "</td><td>❌ NEEDS FIX</td></tr>\n";
}
echo "</table>\n";

echo "<hr>\n<h3>Available Categories:</h3>\n";
echo "<table border='1' cellpadding='8'>\n";
echo "<tr><th>Category ID</th><th>Category Name</th></tr>\n";

$result = $conn->query("SELECT c_id, c_name FROM category ORDER BY c_id");
while($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['c_id']}</td><td>{$row['c_name']}</td></tr>\n";
}
echo "</table>\n";
?>
