<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/Student/Fix.css">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/Student/Studentsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/Student/ProfileEdit.css">

</head>
<body>
    <?php
        $Name = $data['Student'] -> Name;
        $Github = $data['Student'] -> Github;
        $Linkedin = $data['Student'] -> Linkedin;
        $ShortDesc = $data['Student'] -> ShortDesc;
    ?>
    <div class="side">
        <?php $this->renderComponent("studentsidebar")  ?>
    </div>
    <div id="content">
        <div class="main">
            <div class="d">
                <div >
                    <h1>Profile</h1>
                </div>
                <div class="d_pro">
                    <div class="d_profile">
                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                        <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo($Name)?>.jpg" height ="400px" weight="400px"class="logo" />
                            <p><span><?php echo($Name)?></span>Student</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-main">
                <a href="<?=ROOT?>/Student/StudentProfile/profile" class="backreq">
                    <i class="fas fa-chevron-left"></i>
                    <h3>back</h3>
                </a>
                <div>
                    <form action="" method="post">
                        <div>
                            <label for="github">Github</label>
                            <input name="Github" type="text" value="<?= htmlspecialchars($Github) ?>">
                        </div>
                        <div>
                            <label for="linkedin">Linkedin</label>
                            <input name="Linkedin" type="text" value="<?= htmlspecialchars($Linkedin) ?>">
                        </div>
                        <div>
                            <label for="shortDesc">Short Description</label>
                            <textarea name="ShortDesc" id=""><?= htmlspecialchars($ShortDesc) ?></textarea>
                        </div>
                        <a href="<?=ROOT?>/Student/StudentProfile/profileEdit"><button type="submit">Save</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>