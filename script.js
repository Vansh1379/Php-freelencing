// JK Enterprise Website - Complete JavaScript File
// Author: Assistant
// Description: Complete JavaScript functionality for JK Enterprise playground equipment website

document.addEventListener("DOMContentLoaded", function () {
  // Initialize all functions when DOM is loaded
  initializeSmoothScrolling();
  initializeHeaderEffects();
  initializeAnimations();
  initializeCounters();
  initializeMobileMenu();
  initializeFormHandling();
  initializeInteractiveEffects();
  initializeParallax();
  initializeLoadingEffects();
});

// ===== SMOOTH SCROLLING =====
function initializeSmoothScrolling() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href");
      const target = document.querySelector(targetId);

      if (target) {
        const headerHeight = document.querySelector("header").offsetHeight;
        const targetPosition = target.offsetTop - headerHeight - 20;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });

        // Update active navigation
        updateActiveNavigation(targetId);

        // Close mobile menu if open
        closeMobileMenu();
      }
    });
  });
}

// Update active navigation item
function updateActiveNavigation(targetId) {
  document.querySelectorAll(".nav-links a").forEach((link) => {
    link.classList.remove("active");
    if (link.getAttribute("href") === targetId) {
      link.classList.add("active");
    }
  });
}

// ===== HEADER EFFECTS =====
function initializeHeaderEffects() {
  const header = document.querySelector("header");
  let lastScrollY = window.scrollY;
  let ticking = false;

  function updateHeader() {
    const currentScrollY = window.scrollY;

    // Change header background on scroll
    if (currentScrollY > 100) {
      header.style.background = "rgba(255, 255, 255, 0.98)";
      header.style.boxShadow = "0 4px 20px rgba(0,0,0,0.15)";
    } else {
      header.style.background = "rgba(255, 255, 255, 0.95)";
      header.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
    }

    // Hide/show header on scroll (optional)
    if (currentScrollY > lastScrollY && currentScrollY > 200) {
      header.style.transform = "translateY(-100%)";
    } else {
      header.style.transform = "translateY(0)";
    }

    lastScrollY = currentScrollY;
    ticking = false;
  }

  window.addEventListener("scroll", function () {
    if (!ticking) {
      requestAnimationFrame(updateHeader);
      ticking = true;
    }
  });
}

// ===== SCROLL ANIMATIONS =====
function initializeAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("fade-in-up");

        // Add staggered animation for multiple elements
        const siblings = Array.from(entry.target.parentNode.children);
        const index = siblings.indexOf(entry.target);
        entry.target.style.animationDelay = `${index * 0.1}s`;
      }
    });
  }, observerOptions);

  // Observe elements for animation
  const elementsToAnimate = [
    ".product-card",
    ".value-item",
    ".about-stat",
    ".feature",
    ".contact-item",
    ".hero-text",
    ".about-text",
  ];

  elementsToAnimate.forEach((selector) => {
    document.querySelectorAll(selector).forEach((el) => {
      observer.observe(el);
    });
  });
}

// ===== COUNTER ANIMATIONS =====
function initializeCounters() {
  function animateCounter(element, target, duration = 2000) {
    const suffix = element.textContent.replace(/[0-9]/g, "");
    const increment = target / (duration / 16);
    let current = 0;

    const updateCounter = () => {
      current += increment;
      if (current < target) {
        element.textContent = Math.floor(current) + suffix;
        requestAnimationFrame(updateCounter);
      } else {
        element.textContent = target + suffix;
      }
    };

    updateCounter();
  }

  const counterObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const counter = entry.target;
          const text = counter.textContent;
          const target = parseInt(text.replace(/[^0-9]/g, ""));

          if (target > 0) {
            animateCounter(counter, target);
            counterObserver.unobserve(counter);
          }
        }
      });
    },
    { threshold: 0.5 }
  );

  // Observe all counter elements
  document
    .querySelectorAll(".stat-number, .about-stat-number")
    .forEach((counter) => {
      counterObserver.observe(counter);
    });
}

