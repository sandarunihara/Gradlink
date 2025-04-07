<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Company/blockedCompanies.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Students</h1>
                </div>


            </header>

            <?php $activeTab = 'blocked-students'; ?>
            <?php $this->renderComponent("studentTabs") ?>


            <!-- Pending Companies -->
            <section class="company-list">
                <div class="list-header">
                    <h2>Blocked Student List</h2>

                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Registration No</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Degree</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($blockedStudentData)): ?>
                            <?php foreach ($blockedStudentData as $student): ?>
                                <tr>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['student_id'] : $student->student_id) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['student_name'] : $student->student_name) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['nic'] : $student->nic) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['degree'] : $student->degree) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['student_email'] : $student->student_email) ?></td>


                                    <td>
                                        <button
                                            class="view-btn"
                                            data-id="<?= htmlspecialchars(is_array($student) ? $student['student_id'] : $student->student_id) ?>"
                                            data-name="<?= htmlspecialchars(is_array($student) ? $student['student_name'] : $student->student_name) ?>"
                                            data-reason="<?= htmlspecialchars(is_array($student) ? $student['comment'] : $student->comment) ?>">
                                            View
                                        </button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            <?php endforeach ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="9">No Blocked Students</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </section>

        </main>
    </div>
    <div class="modal" id="companyModal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Student Details</h2>
            <p><strong>Registration No:</strong> <span id="modalCompanyId"></span></p>
            <p><strong>Student Name:</strong> <span id="modalCompanyName"></span></p>
            <p><strong>Reason for Blocking:</strong></p>
            <p id="modalBlockReason" style="background-color: #f2f2f2; padding: 10px; border-radius: 5px;"></p>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    <script>
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Get data from button
                const companyId = button.dataset.id;
                const companyName = button.dataset.name;
                const blockReason = button.dataset.reason;

                // Fill modal content
                document.getElementById('modalCompanyId').innerText = companyId;
                document.getElementById('modalCompanyName').innerText = companyName;
                document.getElementById('modalBlockReason').innerText = blockReason;

                // Show modal
                document.getElementById('companyModal').style.display = 'flex';
            });
        });

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('companyModal').style.display = 'none';
        });
    </script>

</body>

</html>