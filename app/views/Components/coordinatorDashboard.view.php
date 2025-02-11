<!-- <div id="sidebar" class="sidebar ">
    <div class="logodiv">
        <img src="<?php echo ROOT ?>/assets/img/grad.png" height="200" width="200" class="logo" />
    </div>
    <div id="sidebaroption" class="sidebaroption ">

        <a class="option dash" href="/GRadlink/public/PDC_coordinator/dashboard">
            <i class="material-icons">dashboard</i>
            <div>
                <p>Dashboard</p>
            </div>
        </a>

        <a class="option" href="/GRadlink/public/PDC_coordinator/dashboardCompany">
            <i class="material-icons">business</i>
            <div>
                <p>Companies</p>
            </div>
        </a>

        <a class="option" href="/GRadlink/public/PDC_coordinator/dashboardStudent">
            <i class="material-icons">school</i>

            <div>
                <p>Students</p>
            </div>
        </a>

        <a class="option" href="/GRadlink/public/PDC_coordinator/dashboardAdvertisement">
            <i class="material-icons">tab</i>

            <div>
                <p>Advertisements</p>
            </div>
        </a>

        <a class="option" href="/GRadlink/public/PDC_coordinator/dashboardApplication">
            <i class="material-icons">article</i>
            <div>
                <p>Applications</p>
            </div>
        </a>

        <a class="option" href="/GRadlink/public/PDC_coordinator/dashboardSession">
            <i class="material-icons">event</i>
            <div>
                <p>Sessions</p>
            </div>
        </a>

        <a class="option" href="/GRadlink/public/PDC_coordinator/dashboardCompanyComplain">
            <i class="material-icons">help</i>
            <div>
                <p>Complains</p>
            </div>
        </a>

        <a class="option logout" href="<?= ROOT ?>/logout">
            <i class="fas fa-sign-out-alt"></i>
            <div>
                <p>Log out</p>
            </div>
        </a>


    </div>
</div> -->



<div class="page">
    <div class="sidebar">
        <div class="profile">
            <img src="<?= ROOT ?>/assets/images/profile_img.jpg" alt="">
        </div>

        <ul>
            <a href="/Gradlink/public/PDC_coordinator/dashboard">
                <li data-title="Dashboard"><i class="fas fa-tachometer-alt fa-lg"></i></li>
            </a>

            <a href="/Gradlink/public/PDC_coordinator/dashboardCompany">
                <li data-title="Company"><i class="fas fa-building fa-lg"></i></li>
            </a>

            <a href="/GRadlink/public/PDC_coordinator/dashboardStudent">
                <li data-title="Student"><i class="fas fa-user-graduate fa-lg"></i></li>
            </a>

            <a href="/GRadlink/public/PDC_coordinator/dashboardAdvertisement">
                <li data-title="Advertisements"><i class="fas fa-bullhorn fa-lg"></i></li>
            </a>

            <a href="/GRadlink/public/PDC_coordinator/dashboardApplication">
                <li data-title="Applications"><i class="fas fa-file-alt fa-lg"></i></li>
            </a>

            <a href="/GRadlink/public/PDC_coordinator/dashboardSession">
                <li data-title="Sessions"><i class="fas fa-calendar-alt fa-lg"></i></li>
            </a>
            
            <a href="/GRadlink/public/PDC_coordinator/dashboardCompanyComplain">
                <li data-title="Complains"><i class="fas fa-exclamation-circle fa-lg"></i></li>
            </a>
        </ul>

        <a href="<?=ROOT?>/logout" class="logout" data-title="Logout">
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
