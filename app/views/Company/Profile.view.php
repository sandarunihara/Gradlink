<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar",['hasShortlisted'=>$_SESSION['hasShortlisted'],'hasRecruited'=>$_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Profile</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="pro_main">
                    <!-- white part -->
                    <div class="coverphoto">
                        <img src="data:image/jpeg;base64,<?php echo $data->coverimg; ?>" />
                    </div>
                    <div class="prophoto">
                        <img src="data:image/jpeg;base64,<?php echo $data->profileimg; ?>" class="pro_logo" width="200" height="200" />
                    </div>
                    <div class="button">
                    <button onclick="window.location.href='<?php echo ROOT; ?>/company/Profile/edit';">Edit profile</button>
                    </div>
                    <div class="pro_head">
                        <span class="name"><?php echo $data->Name ?></span></br>
                        <span><?php echo $data->ShortDesc ?></span>
                    </div>
                    <div class="formdata">
                        <div class="firstset">
                            <div class="formrow">
                                <p class="label">Contact Email</p>
                                <p><?php echo $data->Email ?></p>
                            </div>
                            <div class="formrow">
                                <p class="label">Contact Person</p>
                                <p><?php echo $data->ContactPerson ?></p>
                            </div>
                        </div>
                        <div class="firstset">
                            <div class="formrow">
                            <p class="label">Contact Number</p>
                            <p><?php echo $data->ContactNum ?></p>
                            </div>
                            <div class="formrow">
                                <a href="<?php echo $data->Linkedin ?>"><i onclick="linkedin()" class="fab fa-linkedin"></i></a>
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
        function goeditpro(){
            window.location.href = "<?php echo ROOT ?>/Profile/edit";
        }
    </script>

</body>

</html>