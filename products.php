<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products - JK Enterprise</title>
    <link rel="stylesheet" href="product.css" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php include 'includes/header.php'; ?>
    <!-- Main Products Section -->
    <section class="products-main" id="products">
      <div class="products-container">
        <div class="products-header">
          <h1>Our Product Range</h1>
          <p>
            Discover our comprehensive range of playground and fitness
            equipment, designed to create safe, fun, and engaging environments
            for all ages.
          </p>

          <!-- Filter Buttons -->
          <div class="filter-buttons">
            <button class="filter-btn active" data-category="all">
              All Products
            </button>
            <button class="filter-btn" data-category="playground">
              Playground Equipment
            </button>
            <button class="filter-btn" data-category="outdoor">
              Outdoor Gym
            </button>
            <button class="filter-btn" data-category="indoor">
              Indoor Solutions
            </button>
          </div>
        </div>

        <!-- Product Grid -->
        <div class="product-grid">
          <!-- Playground Equipment Products -->
          <div class="product-card" data-category="playground">
            <div class="product-image playground-bg">
              <div class="product-badge">Popular</div>
            </div>
            <div class="product-content">
              <h3>Multi-Play Structures</h3>
              <p>
                Comprehensive play systems that combine multiple activities in
                one exciting structure, perfect for parks and schools.
              </p>
              <ul class="product-features">
                <li>Multiple climbing options</li>
                <li>Integrated slides</li>
                <li>Safety railings</li>
                <li>Age-appropriate design</li>
              </ul>
              <div class="product-price">₹2,50,000 - ₹8,00,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="playground">
            <div class="product-image playground-bg"></div>
            <div class="product-content">
              <h3>Spring Riders</h3>
              <p>
                Fun and safe spring-mounted riding toys that provide hours of
                entertainment for young children.
              </p>
              <ul class="product-features">
                <li>Colorful animal designs</li>
                <li>Durable spring mechanism</li>
                <li>Non-slip handles</li>
                <li>Weather resistant</li>
              </ul>
              <div class="product-price">₹15,000 - ₹35,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="playground">
            <div class="product-image playground-bg"></div>
            <div class="product-content">
              <h3>Swings & Slides</h3>
              <p>
                Classic playground favorites designed with modern safety
                features and vibrant colors.
              </p>
              <ul class="product-features">
                <li>Multiple swing types</li>
                <li>Various slide heights</li>
                <li>Safety chains</li>
                <li>UV resistant materials</li>
              </ul>
              <div class="product-price">₹25,000 - ₹1,20,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="playground">
            <div class="product-image playground-bg"></div>
            <div class="product-content">
              <h3>Climbing Equipment</h3>
              <p>
                Challenging climbing structures that help develop strength,
                coordination, and confidence in children.
              </p>
              <ul class="product-features">
                <li>Rock climbing walls</li>
                <li>Rope climbing nets</li>
                <li>Monkey bars</li>
                <li>Safety mats included</li>
              </ul>
              <div class="product-price">₹40,000 - ₹2,00,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <!-- Outdoor Gym Equipment Products -->
          <div class="product-card" data-category="outdoor">
            <div class="product-image outdoor-bg">
              <div class="product-badge">New</div>
            </div>
            <div class="product-content">
              <h3>Cardio Stations</h3>
              <p>
                Professional outdoor cardiovascular equipment designed to
                withstand all weather conditions.
              </p>
              <ul class="product-features">
                <li>Elliptical trainers</li>
                <li>Exercise bikes</li>
                <li>Rowing machines</li>
                <li>Galvanized steel frame</li>
              </ul>
              <div class="product-price">₹45,000 - ₹1,50,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="outdoor">
            <div class="product-image outdoor-bg"></div>
            <div class="product-content">
              <h3>Strength Training</h3>
              <p>
                Heavy-duty strength training equipment for outdoor fitness parks
                and community centers.
              </p>
              <ul class="product-features">
                <li>Multi-station units</li>
                <li>Pull-up bars</li>
                <li>Parallel bars</li>
                <li>Rust-proof coating</li>
              </ul>
              <div class="product-price">₹35,000 - ₹1,25,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="outdoor">
            <div class="product-image outdoor-bg"></div>
            <div class="product-content">
              <h3>Flexibility Equipment</h3>
              <p>
                Stretching and flexibility stations that promote wellness and
                injury prevention.
              </p>
              <ul class="product-features">
                <li>Stretching posts</li>
                <li>Balance beams</li>
                <li>Flexibility wheels</li>
                <li>Instructional signage</li>
              </ul>
              <div class="product-price">₹20,000 - ₹80,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="outdoor">
            <div class="product-image outdoor-bg"></div>
            <div class="product-content">
              <h3>Complete Gym Setup</h3>
              <p>
                Full outdoor gymnasium packages with multiple equipment stations
                for comprehensive fitness.
              </p>
              <ul class="product-features">
                <li>8-12 equipment stations</li>
                <li>Professional installation</li>
                <li>Maintenance support</li>
                <li>Custom layouts</li>
              </ul>
              <div class="product-price">₹3,50,000 - ₹12,00,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <!-- Indoor Gym Solutions -->
          <div class="product-card" data-category="indoor">
            <div class="product-image indoor-bg">
              <div class="product-badge">Premium</div>
            </div>
            <div class="product-content">
              <h3>Modular Gym Systems</h3>
              <p>
                Space-efficient indoor fitness solutions perfect for schools,
                offices, and residential complexes.
              </p>
              <ul class="product-features">
                <li>Compact design</li>
                <li>Easy assembly</li>
                <li>Multi-functional</li>
                <li>Low maintenance</li>
              </ul>
              <div class="product-price">₹1,20,000 - ₹4,50,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="indoor">
            <div class="product-image indoor-bg"></div>
            <div class="product-content">
              <h3>Kids Indoor Play</h3>
              <p>
                Safe and engaging indoor playground equipment designed for
                shopping malls and play centers.
              </p>
              <ul class="product-features">
                <li>Soft play structures</li>
                <li>Ball pools</li>
                <li>Climbing frames</li>
                <li>Safety padding</li>
              </ul>
              <div class="product-price">₹2,00,000 - ₹8,00,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="indoor">
            <div class="product-image indoor-bg"></div>
            <div class="product-content">
              <h3>School Gym Equipment</h3>
              <p>
                Educational fitness equipment designed specifically for school
                gymnasiums and sports facilities.
              </p>
              <ul class="product-features">
                <li>Age-appropriate sizing</li>
                <li>Educational benefits</li>
                <li>Durable construction</li>
                <li>Easy storage</li>
              </ul>
              <div class="product-price">₹80,000 - ₹3,00,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>

          <div class="product-card" data-category="indoor">
            <div class="product-image indoor-bg"></div>
            <div class="product-content">
              <h3>Residential Solutions</h3>
              <p>
                Premium indoor fitness equipment designed for homes, apartments,
                and private residences.
              </p>
              <ul class="product-features">
                <li>Space optimization</li>
                <li>Quiet operation</li>
                <li>Premium finishes</li>
                <li>Custom installation</li>
              </ul>
              <div class="product-price">₹60,000 - ₹2,50,000</div>
              <button class="product-btn">Get Quote</button>
            </div>
          </div>
        </div>

        <!-- Load More Button -->
        <div class="load-more-container">
          <button class="load-more-btn" id="loadMoreBtn">
            Load More Products
          </button>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose">
      <div class="container">
        <h2>Why Choose JK Enterprise?</h2>
        <div class="benefits-grid">
          <div class="benefit-item">
            <div class="benefit-icon">🏆</div>
            <h3>10+ Years Experience</h3>
            <p>
              Proven track record in delivering quality playground and fitness
              solutions across India.
            </p>
          </div>
          <div class="benefit-item">
            <div class="benefit-icon">🛡️</div>
            <h3>Safety Certified</h3>
            <p>
              All equipment meets international safety standards with ISO
              certifications.
            </p>
          </div>
          <div class="benefit-item">
            <div class="benefit-icon">🔧</div>
            <h3>Complete Installation</h3>
            <p>
              Professional installation and maintenance services included with
              every purchase.
            </p>
          </div>
          <div class="benefit-item">
            <div class="benefit-icon">💝</div>
            <h3>Custom Solutions</h3>
            <p>
              Tailored designs to meet your specific space requirements and
              budget.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="container">
        <h2>Ready to Create an Amazing Play Space?</h2>
        <p>
          Contact us today for a free consultation and custom quote for your
          playground or fitness equipment needs.
        </p>
        <div class="cta-buttons">
          <a href="#contact" class="btn-primary">Get Free Quote</a>
          <a href="tel:+919773698785" class="btn-secondary">Call Now</a>
        </div>
      </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="product.js"></script>
  </body>
</html>
