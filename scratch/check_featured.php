<?php
define('BASE_PATH', dirname(__DIR__));
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Product.php';

$db = (new Database())->connect();
$productModel = new Product($db);

$count = $productModel->getFeaturedProductsCount();
$products = $productModel->getFeaturedProducts(8, 0);

echo "Count from model: " . $count . "\n";
echo "Products from model:\n";
foreach ($products as $p) {
    echo "- ID: {$p['id']}, Name: {$p['name']}, Featured: {$p['featured']}, Sale Discount: {$p['sale_discount_percent']}%\n";
}
?>
