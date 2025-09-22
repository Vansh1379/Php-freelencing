<?php
/**
 * Admin Panel - Mena Play World
 * Converted from HTML to PHP with proper includes and structure
 */

// Include configuration and database
require_once 'includes/config.php';
require_once 'includes/database.php';

// Simple authentication check (you can enhance this with proper session management)
session_start();

// For demo purposes, we'll allow direct access
// In production, add proper authentication here
/*
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin-login.php');
    exit;
}
*/

// Initialize database if needed
try {
    initializeDatabase();
} catch (Exception $e) {
    die('Database initialization failed: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="product.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cog"></i> Admin Panel</h2>
                <p><?php echo SITE_NAME; ?></p>
            </div>

            <ul class="sidebar-menu">
                <li class="menu-item active" data-section="main">
                    <a href="#"><i class="fas fa-home"></i> Main Page</a>
                </li>
                <li class="menu-item" data-section="about">
                    <a href="#"><i class="fas fa-info-circle"></i> About Page</a>
                </li>
                <li class="menu-item" data-section="products">
                    <a href="#"><i class="fas fa-box"></i> Products</a>
                </li>
                <li class="menu-item" data-section="certifications">
                    <a href="#"><i class="fas fa-certificate"></i> Certifications</a>
                </li>
                <li class="menu-item" data-section="latest-work">
                    <a href="#"><i class="fas fa-hammer"></i> Latest Work</a>
                </li>
                <li class="menu-item" data-section="blogs">
                    <a href="#"><i class="fas fa-blog"></i> Blogs</a>
                </li>
                <li class="menu-item" data-section="settings">
                    <a href="#"><i class="fas fa-sliders-h"></i> Settings</a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <a href="index.php" class="view-site-btn" target="_blank">
                    <i class="fas fa-external-link-alt"></i> View Site
                </a>
                <button class="logout-btn" onclick="handleLogout()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-header">
                <h1 id="page-title">Main Page Management</h1>
                <div class="header-actions">
                    <button class="btn btn-secondary" id="previewBtn">
                        <i class="fas fa-eye"></i> Preview Changes
                    </button>
                    <button class="btn btn-success" id="saveAllBtn">
                        <i class="fas fa-save"></i> Save All
                    </button>
                </div>
            </div>

            <!-- Main Page Section -->
            <section class="content-section active" id="main-section">
                <div class="section-card">
                    <h2><i class="fas fa-edit"></i> Hero Section</h2>
                    <form class="admin-form" id="heroForm">
                        <div class="form-group">
                            <label for="heroTitle">Main Title</label>
                            <input type="text" id="heroTitle" name="heroTitle"
                                   value="Premium Playground Equipment"
                                   placeholder="Enter main title">
                        </div>

                        <div class="form-group">
                            <label for="heroDescription">Description</label>
                            <textarea id="heroDescription" name="heroDescription" rows="4"
                                      placeholder="Enter hero description">We create safe, fun, and engaging play spaces for children of all ages. With 30+ years of experience, we deliver quality equipment that sparks imagination and provides healthy development.</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="heroButton1">Primary Button Text</label>
                                <input type="text" id="heroButton1" name="heroButton1"
                                       value="Explore Products">
                            </div>
                            <div class="form-group">
                                <label for="heroButton2">Secondary Button Text</label>
                                <input type="text" id="heroButton2" name="heroButton2"
                                       value="Watch Demo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="heroImage">Hero Background Image</label>
                            <div class="file-upload-area">
                                <input type="file" id="heroImage" name="heroImage" accept="image/*">
                                <div class="file-upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Drag and drop image here or click to browse</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="section-card">
                    <h2><i class="fas fa-chart-bar"></i> Statistics</h2>
                    <form class="admin-form" id="statsForm">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <label>Years Experience</label>
                                <input type="text" name="stat1Value" value="10+" placeholder="10+">
                                <input type="text" name="stat1Label" value="Years Experience" placeholder="Label">
                            </div>
                            <div class="stat-item">
                                <label>Projects Completed</label>
                                <input type="text" name="stat2Value" value="500+" placeholder="500+">
                                <input type="text" name="stat2Label" value="Projects Completed" placeholder="Label">
                            </div>
                            <div class="stat-item">
                                <label>Quality Certification</label>
                                <input type="text" name="stat3Value" value="9 ISO" placeholder="9 ISO">
                                <input type="text" name="stat3Label" value="Certified Quality" placeholder="Label">
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <!-- About Page Section -->
            <section class="content-section" id="about-section">
                <div class="section-card">
                    <h2><i class="fas fa-building"></i> Company Information</h2>
                    <form class="admin-form" id="companyForm">
                        <div class="form-group">
                            <label for="companyName">Company Name</label>
                            <input type="text" id="companyName" name="companyName"
                                   value="<?php echo defined('COMPANY_NAME') ? COMPANY_NAME : 'MEMA PLAY WORLD'; ?>">
                        </div>

                        <div class="form-group">
                            <label for="certification">Certification</label>
                            <input type="text" id="certification" name="certification"
                                   value="AN ISO 9001:2015 CERTIFIED COMPANY">
                        </div>

                        <div class="form-group">
                            <label for="companyLogo">Company Logo</label>
                            <div class="file-upload-area">
                                <input type="file" id="companyLogo" name="companyLogo" accept="image/*">
                                <div class="file-upload-placeholder">
                                    <i class="fas fa-image"></i>
                                    <p>Upload company logo</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="section-card">
                    <h2><i class="fas fa-align-left"></i> About Content</h2>
                    <form class="admin-form" id="aboutContentForm">
                        <div class="form-group">
                            <label for="welcomeTitle">Welcome Title</label>
                            <input type="text" id="welcomeTitle" name="welcomeTitle"
                                   value="Welcome to <?php echo SITE_NAME; ?>">
                        </div>

                        <div class="form-group">
                            <label for="aboutContent">About Content</label>
                            <div class="content-editor">
                                <div class="editor-toolbar">
                                    <button type="button" class="toolbar-btn" data-command="bold">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="italic">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="toolbar-btn" data-command="insertUnorderedList">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                </div>
                                <div class="editor-content" contenteditable="true" id="aboutContentEditor">
                                    <p>Welcome to <?php echo SITE_NAME; ?>, your premier destination for high-quality playground equipment and solutions. With a passion for creating engaging and safe play spaces, we have been serving communities and institutions for 10 years with our innovative and durable products.</p>
                                    <p>At <?php echo SITE_NAME; ?>, we believe that play is an essential part of childhood development. Our mission is to design and manufacture playground equipment that not only sparks children's imaginations but also promotes physical activity, social interaction, and cognitive growth.</p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="section-card">
                    <h2><i class="fas fa-chart-pie"></i> About Statistics</h2>
                    <form class="admin-form" id="aboutStatsForm">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <label>Years of Experience</label>
                                <input type="text" name="aboutStat1" value="10+" placeholder="10+">
                            </div>
                            <div class="stat-item">
                                <label>Total Products</label>
                                <input type="text" name="aboutStat2" value="1000+" placeholder="1000+">
                            </div>
                            <div class="stat-item">
                                <label>Team Members</label>
                                <input type="text" name="aboutStat3" value="50+" placeholder="50+">
                            </div>
                            <div class="stat-item">
                                <label>Happy Customers</label>
                                <input type="text" name="aboutStat4" value="500+" placeholder="500+">
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Products Section -->
            <section class="content-section" id="products-section">
                <div class="section-header">
                    <h2><i class="fas fa-plus-circle"></i> Manage Products</h2>
                    <button class="btn btn-primary" id="addProductBtn">
                        <i class="fas fa-plus"></i> Add New Product
                    </button>
                </div>

                <div class="product-grid" id="productsGrid">
                    <!-- Product items will be dynamically generated here -->
                </div>

                <!-- Add/Edit Product Modal -->
                <div class="modal" id="productModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 id="modalTitle">Add New Product</h3>
                            <button class="close-modal" id="closeModal">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="admin-form" id="productForm">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" id="productName" name="productName"
                                           placeholder="Enter product name" required>
                                </div>

                                <div class="form-group">
                                    <label for="productCategory">Category</label>
                                    <select id="productCategory" name="productCategory" required>
                                        <option value="">Select Category</option>
                                        <option value="playground">Playground Equipment</option>
                                        <option value="outdoor">Outdoor Gym</option>
                                        <option value="indoor">Indoor Solutions</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="productDescription">Description</label>
                                    <textarea id="productDescription" name="productDescription" rows="4"
                                              placeholder="Enter product description" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="productFeatures">Features (one per line)</label>
                                    <textarea id="productFeatures" name="productFeatures" rows="4"
                                              placeholder="Feature 1&#10;Feature 2&#10;Feature 3"></textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="productMinPrice">Min Price (₹)</label>
                                        <input type="number" id="productMinPrice" name="productMinPrice"
                                               placeholder="25000">
                                    </div>
                                    <div class="form-group">
                                        <label for="productMaxPrice">Max Price (₹)</label>
                                        <input type="number" id="productMaxPrice" name="productMaxPrice"
                                               placeholder="120000">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="productImage">Product Image</label>
                                    <div class="file-upload-area">
                                        <input type="file" id="productImage" name="productImage" accept="image/*">
                                        <div class="file-upload-placeholder">
                                            <i class="fas fa-image"></i>
                                            <p>Upload product image</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-secondary" id="cancelProduct">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="saveProduct">Save Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Certifications Section -->
            <section class="content-section" id="certifications-section">
                <div class="section-header">
                    <h2><i class="fas fa-certificate"></i> Manage Certifications</h2>
                    <button class="btn btn-primary" id="addCertificationBtn">
                        <i class="fas fa-plus"></i> Add New Certification
                    </button>
                </div>

                <div class="certifications-grid" id="certificationsGrid">
                    <!-- Certification items will be dynamically generated here -->
                </div>
            </section>

            <!-- Latest Work Section -->
            <section class="content-section" id="latest-work-section">
                <div class="section-header">
                    <h2><i class="fas fa-hammer"></i> Manage Latest Work</h2>
                    <button class="btn btn-primary" id="addLatestWorkBtn">
                        <i class="fas fa-plus"></i> Add New Project
                    </button>
                </div>

                <div class="latest-work-grid" id="latestWorkGrid">
                    <!-- Latest work items will be dynamically generated here -->
                </div>
            </section>

            <!-- Blogs Section -->
            <section class="content-section" id="blogs-section">
                <div class="section-header">
                    <h2><i class="fas fa-blog"></i> Manage Blogs</h2>
                    <button class="btn btn-primary" id="addBlogBtn">
                        <i class="fas fa-plus"></i> Add New Blog
                    </button>
                </div>

                <div class="blogs-grid" id="blogsGrid">
                    <!-- Blog items will be dynamically generated here -->
                </div>
            </section>

            <!-- Settings Section -->
            <section class="content-section" id="settings-section">
                <div class="section-card">
                    <h2><i class="fas fa-globe"></i> Site Settings</h2>
                    <form class="admin-form" id="siteSettingsForm">
                        <div class="form-group">
                            <label for="siteName">Site Name</label>
                            <input type="text" id="siteName" name="siteName"
                                   value="<?php echo SITE_NAME; ?>">
                        </div>

                        <div class="form-group">
                            <label for="siteDescription">Site Description</label>
                            <textarea id="siteDescription" name="siteDescription" rows="3"
                                      placeholder="Enter site meta description">Premium playground equipment manufacturer in India. Creating safe, fun, and engaging play spaces for children.</textarea>
                        </div>

                        <div class="form-group">
                            <label for="contactEmail">Contact Email</label>
                            <input type="email" id="contactEmail" name="contactEmail"
                                   value="<?php echo CONTACT_EMAIL; ?>">
                        </div>

                        <div class="form-group">
                            <label for="contactPhone">Contact Phone</label>
                            <input type="tel" id="contactPhone" name="contactPhone"
                                   value="<?php echo CONTACT_PHONE; ?>">
                        </div>

                        <div class="form-group">
                            <label for="companyAddress">Company Address</label>
                            <textarea id="companyAddress" name="companyAddress" rows="3"
                                      placeholder="Enter company address"><?php echo defined('COMPANY_ADDRESS') ? COMPANY_ADDRESS : ''; ?></textarea>
                        </div>
                    </form>
                </div>

                <div class="section-card">
                    <h2><i class="fas fa-link"></i> Navigation Settings</h2>
                    <form class="admin-form" id="navigationForm">
                        <div class="form-group">
                            <label>Navigation Menu Items</label>
                            <div id="navigationItems">
                                <?php
                                global $navigation_menu;
                                foreach ($navigation_menu as $page => $title):
                                ?>
                                <div class="nav-item-row">
                                    <input type="text" placeholder="Page" value="<?php echo $page; ?>" name="nav_page[]">
                                    <input type="text" placeholder="Title" value="<?php echo $title; ?>" name="nav_title[]">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeNavItem(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="button" class="btn btn-secondary" onclick="addNavItem()">
                                <i class="fas fa-plus"></i> Add Navigation Item
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <!-- Success/Error Messages -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Confirmation Modal -->
    <div class="modal" id="confirmModal">
        <div class="modal-content small">
            <div class="modal-header">
                <h3>Confirm Action</h3>
            </div>
            <div class="modal-body">
                <p id="confirmMessage">Are you sure you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="confirmCancel">Cancel</button>
                <button class="btn btn-danger" id="confirmYes">Yes, Proceed</button>
            </div>
        </div>
    </div>

    <script>
        // PHP data for JavaScript
        const SITE_CONFIG = {
            siteName: '<?php echo SITE_NAME; ?>',
            contactEmail: '<?php echo CONTACT_EMAIL; ?>',
            contactPhone: '<?php echo CONTACT_PHONE; ?>',
            companyName: '<?php echo defined('COMPANY_NAME') ? COMPANY_NAME : 'MEMA PLAY WORLD'; ?>'
        };

        // API endpoints
        const API_BASE = 'admin-api.php';

        // Navigation items for JavaScript
        const navigationItems = <?php echo json_encode($navigation_menu); ?>;

        // Handle logout function
        function handleLogout() {
            if (confirm('Are you sure you want to logout?')) {
                // In a real implementation, you would handle logout here
                alert('Logout functionality would be implemented here.');
                // window.location.href = 'admin-login.php';
            }
        }

        // Add navigation item function
        function addNavItem() {
            const container = document.getElementById('navigationItems');
            const navItem = document.createElement('div');
            navItem.className = 'nav-item-row';
            navItem.innerHTML = `
                <input type="text" placeholder="Page" name="nav_page[]">
                <input type="text" placeholder="Title" name="nav_title[]">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeNavItem(this)">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(navItem);
        }

        // Remove navigation item function
        function removeNavItem(button) {
            button.parentElement.remove();
        }

        // API Helper Functions
        async function apiRequest(action, data = null, method = 'GET') {
            const url = `${API_BASE}?action=${action}`;
            const options = {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                }
            };

            if (data && method !== 'GET') {
                options.body = JSON.stringify(data);
            }

            try {
                const response = await fetch(url, options);
                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'API request failed');
                }

                return result;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        }

        // Load data from backend
        async function loadBackendData() {
            try {
                // Load hero section
                const heroData = await apiRequest('get_hero');
                if (heroData.data) {
                    document.getElementById('heroTitle').value = heroData.data.title || '';
                    document.getElementById('heroDescription').value = heroData.data.description || '';
                    document.getElementById('heroButton1').value = heroData.data.button1_text || '';
                    document.getElementById('heroButton2').value = heroData.data.button2_text || '';
                }

                // Load company info
                const companyData = await apiRequest('get_company');
                if (companyData.data) {
                    document.getElementById('companyName').value = companyData.data.company_name || '';
                    document.getElementById('certification').value = companyData.data.certification || '';
                    document.getElementById('welcomeTitle').value = companyData.data.welcome_title || '';
                }

                // Load site settings
                const settingsData = await apiRequest('get_settings');
                if (settingsData.data) {
                    document.getElementById('siteName').value = settingsData.data.site_name?.value || '';
                    document.getElementById('contactEmail').value = settingsData.data.contact_email?.value || '';
                    document.getElementById('contactPhone').value = settingsData.data.contact_phone?.value || '';
                }

            } catch (error) {
                console.error('Failed to load backend data:', error);
            }
        }

        // Save data to backend
        async function saveToBackend(section, data) {
            try {
                let action = '';
                switch (section) {
                    case 'hero':
                        action = 'save_hero';
                        break;
                    case 'company':
                        action = 'save_company';
                        break;
                    case 'settings':
                        action = 'save_settings';
                        break;
                    case 'products':
                        action = 'add_product';
                        break;
                    default:
                        throw new Error('Unknown section: ' + section);
                }

                const result = await apiRequest(action, data, 'POST');
                return result;
            } catch (error) {
                console.error('Failed to save to backend:', error);
                throw error;
            }
        }

        // Load backend data when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadBackendData();
        });
    </script>
    <script src="admin.js"></script>

    <style>
        /* Additional PHP-specific styles */
        .nav-item-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }

        .nav-item-row input {
            flex: 1;
        }

        .nav-item-row .btn-sm {
            padding: 8px 12px;
            font-size: 0.8rem;
        }

        .section-card {
            margin-bottom: 2rem;
        }

        .form-actions {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }
    </style>
</body>
</html>
