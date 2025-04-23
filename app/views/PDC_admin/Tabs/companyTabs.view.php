<div class="tabs">
    <button class="tab-button <?= $tabprops['activeTab'] === 'company-list' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/AdminCompanyOverview/dashboard'">
        Active Companies
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'pending-companies' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/PendingCompany/dashboard'">
        Pending Companies<span class="tab-dot"></span>
    </button>

    <button class="tab-button <?= $tabprops['activeTab'] === 'blocked-companies' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_admin/BlockCompany/dashboard'">
        Blocked Companies
    </button>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dot = document.querySelector('.tab-dot');
        
        fetch("<?=ROOT?>/PDC_admin/PendingCompany/getPendingCompanyCount")
            .then(response => response.json())
            .then(data => {
                //console.log(data);

                if(data > 0){
                    dot.style.display = 'block';
                }
                else{
                    dot.style.display = 'none'
                }
            })
            .catch(error => {
                console.error("Error fetching count:", error);

        });
    });
</script>

