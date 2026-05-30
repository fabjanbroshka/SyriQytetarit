<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false]);
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email']);
    exit;
}

$to      = 'info@syriqytetarit.al';
$subject = 'Regjistrim i ri - Syri Qytetarit';
$body    = "Email i ri nga lista e pritjes:\n\n" . $email;
$headers = "From: info@syriqytetarit.al\r\nReply-To: " . $email;

$sent = mail($to, $subject, $body, $headers);

echo json_encode(['success' => $sent]);