// ===== MOBILE MENU =====
function initializeMobileMenu() {
  // Create mobile menu button if not exists
  if (window.innerWidth <= 768 && !document.querySelector(".mobile-menu-btn")) {
    const nav = document.querySelector("nav");
    const mobileBtn = document.createElement("button");
    mobileBtn.className = "mobile-menu-btn";
    mobileBtn.innerHTML = "☰";
    mobileBtn.setAttribute("aria-label", "Toggle mobile menu");
    mobileBtn.onclick = toggleMobileMenu;
    nav.appendChild(mobileBtn);
  }

  // Handle window resize
  window.addEventListener("resize", function () {
    if (window.innerWidth > 768) {
      closeMobileMenu();
      const mobileBtn = document.querySelector(".mobile-menu-btn");
      if (mobileBtn) {
        mobileBtn.remove();
      }
    }
  });
}

function toggleMobileMenu() {
  const navLinks = document.querySelector(".nav-links");
  const mobileBtn = document.querySelector(".mobile-menu-btn");

  navLinks.classList.toggle("mobile-active");

  // Change button icon
  if (navLinks.classList.contains("mobile-active")) {
    mobileBtn.innerHTML = "✕";
    mobileBtn.setAttribute("aria-expanded", "true");
  } else {
    mobileBtn.innerHTML = "☰";
    mobileBtn.setAttribute("aria-expanded", "false");
  }
}

function closeMobileMenu() {
  const navLinks = document.querySelector(".nav-links");
  const mobileBtn = document.querySelector(".mobile-menu-btn");

  if (navLinks) {
    navLinks.classList.remove("mobile-active");
  }
  if (mobileBtn) {
    mobileBtn.innerHTML = "☰";
    mobileBtn.setAttribute("aria-expanded", "false");
  }
}

// ===== FORM HANDLING =====
function initializeFormHandling() {
  const contactForm = document.querySelector(".contact-form form");

  if (contactForm) {
    contactForm.addEventListener("submit", handleFormSubmission);

    // Add input validation
    const inputs = contactForm.querySelectorAll("input, textarea");
    inputs.forEach((input) => {
      input.addEventListener("blur", validateField);
      input.addEventListener("input", clearFieldError);
    });
  }
}

function handleFormSubmission(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);
  const formObject = {};

  // Convert FormData to object
  formData.forEach((value, key) => {
    formObject[key] = value.trim();
  });

  // Validate form
  if (!validateForm(formObject)) {
    return;
  }

  // Show loading state
  const submitBtn = form.querySelector(".form-submit");
  const originalText = submitBtn.textContent;
  submitBtn.textContent = "Sending...";
  submitBtn.disabled = true;

  // Simulate form submission (replace with actual API call)
  setTimeout(() => {
    // Success
    showNotification(
      "Thank you for your message! We will get back to you soon.",
      "success"
    );
    form.reset();

    // Reset button
    submitBtn.textContent = originalText;
    submitBtn.disabled = false;

    // You can replace this with actual form submission:
    // submitFormToServer(formObject);
  }, 1500);
}

function validateForm(data) {
  let isValid = true;

  // Name validation
  if (!data.name || data.name.length < 2) {
    showFieldError("name", "Please enter a valid name");
    isValid = false;
  }

  // Email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!data.email || !emailRegex.test(data.email)) {
    showFieldError("email", "Please enter a valid email address");
    isValid = false;
  }

  // Message validation
  if (!data.message || data.message.length < 10) {
    showFieldError(
      "message",
      "Please enter a message (at least 10 characters)"
    );
    isValid = false;
  }

  return isValid;
}

function validateField(e) {
  const field = e.target;
  const value = field.value.trim();

  clearFieldError(field);

  switch (field.name) {
    case "name":
      if (value.length < 2) {
        showFieldError(field.name, "Name must be at least 2 characters");
      }
      break;
    case "email":
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (value && !emailRegex.test(value)) {
        showFieldError(field.name, "Please enter a valid email address");
      }
      break;
    case "message":
      if (value.length > 0 && value.length < 10) {
        showFieldError(field.name, "Message must be at least 10 characters");
      }
      break;
  }
}

