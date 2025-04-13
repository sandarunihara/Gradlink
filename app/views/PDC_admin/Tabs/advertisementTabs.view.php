<div class="tabs">
    <button class="tab-button <?= $tabprops['activeTab'] === 'advertisement-list' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminAdvertisementOverview/dashboard'">
        Active Advertisements
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'deactive-list' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminAdvertisementOverview/deactive'">
        Deactive Advertisements
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'pending-list' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/PendingAdvertisement/dashboard'">
        Pending Advertisements
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'rejected-list' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminAdvertisementOverview/rejected'">
        Rejected Advertisements
    </button>
</div>