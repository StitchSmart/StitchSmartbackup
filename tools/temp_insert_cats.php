<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'StitchSmart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure Men, Women, Kids exist as main categories (parent_id = 0)
$required_cats = ['Men', 'Women', 'Kids'];
foreach ($required_cats as $cat) {
    $res = $conn->query("SELECT * FROM category WHERE LOWER(c_name) = '" . strtolower($cat) . "' AND parent_id = 0");
    if ($res->num_rows == 0) {
        $slug = strtolower($cat);
        $conn->query("INSERT INTO category (c_name, slug, parent_id, c_description) VALUES ('$cat', '$slug', 0, 'Main Category for $cat')");
        echo "Inserted $cat\n";
    } else {
        echo "$cat already exists\n";
    }
}
$conn->close();
