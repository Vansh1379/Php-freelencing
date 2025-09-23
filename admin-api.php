<?php
/**
 * Admin API Endpoints
 * Mena Play World Admin Panel Backend
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include database connection
require_once 'includes/database.php';

// Start session for authentication (if needed)
session_start();

// Simple authentication check (enhance as needed)
function checkAuth() {
    // For now, allow all requests
    // In production, implement proper authentication
    return true;
}

// Get request method and endpoint
$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$pathParts = explode('/', trim($path, '/'));

// Get the action from query parameters or POST data
$action = $_GET['action'] ?? $_POST['action'] ?? '';
$id = $_GET['id'] ?? null;

// Debug logging for action
error_log("API Action received: " . $action);

// Response helper function
function sendResponse($data, $status = 200, $message = 'Success') {
    http_response_code($status);
    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit();
}

// Error response helper
function sendError($message, $status = 400, $data = null) {
    http_response_code($status);
    echo json_encode([
        'status' => $status,
        'error' => true,
        'message' => $message,
        'data' => $data,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit();
}

// Validate required fields
function validateRequired($data, $fields) {
    $missing = [];
    foreach ($fields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $missing[] = $field;
        }
    }
    return $missing;
}

// Initialize database if not exists
try {
    initializeDatabase();
} catch (Exception $e) {
    sendError('Database initialization failed: ' . $e->getMessage(), 500);
}

// Route the request based on action
switch ($action) {
    // ===== SITE SETTINGS =====
    case 'get_settings':
        handleGetSettings();
        break;

    case 'save_settings':
        handleSaveSettings();
        break;

    // ===== HERO SECTION =====
    case 'get_hero':
        handleGetHero();
        break;

    case 'save_hero':
        handleSaveHero();
        break;

    // ===== COMPANY INFO =====
    case 'get_company':
        handleGetCompany();
        break;

    case 'save_company':
        handleSaveCompany();
        break;

    // ===== ABOUT CONTENT =====
    case 'get_about':
        handleGetAbout();
        break;

    case 'save_about':
        handleSaveAbout();
        break;

    // ===== PRODUCTS =====
    case 'get_products':
        handleGetProducts();
        break;

    case 'add_product':
        handleAddProduct();
        break;

    case 'update_product':
        handleUpdateProduct();
        break;

    case 'delete_product':
        handleDeleteProduct();
        break;

    // ===== NAVIGATION =====
    case 'get_navigation':
        handleGetNavigation();
        break;

    case 'save_navigation':
        handleSaveNavigation();
        break;

    // ===== STATISTICS =====
    case 'get_statistics':
        handleGetStatistics();
        break;

    case 'save_statistics':
        handleSaveStatistics();
        break;

    // ===== FILE UPLOAD =====
    case 'upload_file':
        handleFileUpload();
        break;

    // ===== DASHBOARD DATA =====
    case 'get_dashboard':
        handleGetDashboard();
        break;

    // ===== CERTIFICATIONS =====
    case 'get_certifications':
        handleGetCertifications();
        break;
    case 'add_certification':
        handleAddCertification();
        break;
    case 'update_certification':
        handleUpdateCertification();
        break;
    case 'delete_certification':
        handleDeleteCertification();
        break;

    // ===== LATEST WORK =====
    case 'get_latest_work':
        handleGetLatestWork();
        break;
    case 'add_latest_work':
        handleAddLatestWork();
        break;
    case 'update_latest_work':
        handleUpdateLatestWork();
        break;
    case 'delete_latest_work':
        handleDeleteLatestWork();
        break;

    // ===== BLOGS =====
    case 'get_blogs':
        handleGetBlogs();
        break;
    case 'add_blog':
        handleAddBlog();
        break;
    case 'update_blog':
        handleUpdateBlog();
        break;
    case 'delete_blog':
        handleDeleteBlog();
        break;

    default:
        error_log("No handler found for action: " . $action);
        sendError('Invalid action: ' . $action, 400);
}

// ===== HANDLER FUNCTIONS =====

/**
 * Get all site settings
 */
