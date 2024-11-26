<div class="tabs">
    <button class="tab-button <?= $activeTab == 'advertisement-list' ? 'active' : '' ?>" onclick=" window.location.href='/Gradlink/public/PDC_admin/AdminAdvertisementOverview/dashboard'" >Ongoing Advertisements</button>
    <button class="tab-button  <?= $activeTab == 'pending-advertisements' ? 'active' : '' ?>" onclick="window.location.href='/Gradlink/public/PDC_admin/PendingAdvertisement/dashboard'" >Pending Advertisements</button>
</div>