<?php
// Include configuration
require_once 'config.php';

// Get current page name for active navigation
$current_page = getCurrentPage();

// Check if we should show the header top section (email/phone)
$show_header_top = shouldShowHeaderTop();
?>

<header>
    <?php if ($show_header_top): ?>
    <div class="aboveDiv">
        <div class="mail">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="10"
                height="10"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="icon"
            >
                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            </svg>
            <div><?php echo CONTACT_EMAIL; ?></div>
        </div>
        <div class="phoneDiv">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="10"
                height="10"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="phoneIcon"
            >
                <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                ></path>
            </svg>
            <div class="phone"><?php echo CONTACT_PHONE; ?></div>
        </div>
    </div>
    <?php endif; ?>

    <nav>
        <div class="brand">
            <img src="<?php echo LOGO_PATH; ?>" alt="logo" class="logo" />
            <div class="title">
                <div class="main"><?php echo SITE_NAME; ?></div>
                <div class="sub"><?php echo SITE_TAGLINE; ?></div>
            </div>
        </div>
        <ul class="nav-links">
            <?php
            global $navigation_menu;
            foreach ($navigation_menu as $page => $title):
                $active_class = ($current_page == $page) ? 'class="active"' : '';
            ?>
            <li><a href="<?php echo $page; ?>.php" <?php echo $active_class; ?>><?php echo $title; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
