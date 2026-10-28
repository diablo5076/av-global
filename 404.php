<?php
http_response_code(404);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page Not Found (404) - Anuvanshika Global Export Co</title>
    <meta name="description" content="The page you are looking for cannot be found. Explore our luxury brass handicrafts and tableware collections.">
    <?php include 'assets.php'; ?>
</head>

<body>

    <?php include 'header.php'; ?>

    <main>
        <section class="breadcrumb-section">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col-xl-6 col-lg-6">
                        <div class="breadcrumb-content" style="background-image: url(assets/img/bg/breadcrumb-bg.webp);">
                            <div class="breadcrumb-nav" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                <ul>
                                    <li><a href='index.php'>Home</a></li>
                                    <li><a href="#">404 Error</a></li>
                                </ul>
                            </div>
                            <div class="breadcrumb-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                                <h2>404 Page Not Found</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="p-t-100 p-b-120 text-center" style="background: #fafaf8;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-duration="1000">
                        <span style="font-size: 84px; font-weight: 800; color: #d4af37; font-family: 'Playfair Display', Georgia, serif; line-height: 1; display: block; margin-bottom: 20px;">
                            404
                        </span>
                        <h2 style="font-size: 32px; color: #0b1528; margin-bottom: 15px;">
                            The Requested Page Is Unavailable
                        </h2>
                        <p style="font-size: 16px; color: #64748b; line-height: 1.8; margin-bottom: 35px; max-width: 550px; margin-left: auto; margin-right: auto;">
                            The page or product URL you requested may have been relocated or renamed. Please explore our handcrafted brass and marble collections below or contact our export team directly.
                        </p>
                        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                            <a href="index.php" class="btn" style="background: linear-gradient(135deg, #d4af37 0%, #b8860b 100%); color: #0b1528; font-weight: 700; padding: 12px 30px; border-radius: 30px; text-decoration: none;">
                                <i class="fa-regular fa-house me-2"></i> Return to Homepage
                            </a>
                            <a href="table-ware.php" class="btn btn-outline-dark" style="border-radius: 30px; padding: 12px 30px; font-weight: 600;">
                                <i class="fa-regular fa-utensils me-2"></i> View Tableware Collection
                            </a>
                            <button type="button" class="btn btn-dark" onclick="openInquiryModal()" style="border-radius: 30px; padding: 12px 30px; font-weight: 600;">
                                <i class="fa-regular fa-paper-plane me-2"></i> Send Inquiry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
