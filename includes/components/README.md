# Product Card Component

A reusable PHP component for rendering product cards in the Mena Play World website. This component eliminates code duplication and provides a consistent, flexible way to display products across different pages.

## 📁 Files

- `product-card.php` - Main component file with rendering functions
- `example-usage.php` - Comprehensive usage examples
- `README.md` - This documentation file

## 🚀 Quick Start

### Basic Usage

```php
<?php
// Include the component
include 'includes/components/product-card.php';

// Render a simple product card
echo renderProductCard([
    'title' => 'Multi-Play Structure',
    'description' => 'Complete playground system with slides and climbing features.',
    'features' => ['Safety certified', 'Weather resistant', 'Easy installation'],
    'button_text' => 'Get Quote'
]);
?>
```

### Advanced Usage

```php
<?php
// Render a product card with all options
echo renderProductCard([
    'title' => 'Premium Playground Equipment',
    'description' => 'High-quality playground equipment for schools and parks.',
    'features' => [
        'Multi-activity design',
        'Safety railings',
        'UV resistant materials',
        'Professional installation'
    ],
    'price' => '₹2,50,000 - ₹5,00,000',
    'badge' => 'Popular',
    'category' => 'playground',
    'image_class' => 'playground-bg',
    'button_text' => 'Get Quote',
    'button_action' => 'quote'
]);
?>
```

## 📋 Configuration Options

### Required Parameters

- `title` (string) - Product title/name
- `description` (string) - Product description

### Optional Parameters

| Parameter       | Type    | Default          | Description                             |
| --------------- | ------- | ---------------- | --------------------------------------- |
| `features`      | array   | `[]`             | List of product features                |
| `price`         | string  | `null`           | Price range (e.g., "₹25,000 - ₹50,000") |
| `badge`         | string  | `null`           | Badge text (e.g., "Popular", "New")     |
| `category`      | string  | `'all'`          | Product category for filtering          |
| `image_class`   | string  | `''`             | CSS class for background styling        |
| `button_text`   | string  | `'View Details'` | Button text                             |
| `button_action` | string  | `'view'`         | Button action type                      |
| `button_link`   | string  | `'#'`            | URL for link action                     |
| `show_price`    | boolean | `true`           | Whether to display price                |

### Button Actions

- `'quote'` - Opens quote modal (requires quote modal functionality)
- `'link'` - Navigates to specified URL
- `'view'` - Default view action (scrolls to products section)

### CSS Classes

Pre-defined image background classes:

- `playground-bg` - Playground equipment styling
- `outdoor-bg` - Outdoor gym equipment styling
- `indoor-bg` - Indoor solutions styling

## 🎨 Styling

The component uses existing CSS classes from your stylesheet:

```css
.product-card {
  /* Main card container */
}
.product-image {
  /* Image/background area */
}
.product-badge {
  /* Optional badge */
}
.product-content {
  /* Content area */
}
.product-features {
  /* Features list */
}
.product-price {
  /* Price display */
}
.product-btn {
  /* Action button */
}
```

## 🔧 Helper Functions

### renderProductCard()

Main rendering function that outputs a single product card.

### renderProductCards()

Renders multiple product cards from an array of configurations.

```php
$products = [
    ['title' => 'Product 1', 'description' => '...'],
    ['title' => 'Product 2', 'description' => '...']
];
echo renderProductCards($products);
```

### quickProductCard()

Simplified function for basic cards without pricing.

```php
echo quickProductCard(
    'Simple Swing',
    'Basic playground swing set',
    ['Safe design', 'Easy install'],
    'Learn More'
);
```

### ProductCardPresets Class

Pre-configured card templates for common use cases.

