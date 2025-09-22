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
                <!-- Certification Image 1 -->
                <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center;">
                    <div style="width: 100%; height: 200px; background: #f8f9fa; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; border: 2px dashed #ddd;">
                        <span style="color: #999; font-size: 1.1rem;">Certification Image 1</span>
                    </div>
                </div>

                <!-- Certification Image 2 -->
                <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center;">
                    <div style="width: 100%; height: 200px; background: #f8f9fa; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; border: 2px dashed #ddd;">
                        <span style="color: #999; font-size: 1.1rem;">Certification Image 2</span>
                    </div>
                </div>

                <!-- Certification Image 3 -->
                <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center;">
                    <div style="width: 100%; height: 200px; background: #f8f9fa; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; border: 2px dashed #ddd;">
                        <span style="color: #999; font-size: 1.1rem;">Certification Image 3</span>
                    </div>
                </div>
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
