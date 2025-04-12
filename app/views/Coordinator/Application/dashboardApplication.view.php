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

                    <!-- <section class="company-list"> -->
                    <div class="list-header">
                        <h2>Applications</h2>
                        <div class="search-box">
                            <input type="text" placeholder="Search Students" />
                            <button> Search
                            </button>
                        </div>
                    </div>
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
                                        <td>
                                            <a href="#" class="open-modal"
                                                data-student='<?= json_encode($row) ?>'>
                                                <?= htmlspecialchars($row->StudentId) ?>
                                            </a>
                                        </td>

                                        <!-- <td><?= htmlspecialchars($row->StudentId) ?></td> -->
                                        <td><?= htmlspecialchars($row->StudentName) ?></td>
                                        <td><?= htmlspecialchars($row->DegreeName) ?></td>
                                        <td><?= htmlspecialchars($row->CompanyName) ?></td>
                                        <td><?= htmlspecialchars($row->position) ?></td>
                                        <td><?= htmlspecialchars($row->advertisementId) ?></td>
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

                    <!-- </section> -->


                </div>
            </div>

        </main>
        <div id="studentModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Student Details</h2>
                <p><strong>Registration No:</strong> <span id="modal-studentId"></span></p>
                <p><strong>Name:</strong> <span id="modal-name"></span></p>
                <p><strong>Degree:</strong> <span id="modal-degree"></span></p>
                <p><strong>Company:</strong> <span id="modal-company"></span></p>
                <p><strong>Position:</strong> <span id="modal-position"></span></p>
                <p><strong>Advertisement ID:</strong> <span id="modal-ad-id"></span></p>
                <p><strong>Status:</strong> <span id="modal-status"></span></p>
            </div>
        </div>

    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById("studentModal");
            const closeBtn = document.querySelector(".modal .close");

            document.querySelectorAll(".open-modal").forEach(link => {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const student = JSON.parse(this.dataset.student);
                    document.getElementById("modal-studentId").textContent = student.StudentId;
                    document.getElementById("modal-name").textContent = student.StudentName;
                    document.getElementById("modal-degree").textContent = student.DegreeName;
                    document.getElementById("modal-company").textContent = student.CompanyName;
                    document.getElementById("modal-position").textContent = student.position;
                    document.getElementById("modal-ad-id").textContent = student.advertisementId;
                    document.getElementById("modal-status").textContent = student.Jobstatus;

                    modal.style.display = "block";
                });
            });

            closeBtn.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>

</body>

</html>