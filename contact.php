<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Contact Us - Anuvanshika Global Export Co</title>
	<?php include 'assets.php' ?>
	<?php require_once 'captcha.php'; ?>
</head>

<body>

	<!-- header-section start -->
	<?php include 'header.php' ?>
	<!-- header-section end -->

	<main>
		<!-- breadcrumb-section start -->
		<section class="breadcrumb-section">
			<div class="container-fluid">
				<div class="row g-0">
					<div class="col-xl-6 col-lg-6">
						<div class="breadcrumb-content" style="background-image: url(assets/img/bg/breadcrumb-bg.webp);">
							<div class="breadcrumb-nav" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
								<ul>
									<li><a href='index.php'>Home</a></li>
									<li><a href="#">Contact Us</a></li>
								</ul>
							</div>
							<div class="breadcrumb-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
								<h2>Contact Us</h2>
							</div>
							<div class="shape-1">
								<img src="assets/img/shapes/shape-1.webp" alt="shape">
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 d-none d-lg-block">
						<div class="breadcrumb-thumb">
							<img src="assets/img/thumbs/thumb-1.webp" alt="thumb">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- breadcrumb-section end -->

		<!-- services-section start -->
		<section class="services-section p-t-120">
			<div class="container">
				<div class="row" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
					<div class="col-xl-4">
						<div class="service-card">
							<div class="service-top">
								<h4>Our Location</h4>
								<i class="fa-light fa-location-dot"></i>
							</div>
							<div class="service-content">
								<p><?php echo defined('COMPANY_ADDRESS') ? COMPANY_ADDRESS : 'House No. 15390529, Shop No. 1, Gayatri Nagar Line Par, Near Suncity School, Moradabad, Uttar Pradesh – 244001, India'; ?></p>
							</div>
							<div class="i-shape">
								<i class="fa-light fa-location-dot"></i>
							</div>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="service-card">
							<div class="service-top">
								<h4>Phone Numbers</h4>
								<i class="fa-light fa-phone-volume"></i>
							</div>
							<div class="service-content">
								<p><a href="tel:<?php echo defined('COMPANY_PHONE_RAW') ? COMPANY_PHONE_RAW : '9999027318'; ?>"><?php echo defined('COMPANY_PHONE_FORMATTED') ? COMPANY_PHONE_FORMATTED : '(+91) 99990 27318'; ?></a></p><br>
							</div>
							<div class="i-shape">
								<i class="fa-light fa-phone-volume"></i>
							</div>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="service-card">
							<div class="service-top">
								<h4>Email Address</h4>
								<i class="fa-light fa-envelope"></i>
							</div>
							<div class="service-content">
								<p><a href="mailto:<?php echo defined('COMPANY_PRIMARY_EMAIL') ? COMPANY_PRIMARY_EMAIL : 'anuvanshika.global@gmail.com'; ?>"><?php echo defined('COMPANY_PRIMARY_EMAIL') ? COMPANY_PRIMARY_EMAIL : 'anuvanshika.global@gmail.com'; ?></a></p><br>
							</div>
							<div class="i-shape">
								<i class="fa-light fa-envelope"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- services-section end -->

		<!-- contact-section start -->
		<div class="contact-section p-t-120 p-b-120">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-9">
						<div class="contact-form-wrap" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" style="background:#ffffff; border-radius:14px; box-shadow:0 15px 40px rgba(0,0,0,0.06); padding:45px 40px; border-top: 3px solid #d4af37;">
							<div class="text-center mb-4">
								<h3 style="color:#222; font-weight:700; margin-bottom:8px;">Send Us an Inquiry</h3>
								<p style="color:#666; font-size:14px;">Looking for brass handicrafts, custom designs, or bulk export orders? Fill in your details below and our team will get back to you promptly.</p>
							</div>
							<form action="process-inquiry.php" method="post">
								<input type="hidden" name="form_source" value="Contact Page Main Form">
								<input type="hidden" name="captcha_form_id" value="contact_page">
								<!-- Anti-spam Honeypot -->
								<div style="display:none !important;" aria-hidden="true">
									<input type="text" name="website_url" tabindex="-1" autocomplete="off">
								</div>

								<div class="row form-row">
									<div class="col-xl-6 col-md-6">
										<div class="input-wrap m-b-20">
											<input type="text" placeholder="Full Name *" name="name" required style="border-radius:8px; border:1px solid #ddd; padding:12px 16px;">
										</div>
									</div>
									<div class="col-xl-6 col-md-6">
										<div class="input-wrap m-b-20">
											<input type="text" placeholder="Company / Business Name" name="company" style="border-radius:8px; border:1px solid #ddd; padding:12px 16px;">
										</div>
									</div>
								</div>
								<div class="row form-row">
									<div class="col-xl-6 col-md-6">
										<div class="input-wrap m-b-20">
											<input type="email" placeholder="Email Address *" name="email" required style="border-radius:8px; border:1px solid #ddd; padding:12px 16px;">
										</div>
									</div>
									<div class="col-xl-6 col-md-6">
										<div class="input-wrap m-b-20">
											<input type="tel" placeholder="Phone / WhatsApp Number *" name="phone" required style="border-radius:8px; border:1px solid #ddd; padding:12px 16px;">
										</div>
									</div>
								</div>
								<div class="row form-row">
									<div class="col-xl-4 col-md-4">
										<div class="input-wrap m-b-20">
											<input type="text" placeholder="Country / Destination City" name="country" style="border-radius:8px; border:1px solid #ddd; padding:12px 16px;">
										</div>
									</div>
									<div class="col-xl-4 col-md-4">
										<div class="input-wrap m-b-20">
											<input type="text" placeholder="Product of Interest" name="product" style="border-radius:8px; border:1px solid #ddd; padding:12px 16px;">
										</div>
									</div>
									<div class="col-xl-4 col-md-4">
										<div class="input-wrap m-b-20">
											<input type="text" placeholder="Estimated Quantity" name="quantity" style="border-radius:8px; border:1px solid #ddd; padding:12px 16px;">
										</div>
									</div>
								</div>
								<div class="row form-row">
									<div class="col-xl-12">
										<div class="input-wrap m-b-20">
											<textarea placeholder="Please tell us about your requirements, custom finish or packaging specifications..." name="message" rows="4" style="border-radius:8px; border:1px solid #ddd; padding:14px; width:100%;"></textarea>
										</div>
									</div>
								</div>

								<!-- Manual Math CAPTCHA -->
								<div class="row form-row justify-content-center m-b-25">
									<div class="col-xl-6 col-md-8 col-12 text-center">
										<label style="font-weight:600; font-size:14px; color:#333; margin-bottom:8px; display:block;">
											Security Question: <span style="background:#222; color:#d4af37; padding:4px 10px; border-radius:5px; font-weight:700;"><?php echo generateMathCaptcha('contact_page'); ?></span> <span style="color:#e53e3e;">*</span>
										</label>
										<input type="number" name="captcha_answer" placeholder="Enter answer here" required style="border-radius:8px; border:1px solid #ddd; padding:10px 16px; width:180px; text-align:center; font-size:15px; font-weight:600;">
									</div>
								</div>

								<div class="row">
									<div class="col-xl-12">
										<div class="input-button text-center">
											<button type="submit" class="e-primary-btn has-icon" style="background:#d4af37; color:#1a1a1a; font-weight:700; border:none; padding:14px 42px; border-radius:30px; box-shadow:0 4px 15px rgba(212,175,55,0.35); cursor:pointer;">
												Submit Inquiry
												<span class="icon-wrap ms-2"><span class="icon"><i class="fa-regular fa-arrow-right"></i></span></span>
											</button>
										</div>
									</div>
								</div>
							</form>
							<p class="form-message"></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- contact-section end -->

		<!-- map-section start -->
		<div class="map-section">
			<div class="contact-map" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d111846.41400420509!2d78.773481!3d28.832892000000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390afb72295e0dad%3A0x7021fc333bd5a25e!2sAnuvanshika%20Global%20Exports!5e0!3m2!1sen!2sin!4v1774248779353!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
		<!-- map-section end -->

		<!-- contact-info-section start -->
		<section class="contact-info-section">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<div class="contact-info-layout">
							<a class="contact-info" href="mailto:<?php echo defined('COMPANY_PRIMARY_EMAIL') ? COMPANY_PRIMARY_EMAIL : 'anuvanshika.global@gmail.com'; ?>">
								<div class="icon-wrap">
									<div class="icon-shape"></div>
									<div class="icon">
										<i class="fa-solid fa-paper-plane"></i>
									</div>
								</div>
								<h3><?php echo defined('COMPANY_PRIMARY_EMAIL') ? COMPANY_PRIMARY_EMAIL : 'anuvanshika.global@gmail.com'; ?></h3>
								<p>Send an Email</p>
							</a>
							<a class="contact-info active" href="tel:<?php echo defined('COMPANY_PHONE_RAW') ? COMPANY_PHONE_RAW : '9999027318'; ?>">
								<div class="icon-wrap">
									<div class="icon-shape"></div>
									<div class="icon">
										<i class="fa-solid fa-phone-arrow-up-right"></i>
									</div>
								</div>
								<h3><?php echo defined('COMPANY_PHONE_FORMATTED') ? COMPANY_PHONE_FORMATTED : '(+91) 99990 27318'; ?></h3>
								<p>Call Us Anytime</p>
							</a>
							<a class="contact-info" href="<?php echo defined('COMPANY_WHATSAPP_URL') ? COMPANY_WHATSAPP_URL : 'https://wa.me/919999027318'; ?>" target="_blank" rel="noopener noreferrer">
								<div class="icon-wrap">
									<div class="icon-shape"></div>
									<div class="icon">
										<i class="fa-brands fa-whatsapp"></i>
									</div>
								</div>
								<h3>Chat on WhatsApp</h3>
								<p>Instant Business Inquiries</p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- contact-info-section end -->
	</main>

	<!-- footer-section start -->
	<?php include 'footer.php' ?>
	<!-- footer-section end -->

</body>

</html>
