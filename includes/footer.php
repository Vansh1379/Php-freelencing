<?php
// Include configuration if not already included
if (!defined('COMPANY_NAME')) {
    require_once 'config.php';
}
?>

<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3><?php echo COMPANY_NAME; ?></h3>
            <p>
                Creating safe and exciting play spaces for children across India
                with quality playground equipment.
            </p>
        </div>

        <div class="footer-section">
            <h3>Useful Links</h3>
            <?php
            global $footer_links;
            foreach ($footer_links['useful_links'] as $title => $url):
            ?>
            <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
            <?php endforeach; ?>
        </div>

        <div class="footer-section">
            <h3>Our Products</h3>
            <?php
            foreach ($footer_links['products_links'] as $title => $url):
            ?>
            <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
            <?php endforeach; ?>
        </div>

        <div class="footer-section">
            <h3>Contact Info</h3>
            <a href="tel:<?php echo str_replace(' ', '', CONTACT_PHONE); ?>"><?php echo CONTACT_PHONE; ?></a>
            <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
            <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.9rem">
                <?php echo COMPANY_ADDRESS; ?>
            </p>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php echo COMPANY_NAME; ?>. All rights reserved.</p>
    </div>
</footer>
