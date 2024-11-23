<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Opportunities</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/internship.css"> 
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
        <div class="page-header">
            <h1>Job Opportunities</h1>
        </div>
        <div class="main-content">
            <div class="filter">
                <div class="filter-by-company">
                    <i class="fas fa-filter"></i>
                    <select>
                        <option value="all">All Companies</option>
                        <option value="wso2">WSO2</option>
                        <option value="sysco-labs">Sysco Labs</option>
                        <option value="ifs">IFS</option>
                    </select>
                </div>
                <div class="filter-by-job">
                    <i class="fas fa-filter"></i>
                    <select>
                        <option value="all">All Jobs</option>
                        <option value="software-engineer">Software Engineer</option>
                        <option value="qa">Quality Assuarance Engineer</option>
                        <option value="dev-ops-engineer">Dev-Ops Engineer</option>
                    </select>
                </div>
            </div>
            <div class="job-card">
                <div class="view-button">
                    <button>View</button>
                </div>
                <div class="image">
                    <img src="<?=ROOT?>/assets/img/inter.jpg" alt="error loading image">
                </div>
                <div class="job-details">
                    <h3>Software Engineer</h3>
                    <p>WSO2</p>
                </div>
                <div class="apply-button">
                    <button>Apply</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>