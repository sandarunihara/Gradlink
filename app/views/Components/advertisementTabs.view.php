<!-- Tabs Section -->
<div class="tabs">
    <button class="tab-button <?= $activeTab == 'ongoingad-list' ? 'active' : '' ?>" onclick=" window.location.href='/Gradlink/public/dashboardAdvertisement'" >Ongoing List</button>
    <button class="tab-button  <?= $activeTab == 'pendingad-list' ? 'active' : '' ?>" onclick="window.location.href='/Gradlink/public/pendingAdvertisementList'" >Pending Advertisements</button>
</div>