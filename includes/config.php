<?php
/**
 * Configuration file for Mena Play World website
 * This file contains settings and configurations for reusable components
 */

// Website Information
define('SITE_NAME', 'Mena Play World');
define('SITE_TAGLINE', 'Solution Equipment');
define('COMPANY_NAME', 'JK Enterprise');

// Contact Information
define('CONTACT_EMAIL', 'contact.jkenterprise@gmail.com');
define('CONTACT_PHONE', '+91 9773698785');
define('CONTACT_PHONE_ALT', '+91 9560243588');

// Address Information
define('COMPANY_ADDRESS', 'Shop no.68/4, Gali no.6, 4/6-Ambedkar Colony, Lal Bagh, Sec 7, Guj Ghaziabad, U.P - 201008, India');

// Logo Path
define('LOGO_PATH', 'assets/logo.png');

// Navigation Menu Items
$navigation_menu = [
    'index' => 'Home',
    'about' => 'About',
    'products' => 'Products',
    'contact' => 'Contact'
];

// Page-specific settings
$page_settings = [
    'index' => [
        'show_header_top' => true,
        'page_title' => 'JK Enterprise - Premium Playground Equipment',
        'meta_description' => 'Premium playground equipment manufacturer in India. Creating safe, fun, and engaging play spaces for children.'
    ],
    'about' => [
        'show_header_top' => true,
        'page_title' => 'About - Mema Play World',
        'meta_description' => 'Learn about Mema Play World - your premier destination for high-quality playground equipment and solutions.'
    ],
    'products' => [
        'show_header_top' => true,
        'page_title' => 'Products - JK Enterprise',
        'meta_description' => 'Discover our comprehensive range of playground and fitness equipment designed for all ages.'
    ],
    'contact' => [
        'show_header_top' => true,
        'page_title' => 'Contact Us - Mena Play World',
        'meta_description' => 'Get in touch with Mena Play World for premium playground equipment and consultation services.'
    ]
];

// Social Media Links (for future use)
$social_links = [
    'facebook' => '#',
    'instagram' => '#',
    'linkedin' => '#',
    'youtube' => '#'
];

// Footer Links
$footer_links = [
    'useful_links' => [
        'Home' => 'index.php',
        'About Us' => 'about.php',
        'Products' => 'products.php',
        'Contact' => 'contact.php',
        'Blog' => '#'
    ],
    'products_links' => [
        'Playground Equipment' => 'products.php',
        'Outdoor Gym Equipment' => 'products.php',
        'Indoor Solutions' => 'products.php',
        'Custom Designs' => 'products.php',
        'Installation Services' => 'contact.php'
    ]
];

// Get current page settings
function getCurrentPageSettings() {
    global $page_settings;
    $current_page = basename($_SERVER['PHP_SELF'], '.php');
    return isset($page_settings[$current_page]) ? $page_settings[$current_page] : $page_settings['index'];
}

// Get current page name for navigation
function getCurrentPage() {
    return basename($_SERVER['PHP_SELF'], '.php');
}

// Check if current page should show header top
function shouldShowHeaderTop() {
    $settings = getCurrentPageSettings();
    return isset($settings['show_header_top']) ? $settings['show_header_top'] : true;
}
?>
