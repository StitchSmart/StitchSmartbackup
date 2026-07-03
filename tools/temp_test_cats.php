<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'StitchSmart');
$query = "SELECT c_id, c_name FROM category 
          WHERE parent_id = 0 
          AND LOWER(c_name) IN ('men', 'women', 'kids')
          ORDER BY FIELD(LOWER(c_name), 'men', 'women', 'kids')";
$res = $conn->query($query);
while($row = $res->fetch_assoc()) {
    print_r($row);
}
echo "ALL CATEGORIES:\n";
$res = $conn->query("SELECT c_id, c_name, parent_id FROM category WHERE LOWER(c_name) = 'women'");
while($row = $res->fetch_assoc()) {
    print_r($row);
}
