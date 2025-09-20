<?php
/**
 * Products Configuration File
 * Centralized product data management for Mena Play World
 *
 * This file contains all product definitions used across the website.
 * Modify products here instead of in individual page files.
 */

// Home Page Products (simplified view)
$homePageProducts = [
    [
        'title' => 'Playground Equipment',
        'description' => 'Safe, colorful, and imaginative play structures that foster creativity and physical development.',
        'features' => [
            'Multi-play structures',
            'Climbing equipment',
            'Slides & swings',
            'Spring riders'
        ],
        'image_class' => 'playground-bg',
        'button_text' => 'View Products',
        'button_action' => 'link',
        'button_link' => 'products.php#playground',
        'show_price' => false
    ],
    [
        'title' => 'Outdoor Gym Equipment',
        'description' => 'Durable fitness solutions for outdoor spaces, promoting health and wellness in communities.',
        'features' => [
            'Cardio stations',
            'Strength training',
            'Flexibility equipment',
            'Weather resistant'
        ],
        'image_class' => 'outdoor-bg',
        'button_text' => 'View Products',
        'button_action' => 'link',
        'button_link' => 'products.php#outdoor',
        'show_price' => false
    ],
    [
        'title' => 'Indoor Gym Solutions',
        'description' => 'Complete indoor fitness and play solutions designed for schools, clubs, and residential complexes.',
        'features' => [
            'Modular designs',
            'Space-efficient',
            'Easy installation',
            'Low maintenance'
        ],
        'image_class' => 'indoor-bg',
        'button_text' => 'View Products',
        'button_action' => 'link',
        'button_link' => 'products.php#indoor',
        'show_price' => false
    ]
];

