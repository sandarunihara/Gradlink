<!-- Tabs Section -->
<div class="tabs">
    <button class="tab-button <?= $activeTab == 'company-complaint-list' ? 'active' : '' ?>" onclick=" window.location.href='/Gradlink/public/PDC_coordinator/dashboardCompanyComplain'" >Companies</button>
    <button class="tab-button  <?= $activeTab == 'student-complaint-list' ? 'active' : '' ?>" onclick="window.location.href='/Gradlink/public/PDC_coordinator/studentComplain'" >Students</button>
</div>

<!-- <script>
    function addclasses(tabButton) {
    // Remove 'active' class from all tab buttons
    const tabButtons = document.querySelectorAll(".tab-button");
    tabButtons.forEach(button => button.classList.remove("active"));

    // Add 'active' class to the clicked button
    tabButton.classList.add("active");
    }
</script> -->

<!-- <script>
    // JavaScript for Tabs
    function openTab(event, tabId) {
        const tabButtons = document.querySelectorAll(".tab-button");
        const tabPanes = document.querySelectorAll(".tab-pane");

        // Remove 'active' class from all tabs and tab content
        tabButtons.forEach(button => button.classList.remove("active"));
        tabPanes.forEach(pane => pane.classList.remove("active"));

        // Add 'active' class to clicked tab and corresponding content
        event.currentTarget.classList.add("active");
        document.getElementById(tabId).classList.add("active");
    }

//     function loadContent(url, tabId) {
//     const tabButtons = document.querySelectorAll(".tab-button");
//     tabButtons.forEach(button => button.classList.remove("active"));
//     document.querySelector(`[onclick="loadContent('${url}', '${tabId}')"]`).classList.add("active");

//     fetch(url)
//         .then(response => response.text())
//         .then(html => {
//             document.getElementById("tab-content").innerHTML = html;
//         })
//         .catch(error => console.error('Error loading content:', error));
// }
</script> -->