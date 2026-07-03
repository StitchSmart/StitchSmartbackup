<?php
$conn = new mysqli('127.0.0.1', 'root', '', 'StitchSmart');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check main categories
$res = $conn->query("SELECT * FROM category WHERE parent_id = 0");
echo "MAIN CATEGORIES:\n";
while($row = $res->fetch_assoc()) {
    echo $row['c_id'] . " - " . $row['c_name'] . "\n";
}

// Add Women if missing
$res = $conn->query("SELECT * FROM category WHERE LOWER(c_name) = 'women' AND parent_id = 0");
if ($res->num_rows == 0) {
    $conn->query("INSERT INTO category (c_name, slug, parent_id, c_description) VALUES ('Women', 'women', 0, 'Main Category for Women')");
    echo "Inserted Women\n";
}

// Now insert 3 subcategories for Men, Women, Kids
$main_cats = ['Men', 'Women', 'Kids'];
$sub_names = [
    'Men' => ['Shirts', 'Pants', 'Jackets'],
    'Women' => ['Dresses', 'Tops', 'Skirts'],
    'Kids' => ['Boys', 'Girls', 'Infants']
];

foreach ($main_cats as $mc) {
    $res = $conn->query("SELECT c_id FROM category WHERE LOWER(c_name) = '" . strtolower($mc) . "' AND parent_id = 0");
    if ($row = $res->fetch_assoc()) {
        $parent_id = $row['c_id'];
        
        foreach ($sub_names[$mc] as $sub) {
            $check = $conn->query("SELECT c_id FROM category WHERE LOWER(c_name) = '" . strtolower($sub) . "' AND parent_id = $parent_id");
            if ($check->num_rows == 0) {
                $slug = strtolower($mc . '-' . $sub);
                $conn->query("INSERT INTO category (c_name, slug, parent_id, c_description) VALUES ('$sub', '$slug', $parent_id, '$sub for $mc')");
                echo "Inserted subcategory $sub for $mc\n";
            } else {
                echo "Subcategory $sub for $mc already exists\n";
            }
        }
    }
}
$conn->close();
