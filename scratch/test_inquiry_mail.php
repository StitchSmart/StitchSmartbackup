<?php
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/Exception.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/PHPMailer.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = "Test User";
$email = "test@example.com";
$mobile = "1234567890";
$whatsapp = "0987654321";
$message = "This is a test message to verify HTML email formatting.";
$subject = "New Hoodie Inquiry from Test User";
$body = "New Hoodie Inquiry from Test User
--------------------------
Contact: Email test@example.com | Mobile 1234567890 | WhatsApp 0987654321
Message: This is a test message to verify HTML email formatting.

Order Details
--------------------------
Fit: Regular fit
Fabric: Fleece, 320GSM, 100% cotton brushed back
Dye: Garment Dye [ reactive ]
Color: #000000
Hood Type: Double lined hood
Drawstring: Matching
Notes: Some additional custom notes.

Labels: Standard - Polyester (#000000) - Type: back - label description here

Prints/Comments: None

Finishing:
- Sunfade: Shoulder Sunfade
- Stitching: Standard Stitching (white)
- Distressing: Heavy Distressing
- Pocket: Kangaroo pouch pocket

Quantities (Sample: No):
XXS: 0, XS: 1, S: 2, M: 3, L: 4, XL: 5, XXL: 0, XXXL: 0, XXXXL: 0

Sent via Hoodie Custom Form";

require_once BASE_PATH . '/app/controllers/DesignController.php';

class DummyController extends DesignController {
    public function test() {
        global $subject, $body, $name, $email, $mobile, $whatsapp, $message;
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 2; // Enable verbose debug output
        try {
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USERNAME;
            $mail->Password   = MAIL_PASSWORD;
            $mail->SMTPSecure = MAIL_ENCRYPTION;
            $mail->Port       = MAIL_PORT;

            $mail->setFrom(MAIL_USERNAME, 'Stitch Smart Design Inquiry');
            $mail->addAddress('stitchSmartofficial@gmail.com');
            $mail->addReplyTo($email, $name);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $this->formatHtmlEmail($subject, $body, $name, $email, $mobile, $whatsapp, $message);
            $mail->AltBody = $body;

            $mail->send();
            echo "SUCCESS: Email sent successfully!\n";
        } catch (Exception $e) {
            echo "ERROR: Mailer Error: " . $mail->ErrorInfo . "\n";
        }
    }
}

$test = new DummyController();
$test->test();
