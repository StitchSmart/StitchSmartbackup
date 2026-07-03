<?php
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

// AUTO-ASSIGN products to categories based on their names
echo "🔄 Assigning products to categories...\n";

// Men's products → MEN (ID: 1)
$menProducts = [24, 32, 34, 59]; // Men's Graphic Sweatshirt, Men's Denim Jacket, Men's Sleeveless Jacket, Men's Distressed Leather Jacket
foreach($menProducts as $id) {
    $conn->query("UPDATE product SET parent_cat = 1 WHERE id = $id");
    echo "✅ Product $id assigned to MEN (ID: 1)\n";
}

// Women's products → WOMEN (ID: 12)
$womenProducts = [31, 33, 35, 36, 37, 38, 39, 40, 41]; // All women's items
foreach($womenProducts as $id) {
    $conn->query("UPDATE product SET parent_cat = 12 WHERE id = $id");
    echo "✅ Product $id assigned to WOMEN (ID: 12)\n";
}

// Workwear/uniforms → MEN (ID: 1) [can be moved later]
$workwearProducts = [50, 51, 52, 53];
foreach($workwearProducts as $id) {
    $conn->query("UPDATE product SET parent_cat = 1 WHERE id = $id");
    echo "✅ Product $id assigned to MEN (ID: 1) [workwear]\n";
}

// Compression items → WOMEN (ID: 12)
$sportProducts = [45, 46, 47, 48];
foreach($sportProducts as $id) {
    $conn->query("UPDATE product SET parent_cat = 12 WHERE id = $id");
    echo "✅ Product $id assigned to WOMEN (ID: 12) [sportswear]\n";
}

echo "\n✅ All products assigned to categories!\n";

// Verify
echo "\nVerifying...\n";
$result = $conn->query("
    SELECT COUNT(*) as total FROM product p 
    INNER JOIN category c ON p.parent_cat = c.c_id AND c.c_id IS NOT NULL
    WHERE p.name != '' AND p.name IS NOT NULL AND p.price > 0
    AND c.c_name != '' AND c.c_name IS NOT NULL
");
$row = $result->fetch_assoc();
echo "✅ Products now with valid categories: " . $row['total'] . "\n";

// Show updated list
echo "\n📦 Updated Products:\n";
$result = $conn->query("
    SELECT p.id, p.name, c.c_name as category FROM product p 
    INNER JOIN category c ON p.parent_cat = c.c_id 
    WHERE p.name != '' AND p.name IS NOT NULL AND p.price > 0
    AND c.c_name != '' AND c.c_name IS NOT NULL
    ORDER BY p.id
");
while($row = $result->fetch_assoc()) {
    echo "- ID: {$row['id']} | {$row['name']} | {$row['category']}\n";
}
?>
