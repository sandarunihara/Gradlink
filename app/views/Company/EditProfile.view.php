<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/editpro.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Profile</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <a href='../Profile/dashboard'>
                                <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                                <p><span>WSO2</span>Company</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pro_main">
                    <!-- white part -->
                    <div class="coverphoto">
                        <img src="<?php echo ROOT ?>/assets/img/signinbg.jpg" />
                    </div>
                    <div class="prophoto">
                        <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="pro_logo" width="200" height="200" />
                    </div>
                    
                    <div class="pro_head">
                        <input class="name" name="Name" value="<?php echo $data->Name ?>"></br>
                        <input name="ShortDesc" value="<?php echo $data->ShortDesc ?>">
                    </div>
                    <div class="formdata">
                        <div class="firstset">
                            <div class="formrow">
                                <p class="label">Contact Email</p>
                                <input name="Email" value="<?php echo $data->Email ?>">
                            </div>
                            <div class="formrow">
                                <p class="label">Contact Person</p>
                                <input name="ContactPerson" value="<?php echo $data->ContactPerson ?>">
                            </div>
                        </div>
                        <div class="firstset">
                            <div class="formrow">
                            <p class="label">Contact Number</p>
                            <input name="ContactNum" value="<?php echo $data->ContactNum ?>">
                            </div>
                            <div class="formrow">
                                <i onclick="linkedin()" class="fab fa-linkedin"></i>
                                <a href="<?php echo $data->Website ?>" class="website">Visit Website</a>
                            </div>
                        </div>
                        <div class="Address">
                                <i class="fas fa-location-dot"></i>
                                <p><?php echo $data->No ?>,<?php echo $data->Lane ?>,<?php echo $data->City ?>,<?php echo $data->District ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function linkedin() {
            window.open(<?php echo $data->Linkedin ?>);
        }
    </script>

</body>

</html>