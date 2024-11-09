<!DOCTYPE html>
<html lang="en">
<<<<<<< HEAD

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/login.css">
    <style>
        
    </style>
</head>

<body>
    <div class="f-container">
        <div class="logo">
            <img class="glogo" src="<?php echo ROOT ?>/assets/img/grad.png" alt="" height="400" width="500">
        </div>
        <div class="login-f">
            <h3>Login</h3>
            <div class="input-box">
                <input type="email" id="email" required placeholder=" ">
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <input type="password" id="password" required placeholder=" ">
                <label for="password">Password</label>
            </div>
        </div>
    </div>
</body>

</html>

<!-- <i class="fas fa-user"></i>  -->
<!-- <i class="fas fa-envelope"></i> -->
=======
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">

        <?php if (!empty($errors)): ?>
        <div>
            <?= implode("<br>", $errors) ?>
        </div>
        <?php endif; ?>

        <h1>Please sign in</h1>

        <div>
        <input name="userId" type="text">
        <label>Enter id</label>
        </div>

        <div>
        <input name="password" type="password" placeholder="Password">
        <label>Password</label>
        </div>

        <button type="submit">Sign in</button>
        <a href="<?= ROOT ?>">Home</a>
    </form>

</body>
</html>
>>>>>>> 6fdb968a4d5533db938f9d70daac067681e2ff17
