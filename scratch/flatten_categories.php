<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$conn = $db->connect();
$conn->query("UPDATE category SET parent_id = 0");
echo "Categories flattened successfully!\n";
