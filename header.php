<?php
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    @session_start();
}
?>
<header class="header-section-2">
    <div class="header-bottom-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="header-bottom-layout">
                        <div class="header-left-3">
                            <div class="logo-wrap header-logo">
                                <a href='index.php'>
                                    <img src="assets/img/logo/logo-white.png" alt="Anuvanshika Global Export Co" />
                                </a>
                            </div>
                            <nav class="main-menu-3 d-none d-xl-block">
                                <ul style="display: flex; flex-wrap: nowrap; white-space: nowrap; align-items: center; justify-content: space-between; margin: 0; padding: 0;">
                                    <li><a href='index.php'>Home</a></li>
                                    <li><a href='about.php'>About</a></li>
                                    <li class="has-dropdown"><a href='services.php'>Services</a>
                                        <ul class="sub-menu">
                                            <li><a href='casting-moulding.php'>Casting & Moulding</a></li>
                                            <li><a href='turning-shaping.php'>Turning & Shaping</a></li>
                                            <li><a href='hand-engraving-nakkashi.php'>Nikashi Work (Hand Engraving)</a></li>
                                            <li><a href='polishing-buffing.php'>Polishing & Buffing</a></li>
                                            <li><a href='hand-painted-meenakari.php'>Enameling & Artistry (Meenakari)</a></li>
                                            <li><a href='electroplating-finishing.php'>Electroplating & Lacquering</a></li>
                                            <li><a href='services.php'>All Craftsmanship Services</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown"><a href="products.php">Products</a>
                                        <ul class="sub-menu">
                                            <li><a href='table-ware.php'>Tableware & Serveware</a></li>
                                            <li><a href='kitchen-ware.php'>Kitchenware & Barware</a></li>
                                            <li><a href='brass-handicraft.php'>Brass Handicraft & Art</a></li>
                                            <li><a href='mother-of-pearl.php'>MOP (Mother of Pearls)</a></li>
                                            <li><a href='vases-planters.php'>Vases & Planters</a></li>
                                            <li><a href='lamp.php'>Lamps & Lighting</a></li>
                                            <li><a href='products.php'>All Export Collections</a></li>
                                        </ul>
                                    </li>
                                    <li><a href='gifting.php'>Gifting</a></li>
                                    <li><a href='contact.php'>Contact Us</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <div class="header-info-2 d-none d-xl-flex">
                                <div class="header-info-icon">
                                    <i class="fa-regular fa-phone-volume"></i>
                                </div>
                                <div class="header-info-content">
                                    <span>Call or WhatsApp</span>
                                    <p><a href="tel:9999027318">(+91) 99990 27318</a></p>
                                </div>
                            </div>
                            <div class="header-btn-wrap d-none d-xl-flex" style="gap: 10px; align-items: center;">
                                <button type="button" class='e-primary-btn is-hover-white has-icon' onclick="openInquiryModal()" style="border: none; cursor: pointer; background: linear-gradient(135deg, #d4af37 0%, #b8860b 100%); color: #0b1528; font-weight: 700;">
                                    Send Inquiry
                                    <span class="icon-wrap">
                                        <span class="icon"><i class="fa-regular fa-paper-plane"></i><i class="fa-regular fa-paper-plane"></i></span>
                                    </span>
                                </button>
                            </div>
                            <div class="header-bar-2 open-mobile-menu d-xl-none" data-toggle="menubar">
                                <div class="bar bar-1"></div>
                                <div class="bar bar-2"></div>
                                <div class="bar bar-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-section end -->

