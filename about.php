<?php
// Include configuration
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About - Mema Play World</title>
    <link rel="stylesheet" href="about.css" />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <?php 
    include 'includes/header.php';
    include 'includes/dynamic-data.php';

    // Fetch dynamic data
    $companyInfo = getCompanyInfo();
    $aboutContent = getAboutContent();
    $siteStats = getWebsiteStatistics();
    ?>
    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <!-- Header -->
            <div class="header">
                <h2>About Us</h2>
            </div>

            <div class="main-grid">
                <!-- Logo/Branding Section -->
                <div class="logo-section">
                    <div class="logo-container">
                        <div class="logo-wrapper">
                            <img
                                src="<?php echo LOGO_PATH; ?>"
                                alt="<?php echo htmlspecialchars($companyInfo['company_name'] ?? 'Mema Play World'); ?> Logo"
                                class="logo-image"
                            />
                        </div>
                        <h3 class="company-name"><?php echo htmlspecialchars($companyInfo['company_name'] ?? 'MEMA PLAY WORLD'); ?></h3>
                        <p class="company-subtitle"><?php echo htmlspecialchars($companyInfo['certification'] ?? 'AN ISO 9001:2015 CERTIFIED COMPANY'); ?></p>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="content-section">
                    <h3><?php echo htmlspecialchars($companyInfo['welcome_title'] ?? 'Welcome to Mema Play World'); ?></h3>
                    
                    <div class="content-text">
                        <?php
                        if (!empty($aboutContent)) {
                            foreach ($aboutContent as $content) {
                                if ($content['content_type'] === 'paragraph' || $content['content_type'] === 'main_intro') {
                                    echo "<p>" . nl2br(htmlspecialchars($content['content_text'])) . "</p>";
                                } elseif ($content['content_type'] === 'heading') {
                                    echo "<h4>" . htmlspecialchars($content['content_title']) . "</h4>";
                                    if (!empty($content['content_text'])) {
                                        echo "<p>" . nl2br(htmlspecialchars($content['content_text'])) . "</p>";
                                    }
                                }
                            }
                        } else {
                            // Fallback content
                            echo "<p>Welcome to " . htmlspecialchars($companyInfo['company_name'] ?? 'Mema Play World') . ", your premier destination for high-quality playground equipment and solutions. With a passion for creating engaging and safe play spaces, we have been serving communities and institutions for 10 years with our innovative and durable products.</p>";
                            
                            echo "<p>At " . htmlspecialchars($companyInfo['company_name'] ?? 'Mema Play World') . ", we believe that play is an essential part of childhood development. Our mission is to design and manufacture playground equipment that not only sparks children's imaginations but also promotes physical activity, social interaction, and cognitive growth. We take pride in creating environments where children can explore, learn, and have endless fun.</p>";
                            
                            echo "<p>What sets us apart is our commitment to quality and safety. We understand the importance of providing durable, long-lasting equipment that can withstand the rigors of active play. Our team of experienced designers and engineers work diligently to craft each piece, adhering to strict safety standards and utilizing premium materials. We ensure that our equipment is thoroughly tested to provide the utmost safety for children of all ages.</p>";
                            
                            echo "<p>At " . htmlspecialchars($companyInfo['company_name'] ?? 'Mema Play World') . ", we offer a wide range of playground solutions to suit various needs and spaces. From traditional swings and slides to elaborate climbing structures and interactive play panels, we have something to captivate every child's imagination. Our designs cater to different age groups, ensuring that children of all abilities can enjoy our play spaces.</p>";
                            
                            echo "<p>We are proud to collaborate with schools, parks, day-care centers, municipalities, and other organizations to create customized play areas that meet their specific requirements. Our team of experts is dedicated to guiding you through the entire process, from initial concept development to installation and beyond. We prioritize open communication, listening to your needs and vision, to deliver playground solutions that exceed expectations.</p>";
                            
                            echo "<p>Customer satisfaction is at the heart of everything we do. We take pride in providing exceptional service, ensuring a seamless experience from start to finish. Our knowledgeable staff is always available to answer your questions, provide guidance, and offer ongoing support.</p>";
                            
                            echo "<p>Thank you for considering " . htmlspecialchars($companyInfo['company_name'] ?? 'Mema Play World') . " as your trusted partner in creating inspiring play spaces. We look forward to collaborating with you to bring joy, laughter, and endless adventures to children in your community.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats-grid">
                <?php
                $aboutStats = array_slice($siteStats, 0, 4); // Get first 4 stats
                if (empty($aboutStats)) {
                    // Fallback stats
                    $aboutStats = [
                        ['stat_value' => '10+', 'stat_label' => 'Years of Experience'],
                        ['stat_value' => '1000+', 'stat_label' => 'Total No of Products'],
                        ['stat_value' => '50+', 'stat_label' => 'No of Team'],
                        ['stat_value' => '500+', 'stat_label' => 'Happy Customers']
                    ];
                }
                
                foreach ($aboutStats as $stat): ?>
                <div class="card">
                    <div class="card-content">
                        <div class="stat-value"><?php echo htmlspecialchars($stat['stat_value']); ?></div>
                        <div class="stat-label"><?php echo htmlspecialchars($stat['stat_label']); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php'; ?>

    <script src="about.js"></script>
  </body>
</html>
