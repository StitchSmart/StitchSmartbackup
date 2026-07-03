<?php
require 'config/database.php';
$db = (new Database())->connect();
$res = $db->query('SELECT c_id, c_name, parent_id FROM category');
while($row = $res->fetch_assoc()) {
    print_r($row);
}
