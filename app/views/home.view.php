<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/home.view.css">
</head>
<body>
    <h1>Welcome</h1>
    <h1>Undergraduate Internship Management System</h1>
    <img src="<?php echo ROOT ?>/assets/img/ucsclogo.jpg" alt="" height="200" width="200">
    <?php $this->renderComponent('button', ['name' => 'student_btn', 'type' => 'submit', 'text' => 'Student']) ?>
    <?php $this->renderComponent('button', ['name' => 'company_btn', 'type' => 'submit', 'text' => 'Company']) ?>
    <?php $this->renderComponent('button', ['name' => 'pdc_btn', 'type' => 'submit', 'text' => 'PDC']) ?>
    <img src="<?php echo ROOT ?>/assets/img/glogo.png" alt="" height="200" width="200">
</body>
</html>