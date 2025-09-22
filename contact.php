<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Contact Us - Mena Play World</title>
        <link rel="stylesheet" href="contact.css" />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <?php 
        include 'includes/header.php';
        include 'includes/dynamic-data.php';
        
        // Fetch dynamic data
        $companyInfo = getCompanyInfo();
        ?>

        <!-- Contact Hero Section -->
        <section class="contact-hero">
            <div class="container">
                <div class="contact-hero-content">
                    <h1 class="contact-title">Get In Touch</h1>
                    <p class="contact-subtitle">
                        Ready to create an amazing play space? We're here to
                        help you bring your vision to life with our premium
                        playground equipment and expert consultation.
                    </p>
                </div>
            </div>
        </section>

        <!-- Contact Main Section -->
        <section class="contact-main" id="contact">
            <div class="container">
                <div class="contact-grid">
                    <!-- Contact Information -->
                    <div class="contact-info-section">
                        <h2>Contact Information</h2>
                        <p class="contact-info-text">
                            We're here to help you create the perfect playground
                            experience. Reach out to us through any of these
                            channels.
                        </p>

                        <div class="contact-info-list">
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <span>📍</span>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Our Address</h4>
                                    <p>
                                        <?php echo nl2br(htmlspecialchars($companyInfo['address'] ?? 'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India')); ?>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <span>📞</span>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Phone Numbers</h4>
                                    <p>
                                        <a href="tel:<?php echo str_replace([' ', '-'], '', $companyInfo['phone'] ?? '+91 9773698785'); ?>">
                                            <?php echo htmlspecialchars($companyInfo['phone'] ?? '+91 9773698785'); ?>
                                        </a>
                                        <?php if (!empty($companyInfo['phone_alt'])): ?>
                                        <br />
                                        <a href="tel:<?php echo str_replace([' ', '-'], '', $companyInfo['phone_alt']); ?>">
                                            <?php echo htmlspecialchars($companyInfo['phone_alt']); ?>
                                        </a>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <span>✉️</span>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Email Address</h4>
                                    <p>
                                        <a href="mailto:<?php echo htmlspecialchars($companyInfo['email'] ?? 'contact.jkenterprise@gmail.com'); ?>">
                                            <?php echo htmlspecialchars($companyInfo['email'] ?? 'contact.jkenterprise@gmail.com'); ?>
                                        </a>
                                        <?php if (!empty($companyInfo['email_alt'])): ?>
                                        <br />
                                        <a href="mailto:<?php echo htmlspecialchars($companyInfo['email_alt']); ?>">
                                            <?php echo htmlspecialchars($companyInfo['email_alt']); ?>
                                        </a>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <span>🕒</span>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Business Hours</h4>
                                    <p>
                                        Monday - Saturday: 9:00 AM - 6:00 PM<br />
                                        Sunday / Holidays: Closed
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="quick-stats">
                            <div class="quick-stat">
                                <div class="stat-number">24hrs</div>
                                <div class="stat-label">Response Time</div>
                            </div>
                            <div class="quick-stat">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">Happy Clients</div>
                            </div>
                            <div class="quick-stat">
                                <div class="stat-number">10+</div>
                                <div class="stat-label">Years Experience</div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form-section">
                        <div class="form-container">
                            <h2>Send Us a Message</h2>
                            <p class="form-description">
                                Fill out the form below and we'll get back to
                                you as soon as possible with a personalized
                                quote for your project.
                            </p>

                            <form class="contact-form" id="contactForm">
                                <div class="form-group">
                                    <label for="name">Your Name</label>
                                    <input
                                        type="text"
                                        id="name"
                                        name="name"
                                        placeholder="Enter your name"
                                        required
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        placeholder="Enter your email"
                                        required
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        name="phone"
                                        placeholder="Enter phone number"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea
                                        id="message"
                                        name="message"
                                        placeholder="Tell us about your project..."
                                        required
                                    ></textarea>
                                </div>

                                <button
                                    type="submit"
                                    class="submit-btn"
                                    id="submitBtn"
                                >
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section">
            <div class="container">
                <h2>Find Us on Map</h2>
                <div class="map-container">
                    <div class="map-placeholder">
                        <div class="map-icon">🗺️</div>
                        <h3>Interactive Map Coming Soon</h3>
                        <p>
                            We're located in Ghaziabad, UP. Contact us for
                            detailed directions to our facility.
                        </p>
                        <a href="tel:+919773698785" class="map-contact-btn"
                            >Call for Directions</a
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="container">
                <h2>Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>What is your typical delivery time?</h4>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Our typical delivery time ranges from 2-6 weeks
                                depending on the complexity of the project and
                                customization requirements. We'll provide you
                                with a detailed timeline after assessing your
                                specific needs.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>Do you provide installation services?</h4>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Yes, we provide complete professional
                                installation services for all our equipment. Our
                                certified installation team ensures everything
                                is set up safely and according to all safety
                                standards.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>
                                What safety certifications do your products
                                have?
                            </h4>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                All our products meet international safety
                                standards and are ISO 9001:2015 certified. We
                                conduct rigorous testing to ensure maximum
                                safety for children of all age groups.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>Do you offer custom playground designs?</h4>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Absolutely! We specialize in custom playground
                                designs tailored to your specific space, budget,
                                and requirements. Our design team will work with
                                you to create the perfect play space.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>What warranty do you provide?</h4>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                We provide comprehensive warranties on all our
                                equipment, typically ranging from 2-5 years
                                depending on the product type. We also offer
                                maintenance services to keep your equipment in
                                optimal condition.
                            </p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-question">
                            <h4>
                                Can I visit your facility to see the equipment?
                            </h4>
                            <span class="faq-toggle">+</span>
                        </div>
                        <div class="faq-answer">
                            <p>
                                Yes, we encourage visits to our facility in
                                Ghaziabad. You can see our equipment displays
                                and discuss your requirements with our team.
                                Please call ahead to schedule an appointment.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="contact-cta">
            <div class="container">
                <div class="cta-content">
                    <h2>Ready to Get Started?</h2>
                    <p>
                        Let's create an amazing playground experience together.
                        Contact us today for a free consultation and quote.
                    </p>
                    <div class="cta-buttons">
                        <a href="tel:<?php echo str_replace([' ', '-'], '', $companyInfo['phone'] ?? '+91 9773698785'); ?>" class="btn-primary">
                            Call Now
                        </a>
                        <a href="mailto:<?php echo htmlspecialchars($companyInfo['email'] ?? 'contact.jkenterprise@gmail.com'); ?>" class="btn-secondary">
                            Email Us
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'includes/footer.php'; ?>

        <script src="contact.js"></script>
    </body>
</html>
