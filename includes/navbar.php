<?php
// Get current page name for active navigation
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>

<nav>
    <div class="brand">
        <img src="assets/logo.png" alt="logo" class="logo" />
        <div class="title">
            <div class="main">Mena Play World</div>
            <div class="sub">Solution Equipment</div>
        </div>
    </div>
    <ul class="nav-links">
        <li><a href="index.php" <?php echo ($current_page == 'index') ? 'class="active"' : ''; ?>>Home</a></li>
        <li><a href="about.php" <?php echo ($current_page == 'about') ? 'class="active"' : ''; ?>>About</a></li>
        <li><a href="products.php" <?php echo ($current_page == 'products') ? 'class="active"' : ''; ?>>Products</a></li>
        <li><a href="contact.php" <?php echo ($current_page == 'contact') ? 'class="active"' : ''; ?>>Contact</a></li>
    </ul>
    <a href="contact.php#contact" class="cta-button">Get Quote</a>
</nav>
