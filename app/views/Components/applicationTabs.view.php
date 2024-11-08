<div class="tabs">
    <button class="tab-button <?= $activeTab == 'applications-list' ? 'active' : '' ?>" onclick=" window.location.href='/Gradlink/public/dashboardApplication'" >Applications List</button>
    <button class="tab-button  <?= $activeTab == 'working-list' ? 'active' : '' ?>" onclick="window.location.href='/Gradlink/public/workingStudents'" >Working Students</button>
</div>