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
    
    // Fetch blogs from database
    $blogs = fetchAll("SELECT * FROM blogs WHERE is_active = 1 ORDER BY sort_order ASC, publish_date DESC");
    ?>
    
    <!-- Main Blogs Section -->
    <section class="products-main" id="blogs" style="padding-top: 120px;">
        <div class="products-container">
            <div class="products-header">
                <h1 style="font-size: 3rem; color: #2c3e50; margin-bottom: 20px; font-weight: 700;">Our Blog</h1>
                <p>
                    Latest insights on playground safety, design trends, and equipment maintenance
                </p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
                <?php if (!empty($blogs)): ?>
                    <?php foreach ($blogs as $index => $blog): ?>
                        <article class="blog-card" data-blog="<?php echo $blog['id']; ?>" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); transition: transform 0.3s; cursor: pointer;">
                            <?php if (!empty($blog['image_path'])): ?>
                                <div style="height: 200px; overflow: hidden;">
                                    <img src="<?php echo htmlspecialchars($blog['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($blog['title']); ?>" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            <?php else: ?>
                                <div style="height: 200px; background: linear-gradient(135deg, #b34126, #b34126); display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem;">
                                    🛡️
                                </div>
                            <?php endif; ?>
                            <div style="padding: 2rem;">
                                <div style="color: #b34126; font-size: 0.9rem; font-weight: 600; margin-bottom: 0.5rem;"><?php echo htmlspecialchars($blog['category']); ?></div>
                                <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.3rem; line-height: 1.4;"><?php echo htmlspecialchars($blog['title']); ?></h3>
                                <p style="color: #666; margin-bottom: 1.5rem; line-height: 1.6;">
                                    <?php echo htmlspecialchars($blog['description']); ?>
                                </p>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: #666; font-size: 0.9rem;"><?php echo date('F j, Y', strtotime($blog['publish_date'])); ?></span>
                                    <span style="color: #b34126; text-decoration: none; font-weight: 600;">Read More →</span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #666;">
                        <p>No blog posts available at the moment.</p>
                    </div>
                <?php endif; ?>

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

    <!-- Blog Modal -->
    <div id="blogModal" class="blog-modal">
        <div class="blog-modal-content">
            <div class="blog-modal-header">
                <h2 id="modalTitle">Blog Title</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="blog-modal-body">
                <div class="blog-meta">
                    <span id="modalCategory" class="blog-category">CATEGORY</span>
                    <span id="modalDate" class="blog-date">Date</span>
                </div>
                <div id="modalContent" class="blog-content">
                    <!-- Blog content will be inserted here -->
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Blog Modal Styles */
        .blog-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            animation: fadeIn 0.3s ease;
        }

        .blog-modal-content {
            background-color: white;
            margin: 2% auto;
            padding: 0;
            border-radius: 15px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideIn 0.3s ease;
        }

        .blog-modal-header {
            background: linear-gradient(135deg, #b34126, #b34126);
            color: white;
            padding: 2rem;
            border-radius: 15px 15px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .blog-modal-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .close-modal {
            font-size: 2rem;
            cursor: pointer;
            line-height: 1;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .close-modal:hover {
            opacity: 1;
        }

        .blog-modal-body {
            padding: 2rem;
        }

        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e1e8ed;
        }

        .blog-category {
            background: #b34126;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .blog-date {
            color: #666;
            font-size: 0.9rem;
        }

        .blog-content {
            line-height: 1.8;
            color: #333;
        }

        .blog-content h3 {
            color: #b34126;
            margin: 2rem 0 1rem 0;
            font-size: 1.3rem;
        }

        .blog-content p {
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .blog-content ul, .blog-content ol {
            margin: 1.5rem 0;
            padding-left: 2rem;
        }

        .blog-content li {
            margin-bottom: 0.5rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .blog-modal-content {
                width: 95%;
                margin: 5% auto;
            }
            
            .blog-modal-header {
                padding: 1.5rem;
            }
            
            .blog-modal-header h2 {
                font-size: 1.4rem;
            }
            
            .blog-modal-body {
                padding: 1.5rem;
            }
        }
    </style>

    <?php include 'includes/footer.php'; ?>
    <script src="script.js"></script>
    
    <script>
        // Blog Modal Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('blogModal');
            const closeBtn = document.querySelector('.close-modal');
            const blogCards = document.querySelectorAll('.blog-card');

            // Blog content data from PHP
            const blogContent = {
                <?php foreach ($blogs as $index => $blog): ?>
                <?php echo $blog['id']; ?>: {
                    title: "<?php echo addslashes($blog['title']); ?>",
                    category: "<?php echo addslashes($blog['category']); ?>",
                    date: "<?php echo date('F j, Y', strtotime($blog['publish_date'])); ?>",
                    description: "<?php echo addslashes($blog['description']); ?>"
                }<?php echo ($index < count($blogs) - 1) ? ',' : ''; ?>
                <?php endforeach; ?>
            };

            // Open modal when blog card is clicked
            blogCards.forEach(card => {
                card.addEventListener('click', function(e) {
                    e.preventDefault();
                    const blogId = this.getAttribute('data-blog');
                    const blog = blogContent[blogId];
                    
                    if (blog) {
                        document.getElementById('modalTitle').textContent = blog.title;
                        document.getElementById('modalCategory').textContent = blog.category;
                        document.getElementById('modalDate').textContent = blog.date;
                        document.getElementById('modalContent').innerHTML = `<p>${blog.description}</p>`;
                        
                        modal.style.display = 'block';
                        document.body.style.overflow = 'hidden'; // Prevent background scrolling
                    }
                });
            });

            // Close modal when X is clicked
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto'; // Restore scrolling
            });

            // Close modal when clicking outside the content
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto'; // Restore scrolling
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto'; // Restore scrolling
                }
            });
        });
    </script>
</body>
</html>