function handleGetSettings() {
    try {
        $settings = fetchAll("SELECT setting_key, setting_value, setting_type FROM site_settings ORDER BY setting_key");

        $formatted = [];
        foreach ($settings as $setting) {
            $formatted[$setting['setting_key']] = [
                'value' => $setting['setting_value'],
                'type' => $setting['setting_type']
            ];
        }

        sendResponse($formatted);
    } catch (Exception $e) {
        sendError('Failed to fetch settings: ' . $e->getMessage(), 500);
    }
}

/**
 * Save site settings
 */
function handleSaveSettings() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['settings'])) {
        sendError('Invalid input data');
    }

    try {
        beginTransaction();

        foreach ($input['settings'] as $key => $data) {
            $value = $data['value'] ?? $data;
            $type = $data['type'] ?? 'text';

            executeQuery(
                "INSERT INTO site_settings (setting_key, setting_value, setting_type)
                 VALUES (?, ?, ?)
                 ON DUPLICATE KEY UPDATE setting_value = ?, updated_at = CURRENT_TIMESTAMP",
                [$key, $value, $type, $value]
            );
        }

        commit();
        sendResponse(['message' => 'Settings saved successfully']);

    } catch (Exception $e) {
        rollback();
        sendError('Failed to save settings: ' . $e->getMessage(), 500);
    }
}

/**
 * Get hero section data
 */
function handleGetHero() {
    try {
        $hero = fetchOne("SELECT * FROM hero_section WHERE is_active = 1 ORDER BY id DESC LIMIT 1");

        if (!$hero) {
            // Return default data
            $hero = [
                'title' => 'Premium Playground Equipment',
                'description' => 'We create safe, fun, and engaging play spaces for children of all ages.',
                'button1_text' => 'Explore Products',
                'button1_link' => '#products',
                'button2_text' => 'Watch Demo',
                'button2_link' => '#contact',
                'background_image' => ''
            ];
        }

        sendResponse($hero);
    } catch (Exception $e) {
        sendError('Failed to fetch hero data: ' . $e->getMessage(), 500);
    }
}

/**
 * Save hero section
 */
function handleSaveHero() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    $required = ['title', 'description'];
    $missing = validateRequired($input, $required);

    if (!empty($missing)) {
        sendError('Missing required fields: ' . implode(', ', $missing));
    }

    try {
        // Get the current active hero section
        $existing = fetchOne("SELECT id FROM hero_section WHERE is_active = 1 ORDER BY id DESC LIMIT 1");
        
        if ($existing) {
            // Update the existing active row
            executeQuery(
                "UPDATE hero_section SET 
                    title = ?, 
                    description = ?, 
                    button1_text = ?, 
                    button1_link = ?, 
                    button2_text = ?, 
                    button2_link = ?, 
                    background_image = ?,
                    updated_at = CURRENT_TIMESTAMP
                 WHERE id = ?",
                [
                    $input['title'],
                    $input['description'],
                    $input['button1_text'] ?? '',
                    $input['button1_link'] ?? '',
                    $input['button2_text'] ?? '',
                    $input['button2_link'] ?? '',
                    $input['background_image'] ?? '',
                    $existing['id']
                ]
            );
        } else {
            // Insert new entry only if none exists
            executeQuery(
                "INSERT INTO hero_section (title, description, button1_text, button1_link, button2_text, button2_link, background_image, is_active)
                 VALUES (?, ?, ?, ?, ?, ?, ?, 1)",
                [
                    $input['title'],
                    $input['description'],
                    $input['button1_text'] ?? '',
                    $input['button1_link'] ?? '',
                    $input['button2_text'] ?? '',
                    $input['button2_link'] ?? '',
                    $input['background_image'] ?? ''
                ]
            );
        }

        sendResponse(['message' => 'Hero section saved successfully']);

    } catch (Exception $e) {
        sendError('Failed to save hero section: ' . $e->getMessage(), 500);
    }
}

