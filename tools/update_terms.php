<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$conn = $db->connect();

$sql = "SELECT id, content FROM pages WHERE slug = 'terms-and-condition'";
$res = $conn->query($sql);
$row = $res->fetch_assoc();

if ($row) {
    $content = $row['content'];
    
    // The exact string to remove
    $to_remove = '<p>Our core service revolves around bespoke and custom-tailored garments. Please note:</p>
                            <ul>
                                <li>Customers are responsible for providing accurate measurements if not measured by our in-house staff.</li>
                                <li>We are not liable for ill-fitting garments resulting from incorrect measurements provided by the customer.</li>
                                <li>A tolerance of 0.5 to 1 inch is standard in the bespoke tailoring industry and is not considered a defect.</li>
                            </ul>';
                            
    // Since spaces might be different, let's use preg_replace
    $pattern = '/<p>\s*Our core service revolves around bespoke and custom-tailored garments\.\s*Please note:\s*<\/p>\s*<ul>\s*<li>\s*Customers are responsible for providing accurate measurements if not measured by our in-house staff\.\s*<\/li>\s*<li>\s*We are not liable for ill-fitting garments resulting from incorrect measurements provided by the customer\.\s*<\/li>\s*<li>\s*A tolerance of 0\.5 to 1 inch is standard in the bespoke tailoring industry and is not considered a defect\.\s*<\/li>\s*<\/ul>/is';
    
    $content = preg_replace($pattern, '', $content);
    
    // Also try without the <p> just in case
    $pattern2 = '/Please note:<\/p>\s*<ul>\s*<li>\s*Customers are responsible for providing accurate measurements if not measured by our in-house staff\.\s*<\/li>\s*<li>\s*We are not liable for ill-fitting garments resulting from incorrect measurements provided by the customer\.\s*<\/li>\s*<li>\s*A tolerance of 0\.5 to 1 inch is standard in the bespoke tailoring industry and is not considered a defect\.\s*<\/li>\s*<\/ul>/is';
    $content = preg_replace($pattern2, '', $content);
    
    // Actually, let's just use str_replace on a normalized string or write a simpler regex.
    // The user specifically asked to remove the text starting from "Customers are responsible..."
    // Let's just remove the <ul> and the paragraph containing "Please note:"
    
    // Let's fetch it, modify it using DOMDocument if needed, or simple regex
    $pattern3 = '/<p>[^<]*Please note:<\/p>\s*<ul>(.*?)<\/ul>/is';
    $content = preg_replace($pattern3, '', $content);
    
    $stmt = $conn->prepare("UPDATE pages SET content = ? WHERE id = ?");
    $stmt->bind_param("si", $content, $row['id']);
    $stmt->execute();
    echo "Terms updated successfully!\n";
} else {
    echo "Page not found.\n";
}
?>
