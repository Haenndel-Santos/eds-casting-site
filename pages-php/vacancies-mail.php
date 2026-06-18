<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../private_vendor/autoload.php';
require_once realpath(__DIR__ . '/../../config/mail.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit('Method Not Allowed');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/honeypot-check.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/validate-captcha.php';

$name  = htmlspecialchars(trim($_POST['name'] ?? ''));
$email = htmlspecialchars(trim($_POST['email'] ?? ''));
$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));

if ($name === '' || $email === '') {
  http_response_code(400);
  exit('Missing required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  exit('Invalid email address.');
}

// Verifica se há arquivo e se é PDF
if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== UPLOAD_ERR_OK) {
  http_response_code(400);
  exit('File upload error.');
}
$fileTmp = $_FILES['cv']['tmp_name'];
$fileName = preg_replace('/[^A-Za-z0-9._-]/', '_', basename((string) $_FILES['cv']['name'])) ?: 'cv.pdf';
$fileSize = (int) ($_FILES['cv']['size'] ?? 0);
$fileType = mime_content_type($fileTmp);
if ($fileType !== 'application/pdf') {
  http_response_code(400);
  exit('Only PDF files are allowed.');
}
if ($fileSize > 10 * 1024 * 1024) {
  http_response_code(400);
  exit('File is too large.');
}
if (!is_uploaded_file($fileTmp)) {
  http_response_code(400);
  exit('Invalid uploaded file.');
}

$mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $mail->Host       = $mail_config['host'];
  $mail->SMTPAuth   = true;
  $mail->Username   = $mail_config['user'];
  $mail->Password   = $mail_config['pass'];
  $mail->SMTPSecure = $mail_config['secure'];
  $mail->Port       = $mail_config['port'];

  $mail->setFrom(...$mail_config['from']);
  $mail->addAddress(...$mail_config['to']);
  $mail->addReplyTo($email, $name);

  if (!empty($mail_config['cc']) && is_array($mail_config['cc'])) {
    foreach ($mail_config['cc'] as $cc) {
      if (is_array($cc) && isset($cc[0])) {
        $mail->addCC($cc[0], $cc[1] ?? '');
      }
    }
  }

  $mail->isHTML(true);
  $mail->Subject = "New Job Application - Vacancies Page";
  $mail->Body    = "
    <h2>New Application Received</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Phone:</strong> {$phone}</p>
    <hr><p><small>Sent from the Vacancies page on EDS Casting & Forging website.</small></p>
  ";
  $mail->addAttachment($fileTmp, $fileName);

  $mail->send();
  http_response_code(200);
  echo "Application sent successfully.";
} catch (Exception $e) {
  error_log("[Mail Error] " . $mail->ErrorInfo);
  http_response_code(500);
  echo "Email sending failed.";
}
?>
