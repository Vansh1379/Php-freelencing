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
    
    // Fetch latest work from database
    $latestWork = fetchAll("SELECT * FROM latest_work WHERE is_active = 1 ORDER BY sort_order ASC, project_date DESC");
    ?>
    
    <!-- Main Latest Work Section -->
    <section class="products-main" id="latest-work" style="padding-top: 120px;">
        <div class="products-container">
            <div class="products-header">
                <h1 style="font-size: 3rem; color: #2c3e50; margin-bottom: 20px; font-weight: 700;">Our Latest Work</h1>
                <p>
                    Showcasing our recent playground equipment installations and custom projects
                </p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <?php if (!empty($latestWork)): ?>
                    <?php foreach ($latestWork as $project): ?>
                        <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                            <?php if (!empty($project['image_path'])): ?>
                                <div style="height: 250px; overflow: hidden;">
                                    <img src="<?php echo htmlspecialchars($project['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($project['title']); ?>" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            <?php else: ?>
                                <div style="height: 250px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                    🎠
                                </div>
                            <?php endif; ?>
                            <div style="padding: 2rem;">
                                <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem;"><?php echo htmlspecialchars($project['title']); ?></h3>
                                <p style="color: #666; margin-bottom: 1rem; line-height: 1.6;">
                                    <?php echo htmlspecialchars($project['description']); ?>
                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: #b34126; font-weight: 600;"><?php echo htmlspecialchars($project['location']); ?></span>
                                    <span style="color: #666; font-size: 0.9rem;"><?php echo date('Y', strtotime($project['project_date'])); ?></span>
                                </div>
                                <?php if (!empty($project['category'])): ?>
                                    <div style="margin-top: 0.5rem;">
                                        <span style="background: #b34126; color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.8rem;">
                                            <?php echo htmlspecialchars($project['category']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #666;">
                        <p>No projects available at the moment.</p>
                    </div>
                <?php endif; ?>
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
