<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
    <style>
        :root {
            --deep-blue: #0A2463;
            --light-blue: #3E92CC;
            --ash-grey: #708090;
            --light-ash: #A9A9A9;
            --white: #FFFFFF;
            --light-gray: #F8F9FA;
            --medium-gray: #E9ECEF;
            --dark-gray: #6C757D;
            --black: #212529;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-gray);
            color: var(--black);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        .login-container {
            display: flex;
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .login-left {
            flex: 1;
            background-color: var(--deep-blue);
            color: var(--white);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        }

        .logo-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            background-color: var(--white);
            color: var(--deep-blue);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin-right: 12px;
            font-weight: 700;
            font-size: 24px;
        }

        .logo-header h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 24px;
        }

        .welcome-message h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .welcome-message p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 40px;
            max-width: 400px;
        }

        .login-illustration img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .login-right {
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            color: var(--deep-blue);
            margin-bottom: 8px;
        }

        .form-header p {
            color: var(--dark-gray);
        }

        .input-group {
            margin-bottom: 24px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--deep-blue);
        }

        .input-field {
            position: relative;
        }

        .input-field input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-field input:focus {
            outline: none;
            border-color: var(--ash-grey);
            box-shadow: 0 0 0 3px rgba(112, 128, 144, 0.2);
        }

        .input-field i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ash-grey);
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--ash-grey);
            cursor: pointer;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .forgot-password {
            color: var(--ash-grey);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--deep-blue);
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background-color: var(--ash-grey);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-btn span {
            margin-right: 8px;
        }

        .login-btn:hover {
            background-color: var(--deep-blue);
        }

        .divider {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            color: var(--dark-gray);
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--medium-gray);
        }

        .divider span {
            padding: 0 16px;
        }

        .register-link {
            text-align: center;
            color: var(--dark-gray);
        }

        .register-link a {
            color: var(--ash-grey);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: var(--deep-blue);
        }

        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-left, .login-right {
                padding: 40px;
            }
            
            .login-illustration img {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .login-left, .login-right {
                padding: 30px 20px;
            }
            
            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .forgot-password {
                margin-top: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Left Panel with Welcome Content -->
            <div class="login-left">
                <div class="logo-header">
                    <div class="logo-icon">G</div>
                    <h1>radlink</h1>
                </div>
                <div class="welcome-message">
                    <h2>Welcome back!</h2>
                    <p>Sign in to access your internship management dashboard</p>
                </div>

                <!-- Image placed here in the left panel -->
                <div class="login-illustration">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Students collaborating" class="login-image">                </div>
            </div>

            <!-- Right Panel with Login Form -->
            <div class="login-right">
                <form method="post" class="login-form">
                    <div class="form-header">
                        <h2>Sign In</h2>
                        <!-- <p>Enter your credentials to continue</p> -->
                    </div>

                    <div class="input-group">
                        <label for="userId">User ID</label>
                        <div class="input-field">
                            <i class="material-icons">person</i>
                            <input type="text" id="userId" name="userId" required placeholder="Enter your user ID">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-field">
                            <i class="material-icons">lock</i>
                            <input type="password" id="password" name="password" required placeholder="Enter your password">
                            <button type="button" class="toggle-password" aria-label="Show password">
                                <i class="material-icons">visibility</i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember_me" name="remember_me">
                            <label for="remember_me">Remember me</label>
                        </div>
                        <a href="http://localhost/Gradlink/public/login/createpassword" class="forgot-password">Forgot password?</a>
                    </div>

                    <button type="submit" class="login-btn">
                        <span>Sign In</span>
                        <i class="material-icons">arrow_forward</i>
                    </button>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    <div class="register-link">
                        Don't have an account? <a href="<?php echo ROOT ?>/Signup">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/login.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            localStorage.clear(); // Clear local storage on page load
            const togglePassword = document.querySelector('.toggle-password');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.querySelector('i').textContent = type === 'password' ? 'visibility' : 'visibility_off';
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
            errorToast("<?php echo $data['errors']; ?>");
        </script>
    <?php endif; ?>
    <?php if (!empty($data['success'])): ?>
        <script>
            successToast("<?php echo $data['success']; ?>");
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