<div class="page">
    <div class="sidebar">
        <div class="profile">
            <a href="/Gradlink/public/company/Profile/dashboard">
                <img src="data:image/jpeg;base64,<?php echo $_SESSION['USER']->profileimg; ?>" alt="">
            </a>
        </div>
        
        <ul>
            <a href="/Gradlink/public/company/Companydash/Dashboard">
                <li data-title="Dashboard"><i class="fas option-i fa-home"></i></li>
            </a>
            
            <a href="/Gradlink/public/company/StudentsRequests/dashboard">
                <li data-title="Students Requests"><i class="fas fa-users"></i></li>
            </a>
            
            <?php if (isset($componentProps['hasShortlisted']) && $componentProps['hasShortlisted']): ?>
                <a href="/Gradlink/public/company/ShortlistedStudents/dashboard">
                    <li data-title="Shortlisted Students"><i class="fas fa-user-check"></i></li>
                </a>
                <?php endif; ?>
                <?php if (isset($componentProps['hasRecruited']) && $componentProps['hasRecruited']): ?>
                    <a href="/Gradlink/public/company/RecruitStudents/dashboard">
                        <li data-title="Recruited Students"><i class="fas fa-user-tie"></i></li>
                    </a>
            <?php endif; ?>
            
            <a href="/Gradlink/public/company/Advertisements/dashboard">
                <li data-title="Advertisements"><i class="fas fa-bullhorn"></i></li>
            </a>
            
            <a href="/Gradlink/public/company/Schedule/dashboard">
                <li data-title="Schedule"><i class="fas fa-calendar-alt"></i></li>
            </a>
            
            <a href="/Gradlink/public/company/Messages/dashboard">
                <li data-title="Messages"><i class="fas fa-comments"></i></li>
            </a>
            
            <a href="/Gradlink/public/company/Complaint/dashboard">
                <li data-title="Complaint"><i class="fas fa-exclamation-triangle"></i></li>
            </a>
        </ul>
        
        <a href="<?= ROOT ?>/logout" class="logout" data-title="Logout">
            <i class="fas fa-sign-out-alt fa-lg"></i>
        </a>
        
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const listItems = document.querySelectorAll('.sidebar ul li');
        listItems.forEach((item) => {
            item.addEventListener('click', () => {
                listItems.forEach((li) => li.classList.remove('active')); // Remove active from all
                item.classList.add('active'); // Add active to clicked item
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const listItems = document.querySelectorAll('.sidebar ul li');
        const savedActive = localStorage.getItem('activeItem'); // Retrieve saved item
        if (savedActive) {
            listItems.forEach((item) => item.classList.remove('active'));
            listItems[savedActive].classList.add('active'); // Set active based on saved index
        }

        listItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                listItems.forEach((li) => li.classList.remove('active')); // Remove active from all
                item.classList.add('active'); // Add active to clicked item
                localStorage.setItem('activeItem', index); // Save index of clicked item
            });
        });
    });
</script>




<!-- <a href="/Gradlink/public/company/Profile/dashboard">
    <li>Profile</li>
</a> -->























































<!-- <div class="sidebar" id="sidebar">
    <button id="toggleSidebar" class="toggle-btn">
        <i class="fas fa-bars"></i>
    </button>
    <div class="innersidebar" id="innersidebar">
        <div class="sidebarlogo" id="sidebarlogo">
            <div class="logodiv">
                <img src="<?php echo ROOT ?>/assets/img/grad.png" height="200" width="200" class="logoside" />
            </div>
        </div>
        <div id="sidebaroption" class="sidebaroption ">
            <a class="option dash" href="/Gradlink/public/company/Companydash/Dashboard">
                <i class="fas option-i fa-home"></i>
                <div class="text">
                    <p>Dashboard</p>
                </div>
            </a> -->
            <!-- <a class="option" href="/Gradlink/public/company/StudentsRequests/dashboard">
                <i class="fas fa-users"></i>
                <div class="text">
                    <p>Students Requests</p>
                </div>
            </a> -->
            <!-- <?php if (isset($componentProps['hasShortlisted']) && $componentProps['hasShortlisted']): ?>
                <a class="option shortlisted" href="/Gradlink/public/company/ShortlistedStudents/dashboard">
                    <i class="fas fa-user-check"></i>
                    <div class="text">
                        <p>Shortlisted Students</p>
                    </div>
                </a>
            <?php endif; ?> -->
            <!-- <?php if (isset($componentProps['hasRecruited']) && $componentProps['hasRecruited']): ?>
                <a class="option recruited" href="/Gradlink/public/company/RecruitStudents/dashboard">
                    <i class="fas fa-user-tie"></i>
                    <div class="text">
                        <p>Recruited Students</p>
                    </div>
                </a>
            <?php endif; ?> -->
            <!-- <a class="option" href="/Gradlink/public/company/Advertisements/dashboard">
                <i class="fas fa-bullhorn"></i>
                <div class="text">
                    <p>Advertisements</p>
                </div>
            </a> -->
            <!-- <a class="option" href="/Gradlink/public/company/Schedule/dashboard">
                <i class="fas fa-calendar-alt"></i>
                <div class="text">
                    <p>Schedule</p>
                </div>
            </a> -->
            <!-- <a class="option" href="/Gradlink/public/company/Messages/dashboard">
                <i class="fas fa-comments"></i>
                <div class="text">
                    <p>Messages</p>
                </div>
            </a> -->
            <!-- <a class="option" href="/Gradlink/public/company/Profile/dashboard">
                <i class="fas fa-user"></i>
                <div class="text">
                    <p>Profile</p>
                </div>
            </a>
            <ul class="dropdown-menu">
                <a href="/Gradlink/public/company/Profile/dashboard">
                    <li>Profile</li>
                </a>
                <a href="<?= ROOT ?>/logout">
                    <li>SignOut</li>
                </a>
            </ul>
            <div class="profile_option ">
                <div>
                    <img src="data:image/jpeg;base64,<?php echo $_SESSION['USER']->profileimg; ?>" />
                    <p><span><?php echo $_SESSION['USER']->Name; ?></span>Company</p>
                </div>
                <div>
                    <i class="fas fa-ellipsis-h"></i>
                </div>
            </div>
        </div>
    </div>
</div> -->


<!-- <script>
    const menu = document.querySelector('.profile_option');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    menu.addEventListener('click', () => {
        dropdownMenu.classList.toggle('show'); 
    });

    document.addEventListener('click', (e) => {
        if (!dropdownMenu.contains(e.target) && !menu.contains(e.target)) {
            dropdownMenu.classList.remove('show'); 
        }
    });


    document.addEventListener("DOMContentLoaded", function() {
        var links = document.querySelectorAll(".option");
        var fullPath = window.location.pathname; // e.g., "/Gradlink/public/company/Companydash/Dashboard"

        links.forEach(function(link) {
            var linkPath = link.getAttribute("href");

            if (fullPath === linkPath) {
                link.classList.add("active");
            }
        });
    });

    const sidebar = document.getElementById('sidebar');
    const innersidebar = document.getElementById('innersidebar');
    const toggleButton = document.getElementById('toggleSidebar');
    const sidebarLogo = document.getElementById('sidebarlogo');

    toggleButton.addEventListener('click', () => {
        innersidebar.classList.toggle('collapsed');
        sidebar.classList.toggle('collapsed');
        sidebarLogo.classList.toggle('hidden');
    });

</script> -->