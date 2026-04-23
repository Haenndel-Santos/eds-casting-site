<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_log('CONTACT: start');

require_once $_SERVER['DOCUMENT_ROOT'] . '/../private_vendor/autoload.php';
error_log('CONTACT: autoload ok');

require_once realpath(__DIR__ . '/../../config/db.php');
error_log('CONTACT: db config ok');

require_once realpath(__DIR__ . '/../../config/mail.php');
error_log('CONTACT: mail config ok');

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    error_log('CONTACT: invalid method ' . ($_SERVER['REQUEST_METHOD'] ?? 'unknown'));
    http_response_code(405);
    exit('Method Not Allowed');
}

error_log('CONTACT: post ok');

function clean(string $value): string
{
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function raw_clean(?string $value): string
{
    return trim((string) $value);
}

$name = clean($_POST['name'] ?? '');
$email = clean($_POST['email'] ?? '');
$company = clean($_POST['company'] ?? '');
$service = clean($_POST['service'] ?? '');
$message = clean($_POST['message'] ?? '');

$requestType = clean($_POST['request_type'] ?? '');
$phone = clean($_POST['phone'] ?? '');
$country = clean($_POST['country'] ?? '');
$material = clean($_POST['material'] ?? '');
$quantity = clean($_POST['quantity'] ?? '');
$annualVolume = clean($_POST['annual_volume'] ?? '');
$targetPrice = clean($_POST['target_price'] ?? '');
$deliveryDestination = clean($_POST['delivery_destination'] ?? '');

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$referrer = $_SERVER['HTTP_REFERER'] ?? '';

error_log('CONTACT: fields captured');

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/honeypot-check.php';
error_log('CONTACT: honeypot ok');

/*
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/validate-captcha.php';
error_log('CONTACT: captcha ok');
*/

if ($name === '' || $email === '' || $message === '') {
    error_log('CONTACT: missing required fields');
    http_response_code(400);
    exit('Missing required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    error_log('CONTACT: invalid email');
    http_response_code(400);
    exit('Invalid email address.');
}

$allowedRequestTypes = ['general', 'quotation', 'technical', 'partnership', ''];
if (!in_array(raw_clean($_POST['request_type'] ?? ''), $allowedRequestTypes, true)) {
    error_log('CONTACT: invalid request type');
    http_response_code(400);
    exit('Invalid request type.');
}

$isQuotation = raw_clean($_POST['request_type'] ?? '') === 'quotation';

error_log('CONTACT: validation ok');

/**
 * ATTACHMENTS
 */
$allowedExtensions = ['pdf', 'step', 'stp', 'igs', 'iges', 'zip', 'rar', '7z', 'dwg', 'dxf'];
$maxFileSize = 15 * 1024 * 1024; // 15MB per file
$maxFiles = 5;
$attachments = [];
$attachmentNotes = [];

if (isset($_FILES['attachments']) && is_array($_FILES['attachments']['name'])) {
    $fileCount = count($_FILES['attachments']['name']);

    if ($fileCount > $maxFiles) {
        error_log('CONTACT: too many files uploaded');
        http_response_code(400);
        exit('Too many files uploaded.');
    }

    for ($i = 0; $i < $fileCount; $i++) {
        $originalName = (string) ($_FILES['attachments']['name'][$i] ?? '');
        $tmpName = (string) ($_FILES['attachments']['tmp_name'][$i] ?? '');
        $error = (int) ($_FILES['attachments']['error'][$i] ?? UPLOAD_ERR_NO_FILE);
        $size = (int) ($_FILES['attachments']['size'][$i] ?? 0);

        if ($originalName === '' || $error === UPLOAD_ERR_NO_FILE) {
            continue;
        }

        if ($error !== UPLOAD_ERR_OK) {
            $attachmentNotes[] = 'Upload error: ' . $originalName;
            continue;
        }

        if ($size > $maxFileSize) {
            $attachmentNotes[] = 'Skipped oversized file: ' . $originalName;
            continue;
        }

        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions, true)) {
            $attachmentNotes[] = 'Skipped unsupported file type: ' . $originalName;
            continue;
        }

        if (!is_uploaded_file($tmpName)) {
            $attachmentNotes[] = 'Skipped invalid uploaded file: ' . $originalName;
            continue;
        }

        $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $originalName) ?: ('attachment_' . $i . '.' . $extension);

        $attachments[] = [
            'tmp_name' => $tmpName,
            'name' => $safeName,
        ];
    }
}

/**
 * DATABASE
 * Keeps the existing insert intact.
 * If you later add new DB columns, this block can be expanded.
 */
