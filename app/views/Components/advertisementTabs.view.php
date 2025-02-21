<!-- Tabs Section -->
<div class="tabs">
    <button class="tab-button <?= $activeTab == 'ongoingad-list' ? 'active' : '' ?>" onclick=" window.location.href='/Gradlink/public/PDC_coordinator/dashboardAdvertisement'" >Ongoing List</button>
    <button class="tab-button  <?= $activeTab == 'pendingad-list' ? 'active' : '' ?>" onclick="window.location.href='/Gradlink/public/PDC_coordinator/pendingAdvertisementList'" >Pending Advertisements</button>
</div>

<script>

document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".tab-pane");

    tabs.forEach((tab) => {
        tab.addEventListener("click", function () {
            // Remove active class from all buttons
            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            // Hide all tab contents
            tabContents.forEach(content => content.classList.remove("active"));

            // Show the clicked tab's content
            const target = this.getAttribute("data-target");
            document.getElementById(target).classList.add("active");
        });
    });
});

</script>