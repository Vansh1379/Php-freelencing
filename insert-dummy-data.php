<?php
/**
 * Insert Dummy Data Script
 * Mena Play World - Populate database with sample data for testing
 */

// Include database configuration
require_once 'includes/database.php';

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html>\n";
echo "<html lang='en'>\n";
echo "<head>\n";
echo "    <meta charset='UTF-8'>\n";
echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
echo "    <title>Insert Dummy Data - Mena Play World</title>\n";
echo "    <style>\n";
echo "        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f5f5f5; }\n";
echo "        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }\n";
echo "        h1 { color: #333; text-align: center; margin-bottom: 30px; }\n";
echo "        .success { padding: 15px; border-left: 4px solid #28a745; background: #f0fff0; color: #155724; margin: 10px 0; }\n";
echo "        .error { padding: 15px; border-left: 4px solid #dc3545; background: #fff0f0; color: #721c24; margin: 10px 0; }\n";
echo "        .btn { display: inline-block; padding: 10px 20px; background: #007cba; color: white; text-decoration: none; border-radius: 5px; margin: 10px 5px; }\n";
echo "        .data-section { margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px; }\n";
echo "        .data-count { font-weight: bold; color: #007cba; }\n";
echo "    </style>\n";
echo "</head>\n";
echo "<body>\n";
echo "    <div class='container'>\n";
echo "        <h1>🚀 Insert Dummy Data - Mena Play World</h1>\n";