/**
 * Get company information
 */
function handleGetCompany() {
    try {
        $company = fetchOne("SELECT * FROM company_info ORDER BY id DESC LIMIT 1");

        if (!$company) {
            $company = [
                'company_name' => 'MEMA PLAY WORLD',
                'certification' => 'AN ISO 9001:2015 CERTIFIED COMPANY',
                'welcome_title' => 'Welcome to Mena Play World',
                'logo_path' => 'assets/logo.png',
                'address' => '',
                'phone' => '+91 9773698785',
                'phone_alt' => '+91 9560243588',
                'email' => 'contact.jkenterprise@gmail.com',
                'email_alt' => ''
            ];
        }

        sendResponse($company);
    } catch (Exception $e) {
        sendError('Failed to fetch company info: ' . $e->getMessage(), 500);
    }
}

/**
 * Save company information
 */
function handleSaveCompany() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    $required = ['company_name'];
    $missing = validateRequired($input, $required);

    if (!empty($missing)) {
        sendError('Missing required fields: ' . implode(', ', $missing));
    }

    try {
        $existing = fetchOne("SELECT id FROM company_info LIMIT 1");

        if ($existing) {
            executeQuery(
                "UPDATE company_info SET
                 company_name = ?, certification = ?, welcome_title = ?, logo_path = ?,
                 address = ?, phone = ?, phone_alt = ?, email = ?, email_alt = ?,
                 updated_at = CURRENT_TIMESTAMP
                 WHERE id = ?",
                [
                    $input['company_name'],
                    $input['certification'] ?? '',
                    $input['welcome_title'] ?? '',
                    $input['logo_path'] ?? '',
                    $input['address'] ?? '',
                    $input['phone'] ?? '',
                    $input['phone_alt'] ?? '',
                    $input['email'] ?? '',
                    $input['email_alt'] ?? '',
                    $existing['id']
                ]
            );
        } else {
            executeQuery(
                "INSERT INTO company_info (company_name, certification, welcome_title, logo_path, address, phone, phone_alt, email, email_alt)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [
                    $input['company_name'],
                    $input['certification'] ?? '',
                    $input['welcome_title'] ?? '',
                    $input['logo_path'] ?? '',
                    $input['address'] ?? '',
                    $input['phone'] ?? '',
                    $input['phone_alt'] ?? '',
                    $input['email'] ?? '',
                    $input['email_alt'] ?? ''
                ]
            );
        }

        sendResponse(['message' => 'Company information saved successfully']);

    } catch (Exception $e) {
        sendError('Failed to save company info: ' . $e->getMessage(), 500);
    }
}

/**
 * Get about content
 */
function handleGetAbout() {
    try {
        $content = fetchAll("SELECT * FROM about_content WHERE is_active = 1 ORDER BY sort_order, id");
        sendResponse($content);
    } catch (Exception $e) {
        sendError('Failed to fetch about content: ' . $e->getMessage(), 500);
    }
}

/**
 * Save about content
 */
function handleSaveAbout() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['content'])) {
        sendError('Invalid input data');
    }

    try {
        beginTransaction();

        // Clear existing content
        executeQuery("DELETE FROM about_content");

        // Insert new content
        $sortOrder = 1;
        foreach ($input['content'] as $item) {
            executeQuery(
                "INSERT INTO about_content (content_type, content_title, content_text, sort_order, is_active)
                 VALUES (?, ?, ?, ?, 1)",
                [
                    $item['type'] ?? 'paragraph',
                    $item['title'] ?? '',
                    $item['text'] ?? '',
                    $sortOrder++
                ]
            );
        }

        commit();
        sendResponse(['message' => 'About content saved successfully']);

    } catch (Exception $e) {
        rollback();
        sendError('Failed to save about content: ' . $e->getMessage(), 500);
    }
}

