<div class="tabs">
    <button class="tab-button <?= $tabprops['activeTab'] === 'Not-Applied' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminStudentOverview/dashboard'">
        Not Applied Students
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'pending-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/PendingStudent/dashboard'">
        Pending Students
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'Blocked-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/BlockStudent/dashboard'">
        Blocked Students
    </button>
</div>

