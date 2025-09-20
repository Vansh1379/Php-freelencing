<?php
/**
 * Example Usage Guide for Product Card Component
 *
 * This file demonstrates various ways to use the reusable product card component.
 * Copy and modify these examples for your specific needs.
 */

// Include the product card component
include_once 'product-card.php';

echo '<h1>Product Card Component - Usage Examples</h1>';

// ===== EXAMPLE 1: Basic Product Card =====
echo '<h2>Example 1: Basic Product Card</h2>';
echo '<div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0;">';

echo renderProductCard([
    'title' => 'Basic Swing Set',
    'description' => 'Simple and safe swing set perfect for backyard use.',
    'features' => [
        'Weather resistant',
        'Easy installation',
        'Safety certified',
        '2-year warranty'
    ],
    'button_text' => 'Learn More'
]);

echo '</div>';

// ===== EXAMPLE 2: Product Card with Price and Badge =====
echo '<h2>Example 2: Product Card with Price and Badge</h2>';
echo '<div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0;">';

echo renderProductCard([
    'title' => 'Premium Play Structure',
    'description' => 'Multi-level play structure with slides, climbing walls, and interactive features.',
    'features' => [
        'Multiple play activities',
        'High-quality materials',
        'Professional installation',
        'Custom color options'
    ],
    'price' => '₹3,50,000 - ₹5,00,000',
    'badge' => 'Popular',
    'category' => 'playground',
    'image_class' => 'playground-bg',
    'button_text' => 'Get Quote',
    'button_action' => 'quote'
]);

echo '</div>';

// ===== EXAMPLE 3: Multiple Cards Using Array =====
echo '<h2>Example 3: Multiple Cards from Array</h2>';
echo '<div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0;">';

$sampleProducts = [
    [
        'title' => 'Outdoor Gym Station',
        'description' => 'Complete outdoor fitness solution for parks and communities.',
        'features' => ['Cardio equipment', 'Strength training', 'Weather proof', 'Low maintenance'],
        'price' => '₹75,000 - ₹1,25,000',
        'category' => 'outdoor',
        'badge' => 'New',
        'image_class' => 'outdoor-bg',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ],
    [
        'title' => 'Indoor Play Zone',
        'description' => 'Soft play equipment designed for indoor entertainment centers.',
        'features' => ['Soft padding', 'Colorful design', 'Age appropriate', 'Easy cleaning'],
        'price' => '₹2,00,000 - ₹4,00,000',
        'category' => 'indoor',
        'badge' => 'Premium',
        'image_class' => 'indoor-bg',
        'button_text' => 'Get Quote',
        'button_action' => 'quote'
    ]
];

foreach ($sampleProducts as $product) {
    echo renderProductCard($product);
}

echo '</div>';

// ===== EXAMPLE 4: Using Quick Product Card Function =====
echo '<h2>Example 4: Quick Product Card (Simple)</h2>';
echo '<div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0;">';

echo quickProductCard(
    'Simple Slide',
    'Basic playground slide for small children.',
    ['Safety rails', 'Non-slip steps', 'Rounded edges'],
    'View Details'
);

echo '</div>';

// ===== EXAMPLE 5: Using Presets =====
echo '<h2>Example 5: Using Product Card Presets</h2>';
echo '<div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0;">';

// Home page style card
echo renderProductCard(
    ProductCardPresets::homePageCard(
        'Playground Solutions',
        'Complete playground equipment for schools and parks.',
        ['Safe design', 'Durable materials', 'Professional installation'],
        'playground-bg'
    )
);

// Products page style card
echo renderProductCard(
    ProductCardPresets::productsPageCard(
        'Fitness Equipment',
        'Outdoor fitness equipment for community health.',
        ['Weather resistant', 'Easy maintenance', 'Various exercises'],
        '₹50,000 - ₹2,00,000',
        'outdoor',
        'Bestseller'
    )
);

echo '</div>';

// ===== EXAMPLE 6: Custom Button Actions =====
echo '<h2>Example 6: Custom Button Actions</h2>';
echo '<div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0;">';

