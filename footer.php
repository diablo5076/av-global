<!-- footer-section start -->
<?php 
if (!defined('SITE_NAME')) { @include_once __DIR__ . '/config.php'; } 
require_once __DIR__ . '/captcha.php';
?>
<footer class="footer-section p-t-125 p-b-50 overflow-hidden" style="background-image: url(assets/img/bg/footer-bg.webp)">
    <div class="container">
        <div class="row justify-content-between row-gap-md-5 row-gap-4 p-b-30">
            <div class="col-xl-4 col-lg-8 col-md-7">
                <div class="footer-widget">
                    <div class="about-widget">
                        <div class="footer-logo">
                            <a href='index.php'><img alt="logo" src="assets/img/logo/logo-white.png"></a>
                        </div>
                        <div class="text">
                            <p>
                                Anuvanshika Global Export Co specializes in quality kitchenware, tableware, and handcrafted brass décor products. We are committed to delivering elegant products, dependable service, and reliable export solutions to customers worldwide.
                            </p>
                        </div>
                        <div class="info">
                            <p><b>We Are Available !!</b></p>
                            <p><?php echo defined('BUSINESS_HOURS') ? BUSINESS_HOURS : 'Mon-Sat: <span>10:00am to 08:00pm</span>'; ?></p>
                        </div>
                        <div class="social-links">
                            <a href="<?php echo defined('SOCIAL_FACEBOOK') ? SOCIAL_FACEBOOK : 'https://www.facebook.com/share/1EmP8BvLaa/'; ?>" target="_blank" rel="noopener noreferrer" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="<?php echo defined('SOCIAL_INSTAGRAM') ? SOCIAL_INSTAGRAM : 'https://www.instagram.com/avglobal_exports?exln=MXhyZjc5MDlsaW1vbg%3D%3D'; ?>" target="_blank" rel="noopener noreferrer" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="<?php echo defined('SOCIAL_LINKEDIN') ? SOCIAL_LINKEDIN : 'https://www.linkedin.com/company/avglobalexports/'; ?>" target="_blank" rel="noopener noreferrer" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="<?php echo defined('COMPANY_WHATSAPP_URL') ? COMPANY_WHATSAPP_URL : 'https://wa.me/919999027318'; ?>" target="_blank" rel="noopener noreferrer" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-5">
                <div class="footer-widget">
                    <h3 class="w-title">Quick Links</h3>
                    <ul>
                        <li><a href='about.php'>About Company</a></li>
                        <li><a href='services.php'>Our Services</a></li>
                        <li><a href='products.php'>Our Products</a></li>
                        <li><a href='gifting.php'>Gifting</a></li>
                        <li><a href='contact.php'>Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-5">
                <div class="footer-widget">
                    <h3 class="w-title">Categories</h3>
                    <ul>
                        <li><a href='brass-handicraft.php'>Brass Handicraft</a></li>
                        <li><a href='kitchen-ware.php'>Kitchenware</a></li>
                        <li><a href='table-ware.php'>Tableware</a></li>
                        <li><a href='mother-of-pearl.php'>MOP (Mother of Pearls)</a></li>
                        <li><a href='lamp.php'>Lamps & Lighting</a></li>
                        <li><a href='vases-planters.php'>Vases & Planters</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="footer-widget">
                    <h3 class="w-title">Reach Us</h3>
                    <div class="subscribe-form">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27963.793437682347!2d78.73069256183847!3d28.824739534479562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390afb72295e0dad%3A0x7021fc333bd5a25e!2sAnuvanshika%20Global%20Exports!5e0!3m2!1sen!2sin!4v1773833656635!5m2!1sen!2sin" height="230" style="border:0; width:100%; border-radius:8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 text-center">
                <div class="footer-bottom-layout m-b-xs-40">
                    <a class="e-primary-btn is-hover-white top-btn" href="#">Go Top <i class="fa-regular fa-arrow-up"></i></a>
                    <div class="footer-copyright">©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>  Anuvanshika Global Export Co. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-section end -->

