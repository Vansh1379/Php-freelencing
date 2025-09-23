<?php
/**
 * Reusable Product Card Component
 *
 * Usage:
 * include 'includes/components/product-card.php';
 * renderProductCard([
 *     'title' => 'Product Name',
 *     'description' => 'Product description...',
 *     'features' => ['Feature 1', 'Feature 2'],
 *     'price' => '₹25,000 - ₹50,000', // optional
 *     'badge' => 'Popular', // optional
 *     'category' => 'playground', // optional
 *     'image_class' => 'playground-bg', // optional
 *     'button_text' => 'Get Quote',
 *     'button_action' => 'quote', // 'quote', 'link', or 'view'
 *     'button_link' => '#' // optional, for link action
 * ]);
 */

function renderProductCard($config = []) {
    // Default configuration
    $defaults = [
        'title' => 'Product Title',
        'description' => 'Product description goes here.',
        'features' => [],
        'price' => null,
        'badge' => null,
        'category' => 'all',
        'image_class' => '',
        'image_url' => null,
        'button_text' => 'View Details',
        'button_action' => 'view',
        'button_link' => '#',
        'show_price' => true,
        'show_edit' => true,
        'show_delete' => false,
        'admin_mode' => false
    ];

    // Merge config with defaults
    $card = array_merge($defaults, $config);

    // Generate unique ID for this card
    $card_id = 'card_' . uniqid();

    // Start output buffering
    ob_start();
    ?>

    <div class="product-card-modern group"
         data-category="<?php echo htmlspecialchars($card['category']); ?>"
         id="<?php echo $card_id; ?>">

        <!-- Product Image Section -->
        <div class="product-image-modern <?php echo htmlspecialchars($card['image_class']); ?>" style="position: relative; height: 16rem; overflow: hidden;">
            <?php 
            // Always show placeholder first, then try to load image
            $imageSrc = '';
            if (!empty($card['image_url'])) {
                $imageSrc = $card['image_url'];
                // Always prefix with a forward slash if it's not a full URL
                if (!filter_var($imageSrc, FILTER_VALIDATE_URL)) {
                    // Ensure a single leading slash
                    if ($imageSrc[0] !== '/') {
                        $imageSrc = '/' . ltrim($imageSrc, './');
                    }
                }
            }            
            ?>
            
            <div class="product-placeholder-modern" <?php echo !empty($imageSrc) ? 'style="display: none;"' : ''; ?>>
                <i class="product-icon-modern">🏗️</i>
            </div>
            
            <?php if (!empty($imageSrc)): ?>
                <!-- Debug: Show image URL -->
                <div style="position: absolute; top: 5px; left: 5px; background: rgba(0,0,0,0.7); color: white; padding: 2px 5px; font-size: 10px; z-index: 10;">
                    <?php echo htmlspecialchars($imageSrc); ?>
                </div>
                <img
                    src="<?php echo htmlspecialchars($imageSrc); ?>"
                    alt="<?php echo htmlspecialchars($card['title']); ?>"
                    class="product-img-modern"
                    style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 2; display: block; background: red;"
                    onerror="console.log('Image failed to load:', '<?php echo htmlspecialchars($imageSrc); ?>'); this.style.display='none'; this.parentElement.querySelector('.product-placeholder-modern').style.display='flex';"
                    onload="console.log('Image loaded successfully:', '<?php echo htmlspecialchars($imageSrc); ?>'); this.style.display='block'; this.parentElement.querySelector('.product-placeholder-modern').style.display='none';"
                />
            <?php endif; ?>
            
            <!-- Gradient Overlay -->
            <div class="product-gradient-overlay"></div>
            
            <?php if ($card['badge']): ?>
                <div class="product-badge-modern"><?php echo htmlspecialchars($card['badge']); ?></div>
            <?php endif; ?>
        </div>

        <!-- Product Content -->
        <div class="product-content-modern">
            <h3 class="product-title-modern"><?php echo htmlspecialchars($card['title']); ?></h3>
            <p class="product-description-modern"><?php echo htmlspecialchars($card['description']); ?></p>

            <?php if (!empty($card['features'])): ?>
                <div class="product-features-modern">
                    <?php foreach ($card['features'] as $feature): ?>
                        <div class="product-feature-item">
                            <div class="feature-bullet"></div>
                            <span class="feature-text"><?php echo htmlspecialchars($feature); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($card['price'] && $card['show_price']): ?>
                <div class="product-price-modern"><?php echo htmlspecialchars($card['price']); ?></div>
            <?php endif; ?>

            <!-- Product Button -->
            <div class="product-button-container">
                <?php if ($card['admin_mode']): ?>
                    <?php if ($card['show_delete']): ?>
                        <button class="product-btn-modern product-btn-delete" onclick="deleteProduct('<?php echo htmlspecialchars($card['title']); ?>')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    <?php endif; ?>
                <?php else: ?>
                    <?php renderProductButton($card); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php
    // Return the buffered output
    return ob_get_clean();
}

