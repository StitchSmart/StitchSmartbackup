<?php
// Clear all session data and start fresh
session_start();
session_destroy();

// Create new session
session_start();

// Verify session is clean
echo "=== SESSION CLEARED ===\n";
echo "Session ID: " . session_id() . "\n";
echo "Session data empty: " . (count($_SESSION) == 0 ? "✓ YES" : "❌ NO") . "\n";
echo "\nReady for fresh login!\n\n";

echo "<a href='http://localhost/Stitch-Smart/public/index.php?page=customer_login' style='padding: 10px 20px; background: #c19a4e; color: white; text-decoration: none; border-radius: 5px;'>Go to Login Page</a>";
?>
