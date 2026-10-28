<?php
/**
 * Unified, Secure Inquiry & Lead Handler
 * - Manual Math CAPTCHA verification
 * - Anti-spam Honeypot check
 * - IP rate-limiting (max 5 submissions/hour/IP)
 * - Input validation & HTML escaping (no extract)
 * - Safe SQLite database logging
 * - Email sending via PHPMailer with graceful fallback
 * - Redirects to thank-you.php upon success
 */

ob_start();
error_reporting(0);
ini_set('display_errors', '0');

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/captcha.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// 1. Anti-spam Honeypot Check (field should remain empty)
if (!empty($_POST['website_url']) || !empty($_POST['honey_pot'])) {
    // Bot detected - simulate success silently
    header("Location: thank-you.php");
    exit;
}

// 2. Manual Math CAPTCHA Verification
$captcha_answer  = trim($_POST['captcha_answer'] ?? '');
$captcha_form_id = trim($_POST['captcha_form_id'] ?? 'default');

if (!verifyMathCaptcha($captcha_answer, $captcha_form_id)) {
    die("<div style='font-family:sans-serif; text-align:center; padding:50px;'>
        <h2 style='color:#c53030;'>Incorrect Security Verification (CAPTCHA)</h2>
        <p style='color:#555;'>The answer you entered for the verification math question was incorrect. Please go back and try again.</p>
        <p><a href='javascript:history.back()' style='display:inline-block; margin-top:15px; padding:10px 20px; background:#d4af37; color:#1a1a1a; text-decoration:none; font-weight:bold; border-radius:5px;'>Go Back & Try Again</a></p>
    </div>");
}

// 3. IP Rate Limiting Check
if (!checkRateLimit('inquiry', RATE_LIMIT_MAX_SUBMISSIONS, RATE_LIMIT_WINDOW_SECONDS)) {
    die("Too many requests from your IP address. Please try again after an hour or contact us directly via WhatsApp / Phone.");
}

// 4. Extract and Sanitize Inputs (strict validation, NO extract($_POST))
$form_source = trim($_POST['form_source'] ?? 'General Inquiry');
$name        = trim($_POST['name'] ?? ($_POST['contact_person'] ?? ''));
$company     = trim($_POST['company'] ?? ($_POST['company_name'] ?? ''));
$country     = trim($_POST['country'] ?? ($_POST['delivery_city'] ?? ''));
$email       = trim($_POST['email'] ?? '');
$phone       = trim($_POST['phone'] ?? ($_POST['contact'] ?? ''));
$product     = trim($_POST['product'] ?? '');
$quantity    = trim($_POST['quantity'] ?? '');
$budget      = trim($_POST['budget'] ?? '');
$message     = trim($_POST['message'] ?? '');

// Contact can be email or phone if submitted in single field
if (empty($email) && filter_var($phone, FILTER_VALIDATE_EMAIL)) {
    $email = $phone;
}

// Basic Required Field Check
if (empty($name) || (empty($email) && empty($phone))) {
    die("Please fill in your name and at least one contact method (email or phone). <a href='javascript:history.back()'>Go Back</a>");
}

if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Please provide a valid email address. <a href='javascript:history.back()'>Go Back</a>");
}

$ip_address = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);