```php
// Home page card (no pricing, links to products page)
$homeCard = ProductCardPresets::homePageCard(
    'Playground Equipment',
    'Safe and fun play structures',
    ['Multi-play', 'Climbing', 'Slides'],
    'playground-bg'
);

// Products page card (with pricing, quote button)
$productCard = ProductCardPresets::productsPageCard(
    'Multi-Play Structure',
    'Complete playground system',
    ['Safety certified', 'Weather resistant'],
    '₹2,50,000 - ₹5,00,000',
    'playground',
    'Popular'
);
```

## 📦 Integration with Configuration

Use with the centralized product configuration:

```php
// Include both component and configuration
include 'includes/components/product-card.php';
include 'includes/products-config.php';

// Use predefined products
foreach ($homePageProducts as $product) {
    echo renderProductCard($product);
}

// Filter by category
$playgroundProducts = getProductsByCategory('playground');
foreach ($playgroundProducts as $product) {
    echo renderProductCard($product);
}
```

## 🎯 Use Cases

### Home Page

Display category overview cards with links to detailed product pages.

```php
foreach ($homePageProducts as $product) {
    echo renderProductCard($product);
}
```

### Products Page

Display detailed product cards with pricing and quote functionality.

```php
foreach ($allProducts as $product) {
    echo renderProductCard($product);
}
```

### Category Pages

Show products filtered by specific category.

```php
$outdoorProducts = getProductsByCategory('outdoor');
foreach ($outdoorProducts as $product) {
    echo renderProductCard($product);
}
```

### Featured Products Section

Display highlighted products anywhere on the site.

```php
$featured = getFeaturedProducts();
foreach ($featured as $product) {
    echo renderProductCard($product);
}
```

## 🔄 Migration from Old Code

### Before (Repeated HTML)

```html
<div class="product-card">
  <div class="product-image playground-bg">
    <div class="product-badge">Popular</div>
  </div>
  <div class="product-content">
    <h3>Multi-Play Structures</h3>
    <p>Comprehensive play systems...</p>
    <ul class="product-features">
      <li>Multiple climbing options</li>
      <li>Integrated slides</li>
    </ul>
    <div class="product-price">₹2,50,000 - ₹8,00,000</div>
    <button class="product-btn">Get Quote</button>
  </div>
</div>
```

### After (Reusable Component)

```php
<?php
echo renderProductCard([
    'title' => 'Multi-Play Structures',
    'description' => 'Comprehensive play systems...',
    'features' => ['Multiple climbing options', 'Integrated slides'],
    'price' => '₹2,50,000 - ₹8,00,000',
    'badge' => 'Popular',
    'category' => 'playground',
    'image_class' => 'playground-bg',
    'button_text' => 'Get Quote',
    'button_action' => 'quote'
]);
?>
```

## ✨ Benefits

1. **DRY Principle** - Don't Repeat Yourself
2. **Consistency** - Uniform card structure across pages
3. **Maintainability** - Update once, changes everywhere
4. **Flexibility** - Configurable for different use cases
5. **Type Safety** - Structured parameters prevent errors
6. **Performance** - Optimized HTML generation
7. **Accessibility** - Built-in ARIA attributes and semantic HTML

## 🐛 Troubleshooting

### Cards Not Displaying

- Ensure `product-card.php` is included before use
- Check that required CSS classes exist in your stylesheet
- Verify array structure matches expected format

### Quote Modal Not Working

- Include `product.js` for quote modal functionality
- Ensure `showQuoteModal()` function is defined
- Check browser console for JavaScript errors

### Styling Issues

- Confirm CSS classes are properly defined
- Check for CSS conflicts with existing styles
- Verify image background classes are included

## 🔮 Future Enhancements

- [ ] Image upload and display functionality
- [ ] Star rating system
- [ ] Product comparison features
- [ ] Wishlist/favorites functionality
- [ ] Social sharing buttons
- [ ] Review and testimonials integration
- [ ] Multi-language support
- [ ] Custom field extensions

## 📄 License

This component is part of the Mena Play World website project.

---

**Created for Mena Play World** | **Version 1.0** | **Last Updated: 2024**
