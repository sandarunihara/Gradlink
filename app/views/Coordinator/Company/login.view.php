<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Login</h1>
            <form method="" action="dashboard">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Enter your email">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="minimum 8 characters">
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="remember">
                    <span></span>
                    <label for="remember">Remember me</label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                <button type="submit" class="login-btn" onclick="navigateToDashboardCompany();">Login</button>
            </form>
            <div class="register-link">
                Not registered yet? <a href="#">Create a new account</a>
            </div>
        </div>
        <div class="logo-box">
            <img src="<?= ROOT ?>../assets/images/logo.png" alt="Gradlink Logo">
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>