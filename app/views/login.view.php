<!DOCTYPE html>
<html lang="en">

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
