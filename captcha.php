<?php
/**
 * Manual Math CAPTCHA Generator & Validator
 */

if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}

function generateMathCaptcha($formKey = 'default') {
    $num1 = rand(2, 9);
    $num2 = rand(1, 9);
    $ans = $num1 + $num2;

    if (!isset($_SESSION['captcha'])) {
        $_SESSION['captcha'] = [];
    }
    $_SESSION['captcha'][$formKey] = $ans;

    return "{$num1} + {$num2} = ?";
}

function verifyMathCaptcha($answer, $formKey = 'default') {
    if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
        session_start();
    }

    if (!isset($_SESSION['captcha'][$formKey])) {
        return false;
    }

    $expected = (int)$_SESSION['captcha'][$formKey];
    unset($_SESSION['captcha'][$formKey]); // one-time use

    return (int)trim($answer) === $expected;
}
