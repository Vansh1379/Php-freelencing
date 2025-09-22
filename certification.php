<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification - Mena Play World</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    include 'includes/header.php';
    include 'includes/dynamic-data.php';
    
    // Fetch dynamic data
    $companyInfo = getCompanyInfo();
    
    // Fetch certifications from database
    $certifications = fetchAll("SELECT * FROM certifications WHERE is_active = 1 ORDER BY sort_order ASC, created_at DESC");
    ?>
    
    <!-- Main Certification Section -->
    <section class="products-main" id="certification" style="padding-top: 120px;">
        <div class="products-container">
            <div class="products-header">
                <h1 style="font-size: 3rem; color: #2c3e50; margin-bottom: 20px; font-weight: 700;">Our Certifications</h1>
                <p>
                    Quality assurance and safety standards that guarantee the highest quality playground equipment
                </p>
            </div>
            
            <!-- Certification Images -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <?php if (!empty($certifications)): ?>
                    <?php foreach ($certifications as $certification): ?>
                        <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center;">
                            <?php if (!empty($certification['image_path'])): ?>
                                <div style="width: 100%; height: 200px; border-radius: 10px; margin-bottom: 1rem; overflow: hidden;">
                                    <img src="<?php echo htmlspecialchars($certification['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($certification['title']); ?>" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            <?php else: ?>
                                <div style="width: 100%; height: 200px; background: #f8f9fa; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; border: 2px dashed #ddd;">
                                    <span style="color: #999; font-size: 1.1rem;"><?php echo htmlspecialchars($certification['title']); ?></span>
                                </div>
                            <?php endif; ?>
                            <h3 style="color: #b34126; margin-bottom: 0.5rem; font-size: 1.2rem;"><?php echo htmlspecialchars($certification['title']); ?></h3>
                            <?php if (!empty($certification['description'])): ?>
                                <p style="color: #666; font-size: 0.9rem; line-height: 1.4;"><?php echo htmlspecialchars($certification['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #666;">
                        <p>No certifications available at the moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" style="background: #f8fafc; padding: 5rem 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: #333;">Need More Information?</h2>
            <p style="color: #666; margin-bottom: 3rem; font-size: 1.1rem;">
                Contact us for detailed certification documents and quality assurance information.
            </p>
            <a href="contact.php" style="background: linear-gradient(135deg, #b34126, #b34126); color: white; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; transition: transform 0.3s;">
                Contact Us
            </a>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>
