<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Latest Work - Mena Play World</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    include 'includes/header.php';
    include 'includes/dynamic-data.php';
    
    // Fetch dynamic data
    $companyInfo = getCompanyInfo();
    ?>
    
    <!-- Latest Work Hero Section -->
    <section class="hero" style="padding-top: 120px; min-height: 50vh; background: linear-gradient(135deg, rgba(179, 65, 38, 0.9), rgba(179, 65, 38, 0.8)), url('https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: white; display: flex; align-items: center; text-align: center;">
        <div class="hero-content" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 1rem;">Our Latest Work</h1>
            <p style="font-size: 1.2rem; max-width: 600px; margin: 0 auto; opacity: 0.9;">
                Showcasing our recent playground equipment installations and custom projects
            </p>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="about" style="padding: 5rem 2rem; background: white;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 3rem; color: #333;">
                Recent <span class="highlight" style="color: #b34126;">Projects</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <!-- Project 1 -->
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 250px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        🎠
                    </div>
                    <div style="padding: 2rem;">
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem;">City Park Playground</h3>
                        <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                            Complete playground renovation for a major city park featuring modern climbing structures, swings, and interactive play panels.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #b34126; font-weight: 600;">Delhi, India</span>
                            <span style="color: #666; font-size: 0.9rem;">2024</span>
                        </div>
                    </div>
                </div>

                <!-- Project 2 -->
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 250px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        🏫
                    </div>
                    <div style="padding: 2rem;">
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem;">International School</h3>
                        <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                            Custom-designed playground equipment for an international school with age-appropriate play zones and educational elements.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #b34126; font-weight: 600;">Mumbai, India</span>
                            <span style="color: #666; font-size: 0.9rem;">2024</span>
                        </div>
                    </div>
                </div>

                <!-- Project 3 -->
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 250px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        🏢
                    </div>
                    <div style="padding: 2rem;">
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem;">Corporate Campus</h3>
                        <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                            Employee recreation area with outdoor gym equipment and children's play zone for a leading corporate campus.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #b34126; font-weight: 600;">Bangalore, India</span>
                            <span style="color: #666; font-size: 0.9rem;">2023</span>
                        </div>
                    </div>
                </div>

                <!-- Project 4 -->
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 250px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        🏘️
                    </div>
                    <div style="padding: 2rem;">
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem;">Residential Complex</h3>
                        <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                            Multi-level playground installation for a premium residential complex with safety-first design approach.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #b34126; font-weight: 600;">Pune, India</span>
                            <span style="color: #666; font-size: 0.9rem;">2023</span>
                        </div>
                    </div>
                </div>

                <!-- Project 5 -->
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 250px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        🎯
                    </div>
                    <div style="padding: 2rem;">
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem;">Community Center</h3>
                        <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                            Inclusive playground design for a community center with accessibility features and multi-generational play equipment.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #b34126; font-weight: 600;">Chennai, India</span>
                            <span style="color: #666; font-size: 0.9rem;">2023</span>
                        </div>
                    </div>
                </div>

                <!-- Project 6 -->
                <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 250px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                        🏥
                    </div>
                    <div style="padding: 2rem;">
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem;">Hospital Playground</h3>
                        <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                            Therapeutic play area for children's hospital with calming colors and sensory play elements designed for healing.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #b34126; font-weight: 600;">Kolkata, India</span>
                            <span style="color: #666; font-size: 0.9rem;">2023</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Project Stats -->
            <div style="background: #f8f9fa; padding: 3rem; border-radius: 15px; margin-bottom: 3rem;">
                <h3 style="text-align: center; color: #333; margin-bottom: 2rem; font-size: 2rem;">Project Statistics</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; color: #b34126; font-weight: bold; margin-bottom: 0.5rem;">500+</div>
                        <p style="color: #666; font-size: 1.1rem;">Projects Completed</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; color: #b34126; font-weight: bold; margin-bottom: 0.5rem;">25+</div>
                        <p style="color: #666; font-size: 1.1rem;">Cities Covered</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; color: #b34126; font-weight: bold; margin-bottom: 0.5rem;">10+</div>
                        <p style="color: #666; font-size: 1.1rem;">Years Experience</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="font-size: 3rem; color: #b34126; font-weight: bold; margin-bottom: 0.5rem;">100%</div>
                        <p style="color: #666; font-size: 1.1rem;">Client Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" style="background: #f8fafc; padding: 5rem 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: #333;">Ready to Start Your Project?</h2>
            <p style="color: #666; margin-bottom: 3rem; font-size: 1.1rem;">
                Let us create an amazing playground experience for your space. Contact us for a free consultation.
            </p>
            <a href="contact.php" style="background: linear-gradient(135deg, #b34126, #b34126); color: white; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; transition: transform 0.3s;">
                Get Free Quote
            </a>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>
