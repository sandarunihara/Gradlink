<div class="page">
    <div class="sidebar">
        <div class="profile">
            <img src="<?= ROOT ?>/assets/images/profile_img.jpg" alt="">
        </div>

        <ul>
            <a href="<?=ROOT?>/PDC_admin/AdminDashboardOverview/dashboard">
                <li data-title="Dashboard"><i class="fas fa-tachometer-alt fa-lg"></i></li>
            </a>

            <a href="<?=ROOT?>/PDC_admin/AdminCompanyOverview/dashboard">
                <li data-title="Company"><i class="fas fa-building fa-lg"></i></li>
            </a>

            <a href="<?=ROOT?>/PDC_admin/AdminStudentOverview/dashboard">
                <li data-title="Student"><i class="fas fa-user-graduate fa-lg"></i></li>
            </a>

            <a href="<?=ROOT?>/PDC_admin/AdminAdvertisementOverview/dashboard">
                <li data-title="Advertisements"><i class="fas fa-bullhorn fa-lg"></i></li>
            </a>

            <a href="<?=ROOT?>/PDC_admin/AdminApplicationOverview/dashboard">
                <li data-title="Applications"><i class="fas fa-file-alt fa-lg"></i></li>
            </a>

            <a href="<?=ROOT?>/PDC_admin/AdminSessionOverview/dashboard">
                <li data-title="Sessions"><i class="fas fa-calendar-alt fa-lg"></i></li>
            </a>

            <a href="<?=ROOT?>/PDC_admin/AdminNotificationOverview/dashboard">
                <li data-title="Notifications"><i class="fas fa-bell fa-lg"></i></li>
            </a>

            <a href="<?=ROOT?>/PDC_admin/AdminProfileOverview/dashboard">
                <li data-title="Profile"><i class="fas fa-user fa-lg"></i></li>
            </a>
            
            <!-- <a href="<?=ROOT?>/PDC_admin/AdminComplainOverview/dashboard">
                <li data-title="Complains"><i class="fas fa-exclamation-circle fa-lg"></i></li>
            </a> -->
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
