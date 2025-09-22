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
    
    <!-- Certification Hero Section -->
    <section class="hero" style="padding-top: 120px; min-height: 50vh; background: linear-gradient(135deg, rgba(179, 65, 38, 0.9), rgba(179, 65, 38, 0.8)), url('https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: white; display: flex; align-items: center; text-align: center;">
        <div class="hero-content" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 1rem;">Our Certifications</h1>
            <p style="font-size: 1.2rem; max-width: 600px; margin: 0 auto; opacity: 0.9;">
                Quality assurance and safety standards that guarantee the highest quality playground equipment
            </p>
        </div>
    </section>

    <!-- Certifications Section -->
    <section class="about" style="padding: 5rem 2rem; background: white;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 3rem; color: #333;">
                Quality <span class="highlight" style="color: #b34126;">Certifications</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <!-- ISO Certification -->
                <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; border: 2px solid #b34126;">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">🏆</div>
                    <h3 style="color: #b34126; margin-bottom: 1rem; font-size: 1.5rem;">ISO 9001:2015</h3>
                    <p style="color: #666; line-height: 1.6;">
                        International standard for quality management systems ensuring consistent quality in our manufacturing processes.
                    </p>
                </div>

                <!-- Safety Certification -->
                <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; border: 2px solid #b34126;">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">🛡️</div>
                    <h3 style="color: #b34126; margin-bottom: 1rem; font-size: 1.5rem;">Safety Standards</h3>
                    <p style="color: #666; line-height: 1.6;">
                        All equipment meets international safety standards including ASTM and EN standards for playground safety.
                    </p>
                </div>

                <!-- Environmental Certification -->
                <div style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; border: 2px solid #b34126;">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">🌱</div>
                    <h3 style="color: #b34126; margin-bottom: 1rem; font-size: 1.5rem;">Environmental</h3>
                    <p style="color: #666; line-height: 1.6;">
                        Eco-friendly manufacturing processes and sustainable materials used in our playground equipment.
                    </p>
                </div>
            </div>

            <!-- Quality Assurance -->
            <div style="background: #f8f9fa; padding: 3rem; border-radius: 15px; margin-bottom: 3rem;">
                <h3 style="text-align: center; color: #333; margin-bottom: 2rem; font-size: 2rem;">Quality Assurance Process</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                        <h4 style="color: #b34126; margin-bottom: 0.5rem;">Material Testing</h4>
                        <p style="color: #666; font-size: 0.9rem;">Rigorous testing of all materials before production</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">⚙️</div>
                        <h4 style="color: #b34126; margin-bottom: 0.5rem;">Manufacturing</h4>
                        <p style="color: #666; font-size: 0.9rem;">Precision manufacturing with quality checkpoints</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">✅</div>
                        <h4 style="color: #b34126; margin-bottom: 0.5rem;">Final Inspection</h4>
                        <p style="color: #666; font-size: 0.9rem;">Comprehensive final inspection before delivery</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
                        <h4 style="color: #b34126; margin-bottom: 0.5rem;">Documentation</h4>
                        <p style="color: #666; font-size: 0.9rem;">Complete certification and warranty documentation</p>
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
