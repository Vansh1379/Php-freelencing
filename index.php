<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JK Enterprise - Premium Playground Equipment</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero" id="home">
      <div class="hero-content">
        <div class="hero-text">
          <h1 class="hero-title">
            Premium <span class="highlight">Playground</span>
            <span class="second-line">Equipment</span>
          </h1>
          <p>
            We create safe, fun, and engaging play spaces for children of all
            ages. With 30+ years of experience, we deliver quality equipment
            that sparks imagination and provides healthy development.
          </p>

          <div class="hero-buttons">
            <a href="#products" class="btn-primary"
              >Explore Products
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="15"
                height="15"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="lucide lucide-arrow-right h-5 w-5"
                data-lov-id="src/components/Hero.tsx:45:14"
                data-lov-name="ArrowRight"
                data-component-path="src/components/Hero.tsx"
                data-component-line="45"
                data-component-file="Hero.tsx"
                data-component-name="ArrowRight"
                data-component-content="%7B%22className%22%3A%22h-5%20w-5%22%7D"
              >
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
              </svg>
            </a>
            <a href="#contact" class="btn-secondary">Watch Demo</a>
          </div>

          <div class="stats">
            <div class="stat">
              <span class="stat-number">10+</span>
              <span class="stat-label">Years Experience</span>
            </div>
            <div class="stat">
              <span class="stat-number">500+</span>
              <span class="stat-label">Projects Completed</span>
            </div>
            <div class="stat">
              <span class="stat-number">9 ISO</span>
              <span class="stat-label">Certified Quality</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
      <h2>About <span class="highlight">Mena Play World</span></h2>
      <div class="about-content">
        <div class="about-text">
          <p>
            As Mena Play World, we believe that play is an essential part of
            childhood development. Our mission is to design and manufacture
            playground equipment that fosters creativity, encourages physical
            activity, and provides hours of fun for children while ensuring
            their safety and well-being.
          </p>

          <p>
            Established over a decade ago, we have been designing and
            manufacturing quality playground equipment for parks, schools, and
            other installations. Our skilled team of designers and engineers is
            dedicated to creating innovative and durable equipment that meets
            the highest safety standards.
          </p>

          <div class="features">
            <div class="feature">
              <h4>Quality Assurance</h4>
              <p>
                We implement the highest quality standards for all our equipment
                using premium materials.
              </p>
            </div>
            <div class="feature">
              <h4>Innovation</h4>
              <p>
                Our team continuously works to bring cutting-edge designs and
                innovative solutions.
              </p>
            </div>
            <div class="feature">
              <h4>Customer Focus</h4>
              <p>
                We prioritize customer satisfaction with personalized service
                and competitive pricing.
              </p>
            </div>
            <div class="feature">
              <h4>Safety First</h4>
              <p>
                All equipment meets international safety standards and undergoes
                rigorous testing.
              </p>
            </div>
          </div>
        </div>

        <div class="about-stats">
          <div class="about-stat">
            <span class="about-stat-number">500+</span>
            <div>Happy Customers</div>
          </div>
          <div class="about-stat">
            <span class="about-stat-number">1000+</span>
            <div>Projects Done</div>
          </div>
          <div class="about-stat">
            <span class="about-stat-number">10+</span>
            <div>Years Experience</div>
          </div>
          <div class="about-stat">
            <span class="about-stat-number">15+</span>
            <div>Awards Won</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="products">
      <div class="products-container">
        <h2>Our Product Range</h2>
        <p>
          Discover our comprehensive range of playground and fitness equipment,
          designed to create safe, fun, and engaging environments for all ages.
        </p>

        <div class="product-grid">
          <?php
          // Include the product card component and configuration
          include 'includes/components/product-card.php';
          include 'includes/products-config.php';

          // Render home page product cards from configuration
          foreach ($homePageProducts as $product) {
              echo renderProductCard($product);
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section class="values">
      <div class="values-grid">
        <div class="value-item">
          <div class="value-icon">🛡️</div>
          <h3>Safety First</h3>
          <p>
            All equipment meets the highest safety standards with regular
            quality inspections.
          </p>
        </div>
        <div class="value-item">
          <div class="value-icon">🎨</div>
          <h3>Innovative Design</h3>
          <p>
            Modern, engaging designs that captivate children and encourage
            active play.
          </p>
        </div>
        <div class="value-item">
          <div class="value-icon">💎</div>
          <h3>Quality Materials</h3>
          <p>
            Weather-resistant, durable materials that are designed to last for
            decades.
          </p>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
      <div class="contact-container">
        <h2>Get In Touch</h2>
        <p>
          Ready to create an amazing play space? Contact us today for a
          consultation and let's bring your vision to life.
        </p>

        <div class="contact-content">
          <div class="contact-info">
            <h3>Contact Information</h3>

            <div class="contact-item">
              <div class="contact-icon">📍</div>
              <div>
                <strong>Address</strong><br />
                Shop no.68/4, Gali no.6, 4/6-Ambedkar<br />
                Colony, Lal Bagh, Sec 7, Guj Ghaziabad<br />
                U.P - 201008, India
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">📞</div>
              <div>
                <strong>Phone</strong><br />
                +91 9773698785<br />
                +91 9560243588
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">✉️</div>
              <div>
                <strong>Email</strong><br />
                Contact.jkenterprise@gmail.com<br />
                jkenterprise1999@gmail.com
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">🕒</div>
              <div>
                <strong>Business Hours</strong><br />
                Mon - Sat: 9:00 AM - 6:00 PM<br />
                Sun / Holiday: Closed
              </div>
            </div>
          </div>

          <div class="contact-form">
            <h3>Send us a Message</h3>
            <form>
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

              <button type="submit" class="form-submit">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
  </body>
</html>
