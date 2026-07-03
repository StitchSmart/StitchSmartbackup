<?php
// Root entry point for Stitch Smart when the web server document root is the project root.
// Forward requests to the public folder so URLs like /Stitch-Smart/index.php?page=admin_login work correctly.

$publicIndex = __DIR__ . '/public/index.php';
if (file_exists($publicIndex)) {
    chdir(dirname($publicIndex));
    require $publicIndex;
    return;
}

http_response_code(500);
echo 'Application entry point not found. Please ensure the public/index.php file exists.';
