<?php
// Test script to verify CSRF token handling
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session exactly like the router does
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get current state
$has_csrf_token = !empty($_SESSION['csrf_token']);
$has_last_activity = isset($_SESSION['last_activity']);
$last_activity_value = $_SESSION['last_activity'] ?? 'not set';
$current_time = time();
$time_since_last_activity = $has_last_activity ? ($current_time - (int)$_SESSION['last_activity']) : 'N/A';

?>
<!DOCTYPE html>
<html>
<head>
    <title>CSRF Token Test</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .box { padding: 10px; margin: 10px 0; border: 1px solid #ccc; background: #f5f5f5; }
        .token { word-wrap: break-word; font-family: monospace; }
    </style>
</head>
<body>
<h1>CSRF Token Debug Info</h1>

<div class="box">
    <h3>Session State</h3>
    <p><strong>Has CSRF Token:</strong> <?= $has_csrf_token ? 'YES' : 'NO' ?></p>
    <p><strong>Has Last Activity:</strong> <?= $has_last_activity ? 'YES' : 'NO' ?></p>
    <p><strong>Last Activity Value:</strong> <?= htmlspecialchars($last_activity_value) ?></p>
    <p><strong>Current Time:</strong> <?= $current_time ?></p>
    <p><strong>Time Since Last Activity:</strong> <?= is_numeric($time_since_last_activity) ? round($time_since_last_activity) . ' seconds' : $time_since_last_activity ?></p>
    <p><strong>Session ID:</strong> <?= htmlspecialchars(session_id()) ?></p>
</div>

<div class="box">
    <h3>CSRF Token Value</h3>
    <p class="token"><?= htmlspecialchars($_SESSION['csrf_token'] ?? 'NOT SET') ?></p>
</div>

<div class="box">
    <h3>Full Session Array</h3>
    <pre><?= htmlspecialchars(json_encode($_SESSION, JSON_PRETTY_PRINT)) ?></pre>
</div>

<div class="box">
    <h3>Test Form</h3>
    <p>This form will POST to itself and verify token handling:</p>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
        <button type="submit">Submit Form (Test CSRF)</button>
    </form>
</div>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
<div class="box" style="background: #efe;">
    <h3>POST Result</h3>
    <p><strong>Submitted Token:</strong> <?= htmlspecialchars($_POST['csrf_token'] ?? 'NOT PROVIDED') ?></p>
    <p><strong>Session Token:</strong> <?= htmlspecialchars($_SESSION['csrf_token'] ?? 'NOT SET') ?></p>
    <p><strong>Match:</strong> <?= hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'] ?? '') ? 'YES ✓' : 'NO ✗' ?></p>
</div>
<?php endif; ?>

</body>
</html>
