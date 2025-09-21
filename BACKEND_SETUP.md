# Mena Play World - Backend Setup Guide

## 🚀 Complete PHP Backend for Admin Panel

This guide will help you set up the complete PHP backend system for your Mena Play World admin panel, connecting it to phpMyAdmin/MySQL database.

## 📋 Table of Contents
- [Prerequisites](#prerequisites)
- [Database Setup](#database-setup)
- [Installation Steps](#installation-steps)
- [Database Tables](#database-tables)
- [API Endpoints](#api-endpoints)
- [Usage Guide](#usage-guide)
- [Troubleshooting](#troubleshooting)

## ⚙️ Prerequisites

### Required Software:
- **XAMPP** (Apache + MySQL + PHP 7.4+ + phpMyAdmin)
- **Web Browser** (Chrome, Firefox, Safari, etc.)

### XAMPP Configuration:
1. Start **Apache** and **MySQL** services in XAMPP Control Panel
2. Ensure ports 80 (Apache) and 3306 (MySQL) are not blocked

## 🗄️ Database Setup

### Step 1: Database Configuration
The system is configured with these default settings in `includes/database.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mena_play_world');
```

**If your MySQL has different credentials, update these values.**

### Step 2: Automatic Installation
1. Open your web browser
2. Navigate to: `http://localhost/Mena/install-database.php`
3. Click "🚀 Start Installation"
4. Wait for installation to complete
5. **Important**: Delete `install-database.php` after successful installation

## 📊 Database Tables Created

The system creates 8 tables with the following structure:

### 1. `site_settings`
**Purpose**: Store global website settings
```sql
- setting_key (VARCHAR) - Unique setting identifier
- setting_value (TEXT) - Setting value
- setting_type (ENUM) - text, textarea, json, image, email, phone
```

### 2. `hero_section`
**Purpose**: Manage homepage hero content
```sql
- title (VARCHAR) - Hero title
- description (TEXT) - Hero description
- button1_text, button1_link - First CTA button
- button2_text, button2_link - Second CTA button
- background_image (VARCHAR) - Hero background image
```

### 3. `company_info`
**Purpose**: Store company details
```sql
- company_name (VARCHAR) - Company name
- certification (VARCHAR) - ISO certification
- logo_path (VARCHAR) - Logo file path
- welcome_title (VARCHAR) - Welcome message title
- address (TEXT) - Company address
- phone, phone_alt (VARCHAR) - Phone numbers
- email, email_alt (VARCHAR) - Email addresses
```

### 4. `about_content`
**Purpose**: Manage about page content sections
```sql
- content_type (VARCHAR) - Type of content block
- content_title (VARCHAR) - Content section title
- content_text (LONGTEXT) - Main content
- sort_order (INT) - Display order
```

### 5. `products`
**Purpose**: Product catalog management
```sql
- name (VARCHAR) - Product name
- category (ENUM) - playground, outdoor, indoor
- description (TEXT) - Product description
- features (JSON) - Product features array
- min_price, max_price (DECIMAL) - Price range
- badge (VARCHAR) - Special badge (Popular, New, etc.)
- image_url (VARCHAR) - Product image
- is_featured (BOOLEAN) - Featured product flag
```

### 6. `navigation_menu`
**Purpose**: Website navigation structure
```sql
- page_key (VARCHAR) - Page identifier
- page_title (VARCHAR) - Display title
- page_url (VARCHAR) - Page URL
- sort_order (INT) - Menu order
```

### 7. `statistics`
**Purpose**: Website statistics and counters
```sql
- stat_key (VARCHAR) - Statistic identifier
- stat_value (VARCHAR) - Display value (e.g., "10+", "500+")
- stat_label (VARCHAR) - Statistic label
- icon (VARCHAR) - Icon representation
```

### 8. `file_uploads`
**Purpose**: Track uploaded files
```sql
- original_name (VARCHAR) - Original filename
- file_name (VARCHAR) - System filename
- file_path (VARCHAR) - Storage path
- file_size (INT) - File size in bytes
- file_type (VARCHAR) - MIME type
- upload_context (VARCHAR) - Upload purpose
```

## 🔗 API Endpoints

All API requests go through `admin-api.php?action=<action_name>`

### Site Settings
- `GET ?action=get_settings` - Retrieve all settings
- `POST ?action=save_settings` - Save settings

### Hero Section
- `GET ?action=get_hero` - Get hero content
- `POST ?action=save_hero` - Save hero content

### Company Information
- `GET ?action=get_company` - Get company details
- `POST ?action=save_company` - Save company details

### Products Management
- `GET ?action=get_products` - List all products
- `POST ?action=add_product` - Add new product
- `POST ?action=update_product` - Update existing product
- `POST ?action=delete_product` - Delete product (soft delete)

### Navigation Menu
- `GET ?action=get_navigation` - Get menu items
- `POST ?action=save_navigation` - Save menu structure

### Statistics
- `GET ?action=get_statistics` - Get all statistics
- `POST ?action=save_statistics` - Save statistics

### File Uploads
- `POST ?action=upload_file` - Upload files (multipart/form-data)

### Dashboard
- `GET ?action=get_dashboard` - Get dashboard summary data

## 🎯 Usage Guide

### 1. Access Admin Panel
Navigate to: `http://localhost/Mena/admin.php`

### 2. Manage Content
- **Main Page**: Edit hero section, statistics
- **About Page**: Update company info, about content
- **Products**: Add, edit, delete products with full CRUD operations
- **Settings**: Configure site settings, navigation menu

### 3. Data Flow
1. Admin panel loads data from database via API
2. User makes changes in admin interface
3. Changes are saved to database through API endpoints
4. Website displays updated content from database

### 4. File Uploads
- Upload directory: `Mena/uploads/`
- Allowed types: JPG, PNG, GIF, WebP, BMP, SVG, ICO
- Maximum size: 5MB per file
- Security: PHP execution blocked in uploads directory

## 🐛 Troubleshooting

### Common Issues:

#### 1. Database Connection Failed
**Error**: `Database connection failed`
**Solution**: 
- Check if MySQL is running in XAMPP
- Verify database credentials in `includes/database.php`
- Ensure database `mena_play_world` exists

#### 2. API Request Failed
**Error**: `API request failed`
**Solutions**:
- Check if Apache is running
- Verify file permissions (uploads folder should be writable)
- Check browser console for detailed error messages

#### 3. Products Not Loading
**Error**: Products section shows loading spinner
**Solutions**:
- Run the database installer again
- Check if `products` table exists in phpMyAdmin
- Verify API endpoint is accessible: `http://localhost/Mena/admin-api.php?action=get_products`

#### 4. File Upload Issues
**Error**: File upload fails
**Solutions**:
- Check if `uploads/` directory exists and is writable
- Verify file size (max 5MB)
- Ensure file type is allowed (images only)

#### 5. Admin Panel Not Saving Data
**Error**: Changes not persisting
**Solutions**:
- Check browser console for JavaScript errors
- Verify database connection
- Test API endpoints directly in browser

## 🔐 Security Features

### Database Security:
- Prepared statements prevent SQL injection
- Input validation on all endpoints
- Transaction support for data consistency

### File Upload Security:
- File type validation
- Size limitations
- PHP execution blocked in uploads directory
- Hotlinking protection

### General Security:
- CSRF protection ready (implement tokens if needed)
- Input sanitization
- Error logging

## 📈 Performance Features

### Database Optimization:
- Indexed columns for faster queries
- Soft deletes preserve data integrity
- JSON storage for flexible data structures

### Caching:
- Browser caching for uploaded images
- Optimized queries with minimal data transfer

## 🚀 Next Steps

### After Installation:
1. **Test all functionality** in admin panel
2. **Add products** to populate your catalog
3. **Customize content** to match your business
4. **Upload your logo** and images
5. **Configure contact information**

### Production Deployment:
1. Change database credentials
2. Enable authentication in admin panel
3. Set up SSL certificates
4. Configure proper file permissions
5. Implement regular database backups

### Enhancement Opportunities:
1. Add user authentication and roles
2. Implement email notifications
3. Add product image galleries
4. Create customer inquiry system
5. Add analytics tracking

## 📞 Support

If you encounter any issues:

1. **Check this guide** for common solutions
2. **Verify XAMPP setup** (Apache + MySQL running)
3. **Test database connection** via phpMyAdmin
4. **Check browser console** for JavaScript errors
5. **Review Apache error logs** in XAMPP

## 🎉 Congratulations!

You now have a complete PHP backend system for your Mena Play World website with:

- ✅ **8 Database Tables** for comprehensive content management
- ✅ **12+ API Endpoints** for full CRUD operations
- ✅ **File Upload System** with security features
- ✅ **Admin Panel Integration** with real-time data
- ✅ **Security Features** to protect your data
- ✅ **Performance Optimizations** for smooth operation

Your admin panel is now fully connected to the database and ready for use!

---

**Last Updated**: December 2024  
**Version**: 1.0  
**Created for**: Mena Play World Admin Panel