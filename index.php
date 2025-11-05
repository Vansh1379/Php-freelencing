<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mena Play World</title>
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
      <!-- Hero Background Carousel -->
      <div class="hero-carousel">
        <?php
        // Get dynamic image from backend (first image)
        $dynamicImage = $heroData['background_image'] ?? '';
        if (empty($dynamicImage)) {
            // Try to get from background_images array
            $heroImages = $heroData['background_images'] ?? [];
            $dynamicImage = !empty($heroImages) ? $heroImages[0] : 'https://preview--play-gear-revamp.lovable.app/assets/hero-playground-COBMZKoG.jpg';
        } else {
            // If it's a JSON array, decode it
            $decoded = json_decode($dynamicImage, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                $dynamicImage = $decoded[0];
            }
        }
        
        // Static images (from assets folder)
        // Add your images to the assets folder and update these paths
        // Currently using placeholder URLs - replace with 'assets/your-image-1.jpg' etc.
        $staticImages = [
            'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80', // Static image 1 - replace with 'assets/hero-image-2.jpg'
            'https://images.unsplash.com/photo-1587654780291-39c9404d746b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'  // Static image 2 - replace with 'assets/hero-image-3.jpg'
        ];
        
        // Combine: dynamic first, then static images
        $allImages = array_merge([$dynamicImage], $staticImages);
        
        foreach ($allImages as $index => $image): ?>
          <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
               style="background-image: url('<?php echo htmlspecialchars($image); ?>');">
          </div>
        <?php endforeach; ?>
        
        <!-- Carousel Navigation Buttons -->
        <button class="carousel-btn carousel-btn-prev" aria-label="Previous slide">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <button class="carousel-btn carousel-btn-next" aria-label="Next slide">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
        
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
          <?php foreach ($allImages as $index => $image): ?>
            <button class="carousel-indicator <?php echo $index === 0 ? 'active' : ''; ?>" 
                    data-slide="<?php echo $index; ?>"
                    aria-label="Go to slide <?php echo $index + 1; ?>">
            </button>
          <?php endforeach; ?>
        </div>
      </div>
      
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

    <!-- About Section - Modern Design -->
    <section class="about" id="about">
      <div class="about-container">
        <!-- Section Header -->
        <div class="about-header">
          <div class="section-badge">Who We Are</div>
          <h2>About <span class="highlight"><?php echo htmlspecialchars(
              $companyInfo["company_name"] ?? "Mena Play World",
          ); ?></span></h2>
          <div class="about-intro">
            <?php
            $aboutContent = getAboutContent();
            if (!empty($aboutContent)) {
                foreach ($aboutContent as $content) {
                    if ($content["content_type"] === "main_intro") {
                        echo "<p class='intro-text'>" .
                            nl2br(htmlspecialchars($content["content_text"])) .
                            "</p>";
                        break;
                    }
                }
            } else {
                // Fallback content
                echo "<p class='intro-text'>We believe that play is an essential part of childhood development. Our mission is to design and manufacture playground equipment that fosters creativity, encourages physical activity, and provides hours of fun for children while ensuring their safety and well-being.</p>";
            }
            ?>
          </div>
        </div>

        <!-- Stats Cards -->
        <div class="about-stats-grid">
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

          foreach ($aboutStats as $index => $stat): ?>
          <div class="stat-card" data-index="<?php echo $index; ?>">
            <div class="stat-card-inner">
              <div class="stat-icon">
                <?php
                // Dynamic icons based on label
                $label = strtolower($stat["stat_label"]);
                if (
                    strpos($label, "customer") !== false ||
                    strpos($label, "client") !== false
                ) {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
                } elseif (
                    strpos($label, "project") !== false ||
                    strpos($label, "work") !== false
                ) {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>';
                } elseif (
                    strpos($label, "year") !== false ||
                    strpos($label, "experience") !== false
                ) {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>';
                } else {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>';
                }
                ?>
              </div>
              <div class="stat-number"><?php echo htmlspecialchars(
                  $stat["stat_value"],
              ); ?></div>
              <div class="stat-label"><?php echo htmlspecialchars(
                  $stat["stat_label"],
              ); ?></div>
            </div>
          </div>
          <?php endforeach;
          ?>
        </div>

        <!-- Features Grid -->
        <div class="about-content-modern">
          <div class="features-grid">
            <div class="feature-card">
              <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                  <path d="M9 12l2 2 4-4"></path>
                </svg>
              </div>
              <h4>Quality Assurance</h4>
              <p>We implement the highest quality standards for all our equipment using premium materials.</p>
            </div>

            <div class="feature-card">
              <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                  <line x1="9" y1="9" x2="9.01" y2="9"></line>
                  <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
              </div>
              <h4>Customer Focus</h4>
              <p>We prioritize customer satisfaction with personalized service and competitive pricing.</p>
            </div>

            <div class="feature-card">
              <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
              </div>
              <h4>Innovation</h4>
              <p>Our team continuously works to bring cutting-edge designs and innovative solutions.</p>
            </div>

            <div class="feature-card">
              <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
              </div>
              <h4>Safety First</h4>
              <p>All equipment meets international safety standards and undergoes rigorous testing.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Products Section - Modern Design -->
    <section class="products-main" id="products">
      <div class="products-container-modern">
        <!-- Section Header -->
        <div class="products-header-modern">
          <div class="section-badge">Our Products</div>
          <h2>Explore Our <span class="highlight">Product Range</span></h2>
          <p class="products-subtitle">
            Discover our comprehensive range of playground and fitness equipment,
            designed to create safe, fun, and engaging environments for all ages.
          </p>
        </div>

        <!-- Products Grid -->
        <div class="product-grid-modern">
          <?php
          // Include the product card component
          include "includes/components/product-card.php";

          if (!empty($homeProducts)) {
              // Use dynamic products from database
              foreach ($homeProducts as $index => $product) {
                  $productCard = convertProductToCard($product);
                  // Modify for index page - change button to redirect to products page
                  $productCard['button_text'] = 'View Details';
                  $productCard['button_action'] = 'link';
                  $productCard['button_link'] = 'products.php';
                  $productCard['show_price'] = false; // Remove price display
                  ?>
                  <div class="modern-product-card" data-index="<?php echo $index; ?>">
                    <div class="product-image-wrapper">
                      <?php if (!empty($productCard['badge'])): ?>
                        <div class="product-badge"><?php echo htmlspecialchars($productCard['badge']); ?></div>
                      <?php endif; ?>
                      <div class="product-image" style="background-image: url('<?php echo htmlspecialchars($productCard['image_url']); ?>');">
                        <div class="product-overlay">
                          <a href="<?php echo htmlspecialchars($productCard['button_link']); ?>" class="product-quick-view">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                              <circle cx="11" cy="11" r="8"></circle>
                              <path d="m21 21-4.35-4.35"></path>
                            </svg>
                            <span>View Details</span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-category"><?php echo htmlspecialchars(ucfirst($productCard['category'])); ?></div>
                      <h3 class="product-title"><?php echo htmlspecialchars($productCard['title']); ?></h3>
                      <p class="product-description"><?php echo htmlspecialchars($productCard['description']); ?></p>
                      <?php if (!empty($productCard['features'])): ?>
                        <div class="product-features">
                          <?php foreach (array_slice($productCard['features'], 0, 3) as $feature): ?>
                            <span class="feature-tag">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                              </svg>
                              <?php echo htmlspecialchars($feature); ?>
                            </span>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                      <a href="<?php echo htmlspecialchars($productCard['button_link']); ?>" class="product-cta">
                        <span>Learn More</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                          <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                      </a>
                    </div>
                  </div>
                  <?php
              }
          } else {
              // Fallback to static products if database is empty
              $homePageProducts = [];
              include "includes/products-config.php";
              // Check if static products exist and render them
              if (!empty($homePageProducts)) {
                  foreach (array_slice($homePageProducts, 0, 3) as $index => $product) {
                      ?>
                      <div class="modern-product-card" data-index="<?php echo $index; ?>">
                        <div class="product-image-wrapper">
                          <?php if (!empty($product['badge'])): ?>
                            <div class="product-badge"><?php echo htmlspecialchars($product['badge']); ?></div>
                          <?php endif; ?>
                          <div class="product-image" style="background-image: url('<?php echo htmlspecialchars($product['image_url']); ?>');">
                            <div class="product-overlay">
                              <a href="products.php" class="product-quick-view">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                  <circle cx="11" cy="11" r="8"></circle>
                                  <path d="m21 21-4.35-4.35"></path>
                                </svg>
                                <span>View Details</span>
                              </a>
                            </div>
                          </div>
                        </div>
                        <div class="product-content">
                          <div class="product-category"><?php echo htmlspecialchars(ucfirst($product['category'])); ?></div>
                          <h3 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h3>
                          <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                          <a href="products.php" class="product-cta">
                            <span>Learn More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                              <line x1="5" y1="12" x2="19" y2="12"></line>
                              <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                          </a>
                        </div>
                      </div>
                      <?php
                  }
              } else {
                  // Ultimate fallback - display message
                  echo '<div class="no-products-message">';
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>';
                  echo "<h3>Products Coming Soon</h3>";
                  echo "<p>We are currently updating our product catalog. Please check back soon or contact us for more information.</p>";
                  echo '<a href="contact.php" class="btn-primary-modern">Contact Us</a>';
                  echo "</div>";
              }
          }
          ?>
        </div>

        <!-- View All Products Button -->
        <div class="products-footer">
          <a href="products.php" class="view-all-products-btn">
            <span>View All Products</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="5" y1="12" x2="19" y2="12"></line>
              <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
          </a>
        </div>
      </div>
    </section>

    <!-- Values Section - Modern Design -->
    <section class="values-modern">
      <div class="values-container-modern">
        <div class="values-header">
          <div class="section-badge">Why Choose Us</div>
          <h2>Our <span class="highlight">Core Values</span></h2>
          <p class="values-subtitle">
            We're committed to delivering excellence in every aspect of our service
          </p>
        </div>
        
        <div class="values-grid-modern">
          <div class="value-card-modern">
            <div class="value-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                <path d="M9 12l2 2 4-4"></path>
              </svg>
            </div>
            <h3>Safety First</h3>
            <p>
              All equipment meets the highest safety standards with regular
              quality inspections and certifications.
            </p>
          </div>
          
          <div class="value-card-modern">
            <div class="value-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline>
                <polyline points="7.5 19.79 7.5 14.6 3 12"></polyline>
                <polyline points="21 12 16.5 14.6 16.5 19.79"></polyline>
                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                <line x1="12" y1="22.08" x2="12" y2="12"></line>
              </svg>
            </div>
            <h3>Innovative Design</h3>
            <p>
              Modern, engaging designs that captivate children and encourage
              active play and creative exploration.
            </p>
          </div>
          
          <div class="value-card-modern">
            <div class="value-icon-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                <path d="M2 17l10 5 10-5"></path>
                <path d="M2 12l10 5 10-5"></path>
              </svg>
            </div>
            <h3>Quality Materials</h3>
            <p>
              Weather-resistant, durable materials that are designed to last for
              decades with minimal maintenance.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section - Modern Design -->
    <section class="contact-modern" id="contact">
      <div class="contact-container-modern">
        <!-- Contact Header -->
        <div class="contact-header-modern">
          <div class="section-badge">Contact Us</div>
          <h2>Let's Create Something <span class="highlight">Amazing Together</span></h2>
          <p class="contact-subtitle">
            Ready to create an amazing play space? Contact us today for a
            consultation and let's bring your vision to life.
          </p>
        </div>

        <div class="contact-content-modern">
          <!-- Contact Info Cards -->
          <div class="contact-info-modern">
            <div class="contact-card-modern">
              <div class="contact-icon-modern">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
              </div>
              <h4>Our Location</h4>
              <p>
                <?php 
                $address = !empty($companyInfo["address"]) ? $companyInfo["address"] : "Shop no.68/4, Gali no.6, Sec 7, Guj Ghaziabad U.P - 201008, India";
                echo nl2br(htmlspecialchars($address));
                ?>
              </p>
            </div>

            <div class="contact-card-modern">
              <div class="contact-icon-modern">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
              </div>
              <h4>Phone Number</h4>
              <p>
                <?php 
                $phone = !empty($companyInfo["phone"]) ? $companyInfo["phone"] : "+91 9773698785";
                echo htmlspecialchars($phone);
                ?><br />
                <?php 
                $phoneAlt = !empty($companyInfo["phone_alt"]) ? $companyInfo["phone_alt"] : "+91 9560243588";
                echo htmlspecialchars($phoneAlt);
                ?>
              </p>
            </div>

            <div class="contact-card-modern">
              <div class="contact-icon-modern">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
              </div>
              <h4>Email Address</h4>
              <p>
                <?php 
                $email = !empty($companyInfo["email"]) ? $companyInfo["email"] : "contact.Mena@gmail.com";
                echo htmlspecialchars($email);
                ?>
                <?php 
                $emailAlt = !empty($companyInfo["email_alt"]) ? $companyInfo["email_alt"] : "";
                if (!empty($emailAlt)) {
                    echo "<br>" . htmlspecialchars($emailAlt);
                }
                ?>
              </p>
            </div>

            <div class="contact-card-modern">
              <div class="contact-icon-modern">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
              </div>
              <h4>Business Hours</h4>
              <p>
                Mon - Sat: 9:00 AM - 6:00 PM<br />
                Sunday: Closed
              </p>
            </div>
          </div>

          <!-- Contact Form -->
          <div class="contact-form-modern">
            <div class="form-header">
              <h3>Send us a Message</h3>
              <p>Fill out the form below and we'll get back to you shortly</p>
            </div>
            
            <form class="modern-form">
              <div class="form-row">
                <div class="form-group-modern">
                  <label for="name">Your Name</label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="John Doe"
                    required
                  />
                </div>

                <div class="form-group-modern">
                  <label for="email">Email Address</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="john@example.com"
                    required
                  />
                </div>
              </div>

              <div class="form-group-modern">
                <label for="phone">Phone Number</label>
                <input
                  type="tel"
                  id="phone"
                  name="phone"
                  placeholder="+91 XXXXX XXXXX"
                />
              </div>

              <div class="form-group-modern">
                <label for="message">Your Message</label>
                <textarea
                  id="message"
                  name="message"
                  placeholder="Tell us about your project requirements..."
                  rows="5"
                  required
                ></textarea>
              </div>

              <button type="submit" class="form-submit-modern">
                <span>Send Message</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <line x1="22" y1="2" x2="11" y2="13"></line>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <?php include "includes/footer.php"; ?>

    <script src="script.js"></script>
    
    <!-- Hero Carousel Script -->
    <script>
      // Standalone carousel initialization to ensure it works
      (function() {
        console.log("🎬 Hero Carousel: Initializing...");
        
        function initCarousel() {
          const carousel = document.querySelector(".hero-carousel");
          if (!carousel) {
            console.warn("⚠️ Hero carousel element not found");
            return;
          }
          
          const slides = carousel.querySelectorAll(".hero-slide");
          const indicators = document.querySelectorAll(".carousel-indicator");
          const prevBtn = document.querySelector(".carousel-btn-prev");
          const nextBtn = document.querySelector(".carousel-btn-next");
          
          console.log("📸 Found", slides.length, "slides");
          
          if (slides.length < 2) {
            console.log("ℹ️ Need at least 2 slides for carousel");
            return;
          }
          
          let currentIndex = 0;
          const totalSlides = slides.length;
          let autoRotateInterval = null;
          
          function showSlide(index) {
            // Update slides
            slides.forEach((slide, i) => {
              if (i === index) {
                slide.classList.add("active");
              } else {
                slide.classList.remove("active");
              }
            });
            
            // Update indicators
            indicators.forEach((indicator, i) => {
              if (i === index) {
                indicator.classList.add("active");
              } else {
                indicator.classList.remove("active");
              }
            });
            
            console.log("✅ Showing slide", index + 1, "of", totalSlides);
          }
          
          function nextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            showSlide(currentIndex);
          }
          
          function prevSlide() {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            showSlide(currentIndex);
          }
          
          function goToSlide(index) {
            currentIndex = index;
            showSlide(currentIndex);
          }
          
          function startAutoRotate() {
            if (autoRotateInterval) {
              clearInterval(autoRotateInterval);
            }
            autoRotateInterval = setInterval(nextSlide, 5000);
            console.log("🔄 Auto-rotation started");
          }
          
          function stopAutoRotate() {
            if (autoRotateInterval) {
              clearInterval(autoRotateInterval);
              autoRotateInterval = null;
              console.log("⏸️ Auto-rotation paused");
            }
          }
          
          function resetAutoRotate() {
            stopAutoRotate();
            setTimeout(startAutoRotate, 10000); // Resume after 10 seconds of inactivity
          }
          
          // Show first slide
          showSlide(0);
          
          // Navigation button events
          if (prevBtn) {
            prevBtn.addEventListener('click', () => {
              prevSlide();
              resetAutoRotate();
            });
          }
          
          if (nextBtn) {
            nextBtn.addEventListener('click', () => {
              nextSlide();
              resetAutoRotate();
            });
          }
          
          // Indicator button events
          indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
              goToSlide(index);
              resetAutoRotate();
            });
          });
          
          // Keyboard navigation
          document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
              prevSlide();
              resetAutoRotate();
            } else if (e.key === 'ArrowRight') {
              nextSlide();
              resetAutoRotate();
            }
          });
          
          // Start auto-rotation
          startAutoRotate();
          console.log("🔄 Carousel initialized with navigation controls");
        }
        
        // Run when page loads
        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', initCarousel);
        } else {
          initCarousel();
        }
      })();
    </script>
  </body>
</html>
