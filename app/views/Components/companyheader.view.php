<div class="d_pro">
    <div class="d_profile">
        <a href="../Complaint/dashboard">
            <i class="fas fa-exclamation-triangle"></i>
        </a>

        <a href="../companydash/calendar" title="Complaint">
            <i class="fas fa-calendar-alt"></i>
        </a>
        <div class="notification-wrapper">
            <div class="notification-icon" onclick="toggleDropdown()">
                <i class="fas fa-bell"></i>
            </div>
            <div id="notificationDropdown" class="dropdown-content">
                <i class="fas fa-close" onclick="toggleclose()"></i>
                <p>No new notifications</p>
            </div>
        </div>
    </div>
    <div>
    <a href='../Profile/dashboard'>
            <img src="data:image/jpeg;base64,<?php echo $_SESSION['USER']->profileimg; ?>" class="logo" />
            <p><span><?php echo $_SESSION['USER']->Name; ?></span>Company</p>
        </a>
    </div>
</div>