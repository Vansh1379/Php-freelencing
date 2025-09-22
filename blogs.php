<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs - Mena Play World</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    include 'includes/header.php';
    include 'includes/dynamic-data.php';
    
    // Fetch dynamic data
    $companyInfo = getCompanyInfo();
    ?>
    
    <!-- Blogs Hero Section -->
    <section class="hero" style="padding-top: 120px; min-height: 50vh; background: linear-gradient(135deg, rgba(179, 65, 38, 0.9), rgba(179, 65, 38, 0.8)), url('https://images.unsplash.com/photo-1544816155-12df9643f363?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; color: white; display: flex; align-items: center; text-align: center;">
        <div class="hero-content" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <h1 style="font-size: 3rem; font-weight: bold; margin-bottom: 1rem;">Our Blog</h1>
            <p style="font-size: 1.2rem; max-width: 600px; margin: 0 auto; opacity: 0.9;">
                Latest insights on playground safety, design trends, and equipment maintenance
            </p>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="about" style="padding: 5rem 2rem; background: white;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 3rem; color: #333;">
                Latest <span class="highlight" style="color: #b34126;">Articles</span>
            </h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <!-- Blog Post 1 -->
                <article style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 200px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                        🛡️
                    </div>
                    <div style="padding: 2rem;">
                        <div style="color: #b34126; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;">SAFETY</div>
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem; line-height: 1.4;">Essential Playground Safety Guidelines for Parents</h3>
                        <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;">
                            Learn the most important safety tips every parent should know when their children are playing on playground equipment.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 0.9rem;">December 15, 2024</span>
                            <a href="#" style="color: #b34126; text-decoration: none; font-weight: 600;">Read More →</a>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 2 -->
                <article style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 200px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                        🎨
                    </div>
                    <div style="padding: 2rem;">
                        <div style="color: #b34126; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;">DESIGN</div>
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem; line-height: 1.4;">2024 Playground Design Trends</h3>
                        <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;">
                            Discover the latest trends in playground design including inclusive play, nature integration, and technology-enhanced equipment.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 0.9rem;">December 10, 2024</span>
                            <a href="#" style="color: #b34126; text-decoration: none; font-weight: 600;">Read More →</a>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 3 -->
                <article style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 200px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                        🔧
                    </div>
                    <div style="padding: 2rem;">
                        <div style="color: #b34126; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;">MAINTENANCE</div>
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem; line-height: 1.4;">Playground Equipment Maintenance Checklist</h3>
                        <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;">
                            A comprehensive guide to maintaining playground equipment to ensure safety and longevity of your play structures.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 0.9rem;">December 5, 2024</span>
                            <a href="#" style="color: #b34126; text-decoration: none; font-weight: 600;">Read More →</a>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 4 -->
                <article style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 200px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                        🌱
                    </div>
                    <div style="padding: 2rem;">
                        <div style="color: #b34126; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;">SUSTAINABILITY</div>
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem; line-height: 1.4;">Eco-Friendly Playground Materials</h3>
                        <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;">
                            Learn about sustainable materials used in modern playground construction and their environmental benefits.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 0.9rem;">November 28, 2024</span>
                            <a href="#" style="color: #b34126; text-decoration: none; font-weight: 600;">Read More →</a>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 5 -->
                <article style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 200px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                        👶
                    </div>
                    <div style="padding: 2rem;">
                        <div style="color: #b34126; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;">DEVELOPMENT</div>
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem; line-height: 1.4;">How Playgrounds Support Child Development</h3>
                        <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;">
                            Understanding the role of playground equipment in physical, social, and cognitive development of children.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 0.9rem;">November 20, 2024</span>
                            <a href="#" style="color: #b34126; text-decoration: none; font-weight: 600;">Read More →</a>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 6 -->
                <article style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                    <div style="height: 200px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                        🏗️
                    </div>
                    <div style="padding: 2rem;">
                        <div style="color: #b34126; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;">INSTALLATION</div>
                        <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem; line-height: 1.4;">Playground Installation Process</h3>
                        <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;">
                            A step-by-step guide to playground installation from site preparation to final safety inspection.
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #666; font-size: 0.9rem;">November 15, 2024</span>
                            <a href="#" style="color: #b34126; text-decoration: none; font-weight: 600;">Read More →</a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Newsletter Signup -->
            <div style="background: #f8f9fa; padding: 3rem; border-radius: 15px; margin-bottom: 3rem; text-align: center;">
                <h3 style="color: #333; margin-bottom: 1rem; font-size: 2rem;">Stay Updated</h3>
                <p style="color: #666; margin-bottom: 2rem; font-size: 1.1rem;">
                    Subscribe to our newsletter for the latest playground insights, safety tips, and industry updates.
                </p>
                <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <input type="email" placeholder="Enter your email address" style="padding: 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; min-width: 300px;">
                    <button style="background: linear-gradient(135deg, #b34126, #b34126); color: white; padding: 1rem 2rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: transform 0.3s;">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" style="background: #f8fafc; padding: 5rem 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: #333;">Have Questions?</h2>
            <p style="color: #666; margin-bottom: 3rem; font-size: 1.1rem;">
                Our team of experts is here to help with any playground-related questions or concerns.
            </p>
            <a href="contact.php" style="background: linear-gradient(135deg, #b34126, #b34126); color: white; padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block; transition: transform 0.3s;">
                Contact Our Experts
            </a>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="script.js"></script>
</body>
</html>
