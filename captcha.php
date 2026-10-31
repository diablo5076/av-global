<?php
/**
 * Unified, Resilient Math CAPTCHA Generator & Validator
 * Supports both standard PHP session storage and cryptographic HMAC fallback.
 * Guarantees 100% accuracy even if session cookies are restricted or delayed.
 */

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}

define('CAPTCHA_HMAC_SECRET', 'AV_Global_Secure_Captcha_Salt_2026_xK9#mQ');

function generateMathCaptcha($formKey = 'default') {
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
        @session_start();
    }

    $num1 = rand(2, 9);
    $num2 = rand(1, 9);
    $ans  = $num1 + $num2;

    // 1. Session Storage
    if (!isset($_SESSION['captcha'])) {
        $_SESSION['captcha'] = [];
    }
    $_SESSION['captcha'][$formKey] = $ans;

    // 2. Cryptographic HMAC Token Fallback
    $ts = time();
    $rawToken = "{$ans}|{$ts}|{$formKey}";
    $sig = hash_hmac('sha256', $rawToken, CAPTCHA_HMAC_SECRET);
    $encodedToken = base64_encode("{$rawToken}|{$sig}");

    // Return visible math equation with seamless hidden token
    return "{$num1} + {$num2} = ?<input type=\"hidden\" name=\"captcha_token\" value=\"{$encodedToken}\">";
}

function verifyMathCaptcha($answer, $formKey = 'default') {
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
        @session_start();
    }

    $cleanAnswer = trim((string)$answer);
    if ($cleanAnswer === '') {
        return false;
    }
    $userVal = (int)$cleanAnswer;

    // Method 1: Verify via PHP Session
    if (isset($_SESSION['captcha'][$formKey])) {
        $expected = (int)$_SESSION['captcha'][$formKey];
        if ($userVal === $expected) {
            unset($_SESSION['captcha'][$formKey]);
            return true;
        }
    }

    // Method 2: Verify via Cryptographic HMAC Token (Session-independent fallback)
    $tokenParam = $_POST['captcha_token'] ?? '';
    if (!empty($tokenParam)) {
        $decoded = base64_decode($tokenParam);
        if ($decoded && substr_count($decoded, '|') === 3) {
            list($tokenAns, $tokenTs, $tokenKey, $tokenSig) = explode('|', $decoded, 4);
            $recomputedSig = hash_hmac('sha256', "{$tokenAns}|{$tokenTs}|{$tokenKey}", CAPTCHA_HMAC_SECRET);
            
            // Validate signature, matching form key, expiration (2 hours), and answer
            if (hash_equals($recomputedSig, $tokenSig) && $tokenKey === $formKey) {
                if ((time() - (int)$tokenTs) < 7200) {
                    if ($userVal === (int)$tokenAns) {
                        return true;
                    }
                }
            }
        }
    }

    return false;
}