/**
 * Get all products
 */
function handleGetProducts() {
    try {
        $products = fetchAll("SELECT * FROM products WHERE is_active = 1 ORDER BY sort_order, created_at DESC");

        // Parse JSON features
        foreach ($products as &$product) {
            $product['features'] = json_decode($product['features'], true) ?? [];
        }

        sendResponse($products);
    } catch (Exception $e) {
        sendError('Failed to fetch products: ' . $e->getMessage(), 500);
    }
}

/**
 * Add new product
 */
function handleAddProduct() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    $required = ['name', 'category', 'description'];
    $missing = validateRequired($input, $required);

    if (!empty($missing)) {
        sendError('Missing required fields: ' . implode(', ', $missing));
    }

    try {
        $features = isset($input['features']) ? json_encode($input['features']) : '[]';

        executeQuery(
            "INSERT INTO products (name, category, description, features, min_price, max_price, badge, image_url, image_class, is_featured, sort_order)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $input['name'],
                $input['category'],
                $input['description'],
                $features,
                $input['min_price'] ?? null,
                $input['max_price'] ?? null,
                $input['badge'] ?? null,
                $input['image_url'] ?? null,
                $input['image_class'] ?? null,
                isset($input['is_featured']) ? (int)(bool)$input['is_featured'] : 0,
                $input['sort_order'] ?? 0
            ]
        );

        $productId = getLastInsertId();
        sendResponse(['message' => 'Product added successfully', 'product_id' => $productId]);

    } catch (Exception $e) {
        sendError('Failed to add product: ' . $e->getMessage(), 500);
    }
}

/**
 * Update existing product
 */
function handleUpdateProduct() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['id'])) {
        sendError('Product ID is required');
    }

    $required = ['name', 'category', 'description'];
    $missing = validateRequired($input, $required);

    if (!empty($missing)) {
        sendError('Missing required fields: ' . implode(', ', $missing));
    }

    try {
        $features = isset($input['features']) ? json_encode($input['features']) : '[]';

        executeQuery(
            "UPDATE products SET
             name = ?, category = ?, description = ?, features = ?, min_price = ?, max_price = ?,
             badge = ?, image_url = ?, image_class = ?, is_featured = ?, sort_order = ?,
             updated_at = CURRENT_TIMESTAMP
             WHERE id = ? AND is_active = 1",
            [
                $input['name'],
                $input['category'],
                $input['description'],
                $features,
                $input['min_price'] ?? null,
                $input['max_price'] ?? null,
                $input['badge'] ?? null,
                $input['image_url'] ?? null,
                $input['image_class'] ?? null,
                isset($input['is_featured']) ? (int)(bool)$input['is_featured'] : 0,
                $input['sort_order'] ?? 0,
                $input['id']
            ]
        );

        sendResponse(['message' => 'Product updated successfully']);

    } catch (Exception $e) {
        sendError('Failed to update product: ' . $e->getMessage(), 500);
    }
}

/**
 * Delete product
 */
function handleDeleteProduct() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['id'])) {
        sendError('Product ID is required');
    }

    try {
        executeQuery("UPDATE products SET is_active = 0, updated_at = CURRENT_TIMESTAMP WHERE id = ?", [$input['id']]);
        sendResponse(['message' => 'Product deleted successfully']);

    } catch (Exception $e) {
        sendError('Failed to delete product: ' . $e->getMessage(), 500);
    }
}

/**
 * Get navigation menu
 */
function handleGetNavigation() {
    try {
        $menu = fetchAll("SELECT * FROM navigation_menu WHERE is_active = 1 ORDER BY sort_order");
        sendResponse($menu);
    } catch (Exception $e) {
        sendError('Failed to fetch navigation: ' . $e->getMessage(), 500);
    }
}

/**
 * Save navigation menu
 */