// Card with link action
echo renderProductCard([
    'title' => 'Product Catalog',
    'description' => 'Browse our complete product range.',
    'features' => ['100+ products', 'Detailed specs', 'Price guides', 'Installation info'],
    'button_text' => 'View Catalog',
    'button_action' => 'link',
    'button_link' => 'catalog.pdf',
    'show_price' => false
]);

// Card with quote action
echo renderProductCard([
    'title' => 'Custom Solution',
    'description' => 'Need something specific? We create custom playground solutions.',
    'features' => ['Custom design', 'Site survey', 'Professional planning', 'Full installation'],
    'button_text' => 'Request Quote',
    'button_action' => 'quote',
    'show_price' => false
]);

echo '</div>';

// ===== EXAMPLE 7: Card Without Features List =====
echo '<h2>Example 7: Minimal Card (No Features)</h2>';
echo '<div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0;">';

echo renderProductCard([
    'title' => 'Consultation Service',
    'description' => 'Professional consultation for playground planning and design. Our experts will help you create the perfect play space for your needs.',
    'features' => [], // Empty features array
    'button_text' => 'Book Consultation',
    'button_action' => 'link',
    'button_link' => 'contact.php',
    'show_price' => false
]);

echo '</div>';

// ===== USAGE NOTES =====
echo '<div style="background: #f8f9fa; padding: 2rem; border-radius: 10px; margin: 2rem 0;">';
echo '<h2>Usage Notes:</h2>';
echo '<ul>';
echo '<li><strong>Required Parameters:</strong> title, description</li>';
echo '<li><strong>Optional Parameters:</strong> features, price, badge, category, image_class, button_text, button_action, button_link, show_price</li>';
echo '<li><strong>Button Actions:</strong> "quote" (opens quote modal), "link" (navigates to URL), "view" (default action)</li>';
echo '<li><strong>Categories:</strong> playground, outdoor, indoor, or custom</li>';
echo '<li><strong>Image Classes:</strong> playground-bg, outdoor-bg, indoor-bg for background styling</li>';
echo '<li><strong>Badges:</strong> Popular, New, Premium, or custom text</li>';
echo '</ul>';
echo '</div>';

// ===== INTEGRATION EXAMPLE =====
echo '<div style="background: #e8f5e8; padding: 2rem; border-radius: 10px; margin: 2rem 0;">';
echo '<h2>Integration Example:</h2>';
echo '<pre style="background: #fff; padding: 1rem; border-radius: 5px; overflow-x: auto;">';
echo htmlentities('<?php
// In your PHP page:
include "includes/components/product-card.php";

// Simple usage
echo renderProductCard([
    "title" => "Your Product",
    "description" => "Product description here...",
    "features" => ["Feature 1", "Feature 2"],
    "price" => "₹50,000",
    "button_text" => "Get Quote"
]);

// Multiple cards
$products = [
    ["title" => "Product 1", "description" => "..."],
    ["title" => "Product 2", "description" => "..."]
];

foreach ($products as $product) {
    echo renderProductCard($product);
}
?>');
echo '</pre>';
echo '</div>';
?>

<style>
/* Basic styling for the examples */
.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.product-card:hover {
    transform: translateY(-10px);
}

.product-image {
    height: 200px;
    background: linear-gradient(135deg, #8b5cf6, #a855f7);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: rgba(255,255,255,0.7);
}

.product-image::before {
    content: "🏗️";
}

.playground-bg {
    background: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 100%);
}

.outdoor-bg {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
}

.indoor-bg {
    background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
}

.product-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #e74c3c;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.product-content {
    padding: 1.5rem;
}

.product-content h3 {
    color: #333;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.product-content p {
    color: #666;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.product-features {
    list-style: none;
    margin: 0 0 1.5rem 0;
    padding: 0;
}

.product-features li {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    position: relative;
    padding-left: 1.5rem;
}

.product-features li::before {
    content: "✓";
    color: #16a34a;
    position: absolute;
    left: 0;
    font-weight: bold;
}

.product-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: #8b5cf6;
    margin-bottom: 1rem;
}

.product-btn {
    background: linear-gradient(135deg, #8b5cf6, #a855f7);
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s;
    width: 100%;
    font-size: 1rem;
}

.product-btn:hover {
    transform: translateY(-2px);
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

h1, h2 {
    color: #2c3e50;
    margin: 2rem 0 1rem 0;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 3rem;
}
</style>
