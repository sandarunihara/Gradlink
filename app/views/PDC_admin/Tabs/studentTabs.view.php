<div class="tabs">
    <button class="tab-button <?= $tabprops['activeTab'] === 'Registered-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminStudentOverview/dashboard'">
        Registered Students
    </button>

    <!-- <button class="tab-button <?= $tabprops['activeTab'] === 'pending-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/PendingStudent/dashboard'">
        Pending Students
    </button> -->

    <!-- <button class="tab-button <?= $tabprops['activeTab'] === 'recruited-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminStudentOverview/recruited'">
        Recruited Students
    </button> -->

    <!-- <button class="tab-button <?= $tabprops['activeTab'] === 'rejected-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminStudentOverview/rejected'">
        Rejected Students
    </button> -->

    <button class="tab-button <?= $tabprops['activeTab'] === 'Blocked-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/BlockStudent/dashboard'">
        Blocked Students
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'Not-Registered-Students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminStudentOverview/notReg'">
        Not-Registered-Students
    </button>


</div>

