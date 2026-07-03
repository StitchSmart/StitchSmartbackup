<?php
// Clear login attempts for test account
session_start();

// Method 1: Clear from current session
if (isset($_SESSION['customer_login_attempts']['test@stitchsmart.com'])) {
    unset($_SESSION['customer_login_attempts']['test@stitchsmart.com']);
    echo "✓ Cleared login attempts from session\n";
} else {
    echo "No login attempts in current session\n";
}

// Regenerate session ID to be safe
session_regenerate_id(true);

echo "\n=== ATTEMPTING LOGIN ===\n";
echo "Email: test@stitchsmart.com\n";
echo "Password: Test@123\n";
echo "\nLoginattempt counter has been reset!\n";
echo "You should now be able to login.\n";

echo "\n<a href='http://localhost/Stitch-Smart/public/index.php?page=customer_login'>Go to Login Page</a>";
?>
