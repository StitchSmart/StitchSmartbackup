<?php
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

// Get all products with valid categories AND stock quantity > 0
$result = $conn->query("
    SELECT 
        p.id, 
        p.name, 
        p.article_number, 
        p.price, 
        p.size, 
        p.image_url, 
        p.Fabric_Type as fabric_type,
        p.Designing as designing,
        p.description,
        p.details,
        p.quantity,
        p.parent_cat as category_id,
        c.c_name as category
    FROM product p 
    INNER JOIN category c ON p.parent_cat = c.c_id
    WHERE p.name != '' AND p.name IS NOT NULL 
    AND p.price > 0
    AND p.quantity > 0
    AND c.c_name != '' AND c.c_name IS NOT NULL
    ORDER BY p.id
");

$products = [];
while($row = $result->fetch_assoc()) {
    $products[] = [
        'id' => (int)$row['id'],
        'name' => $row['name'],
        'article_number' => $row['article_number'],
        'price' => (float)$row['price'],
        'size' => $row['size'],
        'image_url' => $row['image_url'],
        'fabric_type' => $row['fabric_type'],
        'designing' => $row['designing'],
        'description' => $row['description'],
        'details' => $row['details'],
        'quantity' => (int)$row['quantity'],
        'category_id' => (int)$row['category_id'],
        'category' => $row['category']
    ];
}

// Write to products.json
$jsonFile = __DIR__ . '/FYP-Chatbot/FYP-Chatbot/data/products.json';
$dir = dirname($jsonFile);
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

file_put_contents($jsonFile, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

echo "✅ Generated products.json with " . count($products) . " in-stock products\n";
echo "📁 File saved to: " . $jsonFile . "\n";
echo "\n📦 Products included:\n";
foreach($products as $p) {
    echo "- ID: {$p['id']} | {$p['name']} | Stock: {$p['quantity']} | {$p['category']}\n";
}
?>