// 5. Save to Database (Reliable Backup)
$db = getDbConnection();
if ($db) {
    try {
        $stmt = $db->prepare("
            INSERT INTO inquiries 
            (form_source, name, company, country, email, phone, product, quantity, budget, message, ip_address, user_agent)
            VALUES 
            (:form_source, :name, :company, :country, :email, :phone, :product, :quantity, :budget, :message, :ip_address, :user_agent)
        ");
        $stmt->execute([
            ':form_source' => $form_source,
            ':name'        => $name,
            ':company'     => $company,
            ':country'     => $country,
            ':email'       => $email,
            ':phone'       => $phone,
            ':product'     => $product,
            ':quantity'    => $quantity,
            ':budget'      => $budget,
            ':message'     => $message,
            ':ip_address'  => $ip_address,
            ':user_agent'  => $user_agent,
        ]);
    } catch (Exception $e) {
        error_log("Database lead insert error: " . $e->getMessage());
    }
}

// 6. Send Notification Email via PHPMailer
$emailSent = false;
$emailConfigPath = __DIR__ . "/email_server/email.php";

if (file_exists($emailConfigPath)) {
    try {
        require_once $emailConfigPath;

        if (isset($mail) && is_object($mail)) {
            $mail->ClearAddresses();
            $mail->ClearCustomHeaders();
            $mail->isHTML(true);

            $mail->From     = "inquiry@avglobalexports.com";
            $mail->FromName = SITE_NAME;
            $mail->addAddress(COMPANY_PRIMARY_EMAIL);

            if (!empty($email)) {
                $mail->addReplyTo($email, $name);
            }

            $mail->Subject = "New Inquiry: " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . " - " . SITE_NAME;

            // Safe HTML template without third-party agency references
            $safeName    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
            $safeCompany = htmlspecialchars($company, ENT_QUOTES, 'UTF-8');
            $safeCountry = htmlspecialchars($country, ENT_QUOTES, 'UTF-8');
            $safeEmail   = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            $safePhone   = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
            $safeProduct = htmlspecialchars($product, ENT_QUOTES, 'UTF-8');
            $safeQty     = htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8');
            $safeBudget  = htmlspecialchars($budget, ENT_QUOTES, 'UTF-8');
            $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
            $safeSource  = htmlspecialchars($form_source, ENT_QUOTES, 'UTF-8');

            $mail->Body = "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='utf-8'>
                <title>New Website Inquiry</title>
            </head>
            <body style='margin:0; padding:25px; background-color:#f4f5f7; font-family:Arial, sans-serif;'>
                <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                    <tr>
                        <td align='center'>
                            <table width='600' cellpadding='0' cellspacing='0' border='0' style='background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.08); border:1px solid #e2e8f0;'>
                                <tr>
                                    <td style='background:#2a2b2e; padding:25px 30px; text-align:center;'>
                                        <h2 style='color:#d4af37; margin:0; font-size:22px; font-weight:700; letter-spacing:1px;'>" . SITE_NAME . "</h2>
                                        <p style='color:#ffffff; margin:6px 0 0 0; font-size:13px;'>New Customer Inquiry Notification</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='padding:30px;'>
                                        <table width='100%' cellpadding='8' cellspacing='0' style='font-size:14px; color:#333; line-height:1.6;'>
                                            <tr style='background:#faf7f0;'>
                                                <td width='35%' style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Lead Source:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'><strong>{$safeSource}</strong></td>
                                            </tr>
                                            <tr>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Client Name:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'>{$safeName}</td>
                                            </tr>
                                            <tr style='background:#faf7f0;'>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Company:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'>" . ($safeCompany ?: 'N/A') . "</td>
                                            </tr>
                                            <tr>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Country / City:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'>" . ($safeCountry ?: 'N/A') . "</td>
                                            </tr>
                                            <tr style='background:#faf7f0;'>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Email:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'><a href='mailto:{$safeEmail}' style='color:#d4af37;'>{$safeEmail}</a></td>
                                            </tr>
                                            <tr>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Phone / WhatsApp:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'><a href='tel:{$safePhone}' style='color:#333;'>{$safePhone}</a></td>
                                            </tr>
                                            <tr style='background:#faf7f0;'>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Product of Interest:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'>" . ($safeProduct ?: 'General Catalog') . "</td>
                                            </tr>
                                            <tr>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea;'>Quantity / Budget:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'>" . ($safeQty ?: 'N/A') . ($safeBudget ? " / {$safeBudget}" : "") . "</td>
                                            </tr>
                                            <tr style='background:#faf7f0;'>
                                                <td style='font-weight:bold; border-bottom:1px solid #eaeaea; vertical-align:top;'>Message / Details:</td>
                                                <td style='border-bottom:1px solid #eaeaea;'>" . ($safeMessage ?: 'No specific message provided.') . "</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style='background:#f8f9fa; padding:15px; text-align:center; font-size:12px; color:#888; border-top:1px solid #eaeaea;'>
                                        Received on " . date('d M Y, h:i A') . " from IP: {$ip_address}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
            ";

            @$mail->send();
        }
    } catch (Exception $e) {
        error_log("PHPMailer error: " . $e->getMessage());
    }
}

// 7. Redirect to Thank You page
header("Location: thank-you.php");
exit;
