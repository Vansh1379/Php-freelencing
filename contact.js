// Contact Page JavaScript
// Author: Assistant
// Description: Complete JavaScript functionality for contact page with form validation, animations, and interactive features

document.addEventListener("DOMContentLoaded", function () {
  // Initialize all functions
  initializeFormValidation();
  initializeAnimations();
  initializeFAQ();
  initializeScrollEffects();
  initializeFormSubmission();
  initializePhoneFormatting();
  initializeAccessibilityFeatures();
});

// ===== FORM VALIDATION =====
function initializeFormValidation() {
  const form = document.getElementById("contactForm");
  const submitBtn = document.getElementById("submitBtn");

  if (!form || !submitBtn) return;

  // Real-time validation for all form fields
  const formFields = form.querySelectorAll("input, select, textarea");
  formFields.forEach((field) => {
    field.addEventListener("blur", () => validateField(field));
    field.addEventListener("input", () => clearFieldError(field));
  });

  // Form submission
  form.addEventListener("submit", handleFormSubmission);
}

function validateField(field) {
  const fieldName = field.name;
  const value = field.value.trim();
  let isValid = true;
  let errorMessage = "";

  // Clear previous errors
  clearFieldError(field);

  // Skip validation for optional fields if empty
  const requiredFields = ["firstName", "lastName", "email", "phone", "message"];
  if (!requiredFields.includes(fieldName) && !value) {
    return true;
  }

  // Field-specific validation
  switch (fieldName) {
    case "firstName":
    case "lastName":
      if (!value) {
        errorMessage = `${
          fieldName === "firstName" ? "First" : "Last"
        } name is required`;
        isValid = false;
      } else if (value.length < 2) {
        errorMessage = "Name must be at least 2 characters";
        isValid = false;
      } else if (!/^[a-zA-Z\s'-]+$/.test(value)) {
        errorMessage = "Name can only contain letters, spaces, hyphens and apostrophes";
        isValid = false;
      }
      break;

    case "email":
      if (!value) {
        errorMessage = "Email address is required";
        isValid = false;
      } else if (!isValidEmail(value)) {
        errorMessage = "Please enter a valid email address";
        isValid = false;
      }
      break;

    case "phone":
      if (!value) {
        errorMessage = "Phone number is required";
        isValid = false;
      } else if (!isValidPhone(value)) {
        errorMessage = "Please enter a valid phone number";
        isValid = false;
      }
      break;

    case "message":
      if (!value) {
        errorMessage = "Project details are required";
        isValid = false;
      } else if (value.length < 20) {
        errorMessage = "Please provide more details (at least 20 characters)";
        isValid = false;
      }
      break;

    case "company":
      if (value && value.length < 2) {
        errorMessage = "Company name must be at least 2 characters";
        isValid = false;
      }
      break;

    case "location":
      if (value && value.length < 2) {
        errorMessage = "Location must be at least 2 characters";
        isValid = false;
      }
      break;
  }

  // Terms checkbox validation
  if (fieldName === "terms" && !field.checked) {
    errorMessage = "You must agree to the terms and conditions";
    isValid = false;
  }

  // Show error if validation failed
  if (!isValid) {
    showFieldError(field, errorMessage);
  } else {
    showFieldSuccess(field);
  }

  return isValid;
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhone(phone) {
  // Remove all non-digits
  const cleanPhone = phone.replace(/\D/g, "");
  // Indian phone number: 10 digits
  return cleanPhone.length === 10 || cleanPhone.length === 12;
}

function showFieldError(field, message) {
  const formGroup = field.closest(".form-group");
  if (!formGroup) return;

  // Remove existing error/success classes and messages
  formGroup.classList.remove("success");
  formGroup.classList.add("error");

  // Remove existing error message
  const existingError = formGroup.querySelector(".error-message");
  if (existingError) {
    existingError.remove();
  }

  // Add new error message
  const errorDiv = document.createElement("div");
  errorDiv.className = "error-message";
  errorDiv.textContent = message;
  formGroup.appendChild(errorDiv);

  // Add error styling to field
  field.setAttribute("aria-invalid", "true");
  field.setAttribute("aria-describedby", `${field.name}-error`);
  errorDiv.id = `${field.name}-error`;
}

function showFieldSuccess(field) {
  const formGroup = field.closest(".form-group");
  if (!formGroup) return;

  formGroup.classList.remove("error");
  formGroup.classList.add("success");
  field.setAttribute("aria-invalid", "false");
  field.removeAttribute("aria-describedby");
}

function clearFieldError(field) {
  const formGroup = field.closest(".form-group");
  if (!formGroup) return;

  formGroup.classList.remove("error", "success");
  const errorMessage = formGroup.querySelector(".error-message");
  if (errorMessage) {
    errorMessage.remove();
  }
  field.removeAttribute("aria-invalid");
  field.removeAttribute("aria-describedby");
}

// ===== FORM SUBMISSION =====
function handleFormSubmission(e) {
  e.preventDefault();

  const form = e.target;
  const formData = new FormData(form);
  const formObject = {};

  // Convert FormData to object
  formData.forEach((value, key) => {
    formObject[key] = value.trim();
  });

  // Validate entire form
  const isFormValid = validateForm(form);

  if (!isFormValid) {
    showNotification("Please correct the errors before submitting.", "error");
    return;
  }

  // Show loading state
  showLoadingState();

  // Simulate form submission (replace with actual API call)
  setTimeout(() => {
    handleFormSuccess(formObject);
  }, 2000);
}

function validateForm(form) {
  const fields = form.querySelectorAll("input, select, textarea");
  let isValid = true;

  fields.forEach((field) => {
    if (!validateField(field)) {
      isValid = false;
    }
  });

  return isValid;
}

function showLoadingState() {
  const submitBtn = document.getElementById("submitBtn");
  const btnText = submitBtn.querySelector(".btn-text");
  const btnLoading = submitBtn.querySelector(".btn-loading");

  btnText.style.display = "none";
  btnLoading.style.display = "flex";
  submitBtn.disabled = true;
}

function hideLoadingState() {
  const submitBtn = document.getElementById("submitBtn");
  const btnText = submitBtn.querySelector(".btn-text");
  const btnLoading = submitBtn.querySelector(".btn-loading");

  btnText.style.display = "inline";
  btnLoading.style.display = "none";
  submitBtn.disabled = false;
}

function handleFormSuccess(formData) {
  hideLoadingState();

  // Show success message
  showSuccessMessage();

  // Reset form
  const form = document.getElementById("contactForm");
  form.reset();

  // Clear all field states
  const formGroups = form.querySelectorAll(".form-group");
  formGroups.forEach((group) => {
    group.classList.remove("error", "success");
  });

  // Log form data (replace with actual submission logic)
  console.log("Form submitted:", formData);

  // You can add actual form submission logic here:
  // submitToServer(formData);
}

function showSuccessMessage() {
  const successHTML = `
        <div class="success-message show" id="successMessage">
            <strong>Thank you for your message!</strong><br>
            We've received your inquiry and will get back to you within 24 hours.
        </div>
    `;

  const formContainer = document.querySelector(".form-container");
  formContainer.insertAdjacentHTML("afterbegin", successHTML);

  // Auto remove after 6 seconds
  setTimeout(() => {
    const successMsg = document.getElementById("successMessage");
    if (successMsg) {
      successMsg.classList.remove("show");
      setTimeout(() => {
        successMsg.remove();
      }, 300);
    }
  }, 6000);
}

// ===== PHONE NUMBER FORMATTING =====
function initializePhoneFormatting() {
  const phoneInput = document.getElementById("phone");
  if (!phoneInput) return;

  phoneInput.addEventListener("input", function (e) {
    let value = e.target.value.replace(/\D/g, "");

    if (value.length > 10) {
      value = value.substring(0, 10);
    }

    // Format as: 98765 43210
    if (value.length > 5) {
      value = value.replace(/(\d{5})(\d{0,5})/, "$1 $2");
    }

    e.target.value = value;
  });

  // Add placeholder formatting
  phoneInput.addEventListener("focus", function (e) {
    if (!e.target.value) {
      e.target.placeholder = "98765 43210";
    }
  });

  phoneInput.addEventListener("blur", function (e) {
    e.target.placeholder = "+91 9876543210";
  });
}

// ===== FAQ FUNCTIONALITY =====
function initializeFAQ() {
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const question = item.querySelector(".faq-question");
    const answer = item.querySelector(".faq-answer");

    question.addEventListener("click", () => {
      const isActive = item.classList.contains("active");

      // Close all other items
      faqItems.forEach((otherItem) => {
        if (otherItem !== item) {
          otherItem.classList.remove("active");
        }
      });

      // Toggle current item
      if (isActive) {
        item.classList.remove("active");
      } else {
        item.classList.add("active");
      }
    });
  });
}

