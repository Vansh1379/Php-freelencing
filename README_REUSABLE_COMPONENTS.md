# Reusable Components Documentation

## Mena Play World Website

### Overview

This website has been upgraded to use reusable PHP components for the header and footer sections. This eliminates code duplication and makes maintenance much easier.

### File Structure

```
Mena/
├── includes/
│   ├── config.php          # Configuration settings
│   ├── header.php          # Complete header component
│   ├── footer.php          # Footer component
│   ├── header-top.php      # Just the email/phone section (optional)
│   └── navbar.php          # Just the navigation (optional)
├── index.php               # Home page (converted from HTML)
├── about.php               # About page (converted from HTML)
├── products.php            # Products page (converted from HTML)
├── contact.php             # Contact page (converted from HTML)
├── admin.html              # Admin panel (unchanged)
└── assets/                 # Logo and other assets
```

### How It Works

#### 1. Configuration File (`includes/config.php`)

Contains all website settings that can be easily modified:

- Site name and tagline
- Contact information
- Navigation menu items
- Page-specific settings
- Footer links

#### 2. Header Component (`includes/header.php`)

- Automatically detects current page for active navigation
- Shows/hides the email/phone section based on configuration
- Uses configuration values for all content
- Includes responsive design and all original styling

#### 3. Footer Component (`includes/footer.php`)

- Uses configuration for all links and contact info
- Automatically updates copyright year
- Maintains all original styling and functionality

### Usage in PHP Files

#### Basic Usage:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <!-- Your page content here -->

    <?php include 'includes/footer.php'; ?>
    <script src="your-script.js"></script>
</body>
</html>
```

#### Advanced Usage with Custom Settings:

```php
<?php
// Customize header for specific page
$show_header_top = false; // Hide email/phone section
include 'includes/header.php';
?>
```

### Features

#### Dynamic Navigation

- Automatically highlights the current page in navigation
- Consistent navigation across all pages
- Easy to add or modify navigation items in config.php

#### Configurable Header Top Section

- Can be shown or hidden per page
- Email and phone information from configuration
- Maintains responsive design

#### Centralized Configuration

- All website information in one place
- Easy to update contact details, company name, etc.
- Page-specific settings available

#### SEO-Friendly

- Proper page titles and meta descriptions
- Clean URL structure with .php extensions
- Semantic HTML structure maintained

### Benefits

1. **No Code Duplication**: Header and footer code exists in only one place
2. **Easy Maintenance**: Update once, changes appear everywhere
3. **Consistency**: All pages use identical header/footer structure
4. **Flexibility**: Can customize per page if needed
5. **Configuration Management**: All settings in one file
6. **Admin Panel Unchanged**: Original admin.html remains untouched

### Customization

#### To Change Contact Information:

Edit `includes/config.php`:

```php
define('CONTACT_EMAIL', 'your-new-email@domain.com');
define('CONTACT_PHONE', '+91 9876543210');
```

#### To Add/Remove Navigation Items:

Edit the `$navigation_menu` array in `includes/config.php`:

```php
$navigation_menu = [
    'index' => 'Home',
    'about' => 'About',
    'products' => 'Products',
    'services' => 'Services',  // New item
    'contact' => 'Contact'
];
```

#### To Hide Header Top Section on Specific Page:

Add to the top of your PHP file:

```php
<?php $show_header_top = false; ?>
<?php include 'includes/header.php'; ?>
```

### CSS Compatibility

- All original CSS classes and styling remain unchanged
- No CSS modifications required
- Responsive design preserved
- All animations and effects work as before

### JavaScript Compatibility

- All original JavaScript functionality preserved
- Form handling works identically
- Interactive features unchanged
- Animation scripts work as before

### Migration Notes

- Original HTML files converted to PHP
- All functionality preserved
- File extensions changed from .html to .php
- Internal links updated to use .php extensions
- Admin panel (admin.html) left unchanged as requested

### Testing Checklist

- [ ] All pages load correctly
- [ ] Navigation highlights current page
- [ ] Email/phone section appears on all pages
- [ ] Footer links work properly
- [ ] Contact forms function normally
- [ ] CSS styling appears correctly
- [ ] JavaScript animations work
- [ ] Mobile responsiveness maintained
- [ ] Admin panel accessible and unchanged

### Future Enhancements

1. Add social media links to header/footer
2. Implement breadcrumb navigation
3. Add multilingual support
4. Create page-specific meta tags system
5. Add structured data for SEO

### Support

For any issues or modifications needed, update the configuration file first, then check the include files. The modular structure makes debugging and updates much simpler than the previous HTML-based approach.
