<div class="tabs">
    <button class="tab-button <?= $tabprops['activeTab'] === 'upcoming' ? 'active' : '' ?>"
        onclick=" window.location.href='/Gradlink/public/PDC_admin/AdminSessionOverview/dashboard'">
        Upcoming
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'completed' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminSessionOverview/completed'">
        completed/Expired
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'unregisteredCompany' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminSessionOverview/unregistered'">
        Unregistered Company Sessions
    </button>
</div>