/**
 * Render the product button based on action type
 */
function renderProductButton($card) {
    $button_class = 'product-btn';
    $button_attributes = '';

    switch ($card['button_action']) {
        case 'quote':
            $button_attributes = 'onclick="openQuoteModal(\'' . htmlspecialchars($card['title']) . '\')"';
            break;

        case 'link':
            $button_attributes = 'onclick="window.location.href=\'' . htmlspecialchars($card['button_link']) . '\'"';
            break;

        case 'edit':
            $button_attributes = 'onclick="editProduct(\'' . htmlspecialchars($card['title']) . '\')"';
            break;

        case 'delete':
            $button_attributes = 'onclick="deleteProduct(\'' . htmlspecialchars($card['title']) . '\')"';
            $button_class .= ' product-btn-delete';
            break;

        case 'view':
        default:
            $button_attributes = 'onclick="viewProduct(\'' . htmlspecialchars($card['title']) . '\')"';
            break;
    }

    echo '<button class="product-btn-modern group" ' . $button_attributes . '>';
    echo htmlspecialchars($card['button_text']);
    echo '<svg class="btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14m-7-7l7 7-7 7"/></svg>';
    echo '</button>';
}

/**
 * Render multiple product cards from an array
 */
function renderProductCards($cards_config) {
    $output = '';
    foreach ($cards_config as $card_config) {
        $output .= renderProductCard($card_config);
    }
    return $output;
}

/**
 * Quick render function for simple cards (backward compatibility)
 */
function quickProductCard($title, $description, $features = [], $button_text = 'View Details') {
    return renderProductCard([
        'title' => $title,
        'description' => $description,
        'features' => $features,
        'button_text' => $button_text,
        'show_price' => false
    ]);
}

/**
 * Predefined product configurations for common use cases
 */
class ProductCardPresets {

    public static function homePageCard($title, $description, $features, $image_class = '') {
        return [
            'title' => $title,
            'description' => $description,
            'features' => $features,
            'button_text' => 'View Products',
            'button_action' => 'link',
            'button_link' => 'products.php',
            'image_class' => $image_class,
            'show_price' => false
        ];
    }

    public static function productsPageCard($title, $description, $features, $price, $category, $badge = null) {
        return [
            'title' => $title,
            'description' => $description,
            'features' => $features,
            'price' => $price,
            'category' => $category,
            'badge' => $badge,
            'button_text' => 'Get Quote',
            'button_action' => 'quote',
            'image_class' => $category . '-bg',
            'show_price' => true
        ];
    }

    public static function adminPageCard($title, $description, $features, $price, $category, $badge = null, $image_url = null) {
        return [
            'title' => $title,
            'description' => $description,
            'features' => $features,
            'price' => $price,
            'category' => $category,
            'badge' => $badge,
            'image_url' => $image_url,
            'button_text' => 'Delete',
            'button_action' => 'delete',
            'image_class' => $category . '-bg',
            'show_price' => true,
            'show_edit' => false,
            'show_delete' => true,
            'admin_mode' => true
        ];
    }
}

// JavaScript functions for button actions (to be included in pages using this component)
?>
<script>
// Global functions for product card interactions
function openQuoteModal(productName) {
    // This function should be defined in the page using the component
    if (typeof showQuoteModal === 'function') {
        showQuoteModal(productName);
    } else {
        console.warn('showQuoteModal function not found. Please include product.js or define the function.');
        alert('Quote request for: ' + productName);
    }
}

function viewProduct(productName) {
    // Default behavior - scroll to products section or redirect
    const productsSection = document.getElementById('products');
    if (productsSection) {
        productsSection.scrollIntoView({ behavior: 'smooth' });
    } else {
        window.location.href = 'products.php';
    }
}

function editProduct(productName) {
    // This function should be defined in admin pages
    if (typeof adminPanel !== 'undefined' && adminPanel.editProduct) {
        adminPanel.editProduct(productName);
    } else {
        console.warn('Admin panel edit function not found');
        alert('Edit product: ' + productName);
    }
}

function deleteProduct(productName) {
    // This function should be defined in admin pages
    if (typeof adminPanel !== 'undefined' && adminPanel.deleteProduct) {
        adminPanel.deleteProduct(productName);
    } else {
        console.warn('Admin panel delete function not found');
        if (confirm('Are you sure you want to delete: ' + productName + '?')) {
            alert('Delete product: ' + productName);
        }
    }
}

// Enhanced card interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to all product cards
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
        });
    });

    // Add click animation to product buttons
    document.querySelectorAll('.product-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });
});
</script>
<?php
?>
