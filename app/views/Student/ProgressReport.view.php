<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Report</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/progressReport.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
            <div class="progress-report-navbar">
                <div class="add-progress-report">
                    <button id="addNewBtn">+ Add New</button>
                </div>
            </div>

            <div class="progress-report-table-div">
                <div class="progress-report-table-background">
                    <!-- Table -->
                    <div>
                        <table class="progress-report-table">
                            <thead class="progress-report-table-headings">
                                <tr>
                                    <th>
                                        <h5>Date</h5>
                                    </th>
                                    <th>
                                        <h5>Topic</h5>
                                    </th>
                                    <th>
                                        <h5>Status</h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-11-23</td>
                                    <td>23rd Progress Report</td>
                                    <td>
                                        <div class="reviewed">Reviewed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-12-05</td>
                                    <td>5th Progress Report</td>
                                    <td>
                                        <div class="not-reviewed">Not Reviewed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2024-12-12</td>
                                    <td>12th Progress Report</td>
                                    <td>
                                        <div class="reviewed">Reviewed</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="progressReportBox" class="progress-report-box hidden">
        <div class="box-content">
            <h2>Add New Progress Report</h2>
            <form id="progressForm">
                <label for="reportTitle">Report Title:</label>
                <input type="text" id="reportTitle" name="reportTitle" placeholder="Enter report title" required>
                
                <label for="reportFile">Upload Report (PDF only):</label>
                <input type="file" id="reportFile" name="reportFile" accept=".pdf" required>
                
                <div class="buttons">
                    <button type="submit">Save</button>
                    <button type="button" id="cancelBtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    // Get elements
    const addNewBtn = document.getElementById("addNewBtn");
    const progressReportBox = document.getElementById("progressReportBox");
    const cancelBtn = document.getElementById("cancelBtn");

    // Show the progress report adding box
    addNewBtn.addEventListener("click", () => {
        progressReportBox.classList.remove("hidden");
    });

    // Hide the progress report adding box
    cancelBtn.addEventListener("click", () => {
        progressReportBox.classList.add("hidden");
    });

    // Form submission logic (optional)
    document.getElementById("progressForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default form submission
        alert("Progress report saved successfully!");
        progressReportBox.classList.add("hidden"); // Close the box after saving
    });
    </script>
</body>
</html>