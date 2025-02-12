<div class="page">
    <div class="sidebar">
        <div class="profile">
            <a href="<?=ROOT?>/Student/StudentProfile/Profile">
                <img src="<?php echo ROOT ?>/assets/img/Student/<?php echo $_SESSION['USER']->Name?>.jpg" alt="Student Image"/>
            </a>
        </div>
        
        <div class="menu">
            <ul>
                <a href="<?=ROOT?>/Student/StudentDash/dashboard" class="menu-item">
                    <li data-title="Dashboard"><i class="fas fa-home"></i></li>
                </a>

                <a href="<?=ROOT?>/Student/StudentProfile/profile" class="menu-item">
                    <li data-title="Profile"><i class="fas fa-user"></i></li>
                </a>

                <a href="<?=ROOT?>/Student/StudentAd/advertisement" class="menu-item">
                    <li data-title="Internships"><i class="fas fa-bullhorn"></i></li>
                </a>

                <a href="<?=ROOT?>/Student/StudentTT/techtalk" class="menu-item">
                    <li data-title="Tech Talk"><i class="fas fa-comments"></i></li>
                </a>

                <a href="<?=ROOT?>/Student/StudentProgress/progressReport" class="menu-item">
                    <li data-title="Progress Report"><i class="fas fa-chart-line"></i></li>
                </a>

                <a href="<?=ROOT?>/Student/StudentComplaint/complaint" class="menu-item">
                    <li data-title="Complaint"><i class="fas fa-exclamation-circle"></i></li>
                </a>
            </ul>
        
            <a href="<?=ROOT?>/logout" class="logout" data-title="Logout">
                <i class="fas fa-sign-out-alt fa-lg"></i>
            </a>
        </div>
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

