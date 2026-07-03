<?php
// Test page to check session and orders
session_start();

require_once 'config/config.php';
require_once 'config/database.php';
require_once 'app/models/User.php';

// Auto login test user for debugging
if (empty($_SESSION['customer_logged_in']) && isset($_GET['auto_login'])) {
    $_SESSION['customer_logged_in'] = true;
    $_SESSION['customer_id'] = 1; // Test customer ID
    $_SESSION['customer_name'] = 'Test Customer';
    $_SESSION['customer_email'] = 'test@example.com';
    header("Location: ?");
    exit;
}

// Check logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ?");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Session & Orders Debug</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        .box { background: #f9f9f9; border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .status { padding: 10px; margin: 10px 0; border-radius: 3px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .warning { background: #fff3cd; color: #856404; }
        code { background: #f4f4f4; padding: 2px 5px; border-radius: 3px; }
        button { padding: 8px 15px; margin: 5px; cursor: pointer; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔍 Session & Orders Debug</h1>
    
    <h2>Session Status</h2>
    <div class="box">
        <p><strong>Session ID:</strong> <code><?= session_id(); ?></code></p>
        <p><strong>Session Started:</strong> <?= session_status() === PHP_SESSION_ACTIVE ? 'Yes' : 'No'; ?></p>
        
        <?php if (!empty($_SESSION['customer_logged_in'])): ?>
            <div class="status success">
                ✓ Customer Logged In
                <ul>
                    <li>ID: <code><?= $_SESSION['customer_id']; ?></code></li>
                    <li>Name: <code><?= htmlspecialchars($_SESSION['customer_name'] ?? 'N/A'); ?></code></li>
                    <li>Email: <code><?= htmlspecialchars($_SESSION['customer_email'] ?? 'N/A'); ?></code></li>
                </ul>
            </div>
        <?php else: ?>
            <div class="status error">
                ✗ Not Logged In
            </div>
        <?php endif; ?>
        
        <p><strong>Session Timeout (seconds):</strong> <code><?= env('SESSION_TIMEOUT_SECONDS', 7200); ?></code></p>
        <p><strong>Last Activity:</strong> <code><?= isset($_SESSION['last_activity']) ? date('H:i:s', $_SESSION['last_activity']) : 'Not set'; ?></code></p>
        <p><strong>Time Since Last Activity:</strong> <code><?= isset($_SESSION['last_activity']) ? time() - $_SESSION['last_activity'] : 'N/A'; ?> seconds</code></p>
    </div>

    <?php if (!empty($_SESSION['customer_id'])): ?>
    <h2>Orders for Customer ID <?= $_SESSION['customer_id']; ?></h2>
    <div class="box">
        <?php
        $database = new Database();
        $conn = $database->connect();
        
        $userId = (int)$_SESSION['customer_id'];
        
        // Check if orders table exists
        $checkTable = $conn->query("SHOW TABLES LIKE 'orders'");
        if (!$checkTable || $checkTable->num_rows === 0) {
            echo '<div class="status error">✗ Orders table does not exist!</div>';
        } else {
            // Count orders
            $result = $conn->query("SELECT COUNT(*) as count FROM orders WHERE user_id = $userId");
            $row = $result->fetch_assoc();
            $orderCount = $row['count'] ?? 0;
            
            if ($orderCount > 0) {
                echo '<div class="status success">✓ Found ' . $orderCount . ' order(s)</div>';
                
                // List orders
                $orders = $conn->query("SELECT id, total, status, created_at FROM orders WHERE user_id = $userId ORDER BY id DESC LIMIT 5");
                echo '<table style="width:100%; border-collapse: collapse;">';
                echo '<tr style="background: #f0f0f0;"><th style="border:1px solid #ddd; padding:8px;">Order ID</th><th style="border:1px solid #ddd; padding:8px;">Total</th><th style="border:1px solid #ddd; padding:8px;">Status</th><th style="border:1px solid #ddd; padding:8px;">Date</th></tr>';
                while ($order = $orders->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td style="border:1px solid #ddd; padding:8px;">' . $order['id'] . '</td>';
                    echo '<td style="border:1px solid #ddd; padding:8px;">Rs ' . number_format($order['total'], 2) . '</td>';
                    echo '<td style="border:1px solid #ddd; padding:8px;">' . htmlspecialchars($order['status']) . '</td>';
                    echo '<td style="border:1px solid #ddd; padding:8px;">' . $order['created_at'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<div class="status warning">⚠ No orders found for this customer</div>';
            }
        }
        ?>
    </div>
    <?php endif; ?>

    <h2>Actions</h2>
    <div class="box">
        <?php if (empty($_SESSION['customer_logged_in'])): ?>
            <button onclick="window.location='?auto_login=1'" style="background: #28a745; color: white;">Auto Login (Test Customer)</button>
        <?php else: ?>
            <button onclick="window.location='?logout=1'" style="background: #dc3545; color: white;">Logout</button>
        <?php endif; ?>
        <button onclick="window.location='?'" style="background: #007bff; color: white;">Refresh</button>
        <button onclick="window.location='<?= BASE_URL ?>index.php?page=customer_orders'" style="background: #6c757d; color: white;">View Orders Page</button>
    </div>

</div>
</body>
</html>
