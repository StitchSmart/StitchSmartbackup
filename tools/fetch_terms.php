<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$conn = $db->connect();

$sql = "SELECT id, content FROM pages WHERE slug = 'terms-and-condition'";
$res = $conn->query($sql);
$row = $res->fetch_assoc();

if ($row) {
    file_put_contents('terms_content.html', $row['content']);
    echo "Content saved to terms_content.html\n";
} else {
    echo "Page not found.\n";
}
?>
