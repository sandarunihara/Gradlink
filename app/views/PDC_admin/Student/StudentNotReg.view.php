<!DOCTYPE html>
<html lang="en">

<head>
    <title>Not Registered Students</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/student/overviewStudent.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/tabs/companytabs.css">
</head>

<body>

    <?php 
        if (isset($_SESSION['flash_message'])): 
            $message = htmlspecialchars($_SESSION['flash_message']['message']);
            $type = htmlspecialchars($_SESSION['flash_message']['type']);
            unset($_SESSION['flash_message']);
        ?>
        <script>
            window.__flashMessage = {
                message: "<?= $message ?>",
                type: "<?= $type ?>"
            };
        </script>
    <?php endif; ?>

    <div class="container">
    <?php $this->renderComponent("pdc_adminsidebar")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Not Registered Students</h1>
                </div>
            </header>

            <div class="tabs">
                <?php $this->renderPDC_adminTabs("studentTabs", ['activeTab' => $activeTab]); ?>
            </div>

            <div class="tab-content">
                <div id="Not-Registered-Students" class="tab-pane active">
                    <section class="company-list">
                        <div class="list-header">
                            <div class="search-box">
                                <input type="text" placeholder="Search Students" />
                                <button> 
                                    Search
                                </button>
 
                                <div class="filter-buttons">
                                    <button class="filter-btn active" data-degree="all">
                                        <i class="fas fa-users"></i> All
                                    </button>
                                    <button class="filter-btn" data-degree="Computer Science">
                                        CS
                                    </button>
                                    <button class="filter-btn" data-degree="Information System">
                                        IS
                                    </button>
                                </div>

                            </div>
                            <div class="action-buttons">
                            <button class="add-btn" onclick="navigateToAddStudent();" ></button>
                        </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Registration No.</th>
                                    <th>Name</th>
                                    <th>Degree</th>
                                    <th>email</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($studentData)): ?>
                                    <?php foreach($studentData as $student): ?>
                                        <tr>
                                            <td><?= htmlspecialchars(is_array($student) ? $student['StudentId'] : $student->StudentId) ?></td>
                                            <td><?= htmlspecialchars(is_array($student) ? $student['Name'] : $student->Name) ?></td>
                                            <td><?= htmlspecialchars(is_array($student) ? $student['DegreeName'] : $student->DegreeName) ?></td>
                                            <td><?= htmlspecialchars(is_array($student) ? $student['Email'] : $student->Email) ?></td>
                                            <td><?= htmlspecialchars(is_array($student) ? $student['Status'] : $student->Status) ?></td>
                                            <td><button class="view-btn action-btn" onclick="navigateToShowStudent('<?= htmlspecialchars(is_array($student) ? $student['StudentId'] : $student->StudentId) ?>')"><i class="fas fa-eye"></i> View</button></td>

                                            <!-- <td><button class="btn delete-btn" id="delete-btn" onclick="navigateToDeleteStudent('<?= htmlspecialchars(is_array($student) ? $student['StudentId'] : $student->StudentId) ?>')">Delete</button></td> -->
                                            <td></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9">No Students found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js?v=<?= time() ?>"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>

</body>

</html>