function showFieldError(fieldName, message) {
  const field = document.querySelector(`[name="${fieldName}"]`);
  if (!field) return;

  clearFieldError(field);

  const errorDiv = document.createElement("div");
  errorDiv.className = "field-error";
  errorDiv.textContent = message;
  errorDiv.style.color = "#dc2626";
  errorDiv.style.fontSize = "0.875rem";
  errorDiv.style.marginTop = "0.25rem";

  field.parentNode.appendChild(errorDiv);
  field.style.borderColor = "#dc2626";
}

function clearFieldError(field) {
  if (typeof field === "string") {
    field = document.querySelector(`[name="${field}"]`);
  }
  if (!field) return;

  const errorDiv = field.parentNode.querySelector(".field-error");
  if (errorDiv) {
    errorDiv.remove();
  }
  field.style.borderColor = "#e5e7eb";
}

// ===== INTERACTIVE EFFECTS =====
function initializeInteractiveEffects() {
  // Product card hover effects
  document.querySelectorAll(".product-card").forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-10px) scale(1.02)";
      this.style.transition = "all 0.3s ease";
    });

    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1)";
    });
  });

  // Button ripple effect
  document
    .querySelectorAll(
      ".btn-primary, .btn-secondary, .product-btn, .form-submit"
    )
    .forEach((btn) => {
      btn.addEventListener("click", createRippleEffect);
    });

  // Smooth hover effects for navigation
  document.querySelectorAll(".nav-links a").forEach((link) => {
    link.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-2px)";
      this.style.transition = "all 0.2s ease";
    });

    link.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)";
    });
  });
}

function createRippleEffect(e) {
  const button = e.currentTarget;
  const ripple = document.createElement("span");
  const rect = button.getBoundingClientRect();
  const size = Math.max(rect.width, rect.height);
  const x = e.clientX - rect.left - size / 2;
  const y = e.clientY - rect.top - size / 2;

  ripple.style.cssText = `
        position: absolute;
        width: ${size}px;
        height: ${size}px;
        left: ${x}px;
        top: ${y}px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s ease-out;
        pointer-events: none;
    `;

  button.style.position = "relative";
  button.style.overflow = "hidden";
  button.appendChild(ripple);

  setTimeout(() => {
    ripple.remove();
  }, 600);
}

// ===== PARALLAX EFFECTS =====
function initializeParallax() {
  let ticking = false;

  function updateParallax() {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector(".hero");

    if (hero) {
      // Subtle parallax effect
      hero.style.transform = `translateY(${scrolled * 0.3}px)`;
    }

    // Parallax for background elements
    document.querySelectorAll(".about-stat").forEach((stat, index) => {
      const rate = (index + 1) * 0.1;
      stat.style.transform = `translateY(${scrolled * rate}px)`;
    });

    ticking = false;
  }

  window.addEventListener("scroll", function () {
    if (!ticking) {
      requestAnimationFrame(updateParallax);
      ticking = true;
    }
  });
}

// ===== LOADING EFFECTS =====
function initializeLoadingEffects() {
  // Smooth page load
  window.addEventListener("load", function () {
    document.body.style.opacity = "1";
    document.body.style.transition = "opacity 0.5s ease-in-out";

    // Trigger initial animations
    setTimeout(() => {
      document.querySelectorAll(".hero-text").forEach((el) => {
        el.classList.add("fade-in-up");
      });
    }, 200);
  });

  // Set initial opacity for smooth load
  document.body.style.opacity = "0";
}

