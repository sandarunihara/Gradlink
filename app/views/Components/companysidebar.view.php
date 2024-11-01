<div class="sidebar" id="sidebar">
    <div class="logodiv">
        <img src="<?php echo ROOT ?>/assets/img/grad.png" height="200" width="200" class="logo" />
    </div>
    <div id="sidebaroption" class="sidebaroption ">
        <a class="option dash" href="../Companydash/Dashboard">
            <i class="fas option-i fa-home"></i>
            <div class="text">
                <p>Dashboard</p>
            </div>
        </a>
        <a class="option" href="../StudentsRequests/dashboard">
            <i class="fas fa-users"></i>
            <div class="text">
                <p>Students Requests</p>
            </div>
        </a>
        <a class="option" href="../ShortlistedStudents/dashboard">
            <i class="fas fa-user-check"></i>
            <div class="text">
                <p>Shortlisted Students</p>
            </div>
        </a>
        <a class="option" href="../Advertisements/dashboard">
            <i class="fas fa-bullhorn"></i>
            <div class="text">
                <p>Advertisements</p>
            </div>
        </a>
        <a class="option" href="../Schedule/dashboard">
            <i class="fas fa-calendar-alt"></i>
            <div class="text">
                <p>Schedule</p>
            </div>
        </a>
        <a class="option" href="../Messages/dashboard">
            <i class="fas fa-comments"></i>
            <div class="text">
                <p>Messages</p>
            </div>
        </a>
        <a class="option" href="../Profile/dashboard">
            <i class="fas fa-user"></i>
            <div class="text">
                <p>Profile</p>
            </div>
        </a>
        <a class="option logout">
            <i class="fas fa-sign-out-alt"></i>
            <div class="text">
                <p>Log out</p>
            </div>
        </a>
    </div>


</div>

<script>

//     document.getElementById("toggleSidebar").addEventListener("click", function () {
//     var sidebar = document.getElementById("sidebar");
//     sidebar.classList.toggle("collapsed");
// });

// Function to set the active class based on the current URL
document.addEventListener("DOMContentLoaded", function () {
    var links = document.querySelectorAll(".option"); 
    var fullPath = window.location.pathname; //  "/Gradlink/public/Companydash/Dashboard"
    var relativePath = fullPath.replace("/Gradlink/public/company", "..");

    links.forEach(function (link) {
        if (link.getAttribute("href") === relativePath) {
            link.classList.add("active");
        }
    });
});

</script>