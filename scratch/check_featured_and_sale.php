<?php
define('BASE_PATH', dirname(__DIR__));
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/Product.php';

$db = (new Database())->connect();
$productModel = new Product($db);

$featuredCount = $productModel->getFeaturedProductsCount();
$featuredProducts = $productModel->getFeaturedProducts(20, 0);

$saleCount = $productModel->getSaleProductsCount();
$saleProducts = $productModel->getSaleProductsPaginated(20, 0);

echo "--- FEATURED PRODUCTS ---\n";
echo "Count: {$featuredCount}\n";
foreach ($featuredProducts as $p) {
    echo "- ID: {$p['id']}, Name: {$p['name']}, Featured: {$p['featured']}, Sale Discount: {$p['sale_discount_percent']}%\n";
}

echo "\n--- SALE PRODUCTS ---\n";
echo "Count: {$saleCount}\n";
foreach ($saleProducts as $p) {
    echo "- ID: {$p['id']}, Name: {$p['name']}, Featured: {$p['featured']}, Sale Discount: {$p['sale_discount_percent']}%\n";
}
?>
