<?php
require_once "config/config.php";
require_once "config/database.php";

$database = new Database();
$conn = $database->connect();

// Test 1: Check if product table exists
echo "<h3>Test 1: Product Table Structure</h3>";
$result = $conn->query("DESCRIBE product");
if ($result) {
    echo "<table border='1'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['Field']}</td>";
        echo "<td>{$row['Type']}</td>";
        echo "<td>{$row['Null']}</td>";
        echo "<td>{$row['Key']}</td>";
        echo "<td>{$row['Default']}</td>";
        echo "<td>{$row['Extra']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . $conn->error;
}

// Test 2: Count products
echo "<h3>Test 2: Product Count</h3>";
$result = $conn->query("SELECT COUNT(*) as count FROM product");
$row = $result->fetch_assoc();
echo "Total products: " . $row['count'] . "<br>";

// Test 3: Sample products
echo "<h3>Test 3: Sample Products</h3>";
$result = $conn->query("SELECT id, name FROM product LIMIT 5");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row['id'] . " - " . $row['name'] . "<br>";
    }
} else {
    echo "No products found";
}

// Test 4: Test the problematic query
echo "<h3>Test 4: Search Query Test (searching for 'shirt')</h3>";
$keyword = "%shirt%";
$query = "SELECT p.* FROM product p
         LEFT JOIN category c ON p.parent_cat = c.c_id
         LEFT JOIN category parent_c ON c.parent_id = parent_c.c_id
         WHERE p.name LIKE ? OR p.description LIKE ? OR c.c_name LIKE ? OR parent_c.c_name LIKE ?
         ORDER BY p.id ASC";

$stmt = $conn->prepare($query);
if (!$stmt) {
    echo "Prepare error: " . $conn->error . "<br>";
    echo "Query: " . htmlspecialchars($query) . "<br>";
} else {
    $stmt->bind_param("ssss", $keyword, $keyword, $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "Found " . $result->num_rows . " results<br>";
    while ($row = $result->fetch_assoc()) {
        echo $row['id'] . " - " . $row['name'] . "<br>";
    }
}

?>
