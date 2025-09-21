<?php
/**
 * Database Configuration and Connection Handler
 * Mena Play World Admin Panel Backend
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mena');
define('DB_SOCKET', '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

// Database Connection Class
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            if (defined('DB_SOCKET') && file_exists(DB_SOCKET)) {
                $dsn .= ";unix_socket=" . DB_SOCKET;
            }
            
            $this->connection = new PDO(
                $dsn,
                DB_USERNAME,
                DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    // Prevent cloning and unserialization
    private function __clone() {}
    public function __wakeup() {}
}

// Database Helper Functions
function getDB() {
    return Database::getInstance()->getConnection();
}

/**
 * Execute a SELECT query and return results
 */
function fetchAll($query, $params = []) {
    $db = getDB();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Execute a SELECT query and return single row
 */
function fetchOne($query, $params = []) {
    $db = getDB();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetch();
}

/**
 * Execute INSERT, UPDATE, DELETE queries
 */
function executeQuery($query, $params = []) {
    $db = getDB();
    $stmt = $db->prepare($query);
    return $stmt->execute($params);
}

/**
 * Get last inserted ID
 */
function getLastInsertId() {
    return getDB()->lastInsertId();
}

/**
 * Begin transaction
 */
function beginTransaction() {
    return getDB()->beginTransaction();
}

/**
 * Commit transaction
 */
function commit() {
    return getDB()->commit();
}

/**
 * Rollback transaction
 */
function rollback() {
    return getDB()->rollBack();
}

/**
 * Initialize database with required tables
 */
function initializeDatabase() {
    $db = getDB();

    // Create site_settings table
    $db->exec("
        CREATE TABLE IF NOT EXISTS site_settings (
            id INT PRIMARY KEY AUTO_INCREMENT,
            setting_key VARCHAR(100) NOT NULL UNIQUE,
            setting_value TEXT,
            setting_type ENUM('text', 'textarea', 'json', 'image', 'email', 'phone') DEFAULT 'text',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    // Create hero_section table
    $db->exec("
        CREATE TABLE IF NOT EXISTS hero_section (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            button1_text VARCHAR(100),
            button1_link VARCHAR(255),
            button2_text VARCHAR(100),
            button2_link VARCHAR(255),
            background_image VARCHAR(255),
            is_active BOOLEAN DEFAULT TRUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    // Create company_info table
    $db->exec("
        CREATE TABLE IF NOT EXISTS company_info (
            id INT PRIMARY KEY AUTO_INCREMENT,
            company_name VARCHAR(255) NOT NULL,
            certification VARCHAR(255),
            logo_path VARCHAR(255),
            welcome_title VARCHAR(255),
            address TEXT,
            phone VARCHAR(20),
            phone_alt VARCHAR(20),
            email VARCHAR(255),
            email_alt VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    // Create about_content table
    $db->exec("
        CREATE TABLE IF NOT EXISTS about_content (
            id INT PRIMARY KEY AUTO_INCREMENT,
            content_type VARCHAR(50) NOT NULL,
            content_title VARCHAR(255),
            content_text LONGTEXT,
            sort_order INT DEFAULT 0,
            is_active BOOLEAN DEFAULT TRUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    // Create products table
    $db->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            category ENUM('playground', 'outdoor', 'indoor') NOT NULL,
            description TEXT,
            features JSON,
            min_price DECIMAL(10,2),
            max_price DECIMAL(10,2),
            badge VARCHAR(50),
            image_url VARCHAR(255),
            image_class VARCHAR(100),
            is_featured BOOLEAN DEFAULT FALSE,
            is_active BOOLEAN DEFAULT TRUE,
            sort_order INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    // Create navigation_menu table
    $db->exec("
        CREATE TABLE IF NOT EXISTS navigation_menu (
            id INT PRIMARY KEY AUTO_INCREMENT,
            page_key VARCHAR(50) NOT NULL,
            page_title VARCHAR(100) NOT NULL,
            page_url VARCHAR(255) NOT NULL,
            sort_order INT DEFAULT 0,
            is_active BOOLEAN DEFAULT TRUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    // Create statistics table
    $db->exec("
        CREATE TABLE IF NOT EXISTS statistics (
            id INT PRIMARY KEY AUTO_INCREMENT,
            stat_key VARCHAR(100) NOT NULL UNIQUE,
            stat_value VARCHAR(50) NOT NULL,
            stat_label VARCHAR(100) NOT NULL,
            icon VARCHAR(100),
            sort_order INT DEFAULT 0,
            is_active BOOLEAN DEFAULT TRUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");

    // Create file_uploads table
    $db->exec("
        CREATE TABLE IF NOT EXISTS file_uploads (
            id INT PRIMARY KEY AUTO_INCREMENT,
            original_name VARCHAR(255) NOT NULL,
            file_name VARCHAR(255) NOT NULL,
            file_path VARCHAR(500) NOT NULL,
            file_size INT,
            file_type VARCHAR(100),
            upload_context VARCHAR(100),
            uploaded_by VARCHAR(100),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Insert default data
    insertDefaultData();

    return true;
}

/**
 * Insert default data for initial setup
 */
function insertDefaultData() {
    $db = getDB();

    // Default site settings
    $defaultSettings = [
        ['site_name', 'Mena Play World', 'text'],
        ['site_tagline', 'Solution Equipment', 'text'],
        ['company_name', 'JK Enterprise', 'text'],
        ['contact_email', 'contact.jkenterprise@gmail.com', 'email'],
        ['contact_phone', '+91 9773698785', 'phone'],
        ['contact_phone_alt', '+91 9560243588', 'phone'],
        ['company_address', 'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India', 'textarea'],
        ['logo_path', 'assets/logo.png', 'image']
    ];

    foreach ($defaultSettings as $setting) {
        $db->prepare("
            INSERT IGNORE INTO site_settings (setting_key, setting_value, setting_type)
            VALUES (?, ?, ?)
        ")->execute($setting);
    }

    // Default hero section
    $db->prepare("
        INSERT IGNORE INTO hero_section (id, title, description, button1_text, button1_link, button2_text, button2_link)
        VALUES (1, ?, ?, ?, ?, ?, ?)
    ")->execute([
        'Premium Playground Equipment',
        'We create safe, fun, and engaging play spaces for children of all ages. With 30+ years of experience, we deliver quality equipment that sparks imagination and provides healthy development.',
        'Explore Products',
        '#products',
        'Watch Demo',
        '#contact'
    ]);

    // Default company info
    $db->prepare("
        INSERT IGNORE INTO company_info (id, company_name, certification, welcome_title, address, phone, phone_alt, email)
        VALUES (1, ?, ?, ?, ?, ?, ?, ?)
    ")->execute([
        'MEMA PLAY WORLD',
        'AN ISO 9001:2015 CERTIFIED COMPANY',
        'Welcome to Mena Play World',
        'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India',
        '+91 9773698785',
        '+91 9560243588',
        'contact.jkenterprise@gmail.com'
    ]);

    // Default navigation menu
    $defaultMenu = [
        ['index', 'Home', 'index.php', 1],
        ['about', 'About', 'about.php', 2],
        ['products', 'Products', 'products.php', 3],
        ['contact', 'Contact', 'contact.php', 4]
    ];

    foreach ($defaultMenu as $index => $item) {
        $db->prepare("
            INSERT IGNORE INTO navigation_menu (page_key, page_title, page_url, sort_order)
            VALUES (?, ?, ?, ?)
        ")->execute($item);
    }

    // Default statistics
    $defaultStats = [
        ['years_experience', '10+', 'Years Experience', '🏆', 1],
        ['projects_completed', '500+', 'Projects Completed', '📈', 2],
        ['quality_certification', '9 ISO', 'Certified Quality', '🛡️', 3],
        ['happy_customers', '500+', 'Happy Customers', '😊', 4],
        ['total_products', '1000+', 'Total Products', '📦', 5],
        ['team_members', '50+', 'Team Members', '👥', 6]
    ];

    foreach ($defaultStats as $stat) {
        $db->prepare("
            INSERT IGNORE INTO statistics (stat_key, stat_value, stat_label, icon, sort_order)
            VALUES (?, ?, ?, ?, ?)
        ")->execute($stat);
    }
}

// Test database connection on file include
try {
    Database::getInstance();
} catch (Exception $e) {
    error_log("Database connection error: " . $e->getMessage());
}
?>
