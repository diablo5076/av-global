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
