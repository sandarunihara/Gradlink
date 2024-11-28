<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Report</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/newProgressReport.css"> 
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
            <div class="form-container">
                <h2>Upload Progress Report</h2>
                <form id="progressForm">
                    <label for="reportFile">Progress Report (PDF only):</label>
                    <input type="file" id="reportFile" name="reportFile" accept=".pdf" required>
                    <p id="fileError" class="error-message"></p>
                    <button type="submit">Upload</button>
                </form>
                <p id="successMessage" class="success-message"></p>
            </div>
        </div>
    </div>
</body>
</html>