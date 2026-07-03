<?php
require_once "config/config.php";
require_once "config/database.php";
require_once "app/models/Product.php";

$database = new Database();
$db = $database->connect();
$product = new Product($db);

echo "Testing searchProducts method:<br>";
$results = $product->searchProducts("shirt", null);
echo "Results: " . json_encode($results) . "<br>";

?>
