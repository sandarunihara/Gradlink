<div class="tabs">
    <button class="tab-button <?= $tabprops['activeTab'] === 'applications' ? 'active' : '' ?>"
        onclick=" window.location.href='/Gradlink/public/PDC_admin/AdminApplicationOverview/dashboard'">
        Applications
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'working-students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminApplicationOverview/working'">
        Working Students
    </button>
</div>