// Full Product Catalog (detailed view for products page)
$allProducts = [
    // PLAYGROUND EQUIPMENT
    [
        'title' => 'Multi-Play Structures',
        'description' => 'Comprehensive play systems that combine multiple activities in one exciting structure, perfect for parks and schools.',
        'features' => [
            'Multiple climbing options',
            'Integrated slides',
            'Safety railings',
            'Age-appropriate design'
        ],
        'price' => '₹2,50,000 - ₹8,00,000',
        'category' => 'playground',
        'badge' => 'Popular',
        'image_class' => 'playground-bg',
        'image_url' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Spring Riders',
        'description' => 'Fun and safe spring-mounted riding toys that provide hours of entertainment for young children.',
        'features' => [
            'Colorful animal designs',
            'Durable spring mechanism',
            'Non-slip handles',
            'Weather resistant'
        ],
        'price' => '₹15,000 - ₹35,000',
        'category' => 'playground',
        'image_class' => 'playground-bg',
        'image_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Swings & Slides',
        'description' => 'Classic playground favorites designed with modern safety features and vibrant colors.',
        'features' => [
            'Multiple swing types',
            'Various slide heights',
            'Safety chains',
            'UV resistant materials'
        ],
        'price' => '₹25,000 - ₹1,20,000',
        'category' => 'playground',
        'image_class' => 'playground-bg',
        'image_url' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Climbing Equipment',
        'description' => 'Challenging climbing structures that help develop strength, coordination, and confidence in children.',
        'features' => [
            'Rock climbing walls',
            'Rope climbing nets',
            'Monkey bars',
            'Safety mats included'
        ],
        'price' => '₹40,000 - ₹2,00,000',
        'category' => 'playground',
        'image_class' => 'playground-bg',
        'image_url' => 'https://images.unsplash.com/photo-1541698444083-023c97d3f4b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Seesaws & Merry-Go-Rounds',
        'description' => 'Traditional playground equipment with modern safety enhancements for group play activities.',
        'features' => [
            'Heavy-duty construction',
            'Safety handles',
            'Smooth operation',
            'Multiple user capacity'
        ],
        'price' => '₹30,000 - ₹85,000',
        'category' => 'playground',
        'image_class' => 'playground-bg',
        'image_url' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],

    // OUTDOOR GYM EQUIPMENT
    [
        'title' => 'Cardio Stations',
        'description' => 'Professional outdoor cardiovascular equipment designed to withstand all weather conditions.',
        'features' => [
            'Elliptical trainers',
            'Exercise bikes',
            'Rowing machines',
            'Galvanized steel frame'
        ],
        'price' => '₹45,000 - ₹1,50,000',
        'category' => 'outdoor',
        'badge' => 'New',
        'image_class' => 'outdoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Strength Training',
        'description' => 'Heavy-duty strength training equipment for outdoor fitness parks and community centers.',
        'features' => [
            'Multi-station units',
            'Pull-up bars',
            'Parallel bars',
            'Rust-proof coating'
        ],
        'price' => '₹35,000 - ₹1,25,000',
        'category' => 'outdoor',
        'image_class' => 'outdoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Flexibility Equipment',
        'description' => 'Stretching and flexibility stations that promote wellness and injury prevention.',
        'features' => [
            'Stretching posts',
            'Balance beams',
            'Flexibility wheels',
            'Instructional signage'
        ],
        'price' => '₹20,000 - ₹80,000',
        'category' => 'outdoor',
        'image_class' => 'outdoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1594736797933-d0b22d3f4ee2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Complete Gym Setup',
        'description' => 'Full outdoor gymnasium packages with multiple equipment stations for comprehensive fitness.',
        'features' => [
            '8-12 equipment stations',
            'Professional installation',
            'Maintenance support',
            'Custom layouts'
        ],
        'price' => '₹3,50,000 - ₹12,00,000',
        'category' => 'outdoor',
        'image_class' => 'outdoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Senior Citizen Equipment',
        'description' => 'Low-impact fitness equipment specifically designed for elderly users with safety features.',
        'features' => [
            'Low-impact exercises',
            'Safety handrails',
            'Easy accessibility',
            'Joint-friendly design'
        ],
        'price' => '₹25,000 - ₹75,000',
        'category' => 'outdoor',
        'image_class' => 'outdoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1594736797933-d0b22d3f4ee2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],

    // INDOOR GYM SOLUTIONS
    [
        'title' => 'Modular Gym Systems',
        'description' => 'Space-efficient indoor fitness solutions perfect for schools, offices, and residential complexes.',
        'features' => [
            'Compact design',
            'Easy assembly',
            'Multi-functional',
            'Low maintenance'
        ],
        'price' => '₹1,20,000 - ₹4,50,000',
        'category' => 'indoor',
        'badge' => 'Premium',
        'image_class' => 'indoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Kids Indoor Play',
        'description' => 'Safe and engaging indoor playground equipment designed for shopping malls and play centers.',
        'features' => [
            'Soft play structures',
            'Ball pools',
            'Climbing frames',
            'Safety padding'
        ],
        'price' => '₹2,00,000 - ₹8,00,000',
        'category' => 'indoor',
        'image_class' => 'indoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'School Gym Equipment',
        'description' => 'Educational fitness equipment designed specifically for school gymnasiums and sports facilities.',
        'features' => [
            'Age-appropriate sizing',
            'Educational benefits',
            'Durable construction',
            'Easy storage'
        ],
        'price' => '₹80,000 - ₹3,00,000',
        'category' => 'indoor',
        'image_class' => 'indoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Residential Solutions',
        'description' => 'Premium indoor fitness equipment designed for homes, apartments, and private residences.',
        'features' => [
            'Space optimization',
            'Quiet operation',
            'Premium finishes',
            'Custom installation'
        ],
        'price' => '₹60,000 - ₹2,50,000',
        'category' => 'indoor',
        'image_class' => 'indoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Therapy & Rehabilitation',
        'description' => 'Specialized equipment for physical therapy centers and rehabilitation facilities.',
        'features' => [
            'Medical-grade quality',
            'Rehabilitation focused',
            'Adjustable settings',
            'Professional support'
        ],
        'price' => '₹1,50,000 - ₹5,00,000',
        'category' => 'indoor',
        'badge' => 'Specialized',
        'image_class' => 'indoor-bg',
        'image_url' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ]
];

// Product Categories Configuration
$productCategories = [
    'all' => [
        'name' => 'All Products',
        'description' => 'Complete range of playground and fitness equipment'
    ],
    'playground' => [
        'name' => 'Playground Equipment',
        'description' => 'Safe and fun play structures for children',
        'icon' => '🏗️'
    ],
    'outdoor' => [
        'name' => 'Outdoor Gym',
        'description' => 'Weather-resistant fitness equipment for outdoor use',
        'icon' => '🏋️'
    ],
    'indoor' => [
        'name' => 'Indoor Solutions',
        'description' => 'Space-efficient indoor fitness and play equipment',
        'icon' => '🏢'
    ]
];

// Featured Products (for special displays)
$featuredProducts = [
    'Multi-Play Structures',
    'Cardio Stations',
    'Modular Gym Systems'
];

// Product Badges Configuration
$productBadges = [
    'Popular' => [
        'color' => '#e74c3c',
        'text_color' => '#ffffff'
    ],
    'New' => [
        'color' => '#2ecc71',
        'text_color' => '#ffffff'
    ],
    'Premium' => [
        'color' => '#f39c12',
        'text_color' => '#ffffff'
    ],
    'Specialized' => [
        'color' => '#9b59b6',
        'text_color' => '#ffffff'
    ]
];

/**
 * Helper Functions for Product Management
 */

// Get products by category
function getProductsByCategory($category = 'all') {
    global $allProducts;

    if ($category === 'all') {
        return $allProducts;
    }

    return array_filter($allProducts, function($product) use ($category) {
        return $product['category'] === $category;
    });
}

// Get featured products
function getFeaturedProducts() {
    global $allProducts, $featuredProducts;

    return array_filter($allProducts, function($product) use ($featuredProducts) {
        return in_array($product['title'], $featuredProducts);
    });
}

// Get products with specific badge
function getProductsByBadge($badge) {
    global $allProducts;

    return array_filter($allProducts, function($product) use ($badge) {
        return isset($product['badge']) && $product['badge'] === $badge;
    });
}

// Get random products for suggestions
function getRandomProducts($count = 3, $excludeCategory = null) {
    global $allProducts;

    $products = $allProducts;

    if ($excludeCategory) {
        $products = array_filter($products, function($product) use ($excludeCategory) {
            return $product['category'] !== $excludeCategory;
        });
    }

    shuffle($products);
    return array_slice($products, 0, $count);
}

// Search products by title or description
function searchProducts($query) {
    global $allProducts;

    $query = strtolower($query);

    return array_filter($allProducts, function($product) use ($query) {
        return strpos(strtolower($product['title']), $query) !== false ||
               strpos(strtolower($product['description']), $query) !== false;
    });
}

// Get product count by category
function getProductCountByCategory() {
    global $allProducts;

    $counts = ['all' => count($allProducts)];

    foreach ($allProducts as $product) {
        $category = $product['category'];
        $counts[$category] = isset($counts[$category]) ? $counts[$category] + 1 : 1;
    }

    return $counts;
}

// Price range analysis
function getPriceRanges() {
    global $allProducts;

    $ranges = [];

    foreach ($allProducts as $product) {
        if (isset($product['price'])) {
            $category = $product['category'];
            if (!isset($ranges[$category])) {
                $ranges[$category] = [];
            }
            $ranges[$category][] = $product['price'];
        }
    }

    return $ranges;
}
?>
