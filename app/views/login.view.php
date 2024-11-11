<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/login.css">
    <title>Document</title>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <form method="post">

                <?php if (!empty($errors)): ?>
                <div>
                    <?= implode("<br>", $errors) ?>
                </div>
                <?php endif; ?>

                <h1>Please sign in</h1>

                <div class="input-group">
                    <label for="id">Enter id</label>
                    <input name="userId" type="text">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" placeholder="Password">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember">
                    <span></span>
                    <label for="remember">Remember me</label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="signin-btn">Sign in</button>
            </form>
            <div class="register-link">
                Not registered yet? <a href="#">Create a new account</a>
            </div>
        </div>
        <div class="logo-box">
            <img src="<?= ROOT ?>/assets/img/glogo.png" alt="Gradlink Logo">
        </div>            
    </div>

</body>
</html>
