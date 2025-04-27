<div class="tabs">
    <button class="tab-button <?= $tabprops['activeTab'] === 'Pending' ? 'active' : '' ?>"
        onclick=" window.location.href='/Gradlink/public/PDC_admin/AdminNotificationOverview/dashboard'">
        Pending
    </button>

    <!-- <button class="tab-button <?= $tabprops['activeTab'] === 'Approved' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminNotificationOverview/approved'">
        Approved
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'Rejected' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminNotificationOverview/rejected'">
        Rejected
    </button> -->

    <button class="tab-button <?= $tabprops['activeTab'] === 'Read' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminNotificationOverview/read'">
        Read
    </button>
</div>