<!-- social contact icon -->
<?php if (!defined('COMPANY_PHONE_TEL')) { @include_once __DIR__ . '/config.php'; } ?>
<div id="thumb1" class="tab-pane fade show active">
    <div class="pro-social-icon">
        <a href="tel:<?php echo defined('COMPANY_PHONE_RAW') ? COMPANY_PHONE_RAW : '9999027318'; ?>" class="theme-btn theme-btn-4 bg-dark"><i class="fa-solid fa-phone"></i> Call Us </a>
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="theme-btn theme-btn-4 bg-info" style="cursor: pointer;"><i class="fa-solid fa-envelope"></i> Get Best Quote</a>
        <a href="<?php echo defined('COMPANY_WHATSAPP_URL') ? COMPANY_WHATSAPP_URL : 'https://wa.me/919999027318'; ?>" target="_blank" rel="noopener noreferrer" class="theme-btn theme-btn-4 bg-success"><i class="fa-brands fa-whatsapp"></i> Chat With Us </a>
    </div>
</div>
<!-- end social contact icon -->
