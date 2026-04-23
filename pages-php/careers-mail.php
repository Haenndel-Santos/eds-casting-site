<?php
// ======================================================
// EDS CAREERS - PHPMailer handler
// ======================================================

require_once $_SERVER['DOCUMENT_ROOT'] . '/../private_vendor/autoload.php';
require_once realpath(__DIR__ . '/../../config/mail.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// === Garante que é POST ===
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  exit('Method Not Allowed');
}

// === Função de limpeza ===
function clean($value) {
  return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

// === Captura dos campos ===
$name      = clean($_POST['name'] ?? '');
$email     = clean($_POST['email'] ?? '');
$file      = $_FILES['cv'] ?? null;
$ip        = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$referrer  = $_SERVER['HTTP_REFERER'] ?? '';

// === Proteções ===
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/honeypot-check.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/validate-captcha.php';

// === Validação básica ===
if ($name === '' || $email === '' || !$file) {
  http_response_code(400);
  exit('Missing required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  exit('Invalid email address.');
}

// Verifica se o arquivo é PDF
$file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if ($file_ext !== 'pdf') {
  http_response_code(400);
  exit('Only PDF files are allowed.');
}

// Verifica upload
if ($file['error'] !== UPLOAD_ERR_OK) {
  http_response_code(400);
  exit('File upload error. Please try again.');
}

// === Inicializa o PHPMailer ===
$mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $mail->Host       = $mail_config['host'];
  $mail->SMTPAuth   = true;
  $mail->Username   = $mail_config['user'];
  $mail->Password   = $mail_config['pass'];
  $mail->SMTPSecure = $mail_config['secure'];
  $mail->Port       = $mail_config['port'];

  $mail->setFrom($mail_config['from'][0], $mail_config['from'][1]);
  $mail->addAddress($mail_config['to'][0], $mail_config['to'][1]);
  $mail->addReplyTo($email, $name);

  if (!empty($mail_config['cc']) && is_array($mail_config['cc'])) {
    foreach ($mail_config['cc'] as $cc) {
      if (is_array($cc) && isset($cc[0])) {
        $mail->addCC($cc[0], $cc[1] ?? '');
      }
    }
  }

  $mail->addAttachment($file['tmp_name'], $file['name']);

  $mail->isHTML(true);
  $mail->Subject = "New Career Application from {$name}";
  $mail->Body = "
    <h2>New Career Application</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p>A new resume has been submitted via the EDS Careers page.</p>
    <hr>
    <p><small>IP: " . clean($ip) . "<br>User Agent: " . clean($userAgent) . "<br>Referrer: " . clean($referrer) . "</small></p>
  ";
  $mail->AltBody = "New career application:\nName: {$name}\nEmail: {$email}\n";

  $mail->send();

  header('Location: /careers?sent=success');
  exit;

} catch (Exception $e) {
  error_log('[Mail Error] ' . $mail->ErrorInfo);
  http_response_code(500);
  exit('Email sending failed.');
}

error_log('CONTACT: start');
error_log('CONTACT: post ok');
error_log('CONTACT: honeypot ok');
error_log('CONTACT: captcha ok');
error_log('CONTACT: db insert ok');
error_log('CONTACT: mail sent');