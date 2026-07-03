<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Match the exact same session cookie params as index.php
$cookieSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $cookieSecure,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

define('BASE_PATH', realpath(__DIR__));
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/config/database.php';

$conn = (new Database())->connect();

echo "<style>body{font-family:sans-serif;padding:20px;max-width:900px;} table{border-collapse:collapse;width:100%;} td,th{border:1px solid #ccc;padding:8px;text-align:left;} tr:nth-child(even){background:#f9f9f9;} h2{color:#8b6914;border-bottom:2px solid #c19a4e;padding-bottom:6px;} .ok{color:green;font-weight:bold;} .fail{color:red;font-weight:bold;} .warn{color:orange;font-weight:bold;}</style>";
echo "<h1>🔍 AI Search Debug Panel</h1>";

// 1. SESSION
echo "<h2>1. Session</h2><pre>";
echo "customer_id   = " . ($_SESSION['customer_id'] ?? '<span class=\"fail\">NOT SET</span>') . "\n";
echo "customer_name = " . ($_SESSION['customer_name'] ?? 'NOT SET') . "\n";
echo "customer_logged_in = " . ($_SESSION['customer_logged_in'] ?? 'NOT SET') . "\n";
echo "</pre>";

$uid = isset($_SESSION['customer_id']) ? (int)$_SESSION['customer_id'] : null;

// 2. TABLE STATUS
echo "<h2>2. Tables</h2>";
foreach (['user_searches', 'user_product_views'] as $tbl) {
    $r = $conn->query("SHOW TABLES LIKE '$tbl'");
    $exists = ($r && $r->num_rows > 0);
    echo "<b>$tbl</b>: ";
    if ($exists) {
        $cnt = $conn->query("SELECT COUNT(*) as c FROM $tbl")->fetch_assoc()['c'];
        echo "<span class='ok'>EXISTS ($cnt rows)</span>";
    } else {
        echo "<span class='fail'>MISSING — creating now...</span>";
        if ($tbl === 'user_searches') {
            $conn->query("CREATE TABLE user_searches (
                id INT(11) NOT NULL AUTO_INCREMENT,
                user_id INT(11) NOT NULL,
                query VARCHAR(255) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY(id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        } else {
            $conn->query("CREATE TABLE user_product_views (
                id INT(11) NOT NULL AUTO_INCREMENT,
                user_id INT(11) NOT NULL,
                product_id INT(11) NOT NULL,
                viewed_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY(id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
        }
        echo " → " . ($conn->error ? "<span class='fail'>Error: " . $conn->error . "</span>" : "<span class='ok'>Created!</span>");
    }
    echo "<br>";
}

// 3. DIRECT DB INSERT TEST
echo "<h2>3. Direct DB Insert Test</h2>";
if ($uid) {
    $q = "direct_test_" . time();
    $stmt = $conn->prepare("INSERT INTO user_searches (user_id, query) VALUES (?, ?)");
    if (!$stmt) {
        echo "<span class='fail'>PREPARE FAILED: " . $conn->error . "</span>";
    } else {
        $stmt->bind_param("is", $uid, $q);
        if ($stmt->execute()) {
            echo "<span class='ok'>✅ Direct insert works! Row ID: " . $conn->insert_id . "</span><br>Saved: user_id=$uid, query=$q";
        } else {
            echo "<span class='fail'>❌ Execute FAILED: " . $stmt->error . "</span>";
        }
    }
} else {
    echo "<span class='warn'>⚠️ Not logged in — cannot test. Please <a href='/Stitch-Smart/public/index.php?page=customer_login'>login</a> first.</span>";
}

// 4. MODEL INSERT TEST
echo "<h2>4. Model logUserSearch() Test</h2>";
if ($uid) {
    require_once BASE_PATH . '/app/models/Product.php';
    $db2 = (new Database())->connect();
    $productModel = new Product($db2);
    $q2 = "model_test_" . time();
    $productModel->logUserSearch($uid, $q2);

    $check = $conn->query("SELECT * FROM user_searches WHERE query = '$q2'");
    if ($check && $check->num_rows > 0) {
        echo "<span class='ok'>✅ Model logUserSearch() works!</span>";
    } else {
        echo "<span class='fail'>❌ Model logUserSearch() FAILED. DB error: " . $conn->error . "</span>";
    }
} else {
    echo "<span class='warn'>⚠️ Need to be logged in.</span>";
}

// 5. RECENT SEARCHES
echo "<h2>5. Recent Searches (last 20)</h2>";
$r2 = $conn->query("SHOW TABLES LIKE 'user_searches'");
if ($r2 && $r2->num_rows > 0) {
    $rows = $conn->query("SELECT * FROM user_searches ORDER BY id DESC LIMIT 20");
    if ($rows->num_rows === 0) {
        echo "<span class='warn'>No records found.</span>";
    } else {
        echo "<table><tr><th>ID</th><th>User ID</th><th>Query</th><th>Created At</th></tr>";
        while ($row = $rows->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['user_id']}</td><td>{$row['query']}</td><td>{$row['created_at']}</td></tr>";
        }
        echo "</table>";
    }
}

// 6. SIMULATE what ProductController->index() does
echo "<h2>6. Simulate Search Save (like the real controller)</h2>";
if ($uid) {
    $simulatedSearch = "shirt"; // simulate user searching for 'shirt'
    // This is EXACTLY what ProductController::index() does:
    $productModel2 = new Product((new Database())->connect());
    $productModel2->logUserSearch($uid, $simulatedSearch);

    $check2 = $conn->query("SELECT * FROM user_searches WHERE user_id=$uid AND query='$simulatedSearch' ORDER BY id DESC LIMIT 1");
    if ($check2 && $check2->num_rows > 0) {
        $r = $check2->fetch_assoc();
        echo "<span class='ok'>✅ Simulation works! Saved 'shirt' for user $uid at {$r['created_at']}</span>";
    } else {
        echo "<span class='fail'>❌ Simulation FAILED.</span>";
    }
}
