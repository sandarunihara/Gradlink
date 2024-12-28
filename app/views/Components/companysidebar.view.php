<div class="sidebar" id="sidebar">
    <div class="innersidebar">
        <div class="sidebarlogo">
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
            </a>
            <a class="option" href="/Gradlink/public/company/StudentsRequests/dashboard">
                <i class="fas fa-users"></i>
                <div class="text">
                    <p>Students Requests</p>
                </div>
            </a>
            <?php if (isset($componentProps['hasShortlisted']) && $componentProps['hasShortlisted']): ?>
                <a class="option shortlisted" href="/Gradlink/public/company/ShortlistedStudents/dashboard">
                    <i class="fas fa-user-check"></i>
                    <div class="text">
                        <p>Shortlisted Students</p>
                    </div>
                </a>
            <?php endif; ?>
            <?php if (isset($componentProps['hasRecruited']) && $componentProps['hasRecruited']): ?>
                <a class="option recruited" href="/Gradlink/public/company/RecruitStudents/dashboard">
                    <i class="fas fa-user-tie"></i>
                    <div class="text">
                        <p>Recruited Students</p>
                    </div>
                </a>
            <?php endif; ?>
            <a class="option" href="/Gradlink/public/company/Advertisements/dashboard">
                <i class="fas fa-bullhorn"></i>
                <div class="text">
                    <p>Advertisements</p>
                </div>
            </a>
            <a class="option" href="/Gradlink/public/company/Schedule/dashboard">
                <i class="fas fa-calendar-alt"></i>
                <div class="text">
                    <p>Schedule</p>
                </div>
            </a>
            <a class="option" href="/Gradlink/public/company/Messages/dashboard">
                <i class="fas fa-comments"></i>
                <div class="text">
                    <p>Messages</p>
                </div>
            </a>
            <a class="option" href="/Gradlink/public/company/Profile/dashboard">
                <i class="fas fa-user"></i>
                <div class="text">
                    <p>Profile</p>
                </div>
            </a>
            <ul class="dropdown-menu">
                <a href="/Gradlink/public/company/Profile/dashboard"><li>Profile</li></a>
                <a href="<?= ROOT ?>/logout"><li>SignOut</li></a>
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
</div>

<script>
  const menu = document.querySelector('.profile_option');
  const dropdownMenu = document.querySelector('.dropdown-menu');

  menu.addEventListener('click', () => {
    dropdownMenu.classList.toggle('show'); // Toggle the "show" class
  });

  // Close the dropdown when clicking outside
  document.addEventListener('click', (e) => {
    if (!dropdownMenu.contains(e.target) && !menu.contains(e.target)) {
      dropdownMenu.classList.remove('show'); // Remove "show" class if clicked outside
    }
  });
</script>





<script>
    // Function to set the active class based on the current URL
    document.addEventListener("DOMContentLoaded", function() {
        var links = document.querySelectorAll(".option");
        var fullPath = window.location.pathname; // e.g., "/Gradlink/public/company/Companydash/Dashboard"

        links.forEach(function(link) {
            // Extract the relevant part of each link's href attribute
            var linkPath = link.getAttribute("href");

            // Check if the link's path matches the current path
            if (fullPath === linkPath) {
                link.classList.add("active");
            }
        });
    });
</script>