try {
    // Initialize database connection
    $db = getDB();

    echo "<div class='success'>✅ Database connection successful</div>\n";

    // Start transaction
    beginTransaction();

    echo "<h2>📊 Inserting Dummy Data...</h2>\n";

    // 1. Update Hero Section
    echo "<div class='data-section'><h3>🎯 Hero Section</h3>\n";
    executeQuery("UPDATE hero_section SET is_active = 0"); // Deactivate existing

    executeQuery(
        "INSERT INTO hero_section (title, description, button1_text, button1_link, button2_text, button2_link, background_image, is_active)
         VALUES (?, ?, ?, ?, ?, ?, ?, 1)",
        [
            'Premium Playground Equipment for Every Adventure',
            'Transform any space into an exciting playground with our ISO-certified, weather-resistant equipment. From traditional swings to modern multi-play structures, we create safe environments where children can learn, play, and grow together.',
            'Explore Our Products',
            'products.php',
            'Get Free Quote',
            'contact.php',
            'https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'
        ]
    );
    echo "<div class='success'>Hero section updated with engaging content</div></div>\n";

    // 2. Update Company Info
    echo "<div class='data-section'><h3>🏢 Company Information</h3>\n";
    executeQuery("DELETE FROM company_info");

    executeQuery(
        "INSERT INTO company_info (company_name, certification, welcome_title, logo_path, address, phone, phone_alt, email, email_alt)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
        [
            'MENA PLAY WORLD',
            'AN ISO 9001:2015 CERTIFIED COMPANY',
            'Welcome to Mena Play World - Your Playground Partner',
            'logo.png',
            'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India',
            '+91 9773698785',
            '+91 9560243588',
            'contact.jkenterprise@gmail.com',
            'jkenterprise1999@gmail.com'
        ]
    );
    echo "<div class='success'>Company information updated</div></div>\n";

    // 3. Insert Site Settings
    echo "<div class='data-section'><h3>⚙️ Site Settings</h3>\n";

    $settings = [
        ['site_name', 'Mena Play World', 'text'],
        ['site_tagline', 'Creating Dreams, Building Playgrounds', 'text'],
        ['site_description', 'Leading manufacturer of premium playground equipment in India. We specialize in creating safe, fun, and engaging play spaces for children with ISO-certified quality standards.', 'textarea'],
        ['company_name', 'JK Enterprise', 'text'],
        ['contact_email', 'contact.jkenterprise@gmail.com', 'email'],
        ['contact_phone', '+91 9773698785', 'phone'],
        ['contact_phone_alt', '+91 9560243588', 'phone'],
        ['business_hours', 'Monday - Saturday: 9:00 AM - 6:00 PM, Sunday: Closed', 'text'],
        ['established_year', '2013', 'text'],
        ['total_projects', '500+', 'text'],
        ['happy_customers', '500+', 'text'],
        ['company_address', 'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India', 'textarea']
    ];

    foreach ($settings as $setting) {
        executeQuery(
            "INSERT INTO site_settings (setting_key, setting_value, setting_type)
             VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE setting_value = ?",
            [$setting[0], $setting[1], $setting[2], $setting[1]]
        );
    }
    echo "<div class='success'>Site settings configured</div></div>\n";

    // 4. Insert About Content
    echo "<div class='data-section'><h3>📖 About Content</h3>\n";
    executeQuery("DELETE FROM about_content");

    $aboutSections = [
        [
            'main_intro',
            'Our Story',
            '<p>Welcome to <strong>Mena Play World</strong>, your premier destination for high-quality playground equipment and innovative play solutions. With over <strong>10 years of experience</strong> in the industry, we have established ourselves as a trusted name in creating safe, engaging, and memorable play experiences for children across India.</p>'
        ],
        [
            'mission',
            'Our Mission',
            '<p>At Mena Play World, we believe that <strong>play is fundamental to childhood development</strong>. Our mission is to design and manufacture playground equipment that not only provides endless fun but also promotes physical activity, social interaction, cognitive growth, and emotional well-being in children of all ages and abilities.</p>'
        ],
        [
            'quality',
            'Quality & Safety',
            '<p>What sets us apart is our unwavering commitment to <strong>quality and safety</strong>. We understand that parents and institutions trust us with their most precious assets – their children. That\'s why we adhere to strict international safety standards, use premium materials, and conduct rigorous testing on every piece of equipment we manufacture.</p>'
        ],
        [
            'products',
            'Our Product Range',
            '<p>We offer an extensive range of playground solutions including <strong>multi-play structures, swings, slides, spring riders, climbing equipment, outdoor gym apparatus, and custom-designed installations</strong>. Each product is carefully crafted to stimulate imagination while ensuring maximum safety and durability.</p>'
        ],
        [
            'services',
            'Complete Solutions',
            '<p>Beyond manufacturing, we provide <strong>comprehensive services</strong> including site consultation, custom design, professional installation, and ongoing maintenance support. Our team of experts works closely with schools, parks, municipalities, and private developers to create play spaces that exceed expectations.</p>'
        ],
        [
            'commitment',
            'Our Commitment',
            '<p>We are proud to be an <strong>ISO 9001:2015 certified company</strong>, reflecting our commitment to quality management and continuous improvement. With over <strong>500 successful installations</strong> and countless happy children, we continue to innovate and evolve to meet the changing needs of modern play environments.</p>'
        ]
    ];

    foreach ($aboutSections as $index => $section) {
        executeQuery(
            "INSERT INTO about_content (content_type, content_title, content_text, sort_order, is_active)
             VALUES (?, ?, ?, ?, 1)",
            [$section[0], $section[1], $section[2], $index + 1]
        );
    }
    echo "<div class='success'>About content sections created</div></div>\n";

    // 5. Insert Products
    echo "<div class='data-section'><h3>🎯 Products Catalog</h3>\n";
    executeQuery("DELETE FROM products WHERE id > 0");

    $products = [
        // Playground Equipment
        [
            'Multi-Play Adventure Tower',
            'playground',
            'Our flagship multi-play structure combines multiple activities in one exciting tower. Features climbing walls, tunnels, slides, and interactive panels designed for children aged 5-12 years.',
            json_encode([
                'Multiple climbing challenges',
                'Twin spiral slides',
                'Monkey bars and rope climbing',
                'Interactive play panels',
                'Safety railings throughout',
                'UV-resistant materials',
                'Professional installation included'
            ]),
            350000.00,
            850000.00,
            'Bestseller',
            'https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'playground-bg',
            1,
            1
        ],
        [
            'Spring Riders Collection',
            'playground',
            'Colorful and safe spring-mounted riding toys featuring various animal designs. Perfect for developing balance and coordination in young children aged 2-6 years.',
            json_encode([
                'Elephant, Horse, Duck designs',
                'Heavy-duty spring mechanism',
                'Non-slip safety handles',
                'Weather-resistant finish',
                'Soft-start spring action',
                'Easy maintenance',
                'Meets EN 1176 standards'
            ]),
            15000.00,
            45000.00,
            'Popular',
            'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'playground-bg',
            1,
            2
        ],
        [
            'Premium Swing Sets',
            'playground',
            'Traditional and modern swing sets featuring various seat options including belt swings, toddler swings, and accessible swings for children with special needs.',
            json_encode([
                'Galvanized steel frame',
                'Multiple swing configurations',
                'Toddler-friendly options',
                'Accessible swing seats available',
                'Safety chains and hardware',
                '10-year frame warranty',
                'Professional installation'
            ]),
            45000.00,
            150000.00,
            null,
            'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'playground-bg',
            0,
            3
        ],
        [
            'Adventure Climbing Structures',
            'playground',
            'Challenging climbing equipment including rock walls, rope nets, and boulder challenges designed to build strength, coordination, and confidence.',
            json_encode([
                'Natural rock climbing wall',
                'Rope climbing nets',
                'Boulder scramble features',
                'Safety fall zones',
                'Various difficulty levels',
                'All-weather materials',
                'Safety mats included'
            ]),
            75000.00,
            250000.00,
            'New',
            'https://images.unsplash.com/photo-1541698444083-023c97d3f4b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'playground-bg',
            0,
            4
        ],
        [
            'Toddler Play Zone',
            'playground',
            'Specially designed play area for children aged 2-5 years featuring low-height equipment, soft play elements, and sensory activities.',
            json_encode([
                'Age-appropriate height',
                'Soft play elements',
                'Sensory play panels',
                'Mini slides and climbers',
                'Sand and water play',
                'Shade structures available',
                'Safe enclosed design'
            ]),
            125000.00,
            350000.00,
            null,
            'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'playground-bg',
            1,
            5
        ],

        // Outdoor Gym Equipment
        [
            'Complete Outdoor Fitness Park',
            'outdoor',
            'Comprehensive outdoor fitness solution featuring 12+ exercise stations designed for adults and teenagers. Weather-resistant and maintenance-free.',
            json_encode([
                'Elliptical trainer',
                'Exercise bike',
                'Pull-up bars',
                'Parallel bars',
                'Rowing machine',
                'Leg press',
                'Balance beam',
                'Stretching posts',
                'Instructions signage',
                'Anti-rust coating',
                'Professional installation'
            ]),
            450000.00,
            1200000.00,
            'Complete Package',
            'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'outdoor-bg',
            1,
            1
        ],
        [
            'Cardio Training Stations',
            'outdoor',
            'Professional cardiovascular equipment for outdoor use including elliptical trainers, exercise bikes, and rowing machines with weather-resistant design.',
            json_encode([
                'Outdoor elliptical trainer',
                'Stationary exercise bike',
                'Air rowing machine',
                'Galvanized steel construction',
                'Self-lubricating bearings',
                'Vandal-resistant design',
                'Exercise instruction panels'
            ]),
            85000.00,
            250000.00,
            'Popular',
            'https://images.unsplash.com/photo-1594736797933-d0b22d3f4ee2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'outdoor-bg',
            0,
            2
        ],
        [
            'Strength Training Equipment',
            'outdoor',
            'Heavy-duty strength training stations including pull-up bars, parallel bars, multi-station units, and functional training equipment.',
            json_encode([
                'Multi-station pull-up bars',
                'Parallel dip bars',
                'Push-up stations',
                'Abs benches',
                'Functional trainer',
                'Heavy-duty construction',
                'Powder-coated finish'
            ]),
            65000.00,
            180000.00,
            null,
            'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'outdoor-bg',
            0,
            3
        ],
        [
            'Senior Citizen Fitness Zone',
            'outdoor',
            'Low-impact exercise equipment specifically designed for elderly users with safety features, easy accessibility, and gentle movements.',
            json_encode([
                'Low-impact exercises',
                'Safety handrails',
                'Easy access design',
                'Joint-friendly movements',
                'Balance training',
                'Flexibility equipment',
                'Clear instruction panels'
            ]),
            125000.00,
            300000.00,
            'Specialized',
            'https://images.unsplash.com/photo-1594736797933-d0b22d3f4ee2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'outdoor-bg',
            0,
            4
        ],

        // Indoor Solutions
        [
            'Modular Indoor Play System',
            'indoor',
            'Space-efficient modular play system perfect for shopping malls, restaurants, and indoor play centers. Customizable configuration with soft play elements.',
            json_encode([
                'Modular design system',
                'Soft play materials',
                'Ball pit included',
                'Tunnel systems',
                'Climbing structures',
                'Slide combinations',
                'Safety padding throughout',
                'Easy assembly',
                'Compact storage'
            ]),
            275000.00,
            750000.00,
            'Bestseller',
            'https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'indoor-bg',
            1,
            1
        ],
        [
            'School Gymnasium Equipment',
            'indoor',
            'Complete indoor sports and fitness equipment designed specifically for school gymnasiums including basketball hoops, volleyball nets, and exercise equipment.',
            json_encode([
                'Adjustable basketball systems',
                'Volleyball/badminton nets',
                'Indoor exercise equipment',
                'Storage solutions',
                'Safety padding',
                'Easy setup and storage',
                'Educational materials'
            ]),
            150000.00,
            450000.00,
            null,
            'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'indoor-bg',
            0,
            2
        ],
        [
            'Residential Indoor Gym',
            'indoor',
            'Premium compact gym equipment designed for homes and apartments. Space-saving design with professional-grade quality.',
            json_encode([
                'Compact multi-station',
                'Adjustable weights',
                'Cardio equipment',
                'Yoga and stretching area',
                'Mirror panels',
                'Rubber flooring',
                'Premium finishes',
                'Silent operation'
            ]),
            85000.00,
            350000.00,
            'Premium',
            'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'indoor-bg',
            1,
            3
        ],
        [
            'Therapy & Rehabilitation Center',
            'indoor',
            'Specialized equipment for physical therapy centers and rehabilitation facilities with medical-grade quality and adjustable features.',
            json_encode([
                'Medical-grade equipment',
                'Adjustable resistance',
                'Therapy-specific designs',
                'Safety features',
                'Professional support',
                'Maintenance included',
                'Training provided'
            ]),
            200000.00,
            600000.00,
            'Medical Grade',
            'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
            'indoor-bg',
            0,
            4
        ]
    ];

    $productCount = 0;
    foreach ($products as $product) {
        executeQuery(
            "INSERT INTO products (name, category, description, features, min_price, max_price, badge, image_url, image_class, is_featured, sort_order, is_active)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1)",
            $product
        );
        $productCount++;
    }
    echo "<div class='success'><span class='data-count'>{$productCount}</span> products inserted successfully</div></div>\n";

    // 6. Update Statistics
    echo "<div class='data-section'><h3>📈 Website Statistics</h3>\n";
    executeQuery("DELETE FROM statistics WHERE id > 0");

    $statistics = [
        ['years_experience', '10+', 'Years of Experience', '🏆', 1],
        ['total_projects', '500+', 'Projects Completed', '📈', 2],
        ['happy_customers', '500+', 'Happy Customers', '😊', 3],
        ['iso_certification', '9 ISO', 'Quality Certified', '🛡️', 4],
        ['total_products', '1000+', 'Product Range', '📦', 5],
        ['team_members', '50+', 'Expert Team', '👥', 6]
    ];

    foreach ($statistics as $stat) {
        executeQuery(
            "INSERT INTO statistics (stat_key, stat_value, stat_label, icon, sort_order, is_active)
             VALUES (?, ?, ?, ?, ?, 1)",
            $stat
        );
    }
    echo "<div class='success'>Website statistics updated</div></div>\n";

    // 7. Navigation Menu
    echo "<div class='data-section'><h3>🧭 Navigation Menu</h3>\n";
    executeQuery("DELETE FROM navigation_menu WHERE id > 0");

    $menuItems = [
        ['index', 'Home', 'index.php', 1],
        ['about', 'About Us', 'about.php', 2],
        ['products', 'Our Products', 'products.php', 3],
        ['contact', 'Contact Us', 'contact.php', 4]
    ];

    foreach ($menuItems as $item) {
        executeQuery(
            "INSERT INTO navigation_menu (page_key, page_title, page_url, sort_order, is_active)
             VALUES (?, ?, ?, ?, 1)",
            $item
        );
    }
    echo "<div class='success'>Navigation menu configured</div></div>\n";

    // Commit transaction
    commit();

    echo "<div class='success'><h2>🎉 All Dummy Data Inserted Successfully!</h2></div>\n";

    // Display summary
    $summary = [
        'Site Settings' => fetchOne("SELECT COUNT(*) as count FROM site_settings")['count'],
        'Hero Sections' => fetchOne("SELECT COUNT(*) as count FROM hero_section WHERE is_active = 1")['count'],
        'Company Info' => fetchOne("SELECT COUNT(*) as count FROM company_info")['count'],
        'About Sections' => fetchOne("SELECT COUNT(*) as count FROM about_content WHERE is_active = 1")['count'],
        'Products' => fetchOne("SELECT COUNT(*) as count FROM products WHERE is_active = 1")['count'],
        'Statistics' => fetchOne("SELECT COUNT(*) as count FROM statistics WHERE is_active = 1")['count'],
        'Navigation Items' => fetchOne("SELECT COUNT(*) as count FROM navigation_menu WHERE is_active = 1")['count']
    ];

    echo "<div class='data-section'><h3>📊 Data Summary</h3>\n";
    foreach ($summary as $table => $count) {
        echo "<p><strong>{$table}:</strong> <span class='data-count'>{$count}</span> records</p>\n";
    }
    echo "</div>\n";

    echo "<div style='text-align: center; margin: 30px 0;'>\n";
    echo "<a href='admin.php' class='btn'>🎛️ Go to Admin Panel</a>\n";
    echo "<a href='index.php' class='btn'>🌐 View Website</a>\n";
    echo "</div>\n";

    echo "<div class='success'>\n";
    echo "<h3>✅ Next Steps:</h3>\n";
    echo "<ol>\n";
    echo "<li>Visit your <strong>website</strong> to see the dynamic content</li>\n";
    echo "<li>Use the <strong>admin panel</strong> to manage your content</li>\n";
    echo "<li>Add your own products and customize the content</li>\n";
    echo "<li>Upload your own images and logos</li>\n";
    echo "<li><strong>Delete this file</strong> after use for security</li>\n";
    echo "</ol>\n";
    echo "</div>\n";

} catch (Exception $e) {
    rollback();
    echo "<div class='error'>❌ Error inserting dummy data: " . htmlspecialchars($e->getMessage()) . "</div>\n";
    echo "<div class='error'>Transaction rolled back. Please try again or check your database connection.</div>\n";
}

echo "    </div>\n";
echo "</body>\n";
echo "</html>\n";
?>
