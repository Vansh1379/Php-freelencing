<?php
/**
 * Database Installation Script
 * Mena Play World Admin Panel
 *
 * Run this file once to set up the database and tables
 */

// Include database configuration
require_once 'includes/database.php';

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering for clean display
ob_start();

echo "<!DOCTYPE html>\n";
echo "<html lang='en'>\n";
echo "<head>\n";
echo "    <meta charset='UTF-8'>\n";
echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
echo "    <title>Database Installation - Mena Play World</title>\n";
echo "    <style>\n";
echo "        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f5f5f5; }\n";
echo "        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }\n";
echo "        h1 { color: #333; text-align: center; margin-bottom: 30px; }\n";
echo "        .step { margin: 20px 0; padding: 15px; border-left: 4px solid #007cba; background: #f0f8ff; }\n";
echo "        .success { border-left-color: #28a745; background: #f0fff0; color: #155724; }\n";
echo "        .error { border-left-color: #dc3545; background: #fff0f0; color: #721c24; }\n";
echo "        .warning { border-left-color: #ffc107; background: #fffbf0; color: #856404; }\n";
echo "        .code { background: #f8f9fa; padding: 10px; border-radius: 5px; font-family: monospace; margin: 10px 0; }\n";
echo "        .btn { display: inline-block; padding: 10px 20px; background: #007cba; color: white; text-decoration: none; border-radius: 5px; margin: 10px 5px; }\n";
echo "        .btn:hover { background: #005a87; }\n";
echo "        .progress { width: 100%; height: 20px; background: #e9ecef; border-radius: 10px; margin: 20px 0; }\n";
echo "        .progress-bar { height: 100%; background: #28a745; border-radius: 10px; transition: width 0.3s; }\n";
echo "    </style>\n";
echo "</head>\n";
echo "<body>\n";
echo "    <div class='container'>\n";
echo "        <h1>🚀 Mena Play World Database Installation</h1>\n";

// Check if already installed
function checkInstallation() {
    try {
        $db = getDB();
        $tables = $db->query("SHOW TABLES LIKE 'site_settings'")->fetchAll();
        return count($tables) > 0;
    } catch (Exception $e) {
        return false;
    }
}

// Function to test database connection
function testDatabaseConnection() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=utf8mb4",
            DB_USERNAME,
            DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return ['success' => true, 'message' => 'Database connection successful'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    }
}

// Function to create database if not exists
function createDatabase() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";charset=utf8mb4",
            DB_USERNAME,
            DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        return ['success' => true, 'message' => 'Database created/verified successfully'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    }
}

