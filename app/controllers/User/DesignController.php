<?php

require_once BASE_PATH.'/config/database.php';
require_once BASE_PATH.'/app/models/settings.php';
require_once BASE_PATH.'/app/models/Product.php';
require_once BASE_PATH.'/app/models/ad_category.php';

require_once BASE_PATH . '/app/libraries/PHPMailer/src/Exception.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/PHPMailer.php';
require_once BASE_PATH . '/app/libraries/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class DesignController {
    private $productModel;
    private $categoryModel;
    private $conn;

    public function __construct(){
        $database = new Database();
        $db = $database->connect();
        $this->conn = $db;

        if ($this->conn) {
            $sqlLogs = "CREATE TABLE IF NOT EXISTS email_logs (
                id INT AUTO_INCREMENT PRIMARY KEY,
                recipient_email VARCHAR(255) NOT NULL,
                subject VARCHAR(255) NOT NULL,
                template_name VARCHAR(100) DEFAULT NULL,
                status VARCHAR(50) NOT NULL,
                error_message TEXT DEFAULT NULL,
                sent_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            @$this->conn->query($sqlLogs);
        }

        $this->productModel = new Product($db);
        $this->categoryModel = new Category($db);
    }
    public function index() {
          $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

        $webname = $webSettings['web_name'] ?? '';
        $webmail = $webSettings['web_mail'] ?? '';
        $webcontact = $webSettings['web_contact'] ?? '';
        $facebook = $webSettings['facebook'] ?? '';
        $instagram = $webSettings['instagram'] ?? '';
        $pinterest = $webSettings['pinterest'] ?? '';
        $linkdin = $webSettings['linkdin'] ?? '';
        $meta_title = $webSettings['meta_title'] ?? '';
        $meta_description = $webSettings['meta_description'] ?? '';
        $global_theme = $webSettings['theme'] ?? 'theme-default';
        $meta_keywords = $webSettings['meta_keywords'] ?? '';

         // fetch data for homepage
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getCategoriesTree();
        require BASE_PATH . '/app/views/User/designyourself/interface.php';
    }
     public function hoodie() {
          $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

        $webname = $webSettings['web_name'] ?? '';
        $webmail = $webSettings['web_mail'] ?? '';
        $webcontact = $webSettings['web_contact'] ?? '';
        $facebook = $webSettings['facebook'] ?? '';
        $instagram = $webSettings['instagram'] ?? '';
        $pinterest = $webSettings['pinterest'] ?? '';
        $linkdin = $webSettings['linkdin'] ?? '';
        $meta_title = $webSettings['meta_title'] ?? '';
        $meta_description = $webSettings['meta_description'] ?? '';
        $global_theme = $webSettings['theme'] ?? 'theme-default';
        $meta_keywords = $webSettings['meta_keywords'] ?? '';

         // fetch data for homepage
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getCategoriesTree();
        require BASE_PATH . '/app/views/User/designyourself/hoodie.php';
    }

    public function shopAllCustomizer() {
        $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

        $webname = $webSettings['web_name'] ?? '';
        $webmail = $webSettings['web_mail'] ?? '';
        $webcontact = $webSettings['web_contact'] ?? '';
        $facebook = $webSettings['facebook'] ?? '';
        $instagram = $webSettings['instagram'] ?? '';
        $pinterest = $webSettings['pinterest'] ?? '';
        $linkdin = $webSettings['linkdin'] ?? '';
        $meta_title = $webSettings['meta_title'] ?? '';
        $meta_description = $webSettings['meta_description'] ?? '';
        $global_theme = $webSettings['theme'] ?? 'theme-default';
        $meta_keywords = $webSettings['meta_keywords'] ?? '';

        $allProducts = $this->productModel->getAllProducts();
        
        // Pagination logic
        $perPage = 12;
        $totalProducts = count($allProducts);
        $totalPages = ceil($totalProducts / $perPage);
        $currentPage = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
        
        // Ensure current page is not greater than total pages if total pages > 0
        if ($totalPages > 0 && $currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        
        $offset = ($currentPage - 1) * $perPage;
        $paginatedProducts = array_slice($allProducts, $offset, $perPage);

        $categories = $this->categoryModel->getCategoriesTree();
        require BASE_PATH . '/app/views/User/designyourself/shopall.php';
    }

    public function shorts() {
          $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

        $webname = $webSettings['web_name'] ?? '';
        $webmail = $webSettings['web_mail'] ?? '';
        $webcontact = $webSettings['web_contact'] ?? '';
        $facebook = $webSettings['facebook'] ?? '';
        $instagram = $webSettings['instagram'] ?? '';
        $pinterest = $webSettings['pinterest'] ?? '';
        $linkdin = $webSettings['linkdin'] ?? '';
        $meta_title = $webSettings['meta_title'] ?? '';
        $meta_description = $webSettings['meta_description'] ?? '';
        $global_theme = $webSettings['theme'] ?? 'theme-default';
        $meta_keywords = $webSettings['meta_keywords'] ?? '';

         // fetch data for homepage
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getCategoriesTree();
        require BASE_PATH . '/app/views/User/designyourself/shorts.php';
    }
    public function crewneck() {
          $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

        $webname = $webSettings['web_name'] ?? '';
        $webmail = $webSettings['web_mail'] ?? '';
        $webcontact = $webSettings['web_contact'] ?? '';
        $facebook = $webSettings['facebook'] ?? '';
        $instagram = $webSettings['instagram'] ?? '';
        $pinterest = $webSettings['pinterest'] ?? '';
        $linkdin = $webSettings['linkdin'] ?? '';
        $meta_title = $webSettings['meta_title'] ?? '';
        $meta_description = $webSettings['meta_description'] ?? '';
        $global_theme = $webSettings['theme'] ?? 'theme-default';
        $meta_keywords = $webSettings['meta_keywords'] ?? '';

         // fetch data for homepage
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getCategoriesTree();
        require BASE_PATH . '/app/views/User/designyourself/crewneck.php';
    }

 public function sweatpant() {
          $settingsModel = new Settings();  
        $webSettings = $settingsModel->getWebSettings();

        $webname = $webSettings['web_name'] ?? '';
        $webmail = $webSettings['web_mail'] ?? '';
        $webcontact = $webSettings['web_contact'] ?? '';
        $facebook = $webSettings['facebook'] ?? '';
        $instagram = $webSettings['instagram'] ?? '';
        $pinterest = $webSettings['pinterest'] ?? '';
        $linkdin = $webSettings['linkdin'] ?? '';
        $meta_title = $webSettings['meta_title'] ?? '';
        $meta_description = $webSettings['meta_description'] ?? '';
        $global_theme = $webSettings['theme'] ?? 'theme-default';
        $meta_keywords = $webSettings['meta_keywords'] ?? '';

         // fetch data for homepage
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getCategoriesTree();
        require BASE_PATH . '/app/views/User/designyourself/sweatpant.php';
    }

    public function sendInquiry() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ob_start();
            $name = trim(strip_tags((string)($_POST['name'] ?? '')));
            $email = trim((string)($_POST['email'] ?? ''));
            $mobile = trim(strip_tags((string)($_POST['mobile'] ?? '')));
            $whatsapp = trim(strip_tags((string)($_POST['whatsapp'] ?? '')));
            $message = trim(strip_tags((string)($_POST['message'] ?? '')));
            $body = $_POST['body'] ?? '';
            $subject = trim(strip_tags((string)($_POST['subject'] ?? 'New Design Inquiry')));

            if (empty($name) || empty($email) || empty($body)) {
                if (ob_get_length()) ob_clean();
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Name, email and details are required.']);
                exit;
            }

            $mail = new PHPMailer(true);
            $mail->Timeout = 15;

            try {
                $mail->isSMTP();
                $mail->Host       = MAIL_HOST;
                $mail->SMTPAuth   = true;
                $mail->AuthType   = 'LOGIN';
                $mail->Username   = MAIL_USERNAME;
                $mail->Password   = MAIL_PASSWORD;
                $mail->SMTPSecure = MAIL_ENCRYPTION;
                $mail->Port       = MAIL_PORT;

                // Save images on server so direct download URLs are available inside HTML body without triggering Gmail attachment quarantine blocks
                $uploadDir = __DIR__ . '/../../../public/uploads/inquiries/';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                $uploadedLinks = [];
                if (isset($_FILES['labelImage']) && $_FILES['labelImage']['error'] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($_FILES['labelImage']['name'], PATHINFO_EXTENSION) ?: 'png';
                    $safeName = 'label_' . time() . '_' . rand(100, 999) . '.' . $ext;
                    $destPath = $uploadDir . $safeName;
                    if (@move_uploaded_file($_FILES['labelImage']['tmp_name'], $destPath) || @copy($_FILES['labelImage']['tmp_name'], $destPath)) {
                        $uploadedLinks['Label Image'] = url('uploads/inquiries/' . $safeName);
                    }
                }
                if (isset($_FILES['designImage']) && $_FILES['designImage']['error'] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($_FILES['designImage']['name'], PATHINFO_EXTENSION) ?: 'png';
                    $safeName = 'design_' . time() . '_' . rand(100, 999) . '.' . $ext;
                    $destPath = $uploadDir . $safeName;
                    if (@move_uploaded_file($_FILES['designImage']['tmp_name'], $destPath) || @copy($_FILES['designImage']['tmp_name'], $destPath)) {
                        $uploadedLinks['Design Image'] = url('uploads/inquiries/' . $safeName);
                    }
                }

                $htmlContent = $this->formatHtmlEmail($subject, $body, $name, $email, $mobile, $whatsapp, $message, $uploadedLinks);

                // ─── MAIL #1: TO ADMIN (EXACT STRUCTURE CLONE OF CONTACT US WHICH DELIVERS 100%) ───
                $mail->setFrom(MAIL_FROM_ADDRESS, 'StitchSmart Design Portal');
                $mail->addAddress(MAIL_FROM_ADDRESS);
                $mail->addReplyTo($email, $name);
                $mail->isHTML(true);
                $mail->Subject = 'New Design Portal Inquiry - ' . $name;
                $mail->Body    = $htmlContent;
                $mail->AltBody = $body;
                $mail->send();

                if ($this->conn) {
                    $stmtLog = @$this->conn->prepare("INSERT INTO email_logs (recipient_email, subject, template_name, status, sent_at) VALUES (?, ?, 'design_inquiry', 'sent', NOW())");
                    if ($stmtLog) {
                        $adminEmailLog = MAIL_FROM_ADDRESS;
                        $subjLog = 'New Design Portal Inquiry - ' . $name;
                        $stmtLog->bind_param('ss', $adminEmailLog, $subjLog);
                        $stmtLog->execute();
                        $stmtLog->close();
                    }
                }

                // ─── MAIL #2: TO CUSTOMER (IF DIFFERENT FROM ADMIN) ───
                if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && strcasecmp(trim($email), trim(MAIL_FROM_ADDRESS)) !== 0) {
                    try {
                        $mailCustomer = new PHPMailer(true);
                        $mailCustomer->Timeout = 15;
                        $mailCustomer->isSMTP();
                        $mailCustomer->Host       = MAIL_HOST;
                        $mailCustomer->SMTPAuth   = true;
                        $mailCustomer->AuthType   = 'LOGIN';
                        $mailCustomer->Username   = MAIL_USERNAME;
                        $mailCustomer->Password   = MAIL_PASSWORD;
                        $mailCustomer->SMTPSecure = MAIL_ENCRYPTION;
                        $mailCustomer->Port       = MAIL_PORT;
                        $mailCustomer->setFrom(MAIL_FROM_ADDRESS, 'StitchSmart');
                        $mailCustomer->addAddress($email, $name);
                        $mailCustomer->isHTML(true);
                        $mailCustomer->Subject = 'We received your Design Inquiry - StitchSmart';
                        $mailCustomer->Body    = $htmlContent;
                        $mailCustomer->AltBody = $body;
                        $mailCustomer->send();
                    } catch (Exception $ex) {
                        // Suppress error on customer copy so admin confirmation success always returns cleanly
                    }
                }

                if (ob_get_length()) ob_clean();
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Inquiry sent successfully!']);
                exit;
            } catch (Exception $e) {
                $errorMsg = $mail->ErrorInfo;
                if (empty($errorMsg)) {
                    $errorMsg = $e->getMessage();
                }

                if ($this->conn) {
                    $stmtLog = @$this->conn->prepare("INSERT INTO email_logs (recipient_email, subject, template_name, status, error_message) VALUES (?, ?, 'design_inquiry', 'failed', ?)");
                    if ($stmtLog) {
                        $adminEmailLog = MAIL_FROM_ADDRESS;
                        $subjLog = 'New Design Portal Inquiry - ' . $name;
                        $stmtLog->bind_param('sss', $adminEmailLog, $subjLog, $errorMsg);
                        $stmtLog->execute();
                        $stmtLog->close();
                    }
                }

                if (ob_get_length()) ob_clean();
                header('Content-Type: application/json');
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $errorMsg]);
                exit;
            }
        }
    }

    private function formatHtmlEmail($subject, $body, $name, $email, $mobile, $whatsapp, $message, $uploadedLinks = []) {
        $lines = explode("\n", $body);
        $sections = [];
        $currentSection = 'General';
        
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || strpos($line, '---') !== false) {
                continue;
            }
            
            $lowerLine = strtolower($line);
            
            // Check for section transitions
            if (str_starts_with($lowerLine, 'order details') || str_starts_with($lowerLine, 'order summary')) {
                $currentSection = 'Order Details';
                continue;
            }
            if (str_starts_with($lowerLine, 'finishing')) {
                $currentSection = 'Finishing';
                continue;
            }
            if (str_starts_with($lowerLine, 'prints/comments') || str_starts_with($lowerLine, 'prints & requests')) {
                $currentSection = 'Prints/Comments';
                // Do not continue: the line might contain data after the colon (e.g. Prints/Comments: Left chest print)
            }
            if (str_starts_with($lowerLine, 'quantities')) {
                $currentSection = 'Quantities';
                // Try to extract sample info if present on this line
                if (preg_match('/sample(?:\s+first\?)?:\s*([^\)]+)/i', $line, $matches)) {
                    $sections['Quantities']['Sample'] = trim($matches[1]);
                }
                continue;
            }
            if (str_starts_with($lowerLine, 'sent via') || str_starts_with($lowerLine, 'sent from')) {
                $currentSection = 'General';
                continue;
            }
            if (stripos($line, 'New') === 0 && stripos($line, 'Inquiry') !== false) {
                $currentSection = 'Header';
                $sections['Title'] = $line;
                continue;
            }
            
            // Specific parsing for Labels line to make sure it goes to the Labels section
            if (stripos($line, 'labels:') === 0) {
                list($key, $val) = explode(':', $line, 2);
                $sections['Labels'][trim($key)] = trim($val);
                continue;
            }
            
            // Parse based on current section
            if ($currentSection === 'Quantities') {
                $parts = explode(',', $line);
                foreach ($parts as $part) {
                    if (strpos($part, ':') !== false) {
                        list($qKey, $qVal) = explode(':', $part, 2);
                        $qKey = trim($qKey);
                        $qVal = trim($qVal);
                        if (strtolower($qKey) !== 'sample') {
                            $sections['Quantities'][$qKey] = $qVal;
                        }
                    }
                }
            } else {
                if (strpos($line, ':') !== false) {
                    list($key, $val) = explode(':', $line, 2);
                    $key = trim($key);
                    $val = trim($val);
                    
                    if (strtolower($key) === 'contact' || strtolower($key) === 'message') {
                        continue;
                    }
                    
                    $sections[$currentSection][$key] = $val;
                } else {
                    if (!isset($sections[$currentSection]['_text'])) {
                        $sections[$currentSection]['_text'] = [];
                    }
                    $sections[$currentSection]['_text'][] = $line;
                }
            }
        }
        
        $logoText = "Stitch Smart";
        $titleText = isset($sections['Title']) ? $sections['Title'] : $subject;
        
        $html = "<div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f7f4f0; padding: 30px; border-radius: 10px; border: 1px solid #e8e0d5;'>
            <div style='text-align: center; margin-bottom: 25px;'>
                <h2 style='color: #1a0f0a; margin: 0; font-family: Georgia, serif;'>" . htmlspecialchars($logoText) . "</h2>
                <div style='height: 3px; width: 50px; background: #c19a4e; margin: 15px auto;'></div>
                <p style='color: #c19a4e; font-size: 14px; margin: 0; font-weight: bold;'>" . htmlspecialchars($titleText) . "</p>
            </div>
            <div style='background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);'>
                <h3 style='color: #1a0f0a; margin-top: 0; border-bottom: 1px solid #f0ece1; padding-bottom: 10px; font-size: 16px;'>Client Information</h3>
                
                <p style='color: #4a4a4a; font-size: 15px; line-height: 1.6; margin: 6px 0;'>
                    <strong style='color: #1a0f0a; width: 120px; display: inline-block;'>Client Name:</strong> <strong style='color: #c19a4e;'>" . htmlspecialchars($name) . "</strong>
                </p>
                <p style='color: #4a4a4a; font-size: 15px; line-height: 1.6; margin: 6px 0;'>
                    <strong style='color: #1a0f0a; width: 120px; display: inline-block;'>Email:</strong> 
                    <a href='mailto:" . htmlspecialchars($email) . "' style='color: #c19a4e; text-decoration: none;'>" . htmlspecialchars($email) . "</a>
                </p>
                <p style='color: #4a4a4a; font-size: 15px; line-height: 1.6; margin: 6px 0;'>
                    <strong style='color: #1a0f0a; width: 120px; display: inline-block;'>Mobile:</strong> " . htmlspecialchars($mobile) . "
                </p>
                <p style='color: #4a4a4a; font-size: 15px; line-height: 1.6; margin: 6px 0;'>
                    <strong style='color: #1a0f0a; width: 120px; display: inline-block;'>WhatsApp:</strong> " . htmlspecialchars($whatsapp) . "
                </p>
                
                <div style='margin-top: 20px;'>
                    <strong style='color: #1a0f0a; display: block; margin-bottom: 8px; font-size: 15px;'>Client Message:</strong>
                    <div style='background: #fdfaf6; border-left: 4px solid #c19a4e; padding: 15px; color: #5a5a5a; font-size: 14px; line-height: 1.6; border-radius: 0 4px 4px 0;'>
                        " . nl2br(htmlspecialchars($message)) . "
                    </div>
                </div>";

        $appendInlineSection = function($title, $data) {
            if (empty($data)) return '';
            $out = "<div style='margin-top: 25px;'><h4 style='color: #1a0f0a; border-bottom: 2px solid #f0ece1; padding-bottom: 6px; margin-bottom: 12px; font-size: 16px;'>" . htmlspecialchars($title) . "</h4>";
            if (isset($data['_text'])) {
                foreach ($data['_text'] as $t) {
                    $out .= "<p style='color: #4a4a4a; font-size: 14px; margin: 4px 0;'>" . htmlspecialchars($t) . "</p>";
                }
            }
            foreach ($data as $k => $v) {
                if ($k === '_text') continue;
                $out .= "<p style='color: #4a4a4a; font-size: 14px; margin: 6px 0;'><strong style='color: #1a0f0a; width: 160px; display: inline-block;'>" . htmlspecialchars($k) . ":</strong> " . htmlspecialchars($v) . "</p>";
            }
            $out .= "</div>";
            return $out;
        };

        if (isset($sections['Order Details'])) $html .= $appendInlineSection('Garment Specifications', $sections['Order Details']);
        if (isset($sections['Labels'])) $html .= $appendInlineSection('Labels & Branding', $sections['Labels']);
        if (isset($sections['Prints/Comments'])) $html .= $appendInlineSection('Prints & Designs', $sections['Prints/Comments']);
        if (isset($sections['Finishing'])) $html .= $appendInlineSection('Finishing Details', $sections['Finishing']);

        if (isset($sections['Quantities']) && !empty($sections['Quantities'])) {
            $html .= "<div style='margin-top: 25px;'><h4 style='color: #1a0f0a; border-bottom: 2px solid #f0ece1; padding-bottom: 6px; margin-bottom: 12px; font-size: 16px;'>Order Quantities</h4><div style='background: #fdfaf6; padding: 12px; border-radius: 6px;'>";
            if (isset($sections['Quantities']['Sample'])) {
                $html .= "<p style='margin: 4px 0; font-size: 14px;'><strong style='color: #1a0f0a;'>Sample First:</strong> " . htmlspecialchars($sections['Quantities']['Sample']) . "</p>";
            }
            $qList = [];
            foreach ($sections['Quantities'] as $k => $v) {
                if ($k === '_text' || strtolower($k) === 'sample') continue;
                $qList[] = "<strong style='color: #1a0f0a;'>" . htmlspecialchars($k) . ":</strong> " . htmlspecialchars($v);
            }
            if (!empty($qList)) $html .= "<p style='margin: 6px 0; font-size: 14px; line-height: 1.6;'>" . implode(' &bull; ', $qList) . "</p>";
            $html .= "</div></div>";
        }

        foreach ($sections as $secName => $secData) {
            if (in_array($secName, ['Header', 'Title', 'Order Details', 'Labels', 'Prints/Comments', 'Finishing', 'Quantities', 'General'])) {
                continue;
            }
            if (empty($secData)) continue;
            if (is_array($secData)) {
                $html .= $appendInlineSection($secName, $secData);
            } else {
                $html .= "<div style='margin-top: 25px;'><h4 style='color: #1a0f0a; border-bottom: 2px solid #f0ece1; padding-bottom: 6px; margin-bottom: 12px; font-size: 16px;'>" . htmlspecialchars($secName) . "</h4><p style='color: #4a4a4a; font-size: 14px;'>" . htmlspecialchars($secData) . "</p></div>";
            }
        }

        if (!empty($uploadedLinks)) {
            $html .= "<div style='margin-top: 25px;'><h4 style='color: #1a0f0a; border-bottom: 2px solid #f0ece1; padding-bottom: 6px; margin-bottom: 12px; font-size: 16px;'>Uploaded Design & Label Files</h4><div style='text-align: center; background: #fdfaf6; padding: 15px; border-radius: 6px; border: 1px dashed #c19a4e;'><p style='margin: 0 0 10px 0; font-size: 13px; color: #5a5a5a;'>Direct download links:</p>";
            foreach ($uploadedLinks as $labelName => $linkUrl) {
                $html .= "<div style='margin: 8px 0;'><a href='" . htmlspecialchars($linkUrl) . "' target='_blank' style='display: inline-block; padding: 10px 20px; background: #c19a4e; color: #1a0f0a; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;'>Download / View " . htmlspecialchars($labelName) . " &rarr;</a></div>";
            }
            $html .= "</div></div>";
        }

        $html .= "
            </div>
            <div style='text-align: center; margin-top: 25px; color: #8a8a8a; font-size: 12px;'>
                This design inquiry was automatically submitted from the StitchSmart design portal.<br>
                &copy; " . date('Y') . " StitchSmart. All rights reserved.
            </div>
        </div>";
        return $html;
    }
}
