<?php
/**
 * PHPMailer Initializer
 * Loads credentials securely from protected data/smtp_credentials.php
 */

require_once __DIR__ . '/PHPMailerAutoload.php';
require_once __DIR__ . '/class.phpmailer.php';

$mail = new PHPMailer();
$mail->isSMTP();

// Load protected SMTP credentials
$smtpConfigPath = __DIR__ . '/../data/smtp_credentials.php';
$smtpConfig = file_exists($smtpConfigPath) ? require($smtpConfigPath) : [];

$mail->Host       = $smtpConfig['host'] ?? 'smtp.gmail.com';
$mail->SMTPAuth   = $smtpConfig['smtp_auth'] ?? true;
$mail->Port       = $smtpConfig['port'] ?? 587;
$mail->SMTPSecure = $smtpConfig['secure'] ?? 'tls';
$mail->Username   = $smtpConfig['username'] ?? '';
$mail->Password   = $smtpConfig['password'] ?? '';

if (!empty($smtpConfig['from_email'])) {
    $mail->From = $smtpConfig['from_email'];
    $mail->FromName = $smtpConfig['from_name'] ?? 'Anuvanshika Global Export Co';
}
