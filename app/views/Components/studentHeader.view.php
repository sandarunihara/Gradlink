<div class="header-container">
    <div class="header-icons">
        <i class="fas fa-calendar-alt"></i>
        <i class="fas fa-bell"></i>
    </div>
    <div class="header-profile">
        <a href="<?=ROOT?>/Student/StudentProfile/Profile">
            <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo $_SESSION['USER']->Name?>.jpg" class="logo" alt="Student Image"/>
            <div class="header-text">
                <p><span><?php echo $_SESSION['USER']->Name?></span> Student</p>
            </div>
        </a>
    </div>
</div>
