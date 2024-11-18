<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/createpassword.css">
    <title>Document</title>
</head>

<body>
    <img src="<?= ROOT ?>/assets/img/glogo.png" alt="Gradlink Logo" class="logo-overlay">
    <div class="maincontainer">
        <form class="useridcontainer" method="post">
            <input type="text" name="userId" id="userId" required placeholder="userId" value="<?= htmlspecialchars($_POST['userId'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit"><i class="fa fa-arrow-right"></i></button>
        </form>
        <?php if (isset($data['rowdata'])): ?>
            <p>Register Name:
                <?php
                echo htmlspecialchars($data['rowdata']->Name ?? '', ENT_QUOTES, 'UTF-8');
                ?>
            </p>
            <p>Register Email:
                <?php
                echo htmlspecialchars($data['rowdata']->Email ?? '', ENT_QUOTES, 'UTF-8');
                ?>
            </p>
        <?php endif; ?>
        
            <?php if (isset($data['rowdata']) || isset($data['errors'])): ?>
        <form class="passwordcontainer" method="post">
            <div>
                <label for="password">Create New Password</label>
                <input type="text" name="password" id="password" required placeholder="password">
            </div>
            <div>
                <label for="confirmpassword">Confirm Password</label>
                <input type="text" name="confirmpassword" id="confirmpassword" required placeholder="confirmpassword">
            </div>
            <button type="submit">Save Password</button>
        </form>
        <?php endif; ?>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <?php if (!empty($data['errors'])): ?>
        <p>
            <?php echo $data['errors']; ?>
        </p>
        <!-- <script>
            errorToast($data['errors']);
        </script> -->
    <?php endif; ?>

</body>


</html>







