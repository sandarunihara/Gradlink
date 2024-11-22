<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/login.css">
    <title>Document</title>
</head>

<body>
    <img src="<?= ROOT ?>/assets/img/ucsclogo-.png" alt="UCSC Logo" class="logo-overlay">
    <div class="login-container">
        <div class="login-box">
            <form method="post">
                <h1 class="topic">Sign in</h1>
                <div class="input-group input-box">
                    <input name="userId" id="userId" type="text"  required>
                    <label for="userId">Enter User Id</label>
                </div>
                <div class="input-group input-box">
                    <input name="password" type="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <span></span>
                    <label for="remember_me">Remember me</label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="signin-btn">Sign in</button>
            </form>
            <div class="register-link">
                Not registered yet? <a href="<?php echo ROOT ?>/login/createpassword">Create a Password</a>
            </div>
        </div>
        <div class="logo-box">
            <img src="<?= ROOT ?>/assets/img/glogo.png" alt="Gradlink Logo">
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <?php if (!empty($data['errors'])): ?>
        <script>
            errorToast("Wrong UserId or Password");
        </script>
    <?php endif; ?>
    <?php if (!empty($data['success'])): ?>
        <script>
            successToast("ok");
        </script>
    <?php endif; ?>
</body>


</html>