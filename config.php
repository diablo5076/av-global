<?php
/**
 * Global Configuration for Anuvanshika Global Export Co
 * Centralized settings for contact info, social links, email, and security.
 */

// Environment settings
define('SITE_NAME', 'Anuvanshika Global Export Co');
define('SITE_TAGLINE', 'Premium Brass Handicrafts, Crafted with Indian Heritage');
define('SITE_URL', 'http://localhost:8000'); // or https://avglobalexports.com on live server

// Contact Information
define('COMPANY_PHONE_RAW', '9999027318');
define('COMPANY_PHONE_FORMATTED', '(+91) 99990 27318');
define('COMPANY_PHONE_TEL', '+919999027318');

// WhatsApp Configuration
define('COMPANY_WHATSAPP_NUMBER', '919999027318');
define('COMPANY_WHATSAPP_MESSAGE', 'Hello! I found your website https://avglobalexports.com/ and I am interested in your products.');
define('COMPANY_WHATSAPP_URL', 'https://wa.me/' . COMPANY_WHATSAPP_NUMBER . '?text=' . rawurlencode(COMPANY_WHATSAPP_MESSAGE));

// Company Email Recipients
define('COMPANY_PRIMARY_EMAIL', 'anuvanshika.global@gmail.com');
// Updated exact address per Section 2
define('COMPANY_ADDRESS', 'House No. 15390529, Shop No. 1, Gayatri Nagar Line Par, Near Suncity School, Moradabad, Uttar Pradesh – 244001, India');
define('COMPANY_ADDRESS_SHORT', 'Shop No. 1, Gayatri Nagar Line Par, Near Suncity School, Moradabad – 244001, UP, India');

// Social Media Links (Updated)
define('SOCIAL_FACEBOOK', 'https://www.facebook.com/share/1EmP8BvLaa/');
define('SOCIAL_INSTAGRAM', 'https://www.instagram.com/avglobal_exports?exln=MXhyZjc5MDlsaW1vbg%3D%3D');
define('SOCIAL_LINKEDIN', 'https://www.linkedin.com/company/avglobalexports/');
define('SOCIAL_YOUTUBE', 'https://www.youtube.com/');

// Business Hours
define('BUSINESS_HOURS', 'Mon-Sat: 10:00am to 08:00pm');

// Database / Storage
define('DB_DIR', __DIR__ . '/data');
define('DB_PATH', DB_DIR . '/inquiries.sqlite');

// Rate Limiting (Anti-Spam)
define('RATE_LIMIT_MAX_SUBMISSIONS', 5);
define('RATE_LIMIT_WINDOW_SECONDS', 3600); // 1 hour

// CAPTCHA Configuration (Cloudflare Turnstile or Google reCAPTCHA v3)
// Options: 'none', 'turnstile', 'recaptcha'
define('CAPTCHA_PROVIDER', 'none'); 
define('CAPTCHA_SITE_KEY', '');
define('CAPTCHA_SECRET_KEY', '');

// Protected Assets
define('PRIVATE_FILES_DIR', __DIR__ . '/data/private_files');
define('BROCHURE_FILENAME', 'brochure.pdf');
