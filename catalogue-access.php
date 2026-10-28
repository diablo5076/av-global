<?php
/**
 * Protected Catalogue Gateway & User Registration
 * Requires user registration/login and CAPTCHA before serving the brochure PDF.
 */

session_start();
error_reporting(0);
ini_set('display_errors', '0');

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/captcha.php';

$action = $_POST['action'] ?? ($_GET['action'] ?? '');

// 1. If download action requested and user session is verified
if ($action === 'download' || isset($_GET['download'])) {
    if (empty($_SESSION['catalogue_authorized'])) {
        // Not logged in or registered
        header("Location: about.php?require_auth=1#brochure-section");
        exit;
    }

    $filePath = PRIVATE_FILES_DIR . '/' . BROCHURE_FILENAME;

    if (!file_exists($filePath)) {
        die("Brochure file is temporarily unavailable. Please contact " . COMPANY_PRIMARY_EMAIL);
    }

    // Serve PDF with secure headers (file is outside public webroot)
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="Anuvanshika_Global_Exports_Brochure.pdf"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    readfile($filePath);
    exit;
}

// 2. Handle Lead Registration / Access Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot check
    if (!empty($_POST['website_url'])) {
        header("Location: about.php");
        exit;
    }

    // Manual Math CAPTCHA Verification
    $captcha_answer  = trim($_POST['captcha_answer'] ?? '');
    $captcha_form_id = trim($_POST['captcha_form_id'] ?? 'brochure_modal');

    if (!verifyMathCaptcha($captcha_answer, $captcha_form_id)) {
        die("<div style='font-family:sans-serif; text-align:center; padding:50px;'>
            <h2 style='color:#c53030;'>Incorrect Security Verification (CAPTCHA)</h2>
            <p style='color:#555;'>The answer you entered for the verification math question was incorrect. Please go back and try again.</p>
            <p><a href='javascript:history.back()' style='display:inline-block; margin-top:15px; padding:10px 20px; background:#d4af37; color:#1a1a1a; text-decoration:none; font-weight:bold; border-radius:5px;'>Go Back & Try Again</a></p>
        </div>");
    }

    // Rate Limit check
    if (!checkRateLimit('catalogue_reg', 5, 3600)) {
        die("Too many attempts. Please try again after some time.");
    }

    $name    = trim($_POST['name'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');

    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please provide a valid name and business email address. <a href='javascript:history.back()'>Go Back</a>");
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

    // Store lead in catalogue_users database
    $db = getDbConnection();
    if ($db) {
        try {
            $stmt = $db->prepare("
                INSERT INTO catalogue_users (name, company, country, email, phone, is_verified, ip_address, last_login_at)
                VALUES (:name, :company, :country, :email, :phone, 1, :ip, CURRENT_TIMESTAMP)
                ON CONFLICT(email) DO UPDATE SET 
                    last_login_at = CURRENT_TIMESTAMP,
                    phone = excluded.phone,
                    company = excluded.company,
                    country = excluded.country
            ");
            $stmt->execute([
                ':name'    => $name,
                ':company' => $company,
                ':country' => $country,
                ':email'   => $email,
                ':phone'   => $phone,
                ':ip'      => $ip
            ]);
        } catch (Exception $e) {
            error_log("Catalogue lead save error: " . $e->getMessage());
        }
    }

    // Also record in general inquiries table as a catalogue lead
    if ($db) {
        try {
            $inqStmt = $db->prepare("
                INSERT INTO inquiries (form_source, name, company, country, email, phone, message, ip_address)
                VALUES ('Catalogue Download Registration', :name, :company, :country, :email, :phone, 'Requested brochure download', :ip)
            ");
            $inqStmt->execute([
                ':name'    => $name,
                ':company' => $company,
                ':country' => $country,
                ':email'   => $email,
                ':phone'   => $phone,
                ':ip'      => $ip
            ]);
        } catch (Exception $e) {}
    }

    // Send email alert to client
    $emailConfigPath = __DIR__ . "/email_server/email.php";
    if (file_exists($emailConfigPath)) {
        try {
            require_once $emailConfigPath;
            if (isset($mail) && is_object($mail)) {
                $mail->ClearAddresses();
                $mail->isHTML(true);
                $mail->From     = "inquiry@avglobalexports.com";
                $mail->FromName = SITE_NAME;
                $mail->addAddress(COMPANY_PRIMARY_EMAIL);
                $mail->Subject  = "New Catalogue Download Lead: " . htmlspecialchars($name);
                $mail->Body     = "
                    <h3>New Catalogue Download Request</h3>
                    <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
                    <p><strong>Company:</strong> " . htmlspecialchars($company) . "</p>
                    <p><strong>Country:</strong> " . htmlspecialchars($country) . "</p>
                    <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                    <p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>
                    <p><strong>IP:</strong> " . htmlspecialchars($ip) . "</p>
                ";
                @$mail->send();
            }
        } catch (Exception $e) {}
    }

    // Authorize user session
    $_SESSION['catalogue_authorized'] = true;
    $_SESSION['catalogue_user_email'] = $email;
    $_SESSION['catalogue_user_name']  = $name;

    // Immediately trigger the secure download
    header("Location: catalogue-access.php?action=download");
    exit;
}

// Fallback redirect
header("Location: about.php");
exit;
