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
                        <?php
                        $degreeSet = [];

                        if (!empty($studentData)) {
                            foreach ($studentData as $student) {
                                $degree = is_array($student) ? $student['degree'] : $student->degree;
                                if (!in_array($degree, $degreeSet)) {
                                    $degreeSet[] = $degree;
                                }
                            }
                            sort($degreeSet); // Optional: sort alphabetically
                        }
                        ?>
                        <div class="search-field">
                            <select id="search-degree">
                                <option value="">All Degrees</option>
                                <?php foreach ($degreeSet as $degree): ?>
                                    <option value="<?= htmlspecialchars($degree) ?>"><?= htmlspecialchars($degree) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="search-field">
                            <input type="text" id="search-name" placeholder="Search by Name" />
                            <button class="search-icon-btn"><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                </div>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Registration No.</th>
                                <th>Name</th>
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
                                        <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['degree'] : $student->degree) ?></td>
                                        <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['student_email'] : $student->student_email) ?></td>
                                        <td> <?= htmlspecialchars(string: is_array(value: $student) ? $student['contact_no'] : $student->contact_no) ?></td>
                                        <td><button class="view-btn" onclick="navigateToStudentProfile('<?= htmlspecialchars(is_array($student) ? $student['student_id'] : $student->student_id) ?>');">
                                                <i class="fas fa-eye"></i>
                                                View</button></td>
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
            const nameInput = document.getElementById("search-name");
            const degreeSelect = document.getElementById("search-degree");
            const studentRows = document.querySelectorAll("table tbody tr");

            function filterTable() {
                const nameQuery = nameInput.value.toLowerCase();
                const degreeQuery = degreeSelect.value.toLowerCase();

                studentRows.forEach(row => {
                    const nameCell = row.children[1]?.textContent.toLowerCase(); // Name
                    const degreeCell = row.children[2]?.textContent.toLowerCase(); // Degree

                    const nameMatches = nameCell.includes(nameQuery);
                    const degreeMatches = degreeQuery === "" || degreeCell.includes(degreeQuery);

                    row.style.display = (nameMatches && degreeMatches) ? "" : "none";
                });
            }

            nameInput.addEventListener("keyup", filterTable);
            degreeSelect.addEventListener("change", filterTable);
        });
    </script>


    <script src="<?= ROOT ?>/assets/js/script.js"></script>

</body>

</html>