// Installation process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install'])) {
    echo "<div class='progress'><div class='progress-bar' style='width: 10%'></div></div>\n";

    // Step 1: Test connection
    echo "<div class='step'>📡 <strong>Step 1:</strong> Testing database connection...</div>\n";
    $connectionTest = testDatabaseConnection();

    if (!$connectionTest['success']) {
        echo "<div class='error'>❌ Connection failed: " . htmlspecialchars($connectionTest['message']) . "</div>\n";
        echo "<div class='warning'>Please check your database configuration in <code>includes/database.php</code></div>\n";
        echo "<div class='code'>";
        echo "Current settings:<br>";
        echo "Host: " . DB_HOST . "<br>";
        echo "Username: " . DB_USERNAME . "<br>";
        echo "Database: " . DB_NAME . "<br>";
        echo "</div>";
        exit;
    }

    echo "<div class='success'>✅ " . $connectionTest['message'] . "</div>\n";
    echo "<div class='progress'><div class='progress-bar' style='width: 25%'></div></div>\n";

    // Step 2: Create database
    echo "<div class='step'>🗃️ <strong>Step 2:</strong> Creating database...</div>\n";
    $dbCreation = createDatabase();

    if (!$dbCreation['success']) {
        echo "<div class='error'>❌ Database creation failed: " . htmlspecialchars($dbCreation['message']) . "</div>\n";
        exit;
    }

    echo "<div class='success'>✅ " . $dbCreation['message'] . "</div>\n";
    echo "<div class='progress'><div class='progress-bar' style='width: 50%'></div></div>\n";

    // Step 3: Initialize tables and data
    echo "<div class='step'>📋 <strong>Step 3:</strong> Creating tables and inserting default data...</div>\n";

    try {
        initializeDatabase();
        echo "<div class='success'>✅ Tables created and default data inserted successfully</div>\n";
        echo "<div class='progress'><div class='progress-bar' style='width: 75%'></div></div>\n";

        // Step 4: Verify installation
        echo "<div class='step'>🔍 <strong>Step 4:</strong> Verifying installation...</div>\n";

        $db = getDB();
        $tables = [
            'site_settings',
            'hero_section',
            'company_info',
            'about_content',
            'products',
            'navigation_menu',
            'statistics',
            'file_uploads',
            'certifications',
            'latest_work',
            'blogs'
        ];

        $verified = true;
        foreach ($tables as $table) {
            $result = $db->query("SHOW TABLES LIKE '$table'")->fetchAll();
            if (count($result) > 0) {
                echo "<div class='success'>✅ Table '$table' created successfully</div>\n";
            } else {
                echo "<div class='error'>❌ Table '$table' not found</div>\n";
                $verified = false;
            }
        }

        echo "<div class='progress'><div class='progress-bar' style='width: 100%'></div></div>\n";

        if ($verified) {
            echo "<div class='success'>";
            echo "<h2>🎉 Installation Complete!</h2>";
            echo "<p>Your Mena Play World database has been successfully installed.</p>";
            echo "<h3>📊 Database Summary:</h3>";
            echo "<ul>";
            foreach ($tables as $table) {
                $count = $db->query("SELECT COUNT(*) FROM $table")->fetchColumn();
                echo "<li><strong>$table:</strong> $count records</li>";
            }
            echo "</ul>";
            echo "<h3>🔗 Next Steps:</h3>";
            echo "<p>1. Access your admin panel: <a href='admin.php' class='btn'>Go to Admin Panel</a></p>";
            echo "<p>2. Visit your website: <a href='index.php' class='btn'>View Website</a></p>";
            echo "<p>3. For security, consider deleting this installation file after use.</p>";
            echo "</div>";
        }

    } catch (Exception $e) {
        echo "<div class='error'>❌ Installation failed: " . htmlspecialchars($e->getMessage()) . "</div>\n";
        echo "<div class='warning'>Please check the error message above and try again.</div>\n";
    }

} else {
    // Show installation form
    if (checkInstallation()) {
        echo "<div class='warning'>";
        echo "<h2>⚠️ Database Already Installed</h2>";
        echo "<p>It looks like your database is already set up. If you want to reinstall:</p>";
        echo "<ol>";
        echo "<li>Backup your existing data if needed</li>";
        echo "<li>Drop the database or tables manually</li>";
        echo "<li>Run this installer again</li>";
        echo "</ol>";
        echo "<a href='admin.php' class='btn'>Go to Admin Panel</a>";
        echo "<a href='index.php' class='btn'>View Website</a>";
        echo "</div>";
    } else {
        echo "<div class='step'>";
        echo "<h2>🎯 Welcome to the Installation Process</h2>";
        echo "<p>This installer will set up the database and tables for your Mena Play World admin panel.</p>";
        echo "<h3>📋 What will be installed:</h3>";
        echo "<ul>";
        echo "<li><strong>Database:</strong> " . DB_NAME . "</li>";
        echo "<li><strong>Tables:</strong> 8 tables for managing your website content</li>";
        echo "<li><strong>Default Data:</strong> Sample content to get you started</li>";
        echo "</ul>";
        echo "<h3>⚙️ Current Configuration:</h3>";
        echo "<div class='code'>";
        echo "Host: " . DB_HOST . "<br>";
        echo "Username: " . DB_USERNAME . "<br>";
        echo "Database: " . DB_NAME . "<br>";
        echo "</div>";
        echo "<p><strong>Note:</strong> Make sure your MySQL server is running and the credentials are correct.</p>";
        echo "</div>";

        echo "<form method='POST'>";
        echo "<div style='text-align: center; margin: 30px 0;'>";
        echo "<button type='submit' name='install' class='btn' style='font-size: 18px; padding: 15px 30px;'>";
        echo "🚀 Start Installation";
        echo "</button>";
        echo "</div>";
        echo "</form>";
    }
}

echo "    </div>\n";

// Add some JavaScript for better UX
echo "<script>";
echo "document.addEventListener('DOMContentLoaded', function() {";
echo "    const progressBars = document.querySelectorAll('.progress-bar');";
echo "    progressBars.forEach(bar => {";
echo "        bar.style.width = '0%';";
echo "        setTimeout(() => {";
echo "            bar.style.width = bar.getAttribute('style').split('width: ')[1];";
echo "        }, 100);";
echo "    });";
echo "});";
echo "</script>";

echo "</body>\n";
echo "</html>\n";

// Flush output
ob_end_flush();
?>
