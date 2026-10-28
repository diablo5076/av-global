<?php
/**
 * SMTP Configuration
 * Placed in protected data/ directory (inaccessible via HTTP due to data/.htaccess).
 * Replace placeholder credentials with the client's production email account or Google App Password.
 */

return [
    'host'       => 'smtp.gmail.com',
    'smtp_auth'  => true,
    'port'       => 587,
    'secure'     => 'tls', // 'tls' or 'ssl'
    'username'   => 'anuvanshika.global@gmail.com', // Replace with client's sending email
    'password'   => '', // Enter App Password or SMTP password here
    'from_email' => 'anuvanshika.global@gmail.com',
    'from_name'  => 'Anuvanshika Global Export Co'
];
