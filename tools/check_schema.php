<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$conn = $db->connect();

// Check product table structure
$result = $conn->query("DESCRIBE product");

echo "📋 Product Table Schema:\n";
echo "========================\n\n";

while($row = $result->fetch_assoc()) {
    echo $row['Field'] . " ({$row['Type']})\n";
}
?>
