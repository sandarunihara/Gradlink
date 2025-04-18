<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/login.css">
</head>

<body>
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Left Panel with Welcome Content -->
            <div class="login-left">
                <div class="logo-header">
                    <div class="logo-icon">G</div>
                    <h1>Gradlink</h1>
                </div>
                <div class="welcome-message">
                    <h2>Welcome back!</h2>
                    <p>Sign in to access your internship management dashboard</p>
                </div>

                <!-- Image placed here in the left panel -->
                <div class="login-illustration">
                    <img src="<?= ROOT ?>/assets/img/login.jpg" alt="Login illustration">
                </div>
            </div>

            <!-- Right Panel with Login Form -->
            <div class="login-right">
                <form method="post" class="login-form">
                    <div class="form-header">
                        <h2>Sign In</h2>
                        <p>Enter your credentials to continue</p>
                    </div>

                    <div class="input-group">
                        <label for="userId">User ID</label>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" id="userId" name="userId" required placeholder="Enter your user ID">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" required placeholder="Enter your password">
                            <button type="button" class="toggle-password" aria-label="Show password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember_me" name="remember_me">
                            <label for="remember_me">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>

                    <button type="submit" class="login-btn">
                        <span>Sign In</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    <div class="social-login">
                        <button type="button" class="social-btn google">
                            <i class="fab fa-google"></i>
                            Continue with Google
                        </button>
                        <button type="button" class="social-btn microsoft">
                            <i class="fab fa-microsoft"></i>
                            Continue with Microsoft
                        </button>
                    </div>

                    <div class="register-link">
                        Don't have an account? <a href="<?php echo ROOT ?>/signup">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/login.js"></script>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            localStorage.clear(); // Clear local storage on page load
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            }

            const loginForm = document.querySelector('.login-form');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const userId = document.getElementById('userId').value.trim();
                    const password = document.getElementById('password').value.trim();

                    if (!userId || !password) {
                        e.preventDefault();
                        errorToast("Please enter both User ID and Password");
                    }
                });
            }
        });
    </script>

    <?php if (!empty($data['errors'])): ?>
        <script>
            errorToast("Invalid credentials. Please try again.");
        </script>
    <?php endif; ?>
    <?php if (!empty($data['success'])): ?>
        <script>
            successToast("Login successful!");
        </script>
    <?php endif; ?>

    <!-- Toast message from session -->
    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            window.__flashMessage = <?php echo json_encode($_SESSION['flash']); ?>;
        </script>
    <?php
        unset($_SESSION['flash']);
    endif;
    ?>

</body>

</html>