// ===== SCROLL ANIMATIONS =====
function initializeAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1";
        entry.target.style.transform = "translateY(0)";
      }
    });
  }, observerOptions);

  // Elements to animate
  const animateElements = [
    ".contact-info-item",
    ".form-container",
    ".faq-item",
    ".quick-stat",
  ];

  animateElements.forEach((selector) => {
    document.querySelectorAll(selector).forEach((el, index) => {
      el.style.opacity = "0";
      el.style.transform = "translateY(30px)";
      el.style.transition = `opacity 0.6s ease ${
        index * 0.1
      }s, transform 0.6s ease ${index * 0.1}s`;
      observer.observe(el);
    });
  });
}

// ===== SCROLL EFFECTS =====
function initializeScrollEffects() {
  let ticking = false;

  function updateScrollEffects() {
    const scrolled = window.pageYOffset;

    // Parallax effect for hero section
    const hero = document.querySelector(".contact-hero");
    if (hero) {
      hero.style.transform = `translateY(${scrolled * 0.3}px)`;
    }

    // Floating animation for contact info items
    document.querySelectorAll(".contact-info-item").forEach((item, index) => {
      const rate = (index + 1) * 0.05;
      item.style.transform = `translateY(${Math.sin(scrolled * 0.01 + index) * 5}px)`;
    });

    ticking = false;
  }

  window.addEventListener("scroll", () => {
    if (!ticking) {
      requestAnimationFrame(updateScrollEffects);
      ticking = true;
    }
  });
}

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = "info") {
  // Remove existing notifications
  const existingNotifications = document.querySelectorAll(".notification");
  existingNotifications.forEach((notification) => notification.remove());

  const notification = document.createElement("div");
  notification.className = `notification notification-${type}`;
  notification.innerHTML = message;

  // Styles
  Object.assign(notification.style, {
    position: "fixed",
    top: "20px",
    right: "20px",
    padding: "1rem 1.5rem",
    borderRadius: "10px",
    color: "white",
    fontWeight: "600",
    zIndex: "10000",
    maxWidth: "350px",
    boxShadow: "0 10px 30px rgba(0,0,0,0.2)",
    transform: "translateX(400px)",
    transition: "transform 0.3s ease",
  });

  // Set background based on type
  const backgrounds = {
    success: "linear-gradient(135deg, #16a34a, #22c55e)",
    error: "linear-gradient(135deg, #dc2626, #ef4444)",
    warning: "linear-gradient(135deg, #d97706, #f59e0b)",
    info: "linear-gradient(135deg, #8e44ad, #9b59b6)",
  };

  notification.style.background = backgrounds[type] || backgrounds.info;

  document.body.appendChild(notification);

  // Slide in animation
  setTimeout(() => {
    notification.style.transform = "translateX(0)";
  }, 10);

  // Auto remove
  setTimeout(() => {
    notification.style.transform = "translateX(400px)";
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  }, 5000);

  // Click to dismiss
  notification.addEventListener("click", () => {
    notification.style.transform = "translateX(400px)";
    setTimeout(() => {
      if (notification.parentNode) {
        notification.parentNode.removeChild(notification);
      }
    }, 300);
  });
}

