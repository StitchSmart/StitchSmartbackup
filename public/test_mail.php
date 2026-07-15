<?php
/**
 * Test SMTP connection and print detailed error logs.
 */
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/Exception.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/PHPMailer.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: text/plain; charset=utf-8');

echo "StitchSmart SMTP Diagnostics\n";
echo "=============================\n";
echo "Host: " . MAIL_HOST . "\n";
echo "Port: " . MAIL_PORT . "\n";
echo "Username: " . MAIL_USERNAME . "\n";
echo "Encryption: " . MAIL_ENCRYPTION . "\n\n";

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 3; // Enable verbose debug output
    $mail->Debugoutput = function($str, $level) {
        echo "[PHPMailer Debug] $str\n";
    };

    $mail->isSMTP();
    $mail->Host       = MAIL_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = MAIL_USERNAME;
    $mail->Password   = MAIL_PASSWORD;
    $mail->SMTPSecure = MAIL_ENCRYPTION;
    $mail->Port       = MAIL_PORT;
    $mail->Timeout    = 10;

    $mail->setFrom(MAIL_USERNAME, 'StitchSmart Diagnostics');
    $mail->addAddress('stitchsmartofficial@gmail.com', 'StitchSmart Test Recipient');

    $mail->isHTML(false);
    $mail->Subject = 'StitchSmart Test Mail';
    $mail->Body    = 'This is a diagnostic email to test SMTP connectivity on Railway.';

    echo "Attempting to send email...\n";
    $mail->send();
    echo "\nSUCCESS! Email sent successfully.\n";

} catch (Exception $e) {
    echo "\nFAILURE: " . $mail->ErrorInfo . "\n";
    echo "Exception Message: " . $e->getMessage() . "\n";
}
