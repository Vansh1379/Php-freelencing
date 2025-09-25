// Admin Panel JavaScript - Mena Play World
// Complete functionality for content management system with backend integration

class AdminPanel {
  constructor() {
    this.currentSection = "main";
    this.products = [];
    this.certifications = [];
    this.latestWork = [];
    this.blogs = [];
    this.currentEditingProduct = null;
    this.currentEditingCertification = null;
    this.currentEditingLatestWork = null;
    this.currentEditingBlog = null;
    this.apiBase = "admin-api.php";
    this.init();
  }

  init() {
    this.initializeEventListeners();
    this.initializeFileUploads();
    this.initializeContentEditor();
    this.showWelcomeMessage();
    this.initializePHPIntegration();

    // Load data after DOM is ready
    setTimeout(() => {
      this.loadInitialData();
    }, 100);
  }

  initializeEventListeners() {
    // Sidebar navigation
    document.querySelectorAll(".menu-item").forEach((item) => {
      item.addEventListener("click", (e) => {
        e.preventDefault();
        const section = item.getAttribute("data-section");
        this.switchSection(section);
      });
    });

    // Header actions
    document.getElementById("saveAllBtn").addEventListener("click", () => {
      this.saveAllChanges();
    });

    // Product management
    document.getElementById("addProductBtn").addEventListener("click", () => {
      this.showProductModal();
    });

    document.getElementById("closeModal").addEventListener("click", () => {
      this.hideProductModal();
    });

    // Certification management
    const addCertBtn = document.getElementById("addCertificationBtn");
    if (addCertBtn) {
      addCertBtn.addEventListener("click", (e) => {
        e.preventDefault();
        console.log("Add Certification button clicked");
        this.showCertificationModal();
      });
    } else {
      console.error("Add Certification button not found!");
    }

    // Latest Work management
    document
      .getElementById("addLatestWorkBtn")
      .addEventListener("click", () => {
        this.showLatestWorkModal();
      });

    // Blog management
    document.getElementById("addBlogBtn").addEventListener("click", () => {
      this.showBlogModal();
    });

    document
      .getElementById("closeCertificationModal")
      .addEventListener("click", () => {
        this.hideCertificationModal();
      });

    document
      .getElementById("cancelCertification")
      .addEventListener("click", () => {
        this.hideCertificationModal();
      });

    // Certification form event listener will be set up when section is switched to

    // Modal backdrop click
    document
      .getElementById("certificationModal")
      .addEventListener("click", (e) => {
        if (e.target.id === "certificationModal") {
          this.hideCertificationModal();
        }
      });

    // Latest work management - event listeners will be set up when section is switched to

    // Blog management - event listeners will be set up when section is switched to

    document.getElementById("cancelProduct").addEventListener("click", () => {
      this.hideProductModal();
    });

    document.getElementById("productForm").addEventListener("submit", (e) => {
      this.handleProductSubmit(e);
    });

    // Modal backdrop click
    document.getElementById("productModal").addEventListener("click", (e) => {
      if (e.target.id === "productModal") {
        this.hideProductModal();
      }
    });

    // Form validation
    this.setupFormValidation();

    // Logout functionality
    document.querySelector(".logout-btn").addEventListener("click", () => {
      this.handleLogout();
    });

    // Auto-save functionality
    this.setupAutoSave();

    // Keyboard shortcuts
    document.addEventListener("keydown", (e) => {
      this.handleKeyboardShortcuts(e);
    });

    // Confirmation modal
    this.initializeConfirmModal();

    // Initialize PHP data integration
    this.loadPHPConfiguration();
  }

  switchSection(section) {
    // Update active menu item
    document.querySelectorAll(".menu-item").forEach((item) => {
      item.classList.remove("active");
    });
    document
      .querySelector(`[data-section="${section}"]`)
      .classList.add("active");

    // Hide all content sections
    document.querySelectorAll(".content-section").forEach((sec) => {
      sec.classList.remove("active");
    });

    // Show selected section
    document.getElementById(`${section}-section`).classList.add("active");

    // Update page title
    const titles = {
      main: "Main Page Management",
      about: "About Page Management",
      products: "Products Management",
      certifications: "Certifications Management",
      "latest-work": "Latest Work Management",
      blogs: "Blogs Management",
      settings: "Site Settings",
    };
    document.getElementById("page-title").textContent = titles[section];

    this.currentSection = section;

    // Section-specific initialization
    if (section === "products") {
      this.generateProductsGrid();
      // Hide Save All button in products section
      const saveAllBtn = document.getElementById("saveAllBtn");
      if (saveAllBtn) {
        saveAllBtn.style.display = "none";
      }
    } else if (section === "certifications") {
      this.generateCertificationsGrid();
      this.setupCertificationEventListeners();
      // Hide Save All button in certifications section
      const saveAllBtn = document.getElementById("saveAllBtn");
      if (saveAllBtn) {
        saveAllBtn.style.display = "none";
      }
    } else if (section === "latest-work") {
      this.generateLatestWorkGrid();
      this.setupLatestWorkEventListeners(); // New: Setup listeners here
      // Hide Save All button in latest work section
      const saveAllBtn = document.getElementById("saveAllBtn");
      if (saveAllBtn) {
        saveAllBtn.style.display = "none";
      }
    } else if (section === "blogs") {
      this.generateBlogsGrid();
      this.setupBlogEventListeners(); // New: Setup listeners here
      // Hide Save All button in blogs section
      const saveAllBtn = document.getElementById("saveAllBtn");
      if (saveAllBtn) {
        saveAllBtn.style.display = "none";
      }
    } else if (section === "main") {
      // Show Save All button in main section
      const saveAllBtn = document.getElementById("saveAllBtn");
      if (saveAllBtn) {
        saveAllBtn.style.display = "inline-flex";
      }
    } else if (section === "about") {
      // Show Save All button in about section
      const saveAllBtn = document.getElementById("saveAllBtn");
      if (saveAllBtn) {
        saveAllBtn.style.display = "inline-flex";
      }
    } else {
      // Hide Save All button in other sections (settings)
      const saveAllBtn = document.getElementById("saveAllBtn");
      if (saveAllBtn) {
        saveAllBtn.style.display = "none";
      }
    }
  }

