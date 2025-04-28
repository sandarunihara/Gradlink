<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Application/dashboardApplication.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Applications</h1>
                </div>


            </header>

            <?php $activeTab = 'applications-list'; ?>
            <?php $this->renderComponent("applicationTabs") ?>

            <div class="tab-content">
                <div id="applications-list" class="tab-pane active ">

                    <section class="company-list">
                    <div class="list-header">
                        <h2>Applications</h2>
                        <div class="search-box">
                            <input type="text" placeholder="Search Advertisements" />
                            <button class="search-icon-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                <div class="table-wrapper">

                    <table>
                        <thead>
                            <tr>
                                <th>Registration No.</th>
                                <th>Name</th>
                                <th>Degree</th>
                                <th>Applied Company</th>
                                <th>Position</th>
                                <th>Advertisement ID</th>
                                <th>Status</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)): ?>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><a href="#" class="open-modal student-link" data-student='<?= json_encode($row) ?>'><?= htmlspecialchars($row->StudentId) ?></a></td>
                                        <td><?= htmlspecialchars($row->StudentName) ?></td>
                                        <td><?= htmlspecialchars($row->DegreeName) ?></td>
                                        <td><a href="#" class="open-modal company-link" data-company='<?= json_encode($row) ?>'><?= htmlspecialchars($row->CompanyName) ?></a></td>
                                        <td><?= htmlspecialchars($row->position) ?></td>
                                        <td><a href="#" class="open-modal ad-link" data-ad='<?= json_encode($row) ?>'><?= htmlspecialchars($row->advertisementId) ?></a></td>
                                        <td><?= htmlspecialchars($row->Jobstatus) ?></td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="9">No Applications Found</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                    </div>

                    </section>


                </div>
            </div>

        </main>
        <!-- Student Modal -->
        <div id="studentModal" class="modal">
            <div class="modal-content">
                <span class="close" data-close="studentModal">&times;</span>
                <h2>Student Details</h2>
                <p><span>Registration No:</span> <span id="modalStudentId"></span></p>
                <p><span>Name:</span> <span id="modalStudentName"></span></p>
                <p><span>NIC:</span> <span id="modalStudentNIC"></span></p>
                <p><span>Degree:</span> <span id="modalStudentDegree"></span></p>
                <p><span>Email:</span> <span id="modalStudentEmail"></span></p>
                <p><span>Contact No:</span> <span id="modalStudentContact"></span></p>
            </div>
        </div>

        <!-- Advertisement Modal -->
        <div id="adModal" class="modal">
            <div class="modal-content">
                <span class="close" data-close="adModal">&times;</span>
                <h2>Advertisement Details</h2>
                <p><span>Advertisement ID:</span> <span id="modalAdId"></span></p>
                <p><span>Position:</span> <span id="modalAdPosition"></span></p>
                <p><span>Company Name:</span> <span id="modalAdCompany"></span></p>
                <p><span>Working Mode:</span> <span id="modalAdWorkingMode"></span></p>
                <p><span>Status:</span> <span id="modalAdStatus"></span></p>
                <p><span>Start Date:</span> <span id="modalAdStart"></span></p>
                <p><span>Deadline:</span> <span id="modalAdDeadline"></span></p>
            </div>
        </div>

        <!-- Company Modal -->
        <div id="companyModal" class="modal">
            <div class="modal-content">
                <span class="close" data-close="companyModal">&times;</span>
                <h2>Company Details</h2>
                <p><span>Company ID:</span> <span id="modalCompanyID"></span></p>
                <p><span>Name:</span> <span id="modalCompanyName"></span></p>
                <p><span>Contact Person:</span> <span id="modalCompanyContactPerson"></span></p>
                <p><span>Email:</span> <span id="modalCompanyEmail"></span></p>
            </div>
        </div>


    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // student modal
            document.querySelectorAll(".student-link").forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const data = JSON.parse(this.dataset.student);
                    document.getElementById("modalStudentId").textContent = data.StudentId;
                    document.getElementById("modalStudentName").textContent = data.StudentName;
                    document.getElementById("modalStudentNIC").textContent = data.NIC;
                    document.getElementById("modalStudentEmail").textContent = data.Email;
                    document.getElementById("modalStudentDegree").textContent = data.DegreeName;
                    document.getElementById("modalStudentContact").textContent = data.ContactNum;
                    document.getElementById("studentModal").style.display = "block";
                });
            });

            // ad modal
            document.querySelectorAll(".ad-link").forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const data = JSON.parse(this.dataset.ad);
                    document.getElementById("modalAdId").textContent = data.advertisementId;
                    document.getElementById("modalAdPosition").textContent = data.position;
                    document.getElementById("modalAdCompany").textContent = data.CompanyName;
                    document.getElementById("modalAdWorkingMode").textContent = data.workingMode;
                    document.getElementById("modalAdStatus").textContent = data.status;
                    document.getElementById("modalAdStart").textContent = data.startdate;
                    document.getElementById("modalAdDeadline").textContent = data.deadline;
                    document.getElementById("adModal").style.display = "block";
                });
            });

            // company modal
            document.querySelectorAll(".company-link").forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const data = JSON.parse(this.dataset.company);
                    document.getElementById("modalCompanyID").textContent = data.CompanyId;
                    document.getElementById("modalCompanyName").textContent = data.CompanyName;
                    document.getElementById("modalCompanyContactPerson").textContent = data.ContactPerson;
                    document.getElementById("modalCompanyEmail").textContent = data.CompanyEmail;
                    document.getElementById("companyModal").style.display = "block";
                });
            });

            // Close modals
            document.querySelectorAll(".close").forEach(btn => {
                btn.addEventListener("click", function() {
                    const modalId = this.getAttribute("data-close");
                    document.getElementById(modalId).style.display = "none";
                });
            });

            // Click outside modal to close
            window.addEventListener("click", function(e) {
                document.querySelectorAll(".modal").forEach(modal => {
                    if (e.target === modal) modal.style.display = "none";
                });
            });

        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector(".search-box input");
        const tableRows = document.querySelectorAll("table tbody tr");
        const noResultsRow = document.querySelector("tbody tr td[colspan]");

        searchInput.addEventListener("keyup", function() {
            const query = searchInput.value.trim().toLowerCase();
            let anyVisible = false;

            tableRows.forEach(row => {
                // Skip the "No Applications Found" row
                if (row.contains(noResultsRow)) return;
                
                const cells = row.querySelectorAll("td");
                let matchFound = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(query)) {
                        matchFound = true;
                    }
                });

                if (matchFound) {
                    row.style.display = "";
                    anyVisible = true;
                } else {
                    row.style.display = "none";
                }
            });

            // Handle "No results" message visibility
            if (noResultsRow) {
                const parentRow = noResultsRow.closest("tr");
                parentRow.style.display = (query && !anyVisible) ? "" : "none";
            }
        });
    });
</script>

</body>

</html>