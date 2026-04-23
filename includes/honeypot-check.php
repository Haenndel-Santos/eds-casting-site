<?php
// Honeypot field: if filled, it's a bot
$honeypot = $_POST['website'] ?? '';
if (!empty($honeypot)) {
  // Você pode logar aqui se quiser rastrear tentativas
  http_response_code(403);
  exit('Bot detected.');
}
