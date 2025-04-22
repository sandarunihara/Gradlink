<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink | Undergraduate Internship Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home.css">
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo-container">
                    <div class="logo">
                        <div class="logo-icon">G</div>
                        <span>radlink</span>
                    </div>
                </div>

                <div class="header-right">
                    <div class="social">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>

                    <div class="contact-info">
                        <div class="contact">
                            <i class="fas fa-phone-alt"></i>
                            <span>+234 123 456 7890</span>
                        </div>
                        <div class="mail">
                            <i class="fas fa-envelope"></i>
                            <span>info@gradlink.edu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Streamlining <span class="highlight">Internship</span> Management for Universities</h1>
                    <p class="hero-description">
                        Gradlink bridges the gap between academia and industry by connecting talented students with meaningful internship opportunities through our comprehensive management platform.
                    </p>
                    <div class="cta-buttons">
                        <a href="<?=ROOT?>/Login/" class="btn btn-primary">
                            Login to Dashboard
                        </a>
                        <a href="#" class="btn btn-secondary">
                            Learn More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="stats">
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Companies</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">10,000+</span>
                            <span class="stat-label">Students</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">95%</span>
                            <span class="stat-label">Placement Rate</span>
                        </div>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="<?= ROOT ?>/assets/img/welcome.webp" alt="Students collaborating on project" class="featured-image">
                    <div class="image-overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="trust-badges">
        <div class="container">
            <p>Trusted by leading universities and organizations worldwide</p>
            <div class="badges">
                <div class="badge-item">UCSC</div>
                <div class="badge-item">Stanford</div>
                <div class="badge-item">MIT</div>
                <div class="badge-item">Google</div>
                <div class="badge-item">Microsoft</div>
            </div>
        </div>
    </div>
</body>

</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink | Internship Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home.css">

</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
                
            <div class="logo">
                <div class="logo-icon">G</div>
                <span>radlink</span>
            </div>

            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <!-- <li><a href="#testimonials">Testimonials</a></li> -->
                    <li><a href="#admin">For Admins</a></li>
                    <li><a href="<?=ROOT?>/Login/" class="nav-btn">Login</a></li>
                </ul>
            </nav>
            <div class="hamburger">
                <span class="material-icons">menu</span>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay">
            <div class="hero-content container">
            <h1>Launch Your Career with Confidence</h1>
            <p>Streamline internships from application to placement with our all-in-one platform.</p>
            <a href="<?php echo ROOT ?>/Signup" class="btn btn-primary">Get Started</a>
            </div>
        </div>
        <img src="https://img.freepik.com/free-photo/handsome-businessman-working-office_158595-1156.jpg?t=st=1745208562~exp=1745212162~hmac=8d3602d7c7b46ec4d19662087a18e07c82957733f0311a54a70742071a74d01e&w=1380" alt="Internship Management Dashboard" class="hero-image">
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Powerful Features</h2>
                <p>Everything you need to manage university internships effectively</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon material-icons">school</div>
                    <h3>Student Registration</h3>
                    <p>One-click profiles, resume uploads, and application tracking for students.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon material-icons">work</div>
                    <h3>Internship Listings</h3>
                    <p>Curated opportunities from top companies in your field of study.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon material-icons">dashboard</div>
                    <h3>Admin Tools</h3>
                    <p>Automate approvals, track progress, and generate detailed reports.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <!-- <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>What Our Users Say</h2>
                <p>Hear from students, administrators, and employers</p>
            </div>
            <div class="testimonial-slider">
                <div class="testimonial active">
                    <p class="testimonial-text">"InternTrack Pro cut our placement process time by 60%! The automated matching system is incredible."</p>
                    <div class="testimonial-author">Jane Doe</div>
                    <div class="testimonial-role">Career Advisor, Stanford University</div>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">"As a student, I found my dream internship through this platform. The application process was so simple!"</p>
                    <div class="testimonial-author">Michael Chen</div>
                    <div class="testimonial-role">Computer Science Student</div>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">"We've hired 12 interns through InternTrack Pro this year alone. The quality of candidates is outstanding."</p>
                    <div class="testimonial-author">Sarah Johnson</div>
                    <div class="testimonial-role">HR Director, TechCorp</div>
                </div>
                <div class="slider-dots">
                    <div class="dot active" data-slide="0"></div>
                    <div class="dot" data-slide="1"></div>
                    <div class="dot" data-slide="2"></div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Admin Section -->
    <section class="admin-section" id="admin">
        <div class="container">
            <div class="admin-container">
                <div class="admin-image">
                    <img src="https://via.placeholder.com/500x400?text=Admin+Dashboard+Preview" alt="Admin Dashboard" style="width:100%; border-radius:8px; box-shadow:0 10px 30px rgba(0,0,0,0.1);">
                </div>
                <div class="admin-content">
                    <h2>Powerful Tools for Admins & Employers</h2>
                    <p>Our dedicated portals provide everything administrators and companies need to manage internship programs efficiently.</p>
                    <div class="admin-features">
                        <div class="admin-feature">
                            <div class="admin-feature-icon material-icons">track_changes</div>
                            <div class="admin-feature-text">
                                <h4>Real-time Progress Tracking</h4>
                                <p>Monitor student applications, placements, and evaluations in real-time.</p>
                            </div>
                        </div>
                        <div class="admin-feature">
                            <div class="admin-feature-icon material-icons">verified</div>
                            <div class="admin-feature-text">
                                <h4>Automated Verification</h4>
                                <p>System automatically verifies student documents and eligibility.</p>
                            </div>
                        </div>
                        <div class="admin-feature">
                            <div class="admin-feature-icon material-icons">settings</div>
                            <div class="admin-feature-text">
                                <h4>Customizable Workflows</h4>
                                <p>Tailor the platform to match your institution's specific processes.</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-outline">Learn More About Admin Features</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to transform your internship program?</h2>
            <div class="cta-buttons">
                <a href="<?php echo ROOT ?>/Signup" class="btn btn-white">Sign Up</a>
                <a href="#" class="btn btn-outline">Schedule a Demo</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-about">
                    <div class="footer-logo">
                        <div class="footer-logo-icon">G</div>
                        <div class="footer-logo-text">radlink</div>
                    </div>
                    <p>The leading internship management platform for universities and colleges worldwide.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><span class="material-icons">facebook</span></a>
                        <a href="#" class="social-icon"><span class="material-icons">twitter</span></a>
                        <a href="#" class="social-icon"><span class="material-icons">linkedin</span></a>
                        <a href="#" class="social-icon"><span class="material-icons">email</span></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#admin">Admin Portal</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">API</a></li>
                        <li><a href="#">Status</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact Us</h3>
                    <p><span class="material-icons">email</span> hello@interntrack.edu</p>
                    <p><span class="material-icons">phone</span> +1 (555) 123-4567</p>
                    <p><span class="material-icons">location_on</span> 123 University Ave, EduCity</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 InternTrack Pro. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        document.querySelector('.hamburger').addEventListener('click', function() {
            document.querySelector('nav ul').classList.toggle('active');
        });

        // Testimonial Slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial');
        const dots = document.querySelectorAll('.dot');

        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Auto slide change
        setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>