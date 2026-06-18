<?php

declare(strict_types=1);

/**
 * /public_html/includes/validate-captcha.php
 *
 * This file is included by /pages-php/new-leads.php after config/mail.php is loaded.
 * The config folder is intentionally outside public_html.
 *
 * Required in /config/mail.php:
 * $mail_config['recaptcha_secret'] = 'YOUR_REAL_SECRET_KEY';
 */

if (!isset($mail_config) || !is_array($mail_config)) {
    error_log('CAPTCHA: $mail_config is not available. Make sure config/mail.php is required before validate-captcha.php.');
    http_response_code(500);
    exit('Captcha configuration unavailable.');
}

$recaptchaSecret = trim((string) ($mail_config['recaptcha_secret'] ?? ''));

if ($recaptchaSecret === '' || $recaptchaSecret === 'SUA_SECRET_KEY' || $recaptchaSecret === 'SUA_SECRET_KEY_AQUI') {
    error_log('CAPTCHA: recaptcha_secret is missing in config/mail.php.');
    http_response_code(500);
    exit('Captcha verification is temporarily unavailable.');
}

$captchaResponse = trim((string) ($_POST['g-recaptcha-response'] ?? ''));

if ($captchaResponse === '') {
    error_log('CAPTCHA: g-recaptcha-response is empty.');
    http_response_code(400);
    exit('Captcha not filled.');
}

$remoteIp = $_SERVER['REMOTE_ADDR'] ?? '';
$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';

$postFields = http_build_query([
    'secret' => $recaptchaSecret,
    'response' => $captchaResponse,
    'remoteip' => $remoteIp,
]);

$verifyResponse = false;

if (function_exists('curl_init')) {
    $ch = curl_init($verifyUrl);

    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/x-www-form-urlencoded',
        ],
    ]);

    $verifyResponse = curl_exec($ch);

    if ($verifyResponse === false) {
        error_log('CAPTCHA: cURL error: ' . curl_error($ch));
    }

    curl_close($ch);
} else {
    $context = stream_context_create([
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => $postFields,
            'timeout' => 10,
        ],
    ]);

    $verifyResponse = file_get_contents($verifyUrl, false, $context);
}

if ($verifyResponse === false || trim((string) $verifyResponse) === '') {
    error_log('CAPTCHA: verification request failed or returned empty response.');
    http_response_code(500);
    exit('Captcha verification request failed.');
}

$result = json_decode((string) $verifyResponse, true);

if (!is_array($result)) {
    error_log('CAPTCHA: invalid JSON response from Google. Raw response: ' . substr((string) $verifyResponse, 0, 500));
    http_response_code(500);
    exit('Captcha verification request failed.');
}

if (empty($result['success'])) {
    $errorCodes = $result['error-codes'] ?? [];
    error_log('CAPTCHA: verification failed. Errors: ' . json_encode($errorCodes));
    http_response_code(400);
    exit('Captcha verification failed.');
}

error_log('CAPTCHA: verification successful.');