function handleSaveNavigation() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['menu'])) {
        sendError('Invalid input data');
    }

    try {
        beginTransaction();

        // Clear existing menu
        executeQuery("DELETE FROM navigation_menu");

        // Insert new menu items
        foreach ($input['menu'] as $index => $item) {
            executeQuery(
                "INSERT INTO navigation_menu (page_key, page_title, page_url, sort_order, is_active)
                 VALUES (?, ?, ?, ?, 1)",
                [
                    $item['page_key'] ?? '',
                    $item['page_title'] ?? '',
                    $item['page_url'] ?? '',
                    $index + 1
                ]
            );
        }

        commit();
        sendResponse(['message' => 'Navigation menu saved successfully']);

    } catch (Exception $e) {
        rollback();
        sendError('Failed to save navigation: ' . $e->getMessage(), 500);
    }
}

/**
 * Get statistics
 */
function handleGetStatistics() {
    try {
        $stats = fetchAll("SELECT * FROM statistics WHERE is_active = 1 ORDER BY sort_order");
        sendResponse($stats);
    } catch (Exception $e) {
        sendError('Failed to fetch statistics: ' . $e->getMessage(), 500);
    }
}

/**
 * Save statistics
 */
function handleSaveStatistics() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || !isset($input['statistics'])) {
        sendError('Invalid input data');
    }

    try {
        beginTransaction();

        foreach ($input['statistics'] as $stat) {
            if (isset($stat['id']) && $stat['id']) {
                // Update existing
                executeQuery(
                    "UPDATE statistics SET stat_value = ?, stat_label = ?, icon = ?, sort_order = ?, updated_at = CURRENT_TIMESTAMP
                     WHERE id = ?",
                    [$stat['stat_value'], $stat['stat_label'], $stat['icon'] ?? '', $stat['sort_order'] ?? 0, $stat['id']]
                );
            } else {
                // Insert new
                executeQuery(
                    "INSERT INTO statistics (stat_key, stat_value, stat_label, icon, sort_order, is_active)
                     VALUES (?, ?, ?, ?, ?, 1)",
                    [
                        $stat['stat_key'] ?? uniqid('stat_'),
                        $stat['stat_value'],
                        $stat['stat_label'],
                        $stat['icon'] ?? '',
                        $stat['sort_order'] ?? 0
                    ]
                );
            }
        }

        commit();
        sendResponse(['message' => 'Statistics saved successfully']);

    } catch (Exception $e) {
        rollback();
        sendError('Failed to save statistics: ' . $e->getMessage(), 500);
    }
}

/**
 * Handle file upload
 */
function handleFileUpload() {
    // Debug logging
    error_log("File upload request received. Method: " . $_SERVER['REQUEST_METHOD']);
    error_log("FILES array: " . print_r($_FILES, true));
    error_log("POST array: " . print_r($_POST, true));
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendError('Method not allowed', 405);
    }

    if (!isset($_FILES['file'])) {
        sendError('No file uploaded');
    }

    $file = $_FILES['file'];
    $context = $_POST['context'] ?? 'general';

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        sendError('Upload error: ' . $file['error']);
    }

    // Validate file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        sendError('Invalid file type. Only images are allowed. Got: ' . $file['type']);
    }

    $maxSize = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $maxSize) {
        sendError('File too large. Maximum size is 5MB.');
    }

    try {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = uniqid() . '_' . basename($file['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Save to database
            executeQuery(
                "INSERT INTO file_uploads (original_name, file_name, file_path, file_size, file_type, upload_context)
                 VALUES (?, ?, ?, ?, ?, ?)",
                [
                    $file['name'],
                    $fileName,
                    $filePath,
                    $file['size'],
                    $file['type'],
                    $context
                ]
            );

            $fileId = getLastInsertId();

            sendResponse([
                'message' => 'File uploaded successfully',
                'file_id' => $fileId,
                'file_path' => $filePath,
                'file_name' => $fileName
            ]);
        } else {
            sendError('Failed to move uploaded file to: ' . $filePath, 500);
        }

    } catch (Exception $e) {
        sendError('Upload error: ' . $e->getMessage(), 500);
    }
}

