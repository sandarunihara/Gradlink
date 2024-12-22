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
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
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
                                <?php if (isset($data['ProgressDocs']) && !empty($data['ProgressDocs'])): ?>
                                    <?php foreach ($data['ProgressDocs'] as $ProgressDoc): ?>
                                        <?php
                                        $status = $ProgressDoc -> Status;
                                        $statusClass = ($status == 'reviewed') ? 'reviewed' : 'not-reviewed';
                                        $statusText = ($status == 'reviewed') ? 'Reviewed' : 'Not Reviewed';
                                        ?>
                                        <tr>
                                            <td><?php
                                                $SubmissionDate = $ProgressDoc -> SubmissionDate;
                                                $dateString = explode(' ', $SubmissionDate)[0];
                                                echo htmlspecialchars($dateString); 
                                                ?>
                                            </td>
                                            <td><?php
                                                $date = DateTime::createFromFormat('Y-m-d', $dateString);
                                                $day = $date->format('jS');
                                                echo htmlspecialchars($day). " Progress Report";
                                                ?>
                                            </td>
                                            <td>
                                                <div class="<?php echo $statusClass; ?>">
                                                    <?php echo $statusText; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No progress reports found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Popup Box -->
<div id="popupBox" class="popup hidden">
    <div class="popup-content">
        <form action="<?= ROOT ?>/Student/StudentProgress/addProgressReport" method="post" enctype="multipart/form-data">
            <h2>Add New Progress Report</h2>
            <input type="file" id="fileUpload" accept=".pdf" name="file" required>
            <br><br>
            <button 
                type="submit" 
                id="saveBtn"
                name="submit"
            >
            SAVE
            </button>
        </form>
    </div>
</div>
<!-- Toast -->
    <div id="toast-container" class="toast-container"></div>

    <?php if(array_key_exists('isInsert', $_SESSION)){ ?>
        <?php if($_SESSION['isInsert']){?>
            <script>
                successToast("Progress report added successfully");
            </script>
        <?php }else{ ?>
            <script>
                errorToast("Failed to add progress report");
            </script>
        <?php } ?>
        <?php unset($_SESSION['isInsert']);?>
    <?php }?>

    <?php if(array_key_exists('isBig', $_SESSION)){ ?>
        <?php if($_SESSION['isBig']){?>
            <script>
                errorToast("Your file is too big!");
            </script>
        <?php unset($_SESSION['isBig']);?>
        <?php }?>
    <?php }?>

    <?php if(array_key_exists('isTypeError', $_SESSION)){ ?>
        <?php if($_SESSION['isTypeError']){?>
            <script>
                errorToast("You cannot upload files of this type!");
            </script>
        <?php unset($_SESSION['isTypeError']);?>
        <?php }?>
    <?php }?>
    
<!-- script for popup box -->
<script>
    // Get references to elements
    const addNewBtn = document.getElementById('addNewBtn');
    const popupBox = document.getElementById('popupBox');
    const popupContent = document.querySelector('.popup-content');
    const saveBtn = document.getElementById('saveBtn');
    const form = document.querySelector('form');
    
    addNewBtn.addEventListener('click', () => {
        popupBox.classList.remove('hidden');
    });

    saveBtn.addEventListener('click', () => {
        const fileUpload = document.getElementById('fileUpload').files;
        if (fileUpload.length !== 0) {
            form.submit();
        }
    });
    // Hide popup when clicking outside the content box
    popupBox.addEventListener('click', (event) => {
        if (!popupContent.contains(event.target)) {
            popupBox.classList.add('hidden');
        }
    });
</script>
</body>
</html>