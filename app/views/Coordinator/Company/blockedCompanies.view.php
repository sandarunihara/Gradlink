<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
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
                    <h1>Companies</h1>
                </div>


            </header>

            <?php $activeTab = 'pending-companies'; ?>
            <?php $this->renderComponent("companyTabs") ?>


            <!-- Pending Companies -->
            <section class="company-list">
                <div class="list-header">
                    <h2>Blocked Company List</h2>

                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Company ID</th>
                            <th>Company Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($blockedCompanyData)): ?>
                            <?php foreach ($blockedCompanyData as $company): ?>
                                <tr>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_id'] : $company->company_id) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['company_name'] : $company->company_name) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_person'] : $company->contact_person) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['email'] : $company->email) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $company) ? $company['contact_number'] : $company->contact_number) ?></td>


                                    <td>
                                        <button
                                            class="view-btn"
                                            data-id="<?= htmlspecialchars(is_array($company) ? $company['company_id'] : $company->company_id) ?>"
                                            data-name="<?= htmlspecialchars(is_array($company) ? $company['company_name'] : $company->company_name) ?>"
                                            data-reason="<?= htmlspecialchars(is_array($company) ? $company['comment'] : $company->comment) ?>">
                                            View
                                        </button>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            <?php endforeach ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="9">No Registered Companies</td>
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
            <h2>Company Details</h2>
            <p><strong>Company ID:</strong> <span id="modalCompanyId"></span></p>
            <p><strong>Company Name:</strong> <span id="modalCompanyName"></span></p>
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