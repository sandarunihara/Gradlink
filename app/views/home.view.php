<!DOCTYPE html>
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
    <!-- Header Section -->
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

    <!-- Hero Section -->
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

    <!-- Trust Badges Section -->
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

</html>