  setupCertificationEventListeners() {
    // Only set up if not already set up
    const addCertBtn = document.getElementById("addCertificationBtn");
    if (addCertBtn && !addCertBtn.hasAttribute("data-listener-setup")) {
      addCertBtn.setAttribute("data-listener-setup", "true");
      addCertBtn.addEventListener("click", (e) => {
        e.preventDefault();
        this.showCertificationModal();
      });
    }

    // Set up form event listener
    const form = document.getElementById("certificationForm");
    if (form && !form.hasAttribute("data-listener-setup")) {
      form.setAttribute("data-listener-setup", "true");
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        this.saveCertification();
      });
    }
  }

  setupLatestWorkEventListeners() {
    // Only set up if not already set up
    const addWorkBtn = document.getElementById("addLatestWorkBtn");
    if (addWorkBtn && !addWorkBtn.hasAttribute("data-listener-setup")) {
      addWorkBtn.setAttribute("data-listener-setup", "true");
      addWorkBtn.addEventListener("click", (e) => {
        e.preventDefault();
        this.showLatestWorkModal();
      });
    }

    // Set up form event listener
    const form = document.getElementById("latestWorkForm");
    if (form && !form.hasAttribute("data-listener-setup")) {
      form.setAttribute("data-listener-setup", "true");
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        this.saveLatestWork();
      });
    }

    // Set up modal close event listeners
    const closeBtn = document.getElementById("closeLatestWorkModal");
    if (closeBtn && !closeBtn.hasAttribute("data-listener-setup")) {
      closeBtn.setAttribute("data-listener-setup", "true");
      closeBtn.addEventListener("click", () => {
        this.hideLatestWorkModal();
      });
    }

    const cancelBtn = document.getElementById("cancelLatestWork");
    if (cancelBtn && !cancelBtn.hasAttribute("data-listener-setup")) {
      cancelBtn.setAttribute("data-listener-setup", "true");
      cancelBtn.addEventListener("click", () => {
        this.hideLatestWorkModal();
      });
    }

    // Modal backdrop click
    const modal = document.getElementById("latestWorkModal");
    if (modal && !modal.hasAttribute("data-listener-setup")) {
      modal.setAttribute("data-listener-setup", "true");
      modal.addEventListener("click", (e) => {
        if (e.target.id === "latestWorkModal") {
          this.hideLatestWorkModal();
        }
      });
    }
  }

  setupBlogEventListeners() {
    // Only set up if not already set up
    const addBlogBtn = document.getElementById("addBlogBtn");
    if (addBlogBtn && !addBlogBtn.hasAttribute("data-listener-setup")) {
      addBlogBtn.setAttribute("data-listener-setup", "true");
      addBlogBtn.addEventListener("click", (e) => {
        e.preventDefault();
        this.showBlogModal();
      });
    }

    // Set up form event listener
    const form = document.getElementById("blogForm");
    if (form && !form.hasAttribute("data-listener-setup")) {
      form.setAttribute("data-listener-setup", "true");
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        this.saveBlog();
      });
    }

    // Set up modal close event listeners
    const closeBtn = document.getElementById("closeBlogModal");
    if (closeBtn && !closeBtn.hasAttribute("data-listener-setup")) {
      closeBtn.setAttribute("data-listener-setup", "true");
      closeBtn.addEventListener("click", () => {
        this.hideBlogModal();
      });
    }

    const cancelBtn = document.getElementById("cancelBlog");
    if (cancelBtn && !cancelBtn.hasAttribute("data-listener-setup")) {
      cancelBtn.setAttribute("data-listener-setup", "true");
      cancelBtn.addEventListener("click", () => {
        this.hideBlogModal();
      });
    }

    // Modal backdrop click
    const modal = document.getElementById("blogModal");
    if (modal && !modal.hasAttribute("data-listener-setup")) {
      modal.setAttribute("data-listener-setup", "true");
      modal.addEventListener("click", (e) => {
        if (e.target.id === "blogModal") {
          this.hideBlogModal();
        }
      });
    }
  }

  async loadInitialData() {
    try {
      // Load data from backend
      await this.loadFromBackend();

      // Fallback to localStorage if backend fails
      const savedData = this.getSavedData();
      if (savedData) {
        this.populateFormsWithData(savedData);
      }

      // Load PHP configuration if available
      this.loadPHPData();
    } catch (error) {
      console.error("Failed to load initial data:", error);
      this.showToast(
        "Failed to load data from server. Using local storage.",
        "warning"
      );

      // Fallback to localStorage
      const savedData = this.getSavedData();
      if (savedData) {
        this.populateFormsWithData(savedData);
      }
    }
  }

  getSavedData() {
    const savedData = localStorage.getItem("adminData");
    return savedData ? JSON.parse(savedData) : null;
  }

  populateFormsWithData(data) {
    // Populate hero section
    if (data.hero) {
      document.getElementById("heroTitle").value = data.hero.title || "";
      document.getElementById("heroDescription").value =
        data.hero.description || "";
      document.getElementById("heroButton1").value = data.hero.button1 || "";
      document.getElementById("heroButton2").value = data.hero.button2 || "";
    }

    // Populate company information
    if (data.company) {
      document.getElementById("companyName").value = data.company.name || "";
      document.getElementById("certification").value =
        data.company.certification || "";
      document.getElementById("welcomeTitle").value =
        data.company.welcomeTitle || "";
    }

    // Populate about content
    if (data.about && data.about.content) {
      document.getElementById("aboutContentEditor").innerHTML =
        data.about.content;
    }
  }

  getDefaultProducts() {
    return [
      {
        id: 1,
        name: "Multi-Play Structures",
        category: "playground",
        description:
          "Comprehensive play systems that combine multiple activities in one exciting structure, perfect for parks and schools.",
        features: [
          "Multiple climbing options",
          "Integrated slides",
          "Safety railings",
          "Age-appropriate design",
        ],
        minPrice: 250000,
        maxPrice: 800000,
        badge: "Popular",
      },
      {
        id: 2,
        name: "Spring Riders",
        category: "playground",
        description:
          "Fun and safe spring-mounted riding toys that provide hours of entertainment for young children.",
        features: [
          "Colorful animal designs",
          "Durable spring mechanism",
          "Non-slip handles",
          "Weather resistant",
        ],
        minPrice: 15000,
        maxPrice: 35000,
      },
      {
        id: 3,
        name: "Cardio Stations",
        category: "outdoor",
        description:
          "Professional outdoor cardiovascular equipment designed to withstand all weather conditions.",
        features: [
          "Elliptical trainers",
          "Exercise bikes",
          "Rowing machines",
          "Galvanized steel frame",
        ],
        minPrice: 45000,
        maxPrice: 150000,
        badge: "New",
      },
    ];
  }

  async generateProductsGrid() {
    const grid = document.getElementById("productsGrid");
    if (!grid) {
      console.error("Products grid element not found!");
      return;
    }

    grid.innerHTML = '<div class="loading-spinner">Loading products...</div>';

    try {
      await this.loadProductsFromBackend();
      grid.innerHTML = "";

      this.products.forEach((product) => {
        const productElement = this.createProductElement(product);
        grid.appendChild(productElement);
      });
    } catch (error) {
      grid.innerHTML =
        '<div class="error-message">Failed to load products</div>';
      console.error("Failed to load products:", error);
    }
  }

  createProductElement(product) {
    const div = document.createElement("div");
    div.className = "product-card-modern group";
    div.setAttribute("data-category", product.category);

    // Format features array
    const features = Array.isArray(product.features) ? product.features : [];
    const featuresHtml = features
      .map(
        (feature) =>
          `<div class="product-feature-item">
        <div class="feature-bullet"></div>
        <span class="feature-text">${feature}</span>
      </div>`
      )
      .join("");

    div.innerHTML = `
      <!-- Product Image Section -->
      <div class="product-image-modern">
        ${
          product.image_url
            ? `<img src="${product.image_url}" alt="${product.name}" class="product-img-modern" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />`
            : ""
        }
        <div class="product-placeholder-modern" style="${
          product.image_url ? "display: none;" : ""
        }">
          <i class="product-icon-modern">🏗️</i>
        </div>
        
        <!-- Gradient Overlay -->
        <div class="product-gradient-overlay"></div>
        
        ${
          product.badge
            ? `<div class="product-badge-modern">${product.badge}</div>`
            : ""
        }
      </div>

      <!-- Product Content -->
      <div class="product-content-modern">
        <h3 class="product-title-modern">${product.name}</h3>
        <p class="product-description-modern">${
          product.description || "No description available"
        }</p>

        ${
          featuresHtml
            ? `
          <div class="product-features-modern">
            ${featuresHtml}
          </div>
        `
            : ""
        }


        <!-- Delete Button -->
        <div class="product-button-container">
          <button class="product-btn-modern product-btn-delete" onclick="adminPanel.deleteProduct(${
            product.id
          })">
            <i class="fas fa-trash"></i> Delete
          </button>
        </div>
      </div>
    `;
    return div;
  }

  getCategoryDisplay(category) {
    const categories = {
      playground: "Playground Equipment",
      outdoor: "Outdoor Gym",
      indoor: "Indoor Solutions",
    };
    return categories[category] || category;
  }

  formatPrice(price) {
    return new Intl.NumberFormat("en-IN").format(price);
  }

  showProductModal(product = null) {
    const modal = document.getElementById("productModal");
    const form = document.getElementById("productForm");
    const title = document.getElementById("modalTitle");

    if (product) {
      title.textContent = "Edit Product";
      this.currentEditingProduct = product;
      this.populateProductForm(product);
    } else {
      title.textContent = "Add New Product";
      this.currentEditingProduct = null;
      form.reset();
    }

    modal.classList.add("show");
    document.body.style.overflow = "hidden";

    // Focus first input
    setTimeout(() => {
      document.getElementById("productName").focus();
    }, 100);
  }

  hideProductModal() {
    const modal = document.getElementById("productModal");
    modal.classList.remove("show");
    document.body.style.overflow = "";
    this.currentEditingProduct = null;
  }

  populateProductForm(product) {
    document.getElementById("productName").value = product.name;
    document.getElementById("productCategory").value = product.category;
    document.getElementById("productDescription").value = product.description;
    document.getElementById("productFeatures").value =
      product.features.join("\n");
    document.getElementById("productMinPrice").value = product.minPrice;
    document.getElementById("productMaxPrice").value = product.maxPrice;
  }

  async handleProductSubmit(e) {
    e.preventDefault();

    const formData = new FormData(e.target);
    const productData = {
      name: formData.get("productName").trim(),
      category: formData.get("productCategory"),
      description: formData.get("productDescription").trim(),
      features: formData
        .get("productFeatures")
        .split("\n")
        .map((f) => f.trim())
        .filter((f) => f),
      min_price: parseFloat(formData.get("productMinPrice")) || 0,
      max_price: parseFloat(formData.get("productMaxPrice")) || 0,
    };

    // Handle image upload
    const imageFile = formData.get("productImage");
    if (imageFile && imageFile.size > 0) {
      try {
        const uploadResult = await this.uploadFileToServer(imageFile);
        if (uploadResult.success) {
          productData.image_url = uploadResult.file_path;
          productData.image_class = `${productData.category}-bg`; // Set image class based on category
        } else {
          this.showToast("Failed to upload image", "error");
          return;
        }
      } catch (error) {
        this.showToast("Failed to upload image: " + error.message, "error");
        return;
      }
    }

    // Validation
    if (!this.validateProductData(productData)) {
      return;
    }

    try {
      // Debug: Log the product data being sent
      console.log("Product data being sent:", productData);

      if (this.currentEditingProduct) {
        // Update existing product
        productData.id = this.currentEditingProduct.id;
        await this.apiRequest("update_product", productData, "POST");
        this.showToast("Product updated successfully!", "success");
      } else {
        // Add new product
        await this.apiRequest("add_product", productData, "POST");
        this.showToast("Product added successfully!", "success");
      }

      // Refresh products grid
      await this.generateProductsGrid();

      // Hide modal and reset form
      this.hideProductModal();
      this.resetProductForm();
    } catch (error) {
      this.showToast("Failed to save product: " + error.message, "error");
      console.error("Product save error:", error);
    }
  }

  validateProductData(data) {
    const errors = [];

    if (!data.name) errors.push("Product name is required");
    if (!data.category) errors.push("Category is required");
    if (!data.description) errors.push("Description is required");
    if (data.min_price < 0) errors.push("Minimum price must be positive");
    if (data.max_price < 0) errors.push("Maximum price must be positive");
    if (data.min_price > data.max_price)
      errors.push("Minimum price cannot be greater than maximum price");

    if (errors.length > 0) {
      this.showToast(errors.join("<br>"), "error");
      return false;
    }

    return true;
  }

  resetProductForm() {
    document.getElementById("productForm").reset();
    const placeholder = document
      .querySelector("#productImage")
      .parentElement.querySelector(".file-upload-placeholder");
    if (placeholder) {
      placeholder.innerHTML = `
        <i class="fas fa-image"></i>
        <p>Upload product image</p>
      `;
    }
    this.currentEditingProduct = null;
  }

  editProduct(id) {
    const product = this.products.find((p) => p.id === id);
    if (product) {
      this.showProductModal(product);
    }
  }

  async deleteProduct(id) {
    const product = this.products.find((p) => p.id === id);
    if (!product) return;

    this.showConfirmModal(
      `Are you sure you want to delete "${product.name}"?`,
      async () => {
        try {
          await this.apiRequest("delete_product", { id: id }, "POST");
          await this.generateProductsGrid();
          this.showToast("Product deleted successfully!", "success");
        } catch (error) {
          this.showToast("Failed to delete product: " + error.message, "error");
          console.error("Product delete error:", error);
        }
      }
    );
  }

  initializeFileUploads() {
    document.querySelectorAll(".file-upload-area").forEach((area) => {
      const input = area.querySelector('input[type="file"]');
      const placeholder = area.querySelector(".file-upload-placeholder");

      area.addEventListener("dragover", (e) => {
        e.preventDefault();
        area.classList.add("dragover");
      });

      area.addEventListener("dragleave", () => {
        area.classList.remove("dragover");
      });

      area.addEventListener("drop", (e) => {
        e.preventDefault();
        area.classList.remove("dragover");
        const files = e.dataTransfer.files;
        if (files.length > 0) {
          input.files = files;
          this.handleFileUpload(input, files[0]);
        }
      });

      input.addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
          this.handleFileUpload(input, e.target.files[0]);
        }
      });
    });
  }

  handleFileUpload(input, file) {
    if (!file.type.startsWith("image/")) {
      this.showToast("Please select a valid image file", "error");
      return;
    }

    if (file.size > 5 * 1024 * 1024) {
      // 5MB limit
      this.showToast("File size must be less than 5MB", "error");
      return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
      const placeholder = input.parentElement.querySelector(
        ".file-upload-placeholder"
      );
      placeholder.innerHTML = `
                <i class="fas fa-check-circle" style="color: #10b981;"></i>
                <p style="color: #10b981; margin: 0.5rem 0 0 0; font-weight: 600;">${file.name} uploaded</p>
                <button type="button" class="btn btn-sm btn-secondary" style="margin-top: 0.5rem;" onclick="this.closest('.file-upload-area').querySelector('input').value=''; this.closest('.file-upload-placeholder').innerHTML='<i class=&quot;fas fa-cloud-upload-alt&quot;></i><p>Drag and drop image here or click to browse</p>';">Remove</button>
            `;
    };
    reader.readAsDataURL(file);
  }

  async uploadFileToServer(file) {
    if (!file.type.startsWith("image/")) {
      throw new Error("Please select a valid image file");
    }

    if (file.size > 5 * 1024 * 1024) {
      throw new Error("File size must be less than 5MB");
    }

    const formData = new FormData();
    formData.append("file", file);
    formData.append("action", "upload_file");
    formData.append("context", "product"); // Add context for file categorization

    console.log(
      "Uploading file:",
      file.name,
      "Size:",
      file.size,
      "Type:",
      file.type
    );

    const response = await fetch(this.apiBase, {
      method: "POST",
      body: formData,
    });

    console.log("Upload response status:", response.status);

    if (!response.ok) {
      const errorText = await response.text();
      console.error("Upload error response:", errorText);
      throw new Error(
        `Upload failed with status ${response.status}: ${errorText}`
      );
    }

    const result = await response.json();
    console.log("Upload response:", result);

    if (result.status === 200 && result.data) {
      return {
        success: true,
        file_path: result.data.file_path,
      };
    } else {
      throw new Error(result.message || "Upload failed");
    }
  }

  initializeContentEditor() {
    const toolbarButtons = document.querySelectorAll(".toolbar-btn");
    const editor = document.getElementById("aboutContentEditor");

    toolbarButtons.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const command = btn.getAttribute("data-command");
        document.execCommand(command, false, null);
        editor.focus();
      });
    });

    editor.addEventListener("input", () => {
      this.debounce(() => {
        this.autoSave();
      }, 1000)();
    });
  }

  setupFormValidation() {
    const requiredFields = document.querySelectorAll(
      "input[required], textarea[required], select[required]"
    );

    requiredFields.forEach((field) => {
      field.addEventListener("blur", () => {
        this.validateField(field);
      });

      field.addEventListener("input", () => {
        this.clearFieldError(field);
      });
    });
  }

  validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name || field.id;

    if (field.hasAttribute("required") && !value) {
      this.showFieldError(
        field,
        `${this.getFieldLabel(fieldName)} is required`
      );
      return false;
    }

    if (field.type === "email" && value && !this.isValidEmail(value)) {
      this.showFieldError(field, "Please enter a valid email address");
      return false;
    }

    if (field.type === "tel" && value && !this.isValidPhone(value)) {
      this.showFieldError(field, "Please enter a valid phone number");
      return false;
    }

    if (field.type === "number" && value && parseInt(value) < 0) {
      this.showFieldError(field, "Please enter a positive number");
      return false;
    }

    this.clearFieldError(field);
    return true;
  }

  showFieldError(field, message) {
    this.clearFieldError(field);

    field.style.borderColor = "#ef4444";
    const errorDiv = document.createElement("div");
    errorDiv.className = "field-error";
    errorDiv.style.cssText =
      "color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;";
    errorDiv.textContent = message;

    field.parentElement.appendChild(errorDiv);
  }

  clearFieldError(field) {
    field.style.borderColor = "";
    const errorDiv = field.parentElement.querySelector(".field-error");
    if (errorDiv) {
      errorDiv.remove();
    }
  }

  getFieldLabel(fieldName) {
    const labels = {
      heroTitle: "Hero Title",
      heroDescription: "Hero Description",
      productName: "Product Name",
      productCategory: "Category",
      productDescription: "Description",
      companyName: "Company Name",
      welcomeTitle: "Welcome Title",
    };
    return labels[fieldName] || fieldName;
  }

  isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  isValidPhone(phone) {
    return (
      /^[\+]?[0-9\s\-\(\)]+$/.test(phone) &&
      phone.replace(/\D/g, "").length >= 10
    );
  }

  setupAutoSave() {
    const forms = document.querySelectorAll(".admin-form");
    forms.forEach((form) => {
      const inputs = form.querySelectorAll("input, textarea, select");
      inputs.forEach((input) => {
        input.addEventListener(
          "input",
          this.debounce(() => {
            this.autoSave();
          }, 2000)
        );
      });
    });
  }

  autoSave() {
    const data = this.collectAllFormData();
    localStorage.setItem("adminData", JSON.stringify(data));
    this.showAutoSaveIndicator();
  }

  showAutoSaveIndicator() {
    const indicator = document.createElement("div");
    indicator.className = "autosave-indicator";
    indicator.innerHTML = '<i class="fas fa-check"></i> Auto-saved';
    indicator.style.cssText = `
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: #10b981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            z-index: 3000;
            animation: fadeInOut 2s ease-in-out;
        `;

    document.body.appendChild(indicator);

    setTimeout(() => {
      indicator.remove();
    }, 2000);
  }

  collectAllFormData() {
    return {
      hero: {
        title: document.getElementById("heroTitle").value,
        description: document.getElementById("heroDescription").value,
        button1: document.getElementById("heroButton1").value,
        button2: document.getElementById("heroButton2").value,
      },
      company: {
        name: document.getElementById("companyName").value,
        certification: document.getElementById("certification").value,
        welcomeTitle: document.getElementById("welcomeTitle").value,
      },
      about: {
        content: document.getElementById("aboutContentEditor").innerHTML,
      },
      site: {
        name: document.getElementById("siteName").value,
        description: document.getElementById("siteDescription").value,
        contactEmail: document.getElementById("contactEmail").value,
        contactPhone: document.getElementById("contactPhone").value,
      },
    };
  }

  async saveAllChanges() {
    try {
      const data = this.collectAllFormData();

      // Validate all forms
      let isValid = true;
      const requiredFields = document.querySelectorAll(
        "input[required], textarea[required], select[required]"
      );

      requiredFields.forEach((field) => {
        if (!this.validateField(field)) {
          isValid = false;
        }
      });

      if (!isValid) {
        this.showToast("Please fix the errors before saving", "error");
        return;
      }

      // Save to backend
      await this.saveToBackend(data);

      // Also save locally as backup
      localStorage.setItem("adminData", JSON.stringify(data));

      // Show success message
      this.showToast("All changes saved successfully!", "success");
    } catch (error) {
      this.showToast("Failed to save changes: " + error.message, "error");
      console.error("Save error:", error);
    }
  }

  handleLogout() {
    this.showConfirmModal(
      "Are you sure you want to logout? Any unsaved changes will be lost.",
      () => {
        // In a real implementation, you would clear session and redirect
        this.showToast("Logging out...", "info");
        setTimeout(() => {
          // Redirect to home page (now PHP)
          window.location.href = "index.php";
        }, 1500);
      }
    );
  }

  handleKeyboardShortcuts(e) {
    // Ctrl/Cmd + S to save
    if ((e.ctrlKey || e.metaKey) && e.key === "s") {
      e.preventDefault();
      this.saveAllChanges();
    }

    // Escape to close modals
    if (e.key === "Escape") {
      const modal = document.querySelector(".modal.show");
      if (modal) {
        modal.classList.remove("show");
      }
    }
  }

  initializeConfirmModal() {
    const modal = document.getElementById("confirmModal");
    const cancelBtn = document.getElementById("confirmCancel");
    const yesBtn = document.getElementById("confirmYes");

    cancelBtn.addEventListener("click", () => {
      modal.classList.remove("show");
    });

    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.classList.remove("show");
      }
    });
  }

  showConfirmModal(message, onConfirm) {
    const modal = document.getElementById("confirmModal");
    const messageElement = document.getElementById("confirmMessage");
    const yesBtn = document.getElementById("confirmYes");

    messageElement.textContent = message;

    // Remove previous event listeners
    const newYesBtn = yesBtn.cloneNode(true);
    yesBtn.parentNode.replaceChild(newYesBtn, yesBtn);

    newYesBtn.addEventListener("click", () => {
      modal.classList.remove("show");
      onConfirm();
    });

    modal.classList.add("show");
  }

  showToast(message, type = "info") {
    const container = document.getElementById("toastContainer");
    const toast = document.createElement("div");

    const icons = {
      success: "fas fa-check-circle",
      error: "fas fa-exclamation-circle",
      warning: "fas fa-exclamation-triangle",
      info: "fas fa-info-circle",
    };

    toast.className = `toast ${type}`;
    toast.innerHTML = `
            <i class="toast-icon ${icons[type]}"></i>
            <div class="toast-message">${message}</div>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;

    container.appendChild(toast);

    // Show toast
    setTimeout(() => {
      toast.classList.add("show");
    }, 100);

    // Auto remove after 5 seconds
    setTimeout(() => {
      if (toast.parentElement) {
        toast.classList.remove("show");
        setTimeout(() => {
          toast.remove();
        }, 300);
      }
    }, 5000);
  }

  showWelcomeMessage() {
    const siteName = window.SITE_CONFIG
      ? window.SITE_CONFIG.siteName
      : "Mena Play World";
    setTimeout(() => {
      this.showToast(`Welcome to ${siteName} Admin Panel!`, "success");
    }, 500);
  }

  debounce(func, wait) {
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
}

// Add CSS animations
const style = document.createElement("style");
style.textContent = `
    @keyframes fadeInOut {
        0% { opacity: 0; transform: translateY(20px); }
        20%, 80% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(-20px); }
    }

    .dragover {
        background-color: #f3f0ff !important;
        border-color: #8b5cf6 !important;
    }

    .field-error {
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
`;
document.head.appendChild(style);

// Initialize admin panel when DOM is loaded
let adminPanel;
document.addEventListener("DOMContentLoaded", () => {
  adminPanel = new AdminPanel();
});

// Export for global access
window.adminPanel = adminPanel;

// Add PHP integration methods to AdminPanel prototype
AdminPanel.prototype.initializePHPIntegration = function () {
  // Load PHP configuration data
  if (window.SITE_CONFIG) {
    document.getElementById("siteName").value =
      window.SITE_CONFIG.siteName || "";
    document.getElementById("contactEmail").value =
      window.SITE_CONFIG.contactEmail || "";
    document.getElementById("contactPhone").value =
      window.SITE_CONFIG.contactPhone || "";
    document.getElementById("companyName").value =
      window.SITE_CONFIG.companyName || "";
  }
};

AdminPanel.prototype.loadPHPConfiguration = function () {
  // Sync with PHP navigation items if available
  if (window.navigationItems) {
    this.syncNavigationItems(window.navigationItems);
  }
};

AdminPanel.prototype.loadPHPData = function () {
  // Load any PHP-specific data that might be needed
  console.log("Loading PHP configuration data...");

  // Update form fields with PHP constants
  if (window.SITE_CONFIG) {
    const siteName = window.SITE_CONFIG.siteName;
    const welcomeTitle = document.getElementById("welcomeTitle");
    if (welcomeTitle && !welcomeTitle.value) {
      welcomeTitle.value = `Welcome to ${siteName}`;
    }

    // Update about content with site name
    const aboutEditor = document.getElementById("aboutContentEditor");
    if (aboutEditor) {
      let content = aboutEditor.innerHTML;
      content = content.replace(/Mema Play World/g, siteName);
      aboutEditor.innerHTML = content;
    }
  }
};

AdminPanel.prototype.syncNavigationItems = function (navItems) {
  console.log("Syncing navigation items with PHP configuration:", navItems);
  // This method can be expanded to sync navigation items
};

// API Helper Methods
AdminPanel.prototype.apiRequest = async function (
  action,
  data = null,
  method = "GET"
) {
  const url = `${this.apiBase}?action=${action}`;
  const options = {
    method: method,
    headers: {
      "Content-Type": "application/json",
    },
  };

  if (data && method !== "GET") {
    options.body = JSON.stringify(data);
    console.log("=== API REQUEST DEBUG ===");
    console.log("URL:", url);
    console.log("Method:", method);
    console.log("Data being sent:", data);
    console.log("JSON body:", options.body);
    console.log("=== END API REQUEST DEBUG ===");
  }

  try {
    const response = await fetch(url, options);
    const result = await response.json();

    if (!response.ok) {
      throw new Error(result.message || "API request failed");
    }

    return result;
  } catch (error) {
    console.error("API Error:", error);
    throw error;
  }
};

// Backend Integration Methods
AdminPanel.prototype.loadFromBackend = async function () {
  try {
    // Load hero section
    const heroData = await this.apiRequest("get_hero");
    if (heroData && heroData.data) {
      const heroTitle = document.getElementById("heroTitle");
      const heroDescription = document.getElementById("heroDescription");
      const heroButton1 = document.getElementById("heroButton1");
      const heroButton2 = document.getElementById("heroButton2");

      if (heroTitle) heroTitle.value = heroData.data.title || "";
      if (heroDescription)
        heroDescription.value = heroData.data.description || "";
      if (heroButton1) heroButton1.value = heroData.data.button1_text || "";
      if (heroButton2) heroButton2.value = heroData.data.button2_text || "";
    }

    // Load company info
    const companyData = await this.apiRequest("get_company");
    if (companyData.data) {
      document.getElementById("companyName").value =
        companyData.data.company_name || "";
      document.getElementById("certification").value =
        companyData.data.certification || "";
      document.getElementById("welcomeTitle").value =
        companyData.data.welcome_title || "";
    }

    // Load site settings
    const settingsData = await this.apiRequest("get_settings");
    if (settingsData.data) {
      document.getElementById("siteName").value =
        settingsData.data.site_name?.value || "";
      document.getElementById("contactEmail").value =
        settingsData.data.contact_email?.value || "";
      document.getElementById("contactPhone").value =
        settingsData.data.contact_phone?.value || "";
    }

    // Load statistics
    const statsData = await this.apiRequest("get_statistics");
    if (statsData.data) {
      // Populate statistics forms
      const statsGrid = document.querySelector(".stats-grid");
      if (statsGrid) {
        statsData.data.forEach((stat, index) => {
          const inputs = statsGrid.querySelectorAll(".stat-item");
          if (inputs[index]) {
            const valueInput = inputs[index].querySelector(
              'input[name*="Value"]'
            );
            const labelInput = inputs[index].querySelector(
              'input[name*="Label"]'
            );
            if (valueInput) valueInput.value = stat.stat_value;
            if (labelInput) labelInput.value = stat.stat_label;
          }
        });
      }
    }
  } catch (error) {
    console.error("Failed to load from backend:", error);
    throw error;
  }
};

AdminPanel.prototype.saveToBackend = async function (data) {
  try {
    // Save hero section
    if (data.hero) {
      await this.apiRequest(
        "save_hero",
        {
          title: data.hero.title,
          description: data.hero.description,
          button1_text: data.hero.button1,
          button2_text: data.hero.button2,
        },
        "POST"
      );
    }

    // Save company info
    if (data.company) {
      await this.apiRequest(
        "save_company",
        {
          company_name: data.company.name,
          certification: data.company.certification,
          welcome_title: data.company.welcomeTitle,
        },
        "POST"
      );
    }

    // Save site settings
    if (data.site) {
      await this.apiRequest(
        "save_settings",
        {
          settings: {
            site_name: { value: data.site.name, type: "text" },
            contact_email: { value: data.site.contactEmail, type: "email" },
            contact_phone: { value: data.site.contactPhone, type: "phone" },
            site_description: {
              value: data.site.description,
              type: "textarea",
            },
          },
        },
        "POST"
      );
    }

    return true;
  } catch (error) {
    console.error("Failed to save to backend:", error);
    throw error;
  }
};

AdminPanel.prototype.loadProductsFromBackend = async function () {
  try {
    const response = await this.apiRequest("get_products");
    if (response.data) {
      this.products = response.data;
    }
  } catch (error) {
    console.error("Failed to load products from backend:", error);
    throw error;
  }
};

AdminPanel.prototype.loadCertificationsFromBackend = async function () {
  try {
    const response = await this.apiRequest("get_certifications");
    if (response.data) {
      this.certifications = response.data;
    }
  } catch (error) {
    console.error("Failed to load certifications from backend:", error);
    throw error;
  }
};

AdminPanel.prototype.loadLatestWorkFromBackend = async function () {
  try {
    const response = await this.apiRequest("get_latest_work");
    if (response.data) {
      this.latestWork = response.data;
    }
  } catch (error) {
    console.error("Failed to load latest work from backend:", error);
    throw error;
  }
};

AdminPanel.prototype.loadBlogsFromBackend = async function () {
  try {
    const response = await this.apiRequest("get_blogs");
    if (response.data) {
      this.blogs = response.data;
    }
  } catch (error) {
    console.error("Failed to load blogs from backend:", error);
    throw error;
  }
};

// ===== CERTIFICATIONS MANAGEMENT =====

AdminPanel.prototype.generateCertificationsGrid = async function () {
  const grid = document.getElementById("certificationsGrid");
  if (!grid) {
    console.error("Certifications grid element not found!");
    return;
  }

  try {
    await this.loadCertificationsFromBackend();
    grid.innerHTML = "";

    console.log(
      `Loading ${this.certifications.length} certifications into grid`
    );

    this.certifications.forEach((certification) => {
      const certificationElement =
        this.createCertificationElement(certification);
      grid.appendChild(certificationElement);
    });

    // Force grid layout
    grid.style.display = "grid";
    grid.style.gridTemplateColumns = "repeat(3, 1fr)";
    grid.style.gap = "2rem";
    grid.style.width = "100%";
    grid.style.maxWidth = "100%";

    console.log("Certifications grid generated successfully");
    console.log("Grid element:", grid);
    console.log("Grid computed style:", window.getComputedStyle(grid).display);
    console.log(
      "Grid template columns:",
      window.getComputedStyle(grid).gridTemplateColumns
    );
  } catch (error) {
    grid.innerHTML =
      '<div class="error-message">Failed to load certifications</div>';
    console.error("Failed to load certifications:", error);
  }
};

AdminPanel.prototype.createCertificationElement = function (certification) {
  const div = document.createElement("div");
  div.className = "product-card-modern group";
  div.setAttribute("data-category", "certification");

  div.innerHTML = `
    <!-- Certification Image Section -->
    <div class="product-image-modern">
      ${
        certification.image_path
          ? `<img src="${certification.image_path}" alt="${certification.title}" class="product-img-modern" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />`
          : ""
      }
      <div class="product-placeholder-modern" style="${
        certification.image_path ? "display: none;" : ""
      }">
        <i class="product-icon-modern">🏆</i>
      </div>
      
      <!-- Gradient Overlay -->
      <div class="product-gradient-overlay"></div>
      
      ${
        certification.is_active
          ? `<div class="product-badge-modern">Active</div>`
          : ""
      }
    </div>

    <!-- Certification Content -->
    <div class="product-content-modern">
      <h3 class="product-title-modern">${certification.title}</h3>
      <p class="product-description-modern">${
        certification.description || "No description available"
      }</p>

      <div class="product-features-modern">
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Sort Order: ${
            certification.sort_order || 0
          }</span>
        </div>
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Status: ${
            certification.is_active ? "Active" : "Inactive"
          }</span>
        </div>
      </div>

      <!-- Delete Button Only -->
      <div class="product-button-container">
        <button class="product-btn-modern product-btn-delete" onclick="adminPanel.deleteCertification(${
          certification.id
        })">
          <i class="fas fa-trash"></i> Delete
        </button>
      </div>
    </div>
  `;
  return div;
};

AdminPanel.prototype.showCertificationModal = function (certification = null) {
  console.log("showCertificationModal called");
  this.currentEditingCertification = certification;
  const modal = document.getElementById("certificationModal");
  const modalTitle = document.getElementById("certificationModalTitle");
  const form = document.getElementById("certificationForm");

  console.log("Modal element:", modal);
  console.log("Modal title element:", modalTitle);
  console.log("Form element:", form);

  if (!modal) {
    console.error("Certification modal not found!");
    return;
  }

  if (certification) {
    // Edit mode
    modalTitle.textContent = "Edit Certification";
    document.getElementById("certificationTitle").value = certification.title;
    document.getElementById("certificationDescription").value =
      certification.description;
  } else {
    // Add mode
    modalTitle.textContent = "Add New Certification";
    // Clear form fields manually instead of reset()
    if (document.getElementById("certificationTitle")) {
      document.getElementById("certificationTitle").value = "";
    }
    if (document.getElementById("certificationDescription")) {
      document.getElementById("certificationDescription").value = "";
    }
    if (document.getElementById("certificationImage")) {
      document.getElementById("certificationImage").value = "";
    }
  }

  console.log("Adding show class to modal");
  modal.classList.add("show");
  document.body.style.overflow = "hidden";
  console.log("Modal should now be visible");

  // Ensure form is properly initialized after modal is shown
  setTimeout(() => {
    console.log("Form initialization complete");
  }, 100);
};

AdminPanel.prototype.hideCertificationModal = function () {
  const modal = document.getElementById("certificationModal");
  modal.classList.remove("show");
  document.body.style.overflow = "auto";
};

AdminPanel.prototype.editCertification = function (id) {
  const certification = this.certifications.find((c) => c.id === id);
  if (certification) {
    this.showCertificationModal(certification);
  }
};

AdminPanel.prototype.saveCertification = async function () {
  console.log("=== SAVE CERTIFICATION CALLED ===");

  // Get form elements directly
  const titleInput = document.getElementById("certificationTitle");
  const descriptionInput = document.getElementById("certificationDescription");
  const imageInput = document.getElementById("certificationImage");

  console.log("Form elements found:");
  console.log("Title input:", titleInput);
  console.log("Description input:", descriptionInput);
  console.log("Image input:", imageInput);

  if (!titleInput || !descriptionInput) {
    console.error("Form elements not found");
    alert("Form elements not found");
    return;
  }

  // Get values directly from inputs
  const title = titleInput.value;
  const description = descriptionInput.value;

  console.log("=== FORM VALUES DEBUG ===");
  console.log("Raw title value:", title);
  console.log("Raw description value:", description);
  console.log("Title type:", typeof title);
  console.log("Description type:", typeof description);
  console.log("Title length:", title ? title.length : 0);
  console.log("Description length:", description ? description.length : 0);
  console.log("=== END FORM VALUES DEBUG ===");

  if (!title || title.trim() === "") {
    console.error("Certification title is required");
    alert("Certification title is required");
    return;
  }

  if (!description || description.trim() === "") {
    console.error("Certification description is required");
    alert("Certification description is required");
    return;
  }

  const certificationData = {
    title: title.trim(),
    description: description.trim(),
  };

  console.log("=== FINAL CERTIFICATION DATA ===");
  console.log("Final data object:", certificationData);
  console.log("Data keys:", Object.keys(certificationData));
  console.log("Title in final data:", certificationData.title);
  console.log("Description in final data:", certificationData.description);
  console.log("=== END FINAL DATA ===");

  // Handle image upload
  const imageFile = imageInput ? imageInput.files[0] : null;
  if (imageFile && imageFile.size > 0) {
    try {
      const uploadResponse = await this.uploadFileToServer(imageFile);
      if (uploadResponse.success) {
        certificationData.image_path = uploadResponse.file_path;
      } else {
        console.error("Failed to upload image");
        alert("Failed to upload image");
        return;
      }
    } catch (error) {
      console.error("Failed to upload image: " + error.message);
      alert("Failed to upload image: " + error.message);
      return;
    }
  }

  try {
    console.log("=== API CALL DEBUG ===");
    console.log("About to call API with data:", certificationData);
    console.log("API endpoint: add_certification");
    console.log("=== END API DEBUG ===");

    if (this.currentEditingCertification) {
      // Update existing certification
      certificationData.id = this.currentEditingCertification.id;
      await this.apiRequest("update_certification", certificationData, "POST");
      console.log("Certification updated successfully");
      alert("Certification updated successfully");
    } else {
      // Add new certification
      await this.apiRequest("add_certification", certificationData, "POST");
      console.log("Certification added successfully");
      alert("Certification added successfully");
    }

    this.hideCertificationModal();
    this.generateCertificationsGrid();
  } catch (error) {
    console.error("Failed to save certification:", error);
    alert("Failed to save certification: " + error.message);
  }
};

AdminPanel.prototype.deleteCertification = async function (id) {
  if (confirm("Are you sure you want to delete this certification?")) {
    try {
      await this.apiRequest(`delete_certification&id=${id}`);
      this.generateCertificationsGrid();
      this.showNotification("Certification deleted successfully", "success");
    } catch (error) {
      this.showNotification("Failed to delete certification", "error");
    }
  }
};

// ===== LATEST WORK MANAGEMENT =====

AdminPanel.prototype.generateLatestWorkGrid = async function () {
  const grid = document.getElementById("latestWorkGrid");
  if (!grid) return;

  try {
    await this.loadLatestWorkFromBackend();
    grid.innerHTML = "";

    this.latestWork.forEach((work) => {
      const workElement = this.createLatestWorkElement(work);
      grid.appendChild(workElement);
    });

    // Force grid layout
    grid.style.display = "grid";
    grid.style.gridTemplateColumns = "repeat(3, 1fr)";
    grid.style.gap = "2rem";
    grid.style.width = "100%";
    grid.style.maxWidth = "100%";
  } catch (error) {
    grid.innerHTML =
      '<div class="error-message">Failed to load latest work</div>';
    console.error("Failed to load latest work:", error);
  }
};

AdminPanel.prototype.createLatestWorkElement = function (work) {
  const div = document.createElement("div");
  div.className = "product-card-modern group";
  div.setAttribute("data-category", "latest-work");

  div.innerHTML = `
    <!-- Latest Work Image Section -->
    <div class="product-image-modern">
      ${
        work.image_path
          ? `<img src="${work.image_path}" alt="${work.title}" class="product-img-modern" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />`
          : ""
      }
      <div class="product-placeholder-modern" style="${
        work.image_path ? "display: none;" : ""
      }">
        <i class="product-icon-modern">🏗️</i>
      </div>
      
      <!-- Gradient Overlay -->
      <div class="product-gradient-overlay"></div>
      
      ${work.is_active ? `<div class="product-badge-modern">Active</div>` : ""}
    </div>

    <!-- Latest Work Content -->
    <div class="product-content-modern">
      <h3 class="product-title-modern">${work.title}</h3>
      <p class="product-description-modern">${
        work.description || "No description available"
      }</p>

      <div class="product-features-modern">
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Category: ${
            work.category || "Project"
          }</span>
        </div>
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Location: ${work.location || "N/A"}</span>
        </div>
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Date: ${work.project_date || "N/A"}</span>
        </div>
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Status: ${
            work.is_active ? "Active" : "Inactive"
          }</span>
        </div>
      </div>

      <!-- Delete Button Only -->
      <div class="product-button-container">
        <button class="product-btn-modern product-btn-delete" onclick="adminPanel.deleteLatestWork(${
          work.id
        })">
          <i class="fas fa-trash"></i> Delete
        </button>
      </div>
    </div>
  `;
  return div;
};

AdminPanel.prototype.showLatestWorkModal = function (work = null) {
  this.currentEditingLatestWork = work;
  const modal = document.getElementById("latestWorkModal");
  const modalTitle = document.getElementById("latestWorkModalTitle");
  const form = document.getElementById("latestWorkForm");

  if (!modal) {
    console.error("Latest work modal not found!");
    return;
  }

  if (work) {
    // Edit mode
    modalTitle.textContent = "Edit Project";
    document.getElementById("latestWorkTitle").value = work.title;
    document.getElementById("latestWorkDescription").value = work.description;
    document.getElementById("latestWorkCategory").value = work.category || "";
    document.getElementById("latestWorkLocation").value = work.location || "";
    document.getElementById("latestWorkDate").value = work.project_date || "";
  } else {
    // Add mode
    modalTitle.textContent = "Add New Project";
    form.reset();
  }

  modal.classList.add("show");
  document.body.style.overflow = "hidden";
};

AdminPanel.prototype.hideLatestWorkModal = function () {
  const modal = document.getElementById("latestWorkModal");
  modal.classList.remove("show");
  document.body.style.overflow = "auto";
};

AdminPanel.prototype.saveLatestWork = async function () {
  const form = document.getElementById("latestWorkForm");
  const formData = new FormData(form);

  const workData = {
    title: formData.get("latestWorkTitle").trim(),
    description: formData.get("latestWorkDescription").trim(),
    category: formData.get("latestWorkCategory").trim(),
    location: formData.get("latestWorkLocation").trim(),
    project_date: formData.get("latestWorkDate"),
  };

  // Handle image upload
  const imageFile = formData.get("latestWorkImage");
  if (imageFile && imageFile.size > 0) {
    try {
      const uploadResponse = await this.uploadFileToServer(imageFile);
      if (uploadResponse.success) {
        workData.image_path = uploadResponse.file_path;
      } else {
        this.showNotification("Failed to upload image", "error");
        return;
      }
    } catch (error) {
      this.showNotification(
        "Failed to upload image: " + error.message,
        "error"
      );
      return;
    }
  }

  try {
    if (this.currentEditingLatestWork) {
      // Update existing work
      workData.id = this.currentEditingLatestWork.id;
      await this.apiRequest("update_latest_work", workData);
      this.showNotification("Project updated successfully", "success");
    } else {
      // Add new work
      await this.apiRequest("add_latest_work", workData);
      this.showNotification("Project added successfully", "success");
    }

    this.hideLatestWorkModal();
    this.generateLatestWorkGrid();
  } catch (error) {
    this.showNotification("Failed to save project", "error");
    console.error("Error saving project:", error);
  }
};

AdminPanel.prototype.editLatestWork = function (id) {
  const work = this.latestWork.find((w) => w.id === id);
  if (work) {
    this.showLatestWorkModal(work);
  }
};

AdminPanel.prototype.deleteLatestWork = async function (id) {
  if (confirm("Are you sure you want to delete this project?")) {
    try {
      await this.apiRequest(`delete_latest_work&id=${id}`);
      this.generateLatestWorkGrid();
      this.showNotification("Project deleted successfully", "success");
    } catch (error) {
      this.showNotification("Failed to delete project", "error");
    }
  }
};

// ===== BLOGS MANAGEMENT =====

AdminPanel.prototype.generateBlogsGrid = async function () {
  const grid = document.getElementById("blogsGrid");
  if (!grid) return;

  try {
    await this.loadBlogsFromBackend();
    grid.innerHTML = "";

    this.blogs.forEach((blog) => {
      const blogElement = this.createBlogElement(blog);
      grid.appendChild(blogElement);
    });

    // Force grid layout
    grid.style.display = "grid";
    grid.style.gridTemplateColumns = "repeat(3, 1fr)";
    grid.style.gap = "2rem";
    grid.style.width = "100%";
    grid.style.maxWidth = "100%";
  } catch (error) {
    grid.innerHTML = '<div class="error-message">Failed to load blogs</div>';
    console.error("Failed to load blogs:", error);
  }
};

AdminPanel.prototype.createBlogElement = function (blog) {
  const div = document.createElement("div");
  div.className = "product-card-modern group";
  div.setAttribute("data-category", "blog");

  div.innerHTML = `
    <!-- Blog Image Section -->
    <div class="product-image-modern">
      ${
        blog.image_path
          ? `<img src="${blog.image_path}" alt="${blog.title}" class="product-img-modern" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />`
          : ""
      }
      <div class="product-placeholder-modern" style="${
        blog.image_path ? "display: none;" : ""
      }">
        <i class="product-icon-modern">📝</i>
      </div>
      
      <!-- Gradient Overlay -->
      <div class="product-gradient-overlay"></div>
      
      ${blog.is_active ? `<div class="product-badge-modern">Active</div>` : ""}
    </div>

    <!-- Blog Content -->
    <div class="product-content-modern">
      <h3 class="product-title-modern">${blog.title}</h3>
      <p class="product-description-modern">${
        blog.description || "No description available"
      }</p>

      <div class="product-features-modern">
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Category: ${blog.category || "Blog"}</span>
        </div>
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Author: ${blog.author || "N/A"}</span>
        </div>
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Date: ${blog.publish_date || "N/A"}</span>
        </div>
        <div class="product-feature-item">
          <div class="feature-bullet"></div>
          <span class="feature-text">Status: ${
            blog.is_active ? "Active" : "Inactive"
          }</span>
        </div>
      </div>

      <!-- Delete Button Only -->
      <div class="product-button-container">
        <button class="product-btn-modern product-btn-delete" onclick="adminPanel.deleteBlog(${
          blog.id
        })">
          <i class="fas fa-trash"></i> Delete
        </button>
      </div>
    </div>
  `;
  return div;
};

AdminPanel.prototype.showBlogModal = function (blog = null) {
  this.currentEditingBlog = blog;
  const modal = document.getElementById("blogModal");
  const modalTitle = document.getElementById("blogModalTitle");
  const form = document.getElementById("blogForm");

  if (!modal) {
    console.error("Blog modal not found!");
    return;
  }

  if (blog) {
    // Edit mode
    modalTitle.textContent = "Edit Blog";
    document.getElementById("blogTitle").value = blog.title;
    document.getElementById("blogDescription").value = blog.description;
    document.getElementById("blogCategory").value = blog.category || "";
    document.getElementById("blogAuthor").value = blog.author || "";
    document.getElementById("blogPublishDate").value = blog.publish_date || "";
    document.getElementById("blogContent").value = blog.content || "";
  } else {
    // Add mode
    modalTitle.textContent = "Add New Blog";
    form.reset();
  }

  modal.classList.add("show");
  document.body.style.overflow = "hidden";
};

AdminPanel.prototype.hideBlogModal = function () {
  const modal = document.getElementById("blogModal");
  modal.classList.remove("show");
  document.body.style.overflow = "auto";
};

AdminPanel.prototype.saveBlog = async function () {
  const form = document.getElementById("blogForm");
  const formData = new FormData(form);

  const blogData = {
    title: formData.get("blogTitle").trim(),
    description: formData.get("blogDescription").trim(),
    category: formData.get("blogCategory").trim(),
    author: formData.get("blogAuthor").trim(),
    publish_date: formData.get("blogPublishDate"),
    content: formData.get("blogContent").trim(),
  };

  // Handle image upload
  const imageFile = formData.get("blogImage");
  if (imageFile && imageFile.size > 0) {
    try {
      const uploadResponse = await this.uploadFileToServer(imageFile);
      if (uploadResponse.success) {
        blogData.image_path = uploadResponse.file_path;
      } else {
        this.showNotification("Failed to upload image", "error");
        return;
      }
    } catch (error) {
      this.showNotification(
        "Failed to upload image: " + error.message,
        "error"
      );
      return;
    }
  }

  try {
    if (this.currentEditingBlog) {
      // Update existing blog
      blogData.id = this.currentEditingBlog.id;
      await this.apiRequest("update_blog", blogData);
      this.showNotification("Blog updated successfully", "success");
    } else {
      // Add new blog
      await this.apiRequest("add_blog", blogData);
      this.showNotification("Blog added successfully", "success");
    }

    this.hideBlogModal();
    this.generateBlogsGrid();
  } catch (error) {
    this.showNotification("Failed to save blog", "error");
    console.error("Error saving blog:", error);
  }
};

AdminPanel.prototype.editBlog = function (id) {
  const blog = this.blogs.find((b) => b.id === id);
  if (blog) {
    this.showBlogModal(blog);
  }
};

AdminPanel.prototype.deleteBlog = async function (id) {
  if (confirm("Are you sure you want to delete this blog?")) {
    try {
      await this.apiRequest(`delete_blog&id=${id}`);
      this.generateBlogsGrid();
      this.showNotification("Blog deleted successfully", "success");
    } catch (error) {
      this.showNotification("Failed to delete blog", "error");
    }
  }
};

console.log("🚀 Admin Panel initialized successfully!");