// ===== ACCESSIBILITY FEATURES =====
function initializeAccessibilityFeatures() {
  // Keyboard navigation for FAQ
  document.querySelectorAll(".faq-question").forEach((question) => {
    question.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        question.click();
      }
    });

    // Make focusable
    question.setAttribute("tabindex", "0");
  });

  // Form accessibility improvements
  const form = document.getElementById("contactForm");
  if (form) {
    // Add aria-describedby for form description
    const formDescription = form.querySelector(".form-description");
    if (formDescription) {
      formDescription.id = "form-description";
      form.setAttribute("aria-describedby", "form-description");
    }

    // Improve label associations
    form.querySelectorAll("input, select, textarea").forEach((field) => {
      const label = form.querySelector(`label[for="${field.id}"]`);
      if (label && !field.getAttribute("aria-labelledby")) {
        field.setAttribute("aria-labelledby", `${field.id}-label`);
        label.id = `${field.id}-label`;
      }
    });
  }

  // Skip to main content link
  if (!document.querySelector(".skip-to-main")) {
    const skipLink = document.createElement("a");
    skipLink.href = "#contact";
    skipLink.className = "skip-to-main";
    skipLink.textContent = "Skip to main content";
    skipLink.style.cssText = `
            position: absolute;
            left: -10000px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
            background: #8e44ad;
            color: white;
            padding: 10px;
            border-radius: 5px;
            z-index: 10001;
        `;

    skipLink.addEventListener("focus", () => {
      skipLink.style.left = "10px";
      skipLink.style.top = "10px";
      skipLink.style.width = "auto";
      skipLink.style.height = "auto";
    });

    skipLink.addEventListener("blur", () => {
      skipLink.style.left = "-10000px";
      skipLink.style.top = "auto";
      skipLink.style.width = "1px";
      skipLink.style.height = "1px";
    });

    document.body.insertBefore(skipLink, document.body.firstChild);
  }
}

