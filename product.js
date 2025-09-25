// Product filtering and pagination functionality
document.addEventListener("DOMContentLoaded", function () {
  // Pagination settings
  const PRODUCTS_PER_PAGE = 10;

  // DOM elements
  const filterButtons = document.querySelectorAll(".filter-btn");
  const productCards = document.querySelectorAll(".product-card-modern");
  const paginationInfo = document.getElementById("paginationInfo");
  const paginationNumbers = document.getElementById("paginationNumbers");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");

  // State variables
  let currentPage = 1;
  let currentCategory = "all";
  let filteredProducts = [];
  let totalPages = 1;

  // Initialize pagination
  function initializePagination() {
    console.log("Initializing pagination...");
    console.log("Found product cards:", productCards.length);
    console.log("Found filter buttons:", filterButtons.length);
    console.log("Found pagination elements:", {
      paginationInfo: !!paginationInfo,
      paginationNumbers: !!paginationNumbers,
      prevBtn: !!prevBtn,
      nextBtn: !!nextBtn,
    });

    filteredProducts = Array.from(productCards);
    updatePagination();
    showPage(1);
  }

  // Update pagination based on filtered products
  function updatePagination() {
    totalPages = Math.ceil(filteredProducts.length / PRODUCTS_PER_PAGE);

    // Update pagination info
    const startIndex = (currentPage - 1) * PRODUCTS_PER_PAGE + 1;
    const endIndex = Math.min(
      currentPage * PRODUCTS_PER_PAGE,
      filteredProducts.length
    );
    paginationInfo.textContent = `Showing ${startIndex}-${endIndex} of ${filteredProducts.length} products`;

    // Generate page numbers
    generatePageNumbers();

    // Update prev/next buttons
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
  }

  // Generate page number buttons
  function generatePageNumbers() {
    paginationNumbers.innerHTML = "";

    // Calculate which page numbers to show
    const maxVisiblePages = 5;
    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    // Adjust start page if we're near the end
    if (endPage - startPage + 1 < maxVisiblePages) {
      startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    // Add first page and ellipsis if needed
    if (startPage > 1) {
      addPageNumber(1);
      if (startPage > 2) {
        addEllipsis();
      }
    }

    // Add page numbers
    for (let i = startPage; i <= endPage; i++) {
      addPageNumber(i);
    }

    // Add ellipsis and last page if needed
    if (endPage < totalPages) {
      if (endPage < totalPages - 1) {
        addEllipsis();
      }
      addPageNumber(totalPages);
    }
  }

  // Add a page number button
  function addPageNumber(pageNum) {
    const pageBtn = document.createElement("button");
    pageBtn.className = `page-number ${
      pageNum === currentPage ? "active" : ""
    }`;
    pageBtn.textContent = pageNum;
    pageBtn.addEventListener("click", () => goToPage(pageNum));
    paginationNumbers.appendChild(pageBtn);
  }

  // Add ellipsis
  function addEllipsis() {
    const ellipsis = document.createElement("span");
    ellipsis.className = "ellipsis";
    ellipsis.textContent = "...";
    paginationNumbers.appendChild(ellipsis);
  }

  // Show specific page
  function showPage(pageNum) {
    currentPage = pageNum;

    // Hide all products first
    productCards.forEach((card) => {
      card.style.display = "none";
      card.classList.remove("show", "hide");
    });

    // Calculate start and end indices
    const startIndex = (pageNum - 1) * PRODUCTS_PER_PAGE;
    const endIndex = Math.min(
      startIndex + PRODUCTS_PER_PAGE,
      filteredProducts.length
    );

    // Show products for current page with animation
    filteredProducts.slice(startIndex, endIndex).forEach((card, index) => {
      setTimeout(() => {
        card.style.display = "block";
        card.classList.add("show");
      }, index * 50); // Staggered animation
    });

    updatePagination();

    // Scroll to top of products section
    document.querySelector(".product-grid").scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  }

  // Go to specific page
  function goToPage(pageNum) {
    if (pageNum >= 1 && pageNum <= totalPages && pageNum !== currentPage) {
      showPage(pageNum);
    }
  }

  // Filter products by category
  function filterProducts(category) {
    currentCategory = category;
    currentPage = 1; // Reset to first page when filtering

    // Update filter button states
    filterButtons.forEach((btn) => {
      btn.classList.remove("active");
      if (btn.getAttribute("data-category") === category) {
        btn.classList.add("active");
      }
    });

    // Filter products
    if (category === "all") {
      filteredProducts = Array.from(productCards);
    } else {
      filteredProducts = Array.from(productCards).filter((card) => {
        return card.getAttribute("data-category") === category;
      });
    }

    // Update pagination and show first page
    updatePagination();
    showPage(1);
  }

  // Event listeners
  filterButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const category = this.getAttribute("data-category");
      filterProducts(category);
    });
  });

  // Previous button
  prevBtn.addEventListener("click", () => {
    if (currentPage > 1) {
      goToPage(currentPage - 1);
    }
  });

  // Next button
  nextBtn.addEventListener("click", () => {
    if (currentPage < totalPages) {
      goToPage(currentPage + 1);
    }
  });

  // Keyboard navigation
  document.addEventListener("keydown", function (e) {
    if (e.key === "ArrowLeft" && currentPage > 1) {
      goToPage(currentPage - 1);
    } else if (e.key === "ArrowRight" && currentPage < totalPages) {
      goToPage(currentPage + 1);
    }
  });

  // Initialize on page load
  initializePagination();

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

  // Intersection Observer for animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate-in");
      }
    });
  }, observerOptions);

  // Observe product cards for animations
  productCards.forEach((card) => {
    observer.observe(card);
  });

  // Handle window resize
  window.addEventListener("resize", () => {
    // Recalculate pagination on resize
    updatePagination();
  });

  // Search functionality (if search input exists)
  const searchInput = document.getElementById("productSearch");
  if (searchInput) {
    searchInput.addEventListener("input", function () {
      const searchTerm = this.value.toLowerCase();

      if (searchTerm === "") {
        // If search is empty, show all products in current category
        filterProducts(currentCategory);
      } else {
        // Filter by search term
        filteredProducts = Array.from(productCards).filter((card) => {
          const title =
            card
              .querySelector(".product-title-modern")
              ?.textContent.toLowerCase() || "";
          const description =
            card
              .querySelector(".product-description-modern")
              ?.textContent.toLowerCase() || "";
          return title.includes(searchTerm) || description.includes(searchTerm);
        });

        currentPage = 1;
        updatePagination();
        showPage(1);
      }
    });
  }

  // Export functions for external use
  window.productPagination = {
    goToPage,
    filterProducts,
    getCurrentPage: () => currentPage,
    getTotalPages: () => totalPages,
    getCurrentCategory: () => currentCategory,
  };
});
