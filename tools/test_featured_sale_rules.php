<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$conn = $db->connect();

echo "<h2>Featured & Sale Product Rules Test</h2>\n";
echo "<hr>\n";

echo "<h3>✅ Current Rules Enforced:</h3>\n";
echo "<ul>\n";
echo "<li><strong>Rule 1:</strong> Sale products (discount > 5%) <strong>CANNOT</strong> be featured</li>\n";
echo "<li><strong>Rule 2:</strong> Featured products <strong>CANNOT</strong> be put on sale</li>\n";
echo "<li><strong>Action:</strong> System shows error message and prevents the action</li>\n";
echo "</ul>\n";

echo "<hr>\n";
echo "<h3>📊 Current Product Status:</h3>\n";

$result = $conn->query("SELECT id, name, featured, sale_discount_percent FROM product");
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8'>\n";
    echo "<tr><th>ID</th><th>Product Name</th><th>Featured</th><th>Sale Discount</th><th>Status</th></tr>\n";
    
    while ($product = $result->fetch_assoc()) {
        $featured = $product['featured'] ? '✅ YES' : '❌ NO';
        $sale = $product['sale_discount_percent'] . '%';
        
        if ($product['featured'] && $product['sale_discount_percent'] > 5) {
            $status = '⚠️ CONFLICT: Featured AND on sale!';
        } elseif ($product['featured']) {
            $status = '✅ Featured (not on sale)';
        } elseif ($product['sale_discount_percent'] > 5) {
            $status = '✅ On sale (not featured)';
        } else {
            $status = '⚪ Regular product';
        }
        
        echo "<tr>\n";
        echo "<td>" . $product['id'] . "</td>\n";
        echo "<td>" . $product['name'] . "</td>\n";
        echo "<td>" . $featured . "</td>\n";
        echo "<td>" . $sale . "</td>\n";
        echo "<td>" . $status . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
} else {
    echo "No products in database\n";
}

echo "<hr>\n";
echo "<h3>🔒 Validation Summary:</h3>\n";
echo "<p><strong>When trying to Feature a Sale Product:</strong><br>";
echo "Error: ❌ Cannot feature this product - it is currently on sale. Remove it from sale first!</p>\n";

echo "<p><strong>When trying to Sale a Featured Product:</strong><br>";
echo "Error: ❌ Cannot put this product on sale - it is currently featured. Remove from featured first!</p>\n";

?>