// ===== UTILITY FUNCTIONS =====
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

// ===== FORM AUTO-SAVE (Optional) =====
function initializeAutoSave() {
  const form = document.getElementById("contactForm");
  if (!form) return;

  const STORAGE_KEY = "contact-form-data";

  // Load saved data
  const savedData = localStorage.getItem(STORAGE_KEY);
  if (savedData) {
    try {
      const data = JSON.parse(savedData);
      Object.keys(data).forEach((key) => {
        const field = form.querySelector(`[name="${key}"]`);
        if (field && field.type !== "checkbox") {
          field.value = data[key];
        } else if (field && field.type === "checkbox") {
          field.checked = data[key] === "yes";
        }
      });
    } catch (e) {
      console.warn("Could not load saved form data:", e);
    }
  }

  // Save data on input
  const debouncedSave = debounce(() => {
    const formData = new FormData(form);
    const data = {};
    formData.forEach((value, key) => {
      data[key] = value;
    });
    localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
  }, 500);

  form.addEventListener("input", debouncedSave);
  form.addEventListener("change", debouncedSave);

  // Clear saved data on successful submission
  form.addEventListener("submit", (e) => {
    if (validateForm(form)) {
      setTimeout(() => {
        localStorage.removeItem(STORAGE_KEY);
      }, 3000); // Clear after success message shows
    }
  });
}

// Initialize auto-save (uncomment if needed)
// document.addEventListener("DOMContentLoaded", initializeAutoSave);

// ===== CONTACT INFO INTERACTIONS =====
function initializeContactInfoInteractions() {
  // Click to copy functionality
  document.querySelectorAll(".contact-info-content a").forEach((link) => {
    link.addEventListener("click", (e) => {
      if (link.href.startsWith("tel:") || link.href.startsWith("mailto:")) {
        // Add visual feedback
        const originalText = link.textContent;
        link.style.background = "rgba(142, 68, 173, 0.1)";
        link.style.padding = "2px 4px";
        link.style.borderRadius = "3px";

        setTimeout(() => {
          link.style.background = "transparent";
          link.style.padding = "0";
        }, 1000);
      }
    });
  });

  // Add hover effects to contact items
  document.querySelectorAll(".contact-info-item").forEach((item) => {
    item.addEventListener("mouseenter", () => {
      item.style.borderLeftWidth = "6px";
    });

    item.addEventListener("mouseleave", () => {
      item.style.borderLeftWidth = "4px";
    });
  });
}

// Initialize contact info interactions
document.addEventListener("DOMContentLoaded", initializeContactInfoInteractions);

// ===== PERFORMANCE OPTIMIZATION =====
// Lazy load background images
function initializeLazyBackgrounds() {
  const heroSection = document.querySelector(".contact-hero");
  if (heroSection && "IntersectionObserver" in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("loaded");
          observer.unobserve(entry.target);
        }
      });
    });

    observer.observe(heroSection);
  }
}

// Initialize on load
document.addEventListener("DOMContentLoaded", initializeLazyBackgrounds);

// Console message
console.log("✨ Contact Page JavaScript loaded successfully!");
console.log("📧 Contact form with validation ready");
console.log("🎯 All interactive features initialized");