/**
 * Get dashboard data
 */
function handleGetDashboard() {
    try {
        $data = [];

        // Count statistics
        $data['total_products'] = fetchOne("SELECT COUNT(*) as count FROM products WHERE is_active = 1")['count'];
        $data['featured_products'] = fetchOne("SELECT COUNT(*) as count FROM products WHERE is_active = 1 AND is_featured = 1")['count'];
        $data['total_uploads'] = fetchOne("SELECT COUNT(*) as count FROM file_uploads")['count'];

        // Recent products
        $data['recent_products'] = fetchAll("SELECT name, category, created_at FROM products WHERE is_active = 1 ORDER BY created_at DESC LIMIT 5");

        // Category breakdown
        $data['category_stats'] = fetchAll("
            SELECT category, COUNT(*) as count
            FROM products
            WHERE is_active = 1
            GROUP BY category
        ");

        // Statistics
        $data['site_statistics'] = fetchAll("SELECT stat_key, stat_value, stat_label FROM statistics WHERE is_active = 1 ORDER BY sort_order");

        sendResponse($data);

    } catch (Exception $e) {
        sendError('Failed to fetch dashboard data: ' . $e->getMessage(), 500);
    }
}

// ===== CERTIFICATIONS HANDLERS =====

function handleGetCertifications() {
    try {
        $certifications = fetchAll("SELECT * FROM certifications ORDER BY sort_order ASC, created_at DESC");
        sendResponse($certifications);
    } catch (Exception $e) {
        sendError('Failed to fetch certifications: ' . $e->getMessage(), 500);
    }
}

function handleAddCertification() {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $result = executeQuery("
            INSERT INTO certifications (title, description, image_path, sort_order, is_active)
            VALUES (?, ?, ?, ?, ?)
        ", [
            $data['title'],
            $data['description'],
            $data['image_path'] ?? null,
            $data['sort_order'] ?? 0,
            $data['is_active'] ?? 1
        ]);

        if ($result) {
            $id = getLastInsertId();
            sendResponse(['id' => $id, 'message' => 'Certification added successfully']);
        } else {
            sendError('Failed to add certification', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to add certification: ' . $e->getMessage(), 500);
    }
}

function handleUpdateCertification() {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        
        $result = executeQuery("
            UPDATE certifications 
            SET title = ?, description = ?, image_path = ?, sort_order = ?, is_active = ?
            WHERE id = ?
        ", [
            $data['title'],
            $data['description'],
            $data['image_path'] ?? null,
            $data['sort_order'] ?? 0,
            $data['is_active'] ?? 1,
            $id
        ]);

        if ($result) {
            sendResponse(['message' => 'Certification updated successfully']);
        } else {
            sendError('Failed to update certification', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to update certification: ' . $e->getMessage(), 500);
    }
}

function handleDeleteCertification() {
    try {
        $id = $_GET['id'];
        
        $result = executeQuery("DELETE FROM certifications WHERE id = ?", [$id]);
        
        if ($result) {
            sendResponse(['message' => 'Certification deleted successfully']);
        } else {
            sendError('Failed to delete certification', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to delete certification: ' . $e->getMessage(), 500);
    }
}

// ===== LATEST WORK HANDLERS =====

function handleGetLatestWork() {
    try {
        $latestWork = fetchAll("SELECT * FROM latest_work ORDER BY sort_order ASC, project_date DESC");
        sendResponse($latestWork);
    } catch (Exception $e) {
        sendError('Failed to fetch latest work: ' . $e->getMessage(), 500);
    }
}

function handleAddLatestWork() {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $result = executeQuery("
            INSERT INTO latest_work (title, description, category, image_path, project_date, location, sort_order, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ", [
            $data['title'],
            $data['description'],
            $data['category'],
            $data['image_path'] ?? null,
            $data['project_date'],
            $data['location'],
            $data['sort_order'] ?? 0,
            $data['is_active'] ?? 1
        ]);

        if ($result) {
            $id = getLastInsertId();
            sendResponse(['id' => $id, 'message' => 'Latest work added successfully']);
        } else {
            sendError('Failed to add latest work', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to add latest work: ' . $e->getMessage(), 500);
    }
}

function handleUpdateLatestWork() {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        
        $result = executeQuery("
            UPDATE latest_work 
            SET title = ?, description = ?, category = ?, image_path = ?, project_date = ?, location = ?, sort_order = ?, is_active = ?
            WHERE id = ?
        ", [
            $data['title'],
            $data['description'],
            $data['category'],
            $data['image_path'] ?? null,
            $data['project_date'],
            $data['location'],
            $data['sort_order'] ?? 0,
            $data['is_active'] ?? 1,
            $id
        ]);

        if ($result) {
            sendResponse(['message' => 'Latest work updated successfully']);
        } else {
            sendError('Failed to update latest work', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to update latest work: ' . $e->getMessage(), 500);
    }
}

function handleDeleteLatestWork() {
    try {
        $id = $_GET['id'];
        
        $result = executeQuery("DELETE FROM latest_work WHERE id = ?", [$id]);
        
        if ($result) {
            sendResponse(['message' => 'Latest work deleted successfully']);
        } else {
            sendError('Failed to delete latest work', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to delete latest work: ' . $e->getMessage(), 500);
    }
}

// ===== BLOGS HANDLERS =====

function handleGetBlogs() {
    try {
        $blogs = fetchAll("SELECT * FROM blogs ORDER BY sort_order ASC, publish_date DESC");
        sendResponse($blogs);
    } catch (Exception $e) {
        sendError('Failed to fetch blogs: ' . $e->getMessage(), 500);
    }
}

function handleAddBlog() {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $result = executeQuery("
            INSERT INTO blogs (title, description, category, content, image_path, publish_date, author, sort_order, is_active)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ", [
            $data['title'],
            $data['description'],
            $data['category'],
            $data['content'],
            $data['image_path'] ?? null,
            $data['publish_date'],
            $data['author'],
            $data['sort_order'] ?? 0,
            $data['is_active'] ?? 1
        ]);

        if ($result) {
            $id = getLastInsertId();
            sendResponse(['id' => $id, 'message' => 'Blog added successfully']);
        } else {
            sendError('Failed to add blog', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to add blog: ' . $e->getMessage(), 500);
    }
}

function handleUpdateBlog() {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        
        $result = executeQuery("
            UPDATE blogs 
            SET title = ?, description = ?, category = ?, content = ?, image_path = ?, publish_date = ?, author = ?, sort_order = ?, is_active = ?
            WHERE id = ?
        ", [
            $data['title'],
            $data['description'],
            $data['category'],
            $data['content'],
            $data['image_path'] ?? null,
            $data['publish_date'],
            $data['author'],
            $data['sort_order'] ?? 0,
            $data['is_active'] ?? 1,
            $id
        ]);

        if ($result) {
            sendResponse(['message' => 'Blog updated successfully']);
        } else {
            sendError('Failed to update blog', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to update blog: ' . $e->getMessage(), 500);
    }
}

function handleDeleteBlog() {
    try {
        $id = $_GET['id'];
        
        $result = executeQuery("DELETE FROM blogs WHERE id = ?", [$id]);
        
        if ($result) {
            sendResponse(['message' => 'Blog deleted successfully']);
        } else {
            sendError('Failed to delete blog', 500);
        }
    } catch (Exception $e) {
        sendError('Failed to delete blog: ' . $e->getMessage(), 500);
    }
}

?>
