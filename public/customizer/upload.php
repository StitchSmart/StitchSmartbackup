<?php
header('Content-Type: application/json; charset=utf-8');
$uploadField = 'logoFile';
if (!isset($_FILES[$uploadField]) || $_FILES[$uploadField]['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'No file uploaded or upload interrupted.']);
    exit;
}
$file = $_FILES[$uploadField];
$allowedTypes = ['image/png' => 'png', 'image/jpeg' => 'jpg'];
if (!array_key_exists($file['type'], $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Upload only PNG or JPG images.']);
    exit;
}
if ($file['size'] > 4 * 1024 * 1024) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'File size must be 4MB or less.']);
    exit;
}
$uploadsDir = realpath(__DIR__ . '/../assets/uploads');
if (!$uploadsDir) {
    $uploadsDir = __DIR__ . '/../assets/uploads';
    if (!is_dir($uploadsDir) && !mkdir($uploadsDir, 0755, true)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'Unable to create upload directory.']);
        exit;
    }
}
$extension = $allowedTypes[$file['type']];
$basename = preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($file['name'], PATHINFO_FILENAME));
$targetName = sprintf('%s-%s.%s', $basename ?: 'custom-logo', time(), $extension);
$targetPath = $uploadsDir . DIRECTORY_SEPARATOR . $targetName;
if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Unable to save uploaded file.']);
    exit;
}
$relativePath = 'assets/uploads/' . $targetName;
echo json_encode(['success' => true, 'path' => $relativePath]);
