<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/users.css">
</head>

<body>
    <div class="f-container page" id="page">
        <!-- Content of the users.view.php -->
        <div class="logo">
            <img class="glogo" src="<?php echo ROOT ?>/assets/img/grad.png" alt="" height="200" width="300">
        </div>
        <div class="topic">
            <h1>Select Your Role</h1>
        </div>
        <div class="users">
            <div class="role">
                <a href="<?php echo ROOT ?>/Home/userrole" class="student">Student</a>
                <a href="<?php echo ROOT ?>/Home/userrole" class="company">Company</a>
                <a href="<?php echo ROOT ?>/Home/userrole" class="admin">PDC</a>
                <a href="<?php echo ROOT ?>/Home/userrole" class="admin">PDC Admin</a>
            </div>
        </div>
    </div>

    <script>
    // document.addEventListener("DOMContentLoaded", () => {
    //     // Add the 'page-enter' class as soon as the page loads to trigger the entrance animation
    //     document.body.classList.add('page-enter');
    // });
</script>

</body>


</html>