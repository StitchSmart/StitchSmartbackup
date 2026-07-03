<?php
// Direct product database test
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'config/database.php';

try {
    $database = new Database();
    $db = $database->connect();
    
    // Check if products table exists and has data
    $result = $db->query("SELECT COUNT(*) as count FROM product LIMIT 1");
    if (!$result) {
        die('Error querying products: ' . $db->error);
    }
    
    $row = $result->fetch_assoc();
    $count = $row['count'] ?? 0;
    
    echo "Products in database: " . $count . "\n\n";
    
    if ($count > 0) {
        echo "First 5 products:\n";
        // Get columns first
        $result = $db->query("DESCRIBE product");
        echo "Product table columns:\n";
        while ($col = $result->fetch_assoc()) {
            echo "  - " . $col['Field'] . "\n";
        }
        
        echo "\nFirst 5 products (full dump):\n";
        $result = $db->query("SELECT * FROM product LIMIT 5");
        while ($product = $result->fetch_assoc()) {
            echo "ID: " . $product['id'] . ", Name: " . $product['product_name'] . ", Price: " . $product['price'] . "\n";
        }
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
