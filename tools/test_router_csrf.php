<?php
// Comprehensive CSRF Router Test - simulates public/index.php flow
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define minimum config
define('BASE_PATH', dirname(__FILE__) . '/');
define('BASE_URL', 'http://localhost/Stitch-Smart/');
define('APP_DEBUG', true);
define('SESSION_TIMEOUT_SECONDS', 1800); // 30 minutes

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize CSRF token if not present
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Initialize last activity if not present
if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
}

$currentTime = time();
$lastActivityTime = (int) $_SESSION['last_activity'];
$timeSinceActivity = $currentTime - $lastActivityTime;
$isSessionExpired = $timeSinceActivity > SESSION_TIMEOUT_SECONDS;

// Test: Simulate a POST request to test CSRF
$testMode = isset($_GET['test_csrf']);
$testTokenMismatch = isset($_GET['mismatch']);

if ($testMode && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedToken = $_POST['csrf_token'] ?? '';
    $sessionToken = $_SESSION['csrf_token'];
    
    $tokenValid = hash_equals($sessionToken, $submittedToken);
    $result = [
        'post_token' => substr($submittedToken, 0, 16) . '...',
        'session_token' => substr($sessionToken, 0, 16) . '...',
        'token_valid' => $tokenValid,
        'session_expired' => $isSessionExpired,
        'time_since_activity' => $timeSinceActivity,
        'timeout_seconds' => SESSION_TIMEOUT_SECONDS,
    ];
}

// Update last activity at end of request (after token validation)
if (!$testTokenMismatch) {
    $_SESSION['last_activity'] = time();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Router CSRF Test</title>
    <style>
        body { font-family: Arial; margin: 20px; background: #f0f0f0; }
        .container { max-width: 900px; margin: 0 auto; }
        .box { padding: 15px; margin: 10px 0; border: 1px solid #ccc; background: white; border-radius: 4px; }
        .success { border-left: 4px solid green; }
        .warning { border-left: 4px solid orange; }
        .error { border-left: 4px solid red; }
        pre { background: #f5f5f5; padding: 10px; overflow-x: auto; font-size: 12px; }
        .token-display { font-family: monospace; word-wrap: break-word; color: #666; font-size: 11px; }
        h2 { color: #333; }
        button { padding: 8px 15px; margin: 5px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .row { display: flex; gap: 20px; }
        .col { flex: 1; }
    </style>
</head>
<body>
<div class="container">
    <h1>🔐 Router CSRF Token Test Suite</h1>

    <div class="row">
        <div class="col">
            <div class="box <?= $isSessionExpired ? 'error' : 'success' ?>">
                <h2>Session Status</h2>
                <p><strong>Current Time:</strong> <?= $currentTime ?></p>
                <p><strong>Last Activity:</strong> <?= $lastActivityTime ?></p>
                <p><strong>Time Since Activity:</strong> <strong style="color: <?= $timeSinceActivity > 1000 ? 'orange' : 'green' ?>;"><?= $timeSinceActivity ?> seconds</strong></p>
                <p><strong>Session Timeout:</strong> <?= SESSION_TIMEOUT_SECONDS ?> seconds (30 minutes)</p>
                <p><strong>Session Expired:</strong> <?= $isSessionExpired ? 'YES ❌' : 'NO ✓' ?></p>
                <p><strong>Session ID:</strong> <code><?= htmlspecialchars(session_id()) ?></code></p>
            </div>
        </div>
        
        <div class="col">
            <div class="box">
                <h2>CSRF Token Info</h2>
                <p><strong>Token Value (first 32 chars):</strong></p>
                <p class="token-display"><?= substr(htmlspecialchars($_SESSION['csrf_token']), 0, 32) ?></p>
                <p><strong>Full Token Length:</strong> <?= strlen($_SESSION['csrf_token']) ?> characters</p>
                <p><strong>Token Type:</strong> Hexadecimal (bin2hex of 32 random bytes)</p>
            </div>
        </div>
    </div>

    <div class="box">
        <h2>Test CSRF Token Validation</h2>
        <p>These buttons will submit a form to test the CSRF token validation logic:</p>
        
        <h4>✓ Test 1: Valid Token</h4>
        <p>This will submit the current valid CSRF token and should succeed:</p>
        <form method="POST" style="display: inline;">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <input type="hidden" name="test_mode" value="1">
            <button type="submit" formaction="?test_csrf=1">Submit Valid Token</button>
        </form>

        <h4>✗ Test 2: Invalid Token</h4>
        <p>This will submit an invalid token and should show error:</p>
        <form method="POST" style="display: inline;">
            <input type="hidden" name="csrf_token" value="invalid_token_12345">
            <input type="hidden" name="test_mode" value="1">
            <button type="submit" formaction="?test_csrf=1">Submit Invalid Token</button>
        </form>

        <h4>⏰ Test 3: Empty Token</h4>
        <p>This will submit without a token (simulating missing CSRF field):</p>
        <form method="POST" style="display: inline;">
            <input type="hidden" name="test_mode" value="1">
            <button type="submit" formaction="?test_csrf=1">Submit Without Token</button>
        </form>
    </div>

    <?php if (isset($result)): ?>
    <div class="box <?= $result['token_valid'] ? 'success' : 'error' ?>">
        <h2>Test Result</h2>
        <pre><?= htmlspecialchars(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) ?></pre>
        
        <?php if ($result['token_valid']): ?>
            <p style="color: green; font-weight: bold;">✓ Token is VALID - Form would be processed</p>
        <?php else: ?>
            <p style="color: red; font-weight: bold;">✗ Token is INVALID - Router would reject with "Invalid security token" error</p>
        <?php endif; ?>

        <?php if ($result['session_expired']): ?>
            <p style="color: orange; font-weight: bold;">⚠ Session has expired (>30 min inactivity) - User would be redirected to login</p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="box">
        <h2>Session Debug Info</h2>
        <pre><?= htmlspecialchars(json_encode($_SESSION, JSON_PRETTY_PRINT)) ?></pre>
    </div>

    <div class="box warning">
        <h2>How This Works</h2>
        <ol>
            <li><strong>Session starts:</strong> $_SESSION['last_activity'] is set to current time</li>
            <li><strong>CSRF token generated:</strong> $_SESSION['csrf_token'] = bin2hex(random_bytes(32))</li>
            <li><strong>User submits form:</strong> Browser sends CSRF token in hidden field</li>
            <li><strong>Router validates:</strong> Compares submitted token with session token using hash_equals()</li>
            <li><strong>On timeout (>30 min):</strong> Session is destroyed and recreated, user redirected to login</li>
            <li><strong>On token mismatch:</strong> Router regenerates token and shows redirect with error message</li>
            <li><strong>After validation:</strong> last_activity is updated to current time</li>
        </ol>
    </div>

</div>
</body>
</html>