try {
    $stmt = $pdo->prepare(
        'INSERT INTO leads (name, email, company, service, message, ip, user_agent, referrer)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );

    $stmt->execute([
        $name,
        $email,
        $company,
        $service,
        $message,
        $ip,
        $userAgent,
        $referrer,
    ]);

    error_log('CONTACT: db insert ok');
} catch (\PDOException $e) {
    error_log('[DB Error] ' . $e->getMessage());
    error_log('CONTACT: db insert failed');
    http_response_code(500);
    exit('Database error.');
}

$requestTypeLabelMap = [
    'general' => 'General Inquiry',
    'quotation' => 'Request a Quotation',
    'technical' => 'Technical Support',
    'partnership' => 'Partnership',
    '' => '-',
];

$requestTypeLabel = $requestTypeLabelMap[raw_clean($_POST['request_type'] ?? '')] ?? raw_clean($_POST['request_type'] ?? '');
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $mail_config['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $mail_config['user'];
    $mail->Password = $mail_config['pass'];
    $mail->SMTPSecure = $mail_config['secure'];
    $mail->Port = $mail_config['port'];

    error_log('CONTACT: smtp config applied');

    $mail->setFrom($mail_config['from'][0], $mail_config['from'][1]);
    $mail->addAddress($mail_config['to'][0], $mail_config['to'][1]);

    if (!empty($mail_config['cc']) && is_array($mail_config['cc'])) {
        foreach ($mail_config['cc'] as $cc) {
            if (is_array($cc) && isset($cc[0])) {
                $mail->addCC($cc[0], $cc[1] ?? '');
            }
        }
    }

    $mail->addReplyTo($email, $name);
    $mail->isHTML(true);

    $subjectPrefix = $isQuotation ? '[RFQ]' : '[CONTACT]';
    $mail->Subject = $subjectPrefix . ' New Submission from ' . ($company !== '' ? $company : $name);

    foreach ($attachments as $file) {
        $mail->addAttachment($file['tmp_name'], $file['name']);
    }

    $attachmentHtml = '';
    if (!empty($attachments)) {
        $attachmentHtml .= '<h3>Attached Files</h3><ul>';
        foreach ($attachments as $file) {
            $attachmentHtml .= '<li>' . clean($file['name']) . '</li>';
        }
        $attachmentHtml .= '</ul>';
    }

    if (!empty($attachmentNotes)) {
        $attachmentHtml .= '<h3>Attachment Notes</h3><ul>';
        foreach ($attachmentNotes as $note) {
            $attachmentHtml .= '<li>' . clean($note) . '</li>';
        }
        $attachmentHtml .= '</ul>';
    }

    $rfqHtml = '';
    if ($isQuotation) {
        $rfqHtml = '
            <h3>Quotation Details</h3>
            <p><strong>Process / Area of Interest:</strong> ' . ($service !== '' ? $service : '-') . '</p>
            <p><strong>Material:</strong> ' . ($material !== '' ? $material : '-') . '</p>
            <p><strong>Quantity:</strong> ' . ($quantity !== '' ? $quantity : '-') . '</p>
            <p><strong>Annual Volume:</strong> ' . ($annualVolume !== '' ? $annualVolume : '-') . '</p>
            <p><strong>Target Price / Budget:</strong> ' . ($targetPrice !== '' ? $targetPrice : '-') . '</p>
            <p><strong>Delivery Destination:</strong> ' . ($deliveryDestination !== '' ? $deliveryDestination : '-') . '</p>
        ';
    }

    $mail->Body = '
        <h2>New contact form submission</h2>
        <p><strong>Name:</strong> ' . $name . '</p>
        <p><strong>Email:</strong> ' . $email . '</p>
        <p><strong>Company:</strong> ' . ($company !== '' ? $company : '-') . '</p>
        <p><strong>Phone:</strong> ' . ($phone !== '' ? $phone : '-') . '</p>
        <p><strong>Country:</strong> ' . ($country !== '' ? $country : '-') . '</p>
        <p><strong>Request Type:</strong> ' . $requestTypeLabel . '</p>
        ' . $rfqHtml . '
        <p><strong>Message:</strong><br>' . nl2br($message) . '</p>
        ' . $attachmentHtml . '
        <hr>
        <p><small>IP: ' . clean($ip) . '<br>User Agent: ' . clean($userAgent) . '<br>Referrer: ' . clean($referrer) . '</small></p>
    ';

    $altBody =
        "Name: {$name}\n" .
        "Email: {$email}\n" .
        "Company: " . ($company !== '' ? $company : '-') . "\n" .
        "Phone: " . ($phone !== '' ? $phone : '-') . "\n" .
        "Country: " . ($country !== '' ? $country : '-') . "\n" .
        "Request Type: {$requestTypeLabel}\n";

    if ($isQuotation) {
        $altBody .=
            "\nQuotation Details\n" .
            "Process / Area of Interest: " . ($service !== '' ? $service : '-') . "\n" .
            "Material: " . ($material !== '' ? $material : '-') . "\n" .
            "Quantity: " . ($quantity !== '' ? $quantity : '-') . "\n" .
            "Annual Volume: " . ($annualVolume !== '' ? $annualVolume : '-') . "\n" .
            "Target Price / Budget: " . ($targetPrice !== '' ? $targetPrice : '-') . "\n" .
            "Delivery Destination: " . ($deliveryDestination !== '' ? $deliveryDestination : '-') . "\n";
    }

    $altBody .=
        "\nMessage:\n{$message}\n\n";

    if (!empty($attachments)) {
        $altBody .= "Attached Files:\n";
        foreach ($attachments as $file) {
            $altBody .= '- ' . $file['name'] . "\n";
        }
        $altBody .= "\n";
    }

    if (!empty($attachmentNotes)) {
        $altBody .= "Attachment Notes:\n";
        foreach ($attachmentNotes as $note) {
            $altBody .= '- ' . $note . "\n";
        }
        $altBody .= "\n";
    }

    $altBody .=
        "IP: {$ip}\n" .
        "User Agent: {$userAgent}\n" .
        "Referrer: {$referrer}";

    $mail->AltBody = $altBody;

    $mail->send();
    error_log('CONTACT: mail sent');

    error_log('CONTACT: redirect /contact?sent=1');
    header('Location: /contact?sent=1');
    exit;

} catch (Exception $e) {
    error_log('[Mail Error] ' . $mail->ErrorInfo);
    error_log('CONTACT: mail failed');
    http_response_code(500);
    exit('Email sending failed.');
}
