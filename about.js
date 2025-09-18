document.addEventListener("DOMContentLoaded", function () {
  // Counter animation for statistics
  function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16); // 60fps
    let current = start;

    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }

      // Format the number display
      if (target >= 1000) {
        element.textContent = Math.floor(current / 1000) + "k+";
      } else {
        element.textContent = Math.floor(current) + "+";
      }
    }, 16);
  }

  // Intersection Observer for scroll-triggered animations
  const observerOptions = {
    threshold: 0.3,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const statNumbers = entry.target.querySelectorAll(".stat-number");
        const targets = [10, 1000, 50, 500]; // Corresponding to the stats

        statNumbers.forEach((stat, index) => {
          // Add a delay for staggered animation
          setTimeout(() => {
            animateCounter(stat, targets[index]);
          }, index * 200);
        });

        // Unobserve after animation starts
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Observe the stats section
  const statsSection = document.querySelector(".stats-section");
  if (statsSection) {
    observer.observe(statsSection);
  }

  // Smooth scroll behavior for any anchor links (if added later)
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

  // Add parallax effect to company card on scroll
  window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset;
    const companyCard = document.querySelector(".company-card");
    if (companyCard) {
      const translateY = scrolled * 0.1;
      companyCard.style.transform = `translateY(${translateY}px)`;
    }
  });

  // Add typing effect to welcome title
  function typeWriter(element, text, speed = 100) {
    let i = 0;
    element.innerHTML = "";

    function type() {
      if (i < text.length) {
        element.innerHTML += text.charAt(i);
        i++;
        setTimeout(type, speed);
      }
    }

    // Start typing after a delay
    setTimeout(type, 1000);
  }

  // Apply typing effect to welcome title
  const welcomeTitle = document.querySelector(".welcome-title");
  if (welcomeTitle) {
    const originalText = welcomeTitle.textContent;
    // Only apply typing effect on desktop
    if (window.innerWidth > 768) {
      typeWriter(welcomeTitle, originalText, 80);
    }
  }

  // Add hover effect for paragraphs
  const paragraphs = document.querySelectorAll(".content-text p");
  paragraphs.forEach((p) => {
    p.addEventListener("mouseenter", function () {
      this.style.transform = "translateX(10px)";
      this.style.transition = "transform 0.3s ease";
    });

    p.addEventListener("mouseleave", function () {
      this.style.transform = "translateX(0)";
    });
  });

  // Add fade-in animation for paragraphs on scroll
  const paragraphObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "1";
          entry.target.style.transform = "translateY(0)";
        }
      });
    },
    {
      threshold: 0.1,
    }
  );

  // Initially hide paragraphs and observe them
  paragraphs.forEach((p, index) => {
    p.style.opacity = "0";
    p.style.transform = "translateY(20px)";
    p.style.transition = `opacity 0.6s ease ${
      index * 0.1
    }s, transform 0.6s ease ${index * 0.1}s`;
    paragraphObserver.observe(p);
  });

  // Add click effect to stats
  document.querySelectorAll(".stat-item").forEach((stat) => {
    stat.addEventListener("click", function () {
      this.style.transform = "scale(0.95)";
      setTimeout(() => {
        this.style.transform = "scale(1)";
      }, 150);
    });
  });

  // Responsive text adjustment
  function adjustTextSize() {
    const welcomeTitle = document.querySelector(".welcome-title");
    const sectionTitle = document.querySelector(".section-title");

    if (window.innerWidth < 480) {
      if (welcomeTitle) welcomeTitle.style.fontSize = "1.3rem";
      if (sectionTitle) sectionTitle.style.fontSize = "1.8rem";
    } else if (window.innerWidth < 768) {
      if (welcomeTitle) welcomeTitle.style.fontSize = "1.5rem";
      if (sectionTitle) sectionTitle.style.fontSize = "2rem";
    } else {
      if (welcomeTitle) welcomeTitle.style.fontSize = "2rem";
      if (sectionTitle) sectionTitle.style.fontSize = "2.5rem";
    }
  }

  // Call on load and resize
  adjustTextSize();
  window.addEventListener("resize", adjustTextSize);

  // Performance optimization: Throttle scroll events
  let ticking = false;

  function updateScrollEffects() {
    // Your scroll effects here
    ticking = false;
  }

  window.addEventListener("scroll", () => {
    if (!ticking) {
      requestAnimationFrame(updateScrollEffects);
      ticking = true;
    }
  });
});
