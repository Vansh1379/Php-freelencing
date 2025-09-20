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
        <?php include 'includes/header.php'; ?>

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
                                        Shop no.68/4, Gali no.6, 4/6-Ambedkar<br />
                                        Colony, Lal Bagh, Sec 7, Guj
                                        Ghaziabad<br />
                                        U.P - 201008, India
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
                                        <a href="tel:+919773698785"
                                            >+91 9773698785</a
                                        ><br />
                                        <a href="tel:+919560243588"
                                            >+91 9560243588</a
                                        >
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
                                        <a
                                            href="mailto:contact.jkenterprise@gmail.com"
                                            >contact.jkenterprise@gmail.com</a
                                        ><br />
                                        <a
                                            href="mailto:jkenterprise1999@gmail.com"
                                            >jkenterprise1999@gmail.com</a
                                        >
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
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="firstName"
                                            >First Name *</label
                                        >
                                        <input
                                            type="text"
                                            id="firstName"
                                            name="firstName"
                                            placeholder="Enter your first name"
                                            required
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName"
                                            >Last Name *</label
                                        >
                                        <input
                                            type="text"
                                            id="lastName"
                                            name="lastName"
                                            placeholder="Enter your last name"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email"
                                            >Email Address *</label
                                        >
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            placeholder="your.email@example.com"
                                            required
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="phone"
                                            >Phone Number *</label
                                        >
                                        <input
                                            type="tel"
                                            id="phone"
                                            name="phone"
                                            placeholder="+91 9876543210"
                                            required
                                        />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="company"
                                            >Company / Organization</label
                                        >
                                        <input
                                            type="text"
                                            id="company"
                                            name="company"
                                            placeholder="Your company name"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input
                                            type="text"
                                            id="location"
                                            name="location"
                                            placeholder="City, State"
                                        />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="projectType"
                                        >Project Type</label
                                    >
                                    <select id="projectType" name="projectType">
                                        <option value="">
                                            Select project type
                                        </option>
                                        <option value="playground">
                                            Playground Equipment
                                        </option>
                                        <option value="outdoor-gym">
                                            Outdoor Gym Equipment
                                        </option>
                                        <option value="indoor-solutions">
                                            Indoor Solutions
                                        </option>
                                        <option value="custom-design">
                                            Custom Design
                                        </option>
                                        <option value="consultation">
                                            Consultation Only
                                        </option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="budget">Estimated Budget</label>
                                    <select id="budget" name="budget">
                                        <option value="">
                                            Select budget range
                                        </option>
                                        <option value="under-1lakh">
                                            Under ₹1 Lakh
                                        </option>
                                        <option value="1-5lakh">
                                            ₹1 - 5 Lakhs
                                        </option>
                                        <option value="5-10lakh">
                                            ₹5 - 10 Lakhs
                                        </option>
                                        <option value="10-25lakh">
                                            ₹10 - 25 Lakhs
                                        </option>
                                        <option value="above-25lakh">
                                            Above ₹25 Lakhs
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="timeline"
                                        >Project Timeline</label
                                    >
                                    <select id="timeline" name="timeline">
                                        <option value="">
                                            Select timeline
                                        </option>
                                        <option value="urgent">
                                            Urgent (Within 1 month)
                                        </option>
                                        <option value="2-3months">
                                            2-3 Months
                                        </option>
                                        <option value="3-6months">
                                            3-6 Months
                                        </option>
                                        <option value="6months+">
                                            6+ Months
                                        </option>
                                        <option value="flexible">
                                            Flexible
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="message"
                                        >Project Details *</label
                                    >
                                    <textarea
                                        id="message"
                                        name="message"
                                        rows="5"
                                        placeholder="Please describe your project requirements, space dimensions, age group, specific equipment needs, or any other details that would help us provide a better quote..."
                                        required
                                    ></textarea>
                                </div>

                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input
                                            type="checkbox"
                                            id="newsletter"
                                            name="newsletter"
                                            value="yes"
                                        />
                                        <span class="checkbox-text">
                                            Subscribe to our newsletter for
                                            updates and special offers
                                        </span>
                                    </label>
                                </div>

                                <div class="form-group checkbox-group">
                                    <label class="checkbox-label">
                                        <input
                                            type="checkbox"
                                            id="terms"
                                            name="terms"
                                            value="yes"
                                            required
                                        />
                                        <span class="checkbox-text">
                                            I agree to the terms and conditions
                                            *
                                        </span>
                                    </label>
                                </div>

                                <button
                                    type="submit"
                                    class="submit-btn"
                                    id="submitBtn"
                                >
                                    <span class="btn-text">Send Message</span>
                                    <span
                                        class="btn-loading"
                                        style="display: none"
                                    >
                                        <span class="spinner"></span>
                                        Sending...
                                    </span>
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
                        <a href="tel:+919773698785" class="btn-primary"
                            >Call Now</a
                        >
                        <a
                            href="mailto:contact.jkenterprise@gmail.com"
                            class="btn-secondary"
                            >Email Us</a
                        >
                    </div>
                </div>
            </div>
        </section>

        <?php include 'includes/footer.php'; ?>

        <script src="contact.js"></script>
    </body>
</html>
