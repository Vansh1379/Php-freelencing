<?php
// Get current page name for active navigation
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>

<nav>
    <div class="brand">
        <img src="assets/logo.png" alt="logo" class="logo" />
    </div>
    <ul class="nav-links">
        <li><a href="index.php" <?php echo ($current_page == 'index') ? 'class="active"' : ''; ?>>Home</a></li>
        <li><a href="about.php" <?php echo ($current_page == 'about') ? 'class="active"' : ''; ?>>About</a></li>
        <li class="nav-dropdown">
            <a href="products.php" <?php echo (in_array($current_page, ['products', 'playground-equipment', 'outdoor-gym', 'indoor-gym'])) ? 'class="active"' : ''; ?>>
                Products
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="dropdown-icon">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </a>
            <ul class="dropdown-menu">
                <li><a href="products.php">All Products</a></li>
                <li><a href="playground-equipment.php">Playground Equipment</a></li>
                <li><a href="outdoor-gym.php">Outdoor Gym</a></li>
                <li><a href="indoor-gym.php">Indoor Gym</a></li>
            </ul>
        </li>
        <li><a href="contact.php" <?php echo ($current_page == 'contact') ? 'class="active"' : ''; ?>>Contact</a></li>
    </ul>
    <a href="contact.php#contact" class="cta-button">Get Quote</a>
</nav>
