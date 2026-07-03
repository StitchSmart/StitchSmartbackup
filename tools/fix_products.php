<?php
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

echo "🔧 Fixing product categorization...\n";

// Move jackets (61, 63) to MEN category (ID: 1)
$conn->query("UPDATE product SET parent_cat = 1 WHERE id IN (61, 63)");
echo "✅ Moved jackets (IDs 61, 63) to MEN category\n";

// Delete junk product "ads" (ID: 62)
$conn->query("DELETE FROM product WHERE id = 62");
echo "✅ Deleted junk product (ID: 62 - 'ads')\n";

// Verify changes
$result = $conn->query("SELECT COUNT(*) as total FROM product");
$row = $result->fetch_assoc();
echo "✅ Total products now: " . $row['total'] . "\n";

// Show all categories with product counts
echo "\n📊 Products by Category:\n";
$result = $conn->query("
    SELECT c.c_name, COUNT(p.id) as count
    FROM category c
    LEFT JOIN product p ON c.c_id = p.parent_cat
    GROUP BY c.c_id, c.c_name
    ORDER BY count DESC
");
while($row = $result->fetch_assoc()) {
    echo "- {$row['c_name']}: {$row['count']} products\n";
}
?>