<!-- Footer floating quick contact icons -->
<a href="<?php echo defined('COMPANY_WHATSAPP_URL') ? COMPANY_WHATSAPP_URL : 'https://wa.me/919999027318'; ?>" class="float" target="_blank" rel="noopener noreferrer" title="Chat on WhatsApp"><i class="fa fa-whatsapp my-float"></i></a>
<a href="tel:<?php echo defined('COMPANY_PHONE_RAW') ? COMPANY_PHONE_RAW : '9999027318'; ?>" class="float2" title="Call Us"><i class="fa fa-phone my-float2"></i></a>

<!-- Floating Send Inquiry button (Section 1) -->
<button type="button" class="floating-inquiry-btn" onclick="openInquiryModal()" title="Send Inquiry / Request a Quote">
    <i class="fa-solid fa-file-invoice"></i>
    <span>Send Inquiry</span>
</button>
<!-- Footer floating quick contact icons End -->

<style>
.floating-inquiry-btn {
    position: fixed;
    bottom: 25px;
    left: 25px;
    z-index: 9990;
    background: linear-gradient(135deg, #0b1528 0%, #16243d 100%);
    color: #d4af37;
    border: 1.5px solid #d4af37;
    padding: 10px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 700;
    box-shadow: 0 8px 25px rgba(11, 21, 40, 0.45);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.floating-inquiry-btn:hover {
    background: #d4af37;
    color: #0b1528;
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(212, 175, 55, 0.45);
}
@media (max-width: 576px) {
    .floating-inquiry-btn {
        bottom: 85px;
        left: 15px;
        padding: 8px 14px;
        font-size: 12px;
    }
}
.modal-backdrop.show {
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    background-color: rgba(10, 18, 32, 0.75);
}
</style>

<!-- Vendors Js -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/popper/popper.min.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/fancybox/fancybox.umd.js"></script>
<script src="assets/vendor/counter/purecounter.js"></script>
<!-- Main Js -->
<script src="assets/js/script.js?v=20261107_01"></script>

<!-- start Luxury Navy & Gold Inquiry Pop-up Modal (Section 1) -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border: 1px solid rgba(212, 175, 55, 0.4); border-radius: 16px; overflow: hidden; box-shadow: 0 25px 60px rgba(10, 20, 40, 0.45); background: #ffffff;">
            <!-- Modal Header (Navy Blue & Gold) -->
            <div class="modal-header" style="background: linear-gradient(135deg, #0b1528 0%, #16243d 100%); color: #fff; padding: 22px 28px; border-bottom: 2px solid #d4af37; position: relative;">
                <div>
                    <span style="display: inline-block; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #d4af37; font-weight: 700; margin-bottom: 4px;">Anuvanshika Global Export Co</span>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #ffffff; font-weight: 700; font-size: 24px; margin: 0; font-family: 'Playfair Display', serif, Georgia;">
                        Get a Custom Quote
                    </h4>
                    <p style="margin: 6px 0 0 0; font-size: 13px; color: #cbd5e1; line-height: 1.4;">Direct manufacturer pricing, catalogues & custom specifications for international buyers.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="handleInquiryModalDismiss()"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="padding: 26px 28px; background: #fafaf8;">
                <form id="unifiedInquiryForm" action="process-inquiry.php" method="POST">
                    <input type="hidden" name="form_source" value="Luxury Pop-up Inquiry">
                    <input type="hidden" name="captcha_form_id" value="quote_modal">
                    <!-- Invisible Honeypot anti-spam field -->
                    <div style="display:none !important;" aria-hidden="true">
                        <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #1e293b; margin-bottom: 4px;">Full Name <span style="color:#e53e3e;">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required style="border-radius: 8px; padding: 10px 14px; border: 1px solid #cbd5e1; font-size: 14px;">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #1e293b; margin-bottom: 4px;">Business Email <span style="color:#e53e3e;">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="you@company.com" required style="border-radius: 8px; padding: 10px 14px; border: 1px solid #cbd5e1; font-size: 14px;">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #1e293b; margin-bottom: 4px;">Phone / WhatsApp with Country Code <span style="color:#e53e3e;">*</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="e.g. +1 555 123 4567" required style="border-radius: 8px; padding: 10px 14px; border: 1px solid #cbd5e1; font-size: 14px;">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #1e293b; margin-bottom: 4px;">Country / Region</label>
                            <input type="text" name="country" class="form-control" placeholder="e.g. United States, UK, UAE, Australia" style="border-radius: 8px; padding: 10px 14px; border: 1px solid #cbd5e1; font-size: 14px;">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #1e293b; margin-bottom: 4px;">Product Interest</label>
                            <select name="product" class="form-select" style="border-radius: 8px; padding: 10px 14px; border: 1px solid #cbd5e1; font-size: 14px;">
                                <option value="Tableware">Tableware & Serveware</option>
                                <option value="Kitchenware">Kitchenware & Barware</option>
                                <option value="Handicrafts">Brass Handicrafts & Sculptures</option>
                                <option value="MOP">MOP (Mother of Pearls)</option>
                                <option value="Gifting">Gifting & Decorative Accents</option>
                                <option value="Lamps & Lighting">Lamps & Candle Stands</option>
                                <option value="Vases & Planters">Vases & Planters</option>
                                <option value="Other">Other / Custom Manufacturing</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #1e293b; margin-bottom: 4px;">Estimated Quantity (Optional)</label>
                            <input type="text" name="quantity" class="form-control" placeholder="e.g. 50 pcs, 500 pcs, Sample" style="border-radius: 8px; padding: 10px 14px; border: 1px solid #cbd5e1; font-size: 14px;">
                        </div>

                        <div class="col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #1e293b; margin-bottom: 4px;">Message / Custom Requirements</label>
                            <textarea name="message" class="form-control" rows="2" placeholder="Tell us about finishes (polish, satin, antique), packaging, or target dimensions..." style="border-radius: 8px; padding: 10px 14px; border: 1px solid #cbd5e1; font-size: 14px;"></textarea>
                        </div>

                        <!-- Manual Math CAPTCHA -->
                        <div class="col-12">
                            <div style="background: #f1f5f9; padding: 10px 14px; border-radius: 8px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                                <span style="font-weight: 600; font-size: 13px; color: #334155;">
                                    Security Verification: <strong style="color: #0b1528; background: #e2e8f0; padding: 2px 8px; border-radius: 4px; font-size: 14px; border-left: 3px solid #d4af37;"><?php echo generateMathCaptcha('quote_modal'); ?></strong> <span style="color:#e53e3e;">*</span>
                                </span>
                                <input type="number" name="captcha_answer" class="form-control" placeholder="Answer" required style="width: 100px; border-radius: 6px; padding: 6px 10px; border: 1px solid #cbd5e1; font-size: 14px; text-align: center;">
                            </div>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #d4af37 0%, #b8860b 100%); color: #0b1528; font-weight: 700; font-size: 15px; letter-spacing: 0.5px; border: none; padding: 12px 24px; border-radius: 8px; box-shadow: 0 4px 16px rgba(212,175,55,0.4); cursor: pointer; transition: all 0.3s ease;">
                                <i class="fa-regular fa-paper-plane me-2"></i> Send Inquiry
                            </button>
                            <p style="font-size: 11px; color: #64748b; margin: 8px 0 0 0;">Strict confidentiality guaranteed. Export inquiries handled within 24 business hours.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Luxury Navy & Gold Inquiry Pop-up Modal -->

<!-- Brochure Download & Registration Modal -->
<div class="modal fade" id="brochureModal" tabindex="-1" aria-labelledby="brochureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.25);">
            <div class="modal-header" style="background: linear-gradient(135deg, #1b1c1e 0%, #282a2e 100%); color: #fff; padding: 20px 25px; border-bottom: 2px solid #d4af37;">
                <div>
                    <h5 class="modal-title" id="brochureModalLabel" style="color: #d4af37; font-weight: 700; margin: 0;">
                        <i class="fa-light fa-file-arrow-down me-2"></i>Download Full Catalogue
                    </h5>
                    <p style="margin: 4px 0 0 0; font-size: 12px; color: #ccc;">Please register your details to instantly view & download our export brochure.</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 25px; background: #fafaf8;">
                <form action="catalogue-access.php" method="POST">
                    <input type="hidden" name="action" value="register_or_login">
                    <input type="hidden" name="captcha_form_id" value="brochure_modal">
                    <!-- Honeypot -->
                    <div style="display:none !important;" aria-hidden="true">
                        <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #333;">Full Name <span style="color:#e53e3e;">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required style="border-radius: 8px; padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #333;">Company Name</label>
                            <input type="text" name="company" class="form-control" placeholder="Company Name" style="border-radius: 8px; padding: 10px 14px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #333;">Country / Region</label>
                            <input type="text" name="country" class="form-control" placeholder="e.g. USA, UK, India" style="border-radius: 8px; padding: 10px 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #333;">Business Email <span style="color:#e53e3e;">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="you@company.com" required style="border-radius: 8px; padding: 10px 14px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #333;">Phone / WhatsApp <span style="color:#e53e3e;">*</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="+91 99990 27318" required style="border-radius: 8px; padding: 10px 14px;">
                        </div>
                        <!-- Manual Math CAPTCHA for brochure -->
                        <div class="col-12">
                            <label class="form-label" style="font-weight: 600; font-size: 13px; color: #333;">
                                Verification: <strong style="color:#d4af37; background:#222; padding:2px 7px; border-radius:4px;"><?php echo generateMathCaptcha('brochure_modal'); ?></strong> <span style="color:#e53e3e;">*</span>
                            </label>
                            <input type="number" name="captcha_answer" class="form-control" placeholder="Enter result" required style="border-radius: 8px; padding: 9px 14px;">
                        </div>
                        <div class="col-12">
                            <div class="form-check" style="font-size: 12px; color: #666;">
                                <input class="form-check-input" type="checkbox" id="privacyAgree" required checked>
                                <label class="form-check-label" for="privacyAgree">
                                    I agree to receive the product catalogue and product updates from <?php echo SITE_NAME; ?>.
                                </label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn w-100" style="background: #d4af37; color: #111; font-weight: 700; border-radius: 8px; padding: 12px; border: none; box-shadow: 0 4px 12px rgba(212,175,55,0.35);">
                                <i class="fa-light fa-download me-2"></i> Instant Catalogue Download
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Brochure Download Modal -->

<script>
// AV Global Inquiry Pop-up Session Timer & 7-Day Suppression (Section 1)
function openInquiryModal() {
    var modalEl = document.getElementById('exampleModal');
    if (modalEl && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
        var modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
        modalInstance.show();
    }
}

function handleInquiryModalDismiss() {
    // Suppress pop-up for 7 days
    var sevenDaysMs = 7 * 24 * 60 * 60 * 1000;
    localStorage.setItem('av_inquiry_suppressed_until', (Date.now() + sevenDaysMs).toString());
}

document.addEventListener('DOMContentLoaded', function() {
    var modalEl = document.getElementById('exampleModal');
    if (modalEl) {
        modalEl.addEventListener('hide.bs.modal', function() {
            handleInquiryModalDismiss();
        });
    }

    // Check 7-day suppression
    var suppressedUntil = parseInt(localStorage.getItem('av_inquiry_suppressed_until') || '0', 10);
    var isSuppressed = Date.now() < suppressedUntil;
    var alreadyShownThisSession = sessionStorage.getItem('av_inquiry_shown_session') === '1';

    // Session timer for 150 seconds (2.5 minutes) across page navigations
    if (!isSuppressed && !alreadyShownThisSession) {
        var secondsSpent = parseInt(sessionStorage.getItem('av_site_time_spent') || '0', 10);
        var timerInterval = setInterval(function() {
            secondsSpent += 1;
            sessionStorage.setItem('av_site_time_spent', secondsSpent.toString());

            if (secondsSpent >= 150) {
                clearInterval(timerInterval);
                sessionStorage.setItem('av_inquiry_shown_session', '1');
                openInquiryModal();
            }
        }, 1000);
    }

    // Attach to form submission to suppress for 7 days
    var form = document.getElementById('unifiedInquiryForm');
    if (form) {
        form.addEventListener('submit', function() {
            handleInquiryModalDismiss();
        });
    }
});
</script>
