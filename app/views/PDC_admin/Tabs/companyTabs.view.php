<div class="tabs">
    <button class="tab-button <?= $activeTab == 'company-list' ? 'active' : '' ?>" onclick=" window.location.href='/Gradlink/public/PDC_admin/AdminCompanyOverview/dashboard'" >Company List</button>
    <button class="tab-button  <?= $activeTab == 'pending-companies' ? 'active' : '' ?>" onclick="window.location.href='/Gradlink/public/PDC_admin/PendingCompany/dashboard'" >Pending Companies</button>
</div>