<!-- Tabs Section -->
<div class="tabs">
    <button class="tab-button <?= $activeTab == 'student-list' ? 'active' : '' ?>"
        onclick=" window.location.href='/Gradlink/public/PDC_coordinator/dashboardStudent'">Student List</button>
    <button class="tab-button  <?= $activeTab == 'blocked-students' ? 'active' : '' ?>"
        onclick="window.location.href='/Gradlink/public/PDC_coordinator/blockedStudents'">Blocked Companies</button>
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