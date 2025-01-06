<div class="sidebar">
    <div class="toggle-container">
        <i class="fas fa-bars" id="toggleBtn"></i>
    </div>
    <div class="sidebar-menu">
        <a href="<?=ROOT?>/Student/StudentDash/dashboard" class="menu-item">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
        <a href="<?=ROOT?>/Student/StudentProfile/profile" class="menu-item">
            <i class="fas fa-user"></i>
            <p>Profile</p>
        </a>
        <a href="<?=ROOT?>/Student/StudentAd/advertisement" class="menu-item">
            <i class="fas fa-bullhorn"></i>
            <p>Job Opportunities</p>
        </a>
        <a href="<?=ROOT?>/Student/StudentTT/techtalk" class="menu-item">
            <i class="fas fa-comments"></i>
            <p>Tech Talk</p>
        </a>
        <a href="<?=ROOT?>/Student/StudentProgress/progressReport" class="menu-item">
            <i class="fas fa-chart-line"></i>
            <p>Progress Report</p>
        </a>
        <a href="<?=ROOT?>/Student/StudentComplaint/complaint" class="menu-item">
            <i class="fas fa-exclamation-circle"></i>
            <p>Complaint</p>
        </a>
        <a href="<?=ROOT?>/logout" class="menu-item logout">
            <i class="fas fa-sign-out-alt"></i>
            <p>Log out</p>
        </a>
    </div>
</div>
<script>
    const sidebar = document.querySelector('.sidebar');
    const page = window.location.href.split('/').pop();
    const menuItems = document.querySelectorAll('.menu-item');
    const toggleBtn = document.getElementById('toggleBtn');

    // toggleId.addEventListener('click', () => {
    //     sidebar.classList.toggle('active');
    // });

    menuItems.forEach(item => {
        if (item.href.includes(page)) {
            item.classList.add('active');
        }
    });
</script>
