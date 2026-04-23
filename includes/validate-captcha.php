<?php

$recaptchaSecret = 'SUA_SECRET_KEY';

$response = $_POST['g-recaptcha-response'] ?? '';
if (!$response) {
    http_response_code(400);
    exit('Captcha not filled.');
}

$remoteIp = $_SERVER['REMOTE_ADDR'] ?? '';

$url = 'https://www.google.com/recaptcha/api/siteverify';
$postData = http_build_query([
    'secret'   => $recaptchaSecret,
    'response' => $response,
    'remoteip' => $remoteIp,
]);

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => $postData,
        'timeout' => 10,
    ],
];

$context = stream_context_create($options);
$verify = file_get_contents($url, false, $context);

if ($verify === false) {
    http_response_code(500);
    exit('Captcha verification request failed.');
}

$result = json_decode($verify, true);

if (!is_array($result) || empty($result['success'])) {
    http_response_code(400);
    exit('Captcha verification failed.');
}