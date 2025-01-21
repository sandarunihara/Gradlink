<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home.css">
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo-container">
            <div class="logo">
                <div class="logo-icon">G</div>
                <span>radlink</span>
            </div>
            <!-- <div class="university-logo">
                <img src="<?=ROOT?>/assets/img/ucsclogo-.png" alt="University Logo" class="university-logo-img">
            </div> -->
        </div>

        <div class="social">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>

        <div class="contact-info">
            <div class="contact">
                <i class="fas fa-phone"></i>
                <span>+234 123 456 7890</span>
            </div>
            <div class="mail">
                <i class="fas fa-envelope"></i>
                <span>info@example.com</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="text-section">
            <h1>Welcome to the <span class="highlight">Undergraduate Internship</span> Management System</h1>
            <p class="description">
                Connecting talents with opportunities and bridging the gap between academics and industry.
            </p>
            <div class="login">
                <a href="<?=ROOT?>/Login/">
                    <button>Login</button>
                </a>
                
            </div>
        </div>
        <div class="image-section">
            <img src="<?= ROOT ?>/assets/img/welcome.webp" alt="Welcome Image">
        </div>
    </div>
</body>

</html>
