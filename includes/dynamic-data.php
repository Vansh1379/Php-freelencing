<?php
/**
 * Dynamic Data Handler
 * Loads data from database for frontend display
 */

// Include database connection
require_once 'database.php';

/**
 * Get all products from database
 */
function getProductsFromDatabase() {
    try {
        $products = fetchAll("SELECT * FROM products WHERE is_active = 1 ORDER BY sort_order, created_at DESC");
        
        // Parse JSON features and format data for frontend
        $formattedProducts = [];
        foreach ($products as $product) {
            $features = json_decode($product['features'], true) ?? [];
            
            // Format price range
            $priceRange = '';
            if ($product['min_price'] && $product['max_price']) {
                $priceRange = '₹' . number_format($product['min_price']) . ' - ₹' . number_format($product['max_price']);
            } elseif ($product['min_price']) {
                $priceRange = '₹' . number_format($product['min_price']) . '+';
            }
            
            $formattedProducts[] = [
                'title' => $product['name'],
                'description' => $product['description'],
                'features' => $features,
                'price' => $priceRange,
                'category' => $product['category'],
                'badge' => $product['badge'],
                'image_url' => $product['image_url'],
                'image_class' => $product['image_class'] ?: $product['category'] . '-bg',
                'button_text' => 'Get Quote',
                'button_action' => 'quote'
            ];
        }
        
        return $formattedProducts;
        } catch (Exception $e) {
        error_log("Error loading products from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Get products by category from database
 */
function getProductsByCategoryFromDatabase($category = 'all') {
    $allProducts = getProductsFromDatabase();
    
    if ($category === 'all') {
        return $allProducts;
    }
    
    return array_filter($allProducts, function($product) use ($category) {
        return $product['category'] === $category;
    });
}

/**
 * Get featured products from database
 */
function getFeaturedProductsFromDatabase() {
    try {
        $products = fetchAll("SELECT * FROM products WHERE is_active = 1 AND is_featured = 1 ORDER BY sort_order, created_at DESC");
        
        $formattedProducts = [];
        foreach ($products as $product) {
            $features = json_decode($product['features'], true) ?? [];
            
            $priceRange = '';
            if ($product['min_price'] && $product['max_price']) {
                $priceRange = '₹' . number_format($product['min_price']) . ' - ₹' . number_format($product['max_price']);
            } elseif ($product['min_price']) {
                $priceRange = '₹' . number_format($product['min_price']) . '+';
            }
            
            $formattedProducts[] = [
                'title' => $product['name'],
                'description' => $product['description'],
                'features' => $features,
                'price' => $priceRange,
                'category' => $product['category'],
                'badge' => $product['badge'],
                'image_url' => $product['image_url'],
                'image_class' => $product['image_class'] ?: $product['category'] . '-bg',
                'button_text' => 'Get Quote',
                'button_action' => 'quote'
            ];
        }
        
        return $formattedProducts;
        } catch (Exception $e) {
        error_log("Error loading featured products from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Get site settings from database
 */
function getSiteSettingsFromDatabase() {
    try {
        $settings = fetchAll("SELECT setting_key, setting_value FROM site_settings");
        
        $formattedSettings = [];
        foreach ($settings as $setting) {
            $formattedSettings[$setting['setting_key']] = $setting['setting_value'];
        }
        
        return $formattedSettings;
    } catch (Exception $e) {
        error_log("Error loading site settings from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Get company information from database
 */
function getCompanyInfoFromDatabase() {
    try {
        $company = fetchOne("SELECT * FROM company_info ORDER BY id DESC LIMIT 1");
        return $company ?: [];
        } catch (Exception $e) {
        error_log("Error loading company info from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Get hero section data from database
 */
function getHeroSectionFromDatabase() {
    try {
        $hero = fetchOne("SELECT * FROM hero_section WHERE is_active = 1 ORDER BY id DESC LIMIT 1");
        return $hero ?: [];
        } catch (Exception $e) {
        error_log("Error loading hero section from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Get statistics from database
 */
function getStatisticsFromDatabase() {
    try {
        $stats = fetchAll("SELECT * FROM statistics WHERE is_active = 1 ORDER BY sort_order");
        return $stats;
    } catch (Exception $e) {
        error_log("Error loading statistics from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Fallback to static data if database is empty
 */
function getProductsWithFallback() {
    $dbProducts = getProductsFromDatabase();
    
    // If no products in database, use static fallback
    if (empty($dbProducts)) {
        // Include the static products config as fallback
        include_once 'products-config.php';
        return $allProducts;
    }
    
    return $dbProducts;
}

/**
 * Get hero section data from database
 */
function getHeroData() {
    try {
        $hero = fetchOne("SELECT * FROM hero_section WHERE is_active = 1 ORDER BY id DESC LIMIT 1");
        
        if (!$hero) {
            // Return default data
            $hero = [
                'title' => 'Premium Playground Equipment',
                'description' => 'We create safe, fun, and engaging play spaces for children of all ages. With 30+ years of experience, we deliver quality equipment that sparks imagination and provides healthy development.',
                'button1_text' => 'Explore Products',
                'button1_link' => '#products',
                'button2_text' => 'Watch Demo',
                'button2_link' => '#contact',
                'background_image' => ''
            ];
        }
        
        return $hero;
    } catch (Exception $e) {
        error_log("Error loading hero data from database: " . $e->getMessage());
        return [
            'title' => 'Premium Playground Equipment',
            'description' => 'We create safe, fun, and engaging play spaces for children of all ages.',
            'button1_text' => 'Explore Products',
            'button1_link' => '#products',
            'button2_text' => 'Watch Demo',
            'button2_link' => '#contact'
        ];
    }
}

/**
 * Get company information from database
 */
function getCompanyInfo() {
    try {
        $company = fetchOne("SELECT * FROM company_info ORDER BY id DESC LIMIT 1");
        
        if (!$company) {
            $company = [
                'company_name' => 'MEMA PLAY WORLD',
                'certification' => 'AN ISO 9001:2015 CERTIFIED COMPANY',
                'welcome_title' => 'Welcome to Mena Play World',
                'logo_path' => 'assets/logo.png',
                'address' => 'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India',
                'phone' => '+91 9773698785',
                'phone_alt' => '+91 9560243588',
                'email' => 'contact.jkenterprise@gmail.com',
                'email_alt' => ''
            ];
        }
        
        return $company;
    } catch (Exception $e) {
        error_log("Error loading company info from database: " . $e->getMessage());
        return [
            'company_name' => 'MEMA PLAY WORLD',
            'certification' => 'AN ISO 9001:2015 CERTIFIED COMPANY',
            'address' => 'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India',
            'phone' => '+91 9773698785',
            'phone_alt' => '+91 9560243588',
            'email' => 'contact.jkenterprise@gmail.com'
        ];
    }
}

/**
 * Get website statistics from database
 */
function getWebsiteStatistics() {
    try {
        $stats = fetchAll("SELECT * FROM statistics WHERE is_active = 1 ORDER BY sort_order");
        return $stats;
    } catch (Exception $e) {
        error_log("Error loading statistics from database: " . $e->getMessage());
        return [
            ['stat_value' => '10+', 'stat_label' => 'Years Experience'],
            ['stat_value' => '500+', 'stat_label' => 'Projects Completed'],
            ['stat_value' => '9 ISO', 'stat_label' => 'Certified Quality'],
            ['stat_value' => '500+', 'stat_label' => 'Happy Customers']
        ];
    }
}

/**
 * Get home page products (limited number)
 */
function getHomePageProducts($limit = 3) {
    try {
        $products = fetchAll("SELECT * FROM products WHERE is_active = 1 AND is_featured = 1 ORDER BY sort_order, created_at DESC LIMIT ?", [$limit]);
        
        // If no featured products, get any products
        if (empty($products)) {
            $products = fetchAll("SELECT * FROM products WHERE is_active = 1 ORDER BY sort_order, created_at DESC LIMIT ?", [$limit]);
        }
        
        // Parse JSON features and format data for frontend
        $formattedProducts = [];
        foreach ($products as $product) {
            $features = json_decode($product['features'], true) ?? [];
            
            // Format price range
            $priceRange = '';
            if ($product['min_price'] && $product['max_price']) {
                $priceRange = '₹' . number_format($product['min_price']) . ' - ₹' . number_format($product['max_price']);
            } elseif ($product['min_price']) {
                $priceRange = '₹' . number_format($product['min_price']) . '+';
            }
            
            $formattedProducts[] = [
                'title' => $product['name'],
                'description' => $product['description'],
                'features' => $features,
                'price' => $priceRange,
                'category' => $product['category'],
                'badge' => $product['badge'],
                'image_url' => $product['image_url'],
                'image_class' => $product['image_class'] ?: $product['category'] . '-bg',
                'button_text' => 'Get Quote',
                'button_action' => 'quote'
            ];
        }
        
        return $formattedProducts;
    } catch (Exception $e) {
        error_log("Error loading home page products from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Get about content from database
 */
function getAboutContent() {
    try {
        $content = fetchAll("SELECT * FROM about_content WHERE is_active = 1 ORDER BY sort_order, id");
        return $content;
    } catch (Exception $e) {
        error_log("Error loading about content from database: " . $e->getMessage());
        return [];
    }
}

/**
 * Convert database product to card format
 */
function convertProductToCard($product) {
    return [
        'title' => $product['title'],
        'description' => $product['description'],
        'features' => $product['features'],
        'price' => $product['price'],
        'category' => $product['category'],
        'badge' => $product['badge'],
        'image_url' => $product['image_url'],
        'image_class' => $product['image_class'],
        'button_text' => $product['button_text'],
        'button_action' => $product['button_action']
    ];
}
?>