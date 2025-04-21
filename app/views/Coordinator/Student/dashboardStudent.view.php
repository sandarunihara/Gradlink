<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Student/dashboardStudent.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">

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

            <?php $activeTab = 'student-list'; ?>
            <?php $this->renderComponent("studentTabs") ?>

            <section class="company-list">
                <div class="list-header">
                    <h2>Registered Students</h2>
                    <div class="search-box">
                        <input type="text" placeholder="Search Students" />
                        <button> Search
                        </button>
                    </div>
                </div>
                <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Degree</th>
                            <th>email</th>
                            <th>Contact No</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($studentData)): ?>
                            <?php foreach ($studentData as $student): ?>
                                <tr>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['student_id'] : $student->student_id) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['student_name'] : $student->student_name) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['nic'] : $student->nic) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['degree'] : $student->degree) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['student_email'] : $student->student_email) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['contact_no'] : $student->contact_no) ?></td>
                                    <td><button class="view-btn" onclick="navigateToStudentProfile('<?= htmlspecialchars(is_array($student) ? $student['student_id'] : $student->student_id) ?>');">View</button></td>
                                    <!-- View -> Go to the student profile -->
                                </tr>
                            <?php endforeach ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="9">No Registered Companies</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </section>



        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector(".search-box input");
            const studentRows = document.querySelectorAll("table tbody tr");

            searchInput.addEventListener("keyup", function() {
                const query = searchInput.value.toLowerCase();

                studentRows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let matchFound = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(query)) {
                            matchFound = true;
                        }
                    });

                    row.style.display = matchFound ? "" : "none";
                });
            });
        });
    </script>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>