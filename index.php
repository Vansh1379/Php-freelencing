<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JK Enterprise - Premium Playground Equipment</title>
    <link rel="stylesheet" href="product.css" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php
    include "includes/header.php";
    include "includes/dynamic-data.php";

    // Fetch dynamic data
    $heroData = getHeroData();
    $companyInfo = getCompanyInfo();
    $siteStats = getWebsiteStatistics();
    $homeProducts = getHomePageProducts(3);
    ?>

    <!-- Hero Section -->
    <section class="hero" id="home">
      <div class="hero-content">
        <div class="hero-text">
          <h1 class="hero-title">
            <?php
            $title = $heroData["title"] ?? "Premium Playground Equipment";
            $titleParts = explode(" ", $title);
            $highlightWords = ["Playground", "Premium", "Quality", "Play"];

            foreach ($titleParts as $index => $word) {
                if (in_array($word, $highlightWords)) {
                    echo '<span class="highlight">' .
                        htmlspecialchars($word) .
                        "</span>";
                } else {
                    echo htmlspecialchars($word);
                }
                if ($index < count($titleParts) - 1) {
                    echo " ";
                }
            }
            ?>
          </h1>
          <p>
            <?php echo htmlspecialchars(
                $heroData["description"] ??
                    "We create safe, fun, and engaging play spaces for children of all ages. With 30+ years of experience, we deliver quality equipment that sparks imagination and provides healthy development.",
            ); ?>
          </p>

          <div class="hero-buttons">
            <a href="<?php echo htmlspecialchars(
                $heroData["button1_link"] ?? "#products",
            ); ?>" class="btn-primary">
              <?php echo htmlspecialchars(
                  $heroData["button1_text"] ?? "Explore Products",
              ); ?>
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
              >
                <path d="M5 12h14"></path>
                <path d="m12 5 7 7-7 7"></path>
              </svg>
            </a>
            <a href="<?php echo htmlspecialchars(
                $heroData["button2_link"] ?? "#contact",
            ); ?>" class="btn-secondary">
              <?php echo htmlspecialchars(
                  $heroData["button2_text"] ?? "Watch Demo",
              ); ?>
            </a>
          </div>

          <div class="stats">
            <?php
            $heroStats = array_slice($siteStats, 0, 3); // Get first 3 stats for hero
            if (empty($heroStats)) {
                // Fallback to default stats
                $heroStats = [
                    ["stat_value" => "10+", "stat_label" => "Years Experience"],
                    [
                        "stat_value" => "500+",
                        "stat_label" => "Projects Completed",
                    ],
                    [
                        "stat_value" => "9 ISO",
                        "stat_label" => "Certified Quality",
                    ],
                ];
            }

            foreach ($heroStats as $stat): ?>
            <div class="stat">
              <span class="stat-number"><?php echo htmlspecialchars(
                  $stat["stat_value"],
              ); ?></span>
              <span class="stat-label"><?php echo htmlspecialchars(
                  $stat["stat_label"],
              ); ?></span>
            </div>
            <?php endforeach;
            ?>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
      <h2>About <span class="highlight"><?php echo htmlspecialchars(
          $companyInfo["company_name"] ?? "Mena Play World",
      ); ?></span></h2>
      <div class="about-content">
        <div class="about-text">
          <?php
          $aboutContent = getAboutContent();
          if (!empty($aboutContent)) {
              foreach ($aboutContent as $content) {
                  if (
                      $content["content_type"] === "main_intro" ||
                      $content["content_type"] === "paragraph"
                  ) {
                      echo "<p>" .
                          nl2br(htmlspecialchars($content["content_text"])) .
                          "</p>";
                  }
              }
          } else {
              // Fallback content
              echo "<p>As " .
                  htmlspecialchars(
                      $companyInfo["company_name"] ?? "Mena Play World",
                  ) .
                  ", we believe that play is an essential part of childhood development. Our mission is to design and manufacture playground equipment that fosters creativity, encourages physical activity, and provides hours of fun for children while ensuring their safety and well-being.</p>";
              echo "<p>Established over a decade ago, we have been designing and manufacturing quality playground equipment for parks, schools, and other installations. Our skilled team of designers and engineers is dedicated to creating innovative and durable equipment that meets the highest safety standards.</p>";
          }
          ?>

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
          <?php
          $aboutStats = array_slice($siteStats, 0, 4); // Get first 4 stats for about section
          if (empty($aboutStats)) {
              // Fallback stats
              $aboutStats = [
                  ["stat_value" => "500+", "stat_label" => "Happy Customers"],
                  ["stat_value" => "1000+", "stat_label" => "Projects Done"],
                  ["stat_value" => "10+", "stat_label" => "Years Experience"],
                  ["stat_value" => "15+", "stat_label" => "Awards Won"],
              ];
          }

          foreach ($aboutStats as $stat): ?>
          <div class="about-stat">
            <span class="about-stat-number"><?php echo htmlspecialchars(
                $stat["stat_value"],
            ); ?></span>
            <div><?php echo htmlspecialchars($stat["stat_label"]); ?></div>
          </div>
          <?php endforeach;
          ?>
        </div>
      </div>
    </section>

    <!-- Products Section -->
    <section class="products-main" id="products">
      <div class="products-container">
        <div class="products-header">
          <h1>Our Product Range</h1>
          <p>
            Discover our comprehensive range of playground and fitness equipment,
            designed to create safe, fun, and engaging environments for all ages.
          </p>
        </div>

        <div class="product-grid">
          <?php
          // Include the product card component
          include "includes/components/product-card.php";

          if (!empty($homeProducts)) {
              // Use dynamic products from database
              foreach ($homeProducts as $product) {
                  $productCard = convertProductToCard($product);
                  // Modify for index page - change button to redirect to products page
                  $productCard['button_text'] = 'View More Products';
                  $productCard['button_action'] = 'link';
                  $productCard['button_link'] = 'products.php';
                  $productCard['show_price'] = false; // Remove price display
                  echo renderProductCard($productCard);
              }
          } else {
              // Fallback to static products if database is empty
              $homePageProducts = [];
              include "includes/products-config.php";
              // Check if static products exist and render them
              if (!empty($homePageProducts)) {
                  foreach (array_slice($homePageProducts, 0, 3) as $product) {
                      // Modify for index page - change button to redirect to products page
                      $product['button_text'] = 'View More Products';
                      $product['button_action'] = 'link';
                      $product['button_link'] = 'products.php';
                      echo renderProductCard($product);
                  }
              } else {
                  // Ultimate fallback - display message
                  echo '<div class="no-products-message" style="text-align: center; padding: 40px;">';
                  echo "<h3>Products Coming Soon</h3>";
                  echo "<p>We are currently updating our product catalog. Please check back soon or contact us for more information.</p>";
                  echo '<a href="contact.php" class="btn-primary">Contact Us</a>';
                  echo "</div>";
              }
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Values Section -->
    <section class="values">
      <div class="values-grid">
        <div class="value-item">
          <div class="value-icon">☢️</div>
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
                <?php 
                $address = !empty($companyInfo["address"]) ? $companyInfo["address"] : "Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad U.P - 201008, India";
                echo nl2br(htmlspecialchars($address));
                ?>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">📞</div>
              <div>
                <strong>Phone</strong><br />
                <?php 
                $phone = !empty($companyInfo["phone"]) ? $companyInfo["phone"] : "+91 9773698785";
                echo htmlspecialchars($phone);
                ?><br />
                <?php 
                $phoneAlt = !empty($companyInfo["phone_alt"]) ? $companyInfo["phone_alt"] : "+91 9560243588";
                echo htmlspecialchars($phoneAlt);
                ?>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">✉️</div>
              <div>
                <strong>Email</strong><br />
                <?php 
                $email = !empty($companyInfo["email"]) ? $companyInfo["email"] : "contact.jkenterprise@gmail.com";
                echo htmlspecialchars($email);
                ?><br />
                <?php 
                $emailAlt = !empty($companyInfo["email_alt"]) ? $companyInfo["email_alt"] : "";
                if (!empty($emailAlt)) {
                    echo htmlspecialchars($emailAlt);
                }
                ?>
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

    <?php include "includes/footer.php"; ?>

    <script src="script.js"></script>
  </body>
</html>
