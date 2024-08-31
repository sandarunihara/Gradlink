<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/company.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="body ">
    <div class="side">
        <img src="<?php echo ROOT ?>/assets/img/glogo.png" height="200" width="200" class="logo" />
        <?php $this->renderComponent("companysidebar")  ?>
    </div>
    <div id="content">
        <?php $this->renderoption("Dashboard") ?>
    </div>
    <div id="profile">

    </div>
</body>
</html>