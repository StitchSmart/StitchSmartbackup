<?php
$conn = new mysqli("localhost", "root", "", "StitchSmart");
if ($conn->connect_error) die('DB Error: ' . $conn->connect_error);

$res = $conn->query("DESCRIBE product_reviews");
echo "Columns in product_reviews:\n";
while($row = $res->fetch_assoc()) {
    print_r($row);
}
?>
