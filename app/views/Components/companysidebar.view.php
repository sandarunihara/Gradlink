<div class="sidebar" id="sidebar">
    <div class="logodiv">
        <img src="<?php echo ROOT ?>/assets/img/grad.png" height="200" width="200" class="logo" />
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
        <a class="option" href="/Gradlink/public/company/ShortlistedStudents/dashboard">
            <i class="fas fa-user-check"></i>
            <div class="text">
                <p>Shortlisted Students</p>
            </div>
        </a>
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
        <a class="option logout" href="/Gradlink/public/Logout">
            <i class="fas fa-sign-out-alt"></i>
            <div class="text">
                <p>Log out</p>
            </div>
        </a>
    </div>


</div>

<script>

// Function to set the active class based on the current URL
document.addEventListener("DOMContentLoaded", function () {
    var links = document.querySelectorAll(".option");
    var fullPath = window.location.pathname; // e.g., "/Gradlink/public/company/Companydash/Dashboard"

    links.forEach(function (link) {
        // Extract the relevant part of each link's href attribute
        var linkPath = link.getAttribute("href");

        // Check if the link's path matches the current path
        if (fullPath === linkPath) {
            link.classList.add("active");
        }
    });
});

</script>