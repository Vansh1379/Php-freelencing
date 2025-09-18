// Admin Panel JavaScript - Mena Play World
// Complete functionality for content management system

class AdminPanel {
    constructor() {
        this.currentSection = 'main';
        this.products = [];
        this.currentEditingProduct = null;
        this.init();
    }

    init() {
        this.initializeEventListeners();
        this.loadInitialData();
        this.initializeFileUploads();
        this.initializeContentEditor();
        this.generateProductsGrid();
        this.showWelcomeMessage();
    }

    initializeEventListeners() {
        // Sidebar navigation
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const section = item.getAttribute('data-section');
                this.switchSection(section);
            });
        });

        // Header actions
        document.getElementById('previewBtn').addEventListener('click', () => {
            this.previewChanges();
        });

        document.getElementById('saveAllBtn').addEventListener('click', () => {
            this.saveAllChanges();
        });

        // Product management
        document.getElementById('addProductBtn').addEventListener('click', () => {
            this.showProductModal();
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            this.hideProductModal();
        });

        document.getElementById('cancelProduct').addEventListener('click', () => {
            this.hideProductModal();
        });

        document.getElementById('productForm').addEventListener('submit', (e) => {
            this.handleProductSubmit(e);
        });

        // Modal backdrop click
        document.getElementById('productModal').addEventListener('click', (e) => {
            if (e.target.id === 'productModal') {
                this.hideProductModal();
            }
        });

        // Form validation
        this.setupFormValidation();

        // Logout functionality
        document.querySelector('.logout-btn').addEventListener('click', () => {
            this.handleLogout();
        });

        // Auto-save functionality
        this.setupAutoSave();

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            this.handleKeyboardShortcuts(e);
        });

        // Confirmation modal
        this.initializeConfirmModal();
    }

    switchSection(section) {
        // Update active menu item
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
        });
        document.querySelector(`[data-section="${section}"]`).classList.add('active');

        // Hide all content sections
        document.querySelectorAll('.content-section').forEach(sec => {
            sec.classList.remove('active');
        });

        // Show selected section
        document.getElementById(`${section}-section`).classList.add('active');

        // Update page title
        const titles = {
            main: 'Main Page Management',
            about: 'About Page Management',
            products: 'Products Management',
            settings: 'Site Settings'
        };
        document.getElementById('page-title').textContent = titles[section];

        this.currentSection = section;

        // Section-specific initialization
        if (section === 'products') {
            this.generateProductsGrid();
        }
    }

    loadInitialData() {
        // Load saved data from localStorage or set defaults
        const savedData = this.getSavedData();

        if (savedData) {
            this.populateFormsWithData(savedData);
        }

        // Load products
        const savedProducts = localStorage.getItem('adminProducts');
        if (savedProducts) {
            this.products = JSON.parse(savedProducts);
        } else {
            this.products = this.getDefaultProducts();
            localStorage.setItem('adminProducts', JSON.stringify(this.products));
        }
    }

    getSavedData() {
        const savedData = localStorage.getItem('adminData');
        return savedData ? JSON.parse(savedData) : null;
    }

    populateFormsWithData(data) {
        // Populate hero section
        if (data.hero) {
            document.getElementById('heroTitle').value = data.hero.title || '';
            document.getElementById('heroDescription').value = data.hero.description || '';
            document.getElementById('heroButton1').value = data.hero.button1 || '';
            document.getElementById('heroButton2').value = data.hero.button2 || '';
        }

        // Populate company information
        if (data.company) {
            document.getElementById('companyName').value = data.company.name || '';
            document.getElementById('certification').value = data.company.certification || '';
            document.getElementById('welcomeTitle').value = data.company.welcomeTitle || '';
        }

        // Populate about content
        if (data.about && data.about.content) {
            document.getElementById('aboutContentEditor').innerHTML = data.about.content;
        }
    }

    getDefaultProducts() {
        return [
            {
                id: 1,
                name: 'Multi-Play Structures',
                category: 'playground',
                description: 'Comprehensive play systems that combine multiple activities in one exciting structure, perfect for parks and schools.',
                features: ['Multiple climbing options', 'Integrated slides', 'Safety railings', 'Age-appropriate design'],
                minPrice: 250000,
                maxPrice: 800000,
                badge: 'Popular'
            },
            {
                id: 2,
                name: 'Spring Riders',
                category: 'playground',
                description: 'Fun and safe spring-mounted riding toys that provide hours of entertainment for young children.',
                features: ['Colorful animal designs', 'Durable spring mechanism', 'Non-slip handles', 'Weather resistant'],
                minPrice: 15000,
                maxPrice: 35000
            },
            {
                id: 3,
                name: 'Cardio Stations',
                category: 'outdoor',
                description: 'Professional outdoor cardiovascular equipment designed to withstand all weather conditions.',
                features: ['Elliptical trainers', 'Exercise bikes', 'Rowing machines', 'Galvanized steel frame'],
                minPrice: 45000,
                maxPrice: 150000,
                badge: 'New'
            }
        ];
    }

    generateProductsGrid() {
        const grid = document.getElementById('productsGrid');
        grid.innerHTML = '';

        this.products.forEach(product => {
            const productElement = this.createProductElement(product);
            grid.appendChild(productElement);
        });
    }

    createProductElement(product) {
        const div = document.createElement('div');
        div.className = 'product-item fade-in';
        div.innerHTML = `
            <div class="product-header">
                <div class="product-title">${product.name}</div>
                <span class="product-category">${this.getCategoryDisplay(product.category)}</span>
                ${product.badge ? `<span class="product-badge">${product.badge}</span>` : ''}
            </div>
            <div class="product-body">
                <p class="product-description">${product.description}</p>
                <div class="product-price">₹${this.formatPrice(product.minPrice)} - ₹${this.formatPrice(product.maxPrice)}</div>
                <div class="product-actions">
                    <button class="btn btn-sm btn-primary" onclick="adminPanel.editProduct(${product.id})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="adminPanel.deleteProduct(${product.id})">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        `;
        return div;
    }

    getCategoryDisplay(category) {
        const categories = {
            playground: 'Playground Equipment',
            outdoor: 'Outdoor Gym',
            indoor: 'Indoor Solutions'
        };
        return categories[category] || category;
    }

    formatPrice(price) {
        return new Intl.NumberFormat('en-IN').format(price);
    }

    showProductModal(product = null) {
        const modal = document.getElementById('productModal');
        const form = document.getElementById('productForm');
        const title = document.getElementById('modalTitle');

        if (product) {
            title.textContent = 'Edit Product';
            this.currentEditingProduct = product;
            this.populateProductForm(product);
        } else {
            title.textContent = 'Add New Product';
            this.currentEditingProduct = null;
            form.reset();
        }

        modal.classList.add('show');
        document.body.style.overflow = 'hidden';

        // Focus first input
        setTimeout(() => {
            document.getElementById('productName').focus();
        }, 100);
    }

    hideProductModal() {
        const modal = document.getElementById('productModal');
        modal.classList.remove('show');
        document.body.style.overflow = '';
        this.currentEditingProduct = null;
    }

    populateProductForm(product) {
        document.getElementById('productName').value = product.name;
        document.getElementById('productCategory').value = product.category;
        document.getElementById('productDescription').value = product.description;
        document.getElementById('productFeatures').value = product.features.join('\n');
        document.getElementById('productMinPrice').value = product.minPrice;
        document.getElementById('productMaxPrice').value = product.maxPrice;
    }

    handleProductSubmit(e) {
        e.preventDefault();

        const formData = new FormData(e.target);
        const productData = {
            name: formData.get('productName').trim(),
            category: formData.get('productCategory'),
            description: formData.get('productDescription').trim(),
            features: formData.get('productFeatures').split('\n').map(f => f.trim()).filter(f => f),
            minPrice: parseInt(formData.get('productMinPrice')) || 0,
            maxPrice: parseInt(formData.get('productMaxPrice')) || 0
        };

        // Validation
        if (!this.validateProductData(productData)) {
            return;
        }

        if (this.currentEditingProduct) {
            // Update existing product
            productData.id = this.currentEditingProduct.id;
            const index = this.products.findIndex(p => p.id === this.currentEditingProduct.id);
            if (index !== -1) {
                this.products[index] = { ...this.products[index], ...productData };
            }
            this.showToast('Product updated successfully!', 'success');
        } else {
            // Add new product
            productData.id = Date.now(); // Simple ID generation
            this.products.push(productData);
            this.showToast('Product added successfully!', 'success');
        }

        // Save to localStorage
        localStorage.setItem('adminProducts', JSON.stringify(this.products));

        // Refresh products grid
        this.generateProductsGrid();

        // Hide modal
        this.hideProductModal();
    }

    validateProductData(data) {
        const errors = [];

        if (!data.name) errors.push('Product name is required');
        if (!data.category) errors.push('Category is required');
        if (!data.description) errors.push('Description is required');
        if (data.minPrice < 0) errors.push('Minimum price must be positive');
        if (data.maxPrice < 0) errors.push('Maximum price must be positive');
        if (data.minPrice > data.maxPrice) errors.push('Minimum price cannot be greater than maximum price');

        if (errors.length > 0) {
            this.showToast(errors.join('<br>'), 'error');
            return false;
        }

        return true;
    }

    editProduct(id) {
        const product = this.products.find(p => p.id === id);
        if (product) {
            this.showProductModal(product);
        }
    }

    deleteProduct(id) {
        const product = this.products.find(p => p.id === id);
        if (!product) return;

        this.showConfirmModal(
            `Are you sure you want to delete "${product.name}"?`,
            () => {
                this.products = this.products.filter(p => p.id !== id);
                localStorage.setItem('adminProducts', JSON.stringify(this.products));
                this.generateProductsGrid();
                this.showToast('Product deleted successfully!', 'success');
            }
        );
    }

    initializeFileUploads() {
        document.querySelectorAll('.file-upload-area').forEach(area => {
            const input = area.querySelector('input[type="file"]');
            const placeholder = area.querySelector('.file-upload-placeholder');

            area.addEventListener('dragover', (e) => {
                e.preventDefault();
                area.classList.add('dragover');
            });

            area.addEventListener('dragleave', () => {
                area.classList.remove('dragover');
            });

            area.addEventListener('drop', (e) => {
                e.preventDefault();
                area.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    input.files = files;
                    this.handleFileUpload(input, files[0]);
                }
            });

            input.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    this.handleFileUpload(input, e.target.files[0]);
                }
            });
        });
    }

    handleFileUpload(input, file) {
        if (!file.type.startsWith('image/')) {
            this.showToast('Please select a valid image file', 'error');
            return;
        }

        if (file.size > 5 * 1024 * 1024) { // 5MB limit
            this.showToast('File size must be less than 5MB', 'error');
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            const placeholder = input.parentElement.querySelector('.file-upload-placeholder');
            placeholder.innerHTML = `
                <i class="fas fa-check-circle" style="color: #10b981;"></i>
                <p style="color: #10b981; margin: 0.5rem 0 0 0; font-weight: 600;">${file.name} uploaded</p>
                <button type="button" class="btn btn-sm btn-secondary" style="margin-top: 0.5rem;" onclick="this.closest('.file-upload-area').querySelector('input').value=''; this.closest('.file-upload-placeholder').innerHTML='<i class=&quot;fas fa-cloud-upload-alt&quot;></i><p>Drag and drop image here or click to browse</p>';">Remove</button>
            `;
        };
        reader.readAsDataURL(file);
    }

    initializeContentEditor() {
        const toolbarButtons = document.querySelectorAll('.toolbar-btn');
        const editor = document.getElementById('aboutContentEditor');

        toolbarButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const command = btn.getAttribute('data-command');
                document.execCommand(command, false, null);
                editor.focus();
            });
        });

        editor.addEventListener('input', () => {
            this.debounce(() => {
                this.autoSave();
            }, 1000)();
        });
    }

    setupFormValidation() {
        const requiredFields = document.querySelectorAll('input[required], textarea[required], select[required]');

        requiredFields.forEach(field => {
            field.addEventListener('blur', () => {
                this.validateField(field);
            });

            field.addEventListener('input', () => {
                this.clearFieldError(field);
            });
        });
    }

    validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name || field.id;

        if (field.hasAttribute('required') && !value) {
            this.showFieldError(field, `${this.getFieldLabel(fieldName)} is required`);
            return false;
        }

        if (field.type === 'email' && value && !this.isValidEmail(value)) {
            this.showFieldError(field, 'Please enter a valid email address');
            return false;
        }

        if (field.type === 'tel' && value && !this.isValidPhone(value)) {
            this.showFieldError(field, 'Please enter a valid phone number');
            return false;
        }

        if (field.type === 'number' && value && parseInt(value) < 0) {
            this.showFieldError(field, 'Please enter a positive number');
            return false;
        }

        this.clearFieldError(field);
        return true;
    }

    showFieldError(field, message) {
        this.clearFieldError(field);

        field.style.borderColor = '#ef4444';
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.style.cssText = 'color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;';
        errorDiv.textContent = message;

        field.parentElement.appendChild(errorDiv);
    }

    clearFieldError(field) {
        field.style.borderColor = '';
        const errorDiv = field.parentElement.querySelector('.field-error');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    getFieldLabel(fieldName) {
        const labels = {
            heroTitle: 'Hero Title',
            heroDescription: 'Hero Description',
            productName: 'Product Name',
            productCategory: 'Category',
            productDescription: 'Description',
            companyName: 'Company Name',
            welcomeTitle: 'Welcome Title'
        };
        return labels[fieldName] || fieldName;
    }

    isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    isValidPhone(phone) {
        return /^[\+]?[0-9\s\-\(\)]+$/.test(phone) && phone.replace(/\D/g, '').length >= 10;
    }

    setupAutoSave() {
        const forms = document.querySelectorAll('.admin-form');
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('input', this.debounce(() => {
                    this.autoSave();
                }, 2000));
            });
        });
    }

    autoSave() {
        const data = this.collectAllFormData();
        localStorage.setItem('adminData', JSON.stringify(data));
        this.showAutoSaveIndicator();
    }

    showAutoSaveIndicator() {
        const indicator = document.createElement('div');
        indicator.className = 'autosave-indicator';
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
                title: document.getElementById('heroTitle').value,
                description: document.getElementById('heroDescription').value,
                button1: document.getElementById('heroButton1').value,
                button2: document.getElementById('heroButton2').value
            },
            company: {
                name: document.getElementById('companyName').value,
                certification: document.getElementById('certification').value,
                welcomeTitle: document.getElementById('welcomeTitle').value
            },
            about: {
                content: document.getElementById('aboutContentEditor').innerHTML
            },
            site: {
                name: document.getElementById('siteName').value,
                description: document.getElementById('siteDescription').value,
                contactEmail: document.getElementById('contactEmail').value,
                contactPhone: document.getElementById('contactPhone').value
            }
        };
    }

    previewChanges() {
        this.showToast('Opening preview in new tab...', 'info');
        // In a real implementation, you would generate a preview URL
        window.open('index.html', '_blank');
    }

    saveAllChanges() {
        const data = this.collectAllFormData();

        // Validate all forms
        let isValid = true;
        const requiredFields = document.querySelectorAll('input[required], textarea[required], select[required]');

        requiredFields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        if (!isValid) {
            this.showToast('Please fix the errors before saving', 'error');
            return;
        }

        // Save data
        localStorage.setItem('adminData', JSON.stringify(data));
        localStorage.setItem('adminProducts', JSON.stringify(this.products));

        // Show success message
        this.showToast('All changes saved successfully!', 'success');

        // In a real implementation, you would send this data to your server
        console.log('Saving data:', { data, products: this.products });
    }

    handleLogout() {
        this.showConfirmModal(
            'Are you sure you want to logout? Any unsaved changes will be lost.',
            () => {
                // In a real implementation, you would clear session and redirect
                this.showToast('Logging out...', 'info');
                setTimeout(() => {
                    window.location.href = 'index.html';
                }, 1500);
            }
        );
    }

    handleKeyboardShortcuts(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            this.saveAllChanges();
        }

        // Escape to close modals
        if (e.key === 'Escape') {
            const modal = document.querySelector('.modal.show');
            if (modal) {
                modal.classList.remove('show');
            }
        }
    }

    initializeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        const cancelBtn = document.getElementById('confirmCancel');
        const yesBtn = document.getElementById('confirmYes');

        cancelBtn.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    }

    showConfirmModal(message, onConfirm) {
        const modal = document.getElementById('confirmModal');
        const messageElement = document.getElementById('confirmMessage');
        const yesBtn = document.getElementById('confirmYes');

        messageElement.textContent = message;

        // Remove previous event listeners
        const newYesBtn = yesBtn.cloneNode(true);
        yesBtn.parentNode.replaceChild(newYesBtn, yesBtn);

        newYesBtn.addEventListener('click', () => {
            modal.classList.remove('show');
            onConfirm();
        });

        modal.classList.add('show');
    }

    showToast(message, type = 'info') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');

        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
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
            toast.classList.add('show');
        }, 100);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }, 5000);
    }

    showWelcomeMessage() {
        setTimeout(() => {
            this.showToast('Welcome to Mena Play World Admin Panel!', 'success');
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
const style = document.createElement('style');
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
document.addEventListener('DOMContentLoaded', () => {
    adminPanel = new AdminPanel();
});

// Export for global access
window.adminPanel = adminPanel;

console.log('🚀 Admin Panel initialized successfully!');