<!-- Inline guaranteed styling for header navigation dropdowns -->
<style id="navbar-dropdown-fix">
.main-menu-3 .has-dropdown {
    position: relative !important;
}
.main-menu-3 .has-dropdown:hover > a:after {
    transform: rotate(180deg) !important;
    content: "\f068" !important;
}
.main-menu-3 .has-dropdown .sub-menu {
    position: absolute !important;
    left: 0 !important;
    top: 100% !important;
    margin-top: 10px !important;
    width: max-content !important;
    min-width: max-content !important;
    max-width: calc(100vw - 40px) !important;
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    align-items: stretch !important;
    justify-content: flex-start !important;
    white-space: normal !important;
    background: #ffffff !important;
    border-radius: 14px !important;
    padding: 12px 18px !important;
    margin-bottom: 0 !important;
    list-style: none !important;
    box-shadow: 0 16px 45px rgba(0, 0, 0, 0.28), 0 2px 10px rgba(0, 0, 0, 0.08) !important;
    border: 1px solid rgba(212, 175, 55, 0.35) !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
    transform: translateY(8px) !important;
    transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s !important;
    z-index: 999999 !important;
}
@media (max-width: 1550px) {
    .main-menu-3 ul li.has-dropdown:nth-child(4) .sub-menu,
    .main-menu-3 ul li.has-dropdown:last-of-type .sub-menu {
        left: auto !important;
        right: -80px !important;
    }
}
@media (max-width: 1399px) {
    .main-menu-3 ul li.has-dropdown:nth-child(4) .sub-menu,
    .main-menu-3 ul li.has-dropdown:last-of-type .sub-menu {
        left: auto !important;
        right: -130px !important;
    }
}
.main-menu-3 .has-dropdown .sub-menu::before {
    content: "" !important;
    position: absolute !important;
    top: -14px !important;
    left: 0 !important;
    right: 0 !important;
    height: 16px !important;
    background: transparent !important;
    display: block !important;
}
.main-menu-3 .has-dropdown:hover > .sub-menu {
    visibility: visible !important;
    opacity: 1 !important;
    pointer-events: auto !important;
    transform: translateY(0) !important;
}
.main-menu-3 .sub-menu li {
    display: flex !important;
    align-items: stretch !important;
    justify-content: center !important;
    margin: 0 !important;
    padding: 0 4px !important;
    list-style: none !important;
    flex: 0 0 auto !important;
    width: auto !important;
}
.main-menu-3 .sub-menu li::before {
    display: none !important;
    content: none !important;
}
.main-menu-3 .sub-menu li a {
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    box-sizing: border-box !important;
    min-width: 110px !important;
    max-width: 135px !important;
    width: auto !important;
    padding: 9px 12px !important;
    color: #1e293b !important;
    font-size: 13.5px !important;
    font-weight: 500 !important;
    line-height: 1.35 !important;
    border-radius: 8px !important;
    background: transparent !important;
    white-space: normal !important;
    word-break: normal !important;
    border: none !important;
    transition: all 0.2s ease !important;
}
.main-menu-3 .sub-menu li a:hover {
    background: #fbf7ee !important;
    color: #b8860b !important;
    font-weight: 600 !important;
    padding-left: 12px !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 2px 8px rgba(184, 134, 11, 0.15) !important;
}
</style>

<!-- off-canvas-menubar start -->
<div class="off-canvas-menubar">
    <div class="off-canvas-menubar-body">
        <div class="off-canvas-head">
            <div class="off-canvas-logo">
                <a href='index.php'>
                    <img src="assets/img/logo/logo-white.png" alt="logo" style="max-height: 40px;" />
                </a>
            </div>
            <div class="off-canvas-menubar-close" data-close="menubar">
                <i class="fa-regular fa-xmark"></i>
            </div>
        </div>
        <div class="off-canvas-menu">
            <ul>
                <li><a href='index.php'>Home</a></li>
                <li><a href='about.php'>About</a></li>
                <li class="has-dropdown">
                    <a href="services.php">Our Services</a>
                    <ul class="sub-menu">
                        <li><a href='casting-moulding.php'>Casting & Moulding</a></li>
                        <li><a href='turning-shaping.php'>Turning & Shaping</a></li>
                        <li><a href='hand-engraving-nakkashi.php'>Nikashi Work (Hand Engraving)</a></li>
                        <li><a href='polishing-buffing.php'>Polishing & Buffing</a></li>
                        <li><a href='hand-painted-meenakari.php'>Enameling & Artistry (Meenakari)</a></li>
                        <li><a href='electroplating-finishing.php'>Electroplating & Lacquering</a></li>
                        <li><a href='services.php'>All Services</a></li>
                    </ul>
                </li>
                <li class="has-dropdown">
                    <a href="products.php">Our Products</a>
                    <ul class="sub-menu">
                        <li><a href='table-ware.php'>Tableware & Serveware</a></li>
                        <li><a href='kitchen-ware.php'>Kitchenware & Barware</a></li>
                        <li><a href='brass-handicraft.php'>Brass Handicraft</a></li>
                        <li><a href='mother-of-pearl.php'>MOP (Mother of Pearls)</a></li>
                        <li><a href='vases-planters.php'>Vases & Planters</a></li>
                        <li><a href='lamp.php'>Lamps & Lighting</a></li>
                        <li><a href='products.php'>All Products</a></li>
                    </ul>
                </li>
                <li><a href='gifting.php'>Gifting</a></li>
                <li><a href='contact.php'>Contact Us</a></li>
            </ul>
        </div>
        <div style="padding: 20px 25px;">
            <button type="button" class="btn w-100" onclick="openInquiryModal()" style="background: #d4af37; color: #0b1528; font-weight: 700; border-radius: 8px; padding: 12px; border: none;">
                <i class="fa-regular fa-paper-plane me-2"></i> Send Inquiry
            </button>
        </div>
    </div>
    <div class="off-canvas-menubar-overlay" data-close="menubar"></div>
</div>
