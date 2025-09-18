// Product filtering functionality
document.addEventListener("DOMContentLoaded", function () {
  // Filter functionality
  const filterButtons = document.querySelectorAll(".filter-btn");
  const productCards = document.querySelectorAll(".product-card");
  const loadMoreBtn = document.getElementById("loadMoreBtn");

  // Initially show only first 8 products
  let visibleProducts = 8;

  // Hide products beyond initial count
  function initializeProductDisplay() {
    productCards.forEach((card, index) => {
      if (index >= visibleProducts) {
        card.style.display = "none";
      } else {
        card.style.display = "block";
        card.classList.add("show");
      }
    });

    // Show/hide load more button
    if (productCards.length <= visibleProducts) {
      loadMoreBtn.style.display = "none";
    }
  }

  // Filter products by category
  function filterProducts(category) {
    let visibleCount = 0;

    productCards.forEach((card, index) => {
      const cardCategory = card.getAttribute("data-category");

      if (category === "all" || cardCategory === category) {
        card.classList.remove("hide");
        card.classList.add("show");

        if (visibleCount < visibleProducts) {
          card.style.display = "block";
          visibleCount++;
        } else {
          card.style.display = "none";
        }
      } else {
        card.classList.remove("show");
        card.classList.add("hide");
        setTimeout(() => {
          card.style.display = "none";
        }, 300);
      }
    });

    // Update load more button visibility
    const totalVisible = document.querySelectorAll(
      `[data-category="${category}"], [data-category*="all"]`
    );
    const categoryCards =
      category === "all"
        ? productCards
        : document.querySelectorAll(`[data-category="${category}"]`);

    if (
      categoryCards.length <= visibleProducts ||
      visibleCount >= categoryCards.length
    ) {
      loadMoreBtn.style.display = "none";
    } else {
      loadMoreBtn.style.display = "block";
    }
  }

  // Add event listeners to filter buttons
  filterButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Remove active class from all buttons
      filterButtons.forEach((btn) => btn.classList.remove("active"));

      // Add active class to clicked button
      this.classList.add("active");

      // Get the category
      const category = this.getAttribute("data-category");

      // Reset visible products count
      visibleProducts = 8;

      // Filter products
      filterProducts(category);

      // Smooth scroll to products section
      document.getElementById("products").scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    });
  });

  // Load more functionality
  loadMoreBtn.addEventListener("click", function () {
    const activeFilter = document
      .querySelector(".filter-btn.active")
      .getAttribute("data-category");
    const hiddenCards = Array.from(productCards).filter((card) => {
      const cardCategory = card.getAttribute("data-category");
      const matchesFilter =
        activeFilter === "all" || cardCategory === activeFilter;
      return matchesFilter && card.style.display === "none";
    });

    // Show next 4 products
    for (let i = 0; i < Math.min(4, hiddenCards.length); i++) {
      hiddenCards[i].style.display = "block";
      hiddenCards[i].classList.add("show");
    }

    visibleProducts += 4;

    // Hide load more button if all products are visible
    if (hiddenCards.length <= 4) {
      loadMoreBtn.style.display = "none";
    }

    // Add loading animation
    loadMoreBtn.textContent = "Loading...";
    loadMoreBtn.disabled = true;

    setTimeout(() => {
      loadMoreBtn.textContent = "Load More Products";
      loadMoreBtn.disabled = false;
    }, 500);
  });

  // Initialize product display
  initializeProductDisplay();

  // Product card hover effects
  productCards.forEach((card) => {
    const productBtn = card.querySelector(".product-btn");

    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-10px)";
    });

    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)";
    });

    // Product button click handler
    if (productBtn) {
      productBtn.addEventListener("click", function (e) {
        e.preventDefault();

        const productName = card.querySelector("h3").textContent;

        // Create and show quote modal (you can customize this)
        showQuoteModal(productName);

        // Add click animation
        this.style.transform = "scale(0.95)";
        setTimeout(() => {
          this.style.transform = "scale(1)";
        }, 150);
      });
    }
  });

  // Quote modal functionality
  function showQuoteModal(productName) {
    // Create modal HTML
    const modalHTML = `
            <div class="quote-modal" id="quoteModal">
                <div class="quote-modal-content">
                    <div class="quote-modal-header">
                        <h3>Get Quote for ${productName}</h3>
                        <span class="close-modal">&times;</span>
                    </div>
                    <div class="quote-modal-body">
                        <form class="quote-form" id="quoteForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="customerName">Your Name *</label>
                                    <input type="text" id="customerName" name="customerName" required>
                                </div>
                                <div class="form-group">
                                    <label for="customerEmail">Email Address *</label>
                                    <input type="email" id="customerEmail" name="customerEmail" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="customerPhone">Phone Number *</label>
                                    <input type="tel" id="customerPhone" name="customerPhone" required>
                                </div>
                                <div class="form-group">
                                    <label for="customerLocation">Location</label>
                                    <input type="text" id="customerLocation" name="customerLocation" placeholder="City, State">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="projectDetails">Project Details</label>
                                <textarea id="projectDetails" name="projectDetails" rows="4" 
                                    placeholder="Please describe your requirements, space dimensions, budget range, etc."></textarea>
                            </div>
                            <input type="hidden" id="selectedProduct" name="selectedProduct" value="${productName}">
                            <div class="form-actions">
                                <button type="button" class="btn-cancel">Cancel</button>
                                <button type="submit" class="btn-submit">Send Quote Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        `;

    // Add modal to body
    document.body.insertAdjacentHTML("beforeend", modalHTML);

    // Get modal elements
    const modal = document.getElementById("quoteModal");
    const closeBtn = modal.querySelector(".close-modal");
    const cancelBtn = modal.querySelector(".btn-cancel");
    const form = modal.querySelector("#quoteForm");

    // Show modal with animation
    setTimeout(() => {
      modal.classList.add("show");
    }, 10);

    // Close modal handlers
    function closeModal() {
      modal.classList.remove("show");
      setTimeout(() => {
        document.body.removeChild(modal);
      }, 300);
    }

    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    // Close on outside click
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeModal();
      }
    });

    // Form submission
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      // Get form data
      const formData = new FormData(form);
      const data = Object.fromEntries(formData);

      // Show loading state
      const submitBtn = form.querySelector(".btn-submit");
      const originalText = submitBtn.textContent;
      submitBtn.textContent = "Sending...";
      submitBtn.disabled = true;

      // Simulate form submission (replace with actual API call)
      setTimeout(() => {
        // Show success message
        showSuccessMessage();
        closeModal();
      }, 1500);
    });

    // Focus first input
    setTimeout(() => {
      modal.querySelector("#customerName").focus();
    }, 100);
  }

  // Success message function
  function showSuccessMessage() {
    const successHTML = `
            <div class="success-notification" id="successNotification">
                <div class="success-content">
                    <div class="success-icon">✓</div>
                    <h3>Quote Request Sent!</h3>
                    <p>Thank you for your interest. Our team will contact you within 24 hours.</p>
                </div>
            </div>
        `;

    document.body.insertAdjacentHTML("beforeend", successHTML);

    const notification = document.getElementById("successNotification");
    setTimeout(() => {
      notification.classList.add("show");
    }, 10);

    // Auto remove after 4 seconds
    setTimeout(() => {
      notification.classList.remove("show");
      setTimeout(() => {
        if (notification.parentNode) {
          document.body.removeChild(notification);
        }
      }, 300);
    }, 4000);
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });

  // Add scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1";
        entry.target.style.transform = "translateY(0)";
      }
    });
  }, observerOptions);

  // Observe all product cards and benefit items
  document.querySelectorAll(".product-card, .benefit-item").forEach((el) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(30px)";
    el.style.transition = "opacity 0.6s ease, transform 0.6s ease";
    observer.observe(el);
  });

  // Phone number formatting
  const phoneInputs = document.querySelectorAll('input[type="tel"]');
  phoneInputs.forEach((input) => {
    input.addEventListener("input", function (e) {
      let value = e.target.value.replace(/\D/g, "");
      if (value.length <= 10) {
        if (value.length > 5) {
          value = value.replace(/(\d{5})(\d{0,5})/, "$1 $2");
        }
        e.target.value = value;
      }
    });
  });
});