// ===== UTILITY FUNCTIONS =====
function showNotification(message, type = "info") {
  const notification = document.createElement("div");
  notification.className = `notification notification-${type}`;
  notification.textContent = message;

  // Styles
  notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
        max-width: 300px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    `;

  // Set background color based on type
  switch (type) {
    case "success":
      notification.style.background =
        "linear-gradient(135deg, #16a34a, #22c55e)";
      break;
    case "error":
      notification.style.background =
        "linear-gradient(135deg, #dc2626, #ef4444)";
      break;
    case "warning":
      notification.style.background =
        "linear-gradient(135deg, #d97706, #f59e0b)";
      break;
    default:
      notification.style.background =
        "linear-gradient(135deg, #8B5CF6, #A855F7)";
  }

  document.body.appendChild(notification);

  // Auto remove after 5 seconds
  setTimeout(() => {
    notification.style.animation = "slideOutRight 0.3s ease-in forwards";
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  }, 5000);

  // Click to dismiss
  notification.addEventListener("click", () => {
    notification.style.animation = "slideOutRight 0.3s ease-in forwards";
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  });
}

function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

function throttle(func, limit) {
  let inThrottle;
  return function () {
    const args = arguments;
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => (inThrottle = false), limit);
    }
  };
}

// ===== ADDITIONAL CSS ANIMATIONS =====
// Add required CSS animations to head
const animationStyles = document.createElement("style");
animationStyles.textContent = `
    /* Keyframe Animations */
    @keyframes ripple {
        0% { transform: scale(0); opacity: 1; }
        100% { transform: scale(2); opacity: 0; }
    }
    
    @keyframes slideInRight {
        0% { transform: translateX(100%); opacity: 0; }
        100% { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        0% { transform: translateX(0); opacity: 1; }
        100% { transform: translateX(100%); opacity: 0; }
    }
    
    @keyframes fadeInUp {
        0% { transform: translateY(30px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    
    /* Mobile Menu Styles */
    @media (max-width: 768px) {
        .mobile-menu-btn {
            display: block;
            background: none;
            border: none;
            color: #333;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .mobile-menu-btn:hover {
            background-color: #f3f4f6;
        }
        
        .nav-links {
            display: none;
        }
        
        .nav-links.mobile-active {
            display: flex;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            flex-direction: column;
            padding: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 0 0 8px 8px;
            animation: slideDown 0.3s ease-out;
        }
        
        .nav-links.mobile-active li {
            margin: 0.5rem 0;
        }
        
        .nav-links.mobile-active a {
            display: block;
            padding: 0.75rem;
            text-align: center;
            border-radius: 6px;
            transition: background-color 0.3s;
        }
        
        .nav-links.mobile-active a:hover {
            background-color: #f3f4f6;
        }
    }
    
    @keyframes slideDown {
        0% { transform: translateY(-100%); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    
    /* Field Error Styles */
    .field-error {
        animation: fadeInUp 0.3s ease-out;
    }
    
    /* Enhanced Fade In Up Animation */
    .fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    /* Loading State */
    .loading {
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }
    
    .loaded {
        opacity: 1;
    }
    
    /* Active Navigation */
    .nav-links a.active {
        color: #8B5CF6;
        font-weight: 600;
    }
`;

document.head.appendChild(animationStyles);

// ===== SCROLL SPY FOR NAVIGATION =====
function initializeScrollSpy() {
  const sections = document.querySelectorAll("section[id]");
  const navLinks = document.querySelectorAll('.nav-links a[href^="#"]');

  const observerOptions = {
    rootMargin: "-20% 0px -80% 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute("id");
        updateActiveNavigation(`#${id}`);
      }
    });
  }, observerOptions);

  sections.forEach((section) => {
    observer.observe(section);
  });
}

// Initialize scroll spy
document.addEventListener("DOMContentLoaded", initializeScrollSpy);

// ===== PERFORMANCE OPTIMIZATION =====
// Lazy load images when they come into view
function initializeLazyLoading() {
  const images = document.querySelectorAll("img[data-src]");

  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.classList.remove("lazy");
        imageObserver.unobserve(img);
      }
    });
  });

  images.forEach((img) => imageObserver.observe(img));
}

// Initialize lazy loading
document.addEventListener("DOMContentLoaded", initializeLazyLoading);

// ===== ACCESSIBILITY ENHANCEMENTS =====
// Keyboard navigation support
document.addEventListener("keydown", function (e) {
  // Escape key closes mobile menu
  if (e.key === "Escape") {
    closeMobileMenu();
  }

  // Enter key activates buttons
  if (e.key === "Enter" && e.target.classList.contains("mobile-menu-btn")) {
    toggleMobileMenu();
  }
});

// Focus management for mobile menu
document.addEventListener("focusin", function (e) {
  const mobileMenu = document.querySelector(".nav-links.mobile-active");
  if (
    mobileMenu &&
    !mobileMenu.contains(e.target) &&
    !document.querySelector(".mobile-menu-btn").contains(e.target)
  ) {
    closeMobileMenu();
  }
});

console.log("JK Enterprise Website JavaScript loaded successfully! 🚀");
