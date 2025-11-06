<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Playground Equipment - Mena Play World</title>
    <link rel="stylesheet" href="product.css" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php 
    include 'includes/header.php';
    include 'includes/components/product-card.php';
    include 'includes/dynamic-data.php';

    // Get products from database
    $allProducts = getProductsWithFallback();
    
    // Filter playground equipment products
    $playgroundProducts = array_filter($allProducts, function($product) {
        return isset($product['category']) && $product['category'] === 'playground';
    });
    ?>

    <!-- Category Hero Section -->
    <section class="category-hero">
      <div class="category-hero-content">
        <div class="breadcrumb">
          <a href="index.php">Home</a>
          <span>/</span>
          <span>Playground Equipment</span>
        </div>
        <h1>Playground <span class="highlight">Equipment</span></h1>
        <p class="category-description">
          Create safe, fun, and engaging play spaces for children of all ages with our premium playground equipment. 
          From classic swings to modern climbing structures, we have everything you need.
        </p>
      </div>
    </section>

    <!-- Products Section -->
    <section class="category-products-section">
      <div class="products-container-modern">
        <div class="products-filter-header">
          <div class="results-count">
            <h3><?php echo count($playgroundProducts); ?> Products Found</h3>
          </div>
          <div class="category-links">
            <a href="playground-equipment.php" class="category-link active">Playground</a>
            <a href="outdoor-gym.php" class="category-link">Outdoor Gym</a>
            <a href="indoor-gym.php" class="category-link">Indoor Gym</a>
          </div>
        </div>

        <!-- Product Grid -->
        <div class="product-grid-modern">
          <?php
          if (!empty($playgroundProducts)) {
              foreach ($playgroundProducts as $index => $product) {
                  ?>
                  <div class="modern-product-card" data-index="<?php echo $index; ?>">
                    <div class="product-image-wrapper">
                      <?php if (!empty($product['badge'])): ?>
                        <div class="product-badge"><?php echo htmlspecialchars($product['badge']); ?></div>
                      <?php endif; ?>
                      <div class="product-image" style="background-image: url('<?php echo htmlspecialchars($product['image_url']); ?>');">
                        <div class="product-overlay">
                          <button class="product-quick-view" onclick="openQuoteModal('<?php echo htmlspecialchars($product['title']); ?>')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span>Get Quote</span>
                          </button>
                        </div>
                      </div>
                    </div>
                    <div class="product-content">
                      <div class="product-category"><?php echo htmlspecialchars(ucfirst($product['category'])); ?></div>
                      <h3 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h3>
                      <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                      <?php if (!empty($product['features'])): ?>
                        <div class="product-features">
                          <?php foreach (array_slice($product['features'], 0, 3) as $feature): ?>
                            <span class="feature-tag">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
                              </svg>
                              <?php echo htmlspecialchars($feature); ?>
                            </span>
                          <?php endforeach; ?>
                        </div>
                      <?php endif; ?>
                      <div class="product-actions">
                        <button class="product-cta product-cta-primary" onclick="openQuoteModal('<?php echo htmlspecialchars($product['title']); ?>')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                          </svg>
                          <span>Request Quote</span>
                        </button>
                        <button class="product-cta product-cta-secondary" onclick="downloadBrochure('<?php echo htmlspecialchars($product['title']); ?>')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                          </svg>
                          <span>Download Brochure</span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <?php
              }
          } else {
              echo '<div class="no-products-message">';
              echo '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>';
              echo '<h3>No Playground Equipment Found</h3>';
              echo '<p>We are currently updating our product catalog. Please check back soon or contact us for more information.</p>';
              echo '<a href="contact.php" class="btn-primary-modern">Contact Us</a>';
              echo '</div>';
          }
          ?>
        </div>
      </div>
    </section>

    <!-- Quote Modal -->
    <div id="quoteModal" class="quote-modal">
      <div class="quote-modal-content">
        <button class="quote-modal-close" onclick="closeQuoteModal()">&times;</button>
        <h2>Request a Quote</h2>
        <p>Fill out the form below and we'll get back to you with a detailed quote</p>
        <form class="quote-form" onsubmit="return handleQuoteSubmit(event)">
          <input type="hidden" id="productName" name="product">
          <div class="form-row">
            <div class="form-group-modern">
              <label for="quoteName">Your Name</label>
              <input type="text" id="quoteName" name="name" required>
            </div>
            <div class="form-group-modern">
              <label for="quoteEmail">Email</label>
              <input type="email" id="quoteEmail" name="email" required>
            </div>
          </div>
          <div class="form-group-modern">
            <label for="quotePhone">Phone Number</label>
            <input type="tel" id="quotePhone" name="phone" required>
          </div>
          <div class="form-group-modern">
            <label for="quoteMessage">Requirements</label>
            <textarea id="quoteMessage" name="message" rows="4" placeholder="Tell us about your requirements..."></textarea>
          </div>
          <button type="submit" class="form-submit-modern">
            <span>Send Request</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <line x1="22" y1="2" x2="11" y2="13"></line>
              <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
            </svg>
          </button>
        </form>
      </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
      function openQuoteModal(productName) {
        document.getElementById('productName').value = productName;
        document.getElementById('quoteModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
      }

      function closeQuoteModal() {
        document.getElementById('quoteModal').style.display = 'none';
        document.body.style.overflow = 'auto';
      }

      function handleQuoteSubmit(e) {
        e.preventDefault();
        alert('Thank you for your quote request! We will contact you shortly.');
        closeQuoteModal();
        e.target.reset();
        return false;
      }

      function downloadBrochure(productName) {
        // In a real implementation, this would download a PDF brochure
        alert('Downloading brochure for ' + productName + '\n\nThis feature will be available soon with actual PDF files.');
        // window.open('/brochures/' + productName.toLowerCase().replace(/\s+/g, '-') + '.pdf', '_blank');
      }

      // Close modal on outside click
      window.onclick = function(event) {
        const modal = document.getElementById('quoteModal');
        if (event.target === modal) {
          closeQuoteModal();
        }
      }
    </script>
  </body>
</html>

