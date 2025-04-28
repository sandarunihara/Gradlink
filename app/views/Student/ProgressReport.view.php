<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Report</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/progressReport.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
</head>
<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Progress Report"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <div class="progress-report-navbar">
            <?php if (isset($data['recruit']) && $data['recruit'] == 1){ ?>
                <div class="add-progress-report">
                    <button id="addNewBtn">+ Add New</button>
                </div>
            <?php } ?>
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
                                        $statusText = ($status == 'Approved') ? 'Reviewed' : 'Not Reviewed';
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
                                            <a 
                                                href="<?=ROOT?>/assets/uploads/progress_docs/<?php echo htmlspecialchars($ProgressDoc -> Name)?>" 
                                                target="_blank">
                                                    <div class="<?php echo $statusClass; ?>">
                                                        <?php echo $statusText; ?>
                                                    </div>
                                            </a>
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
<!-- Popup Box -->
<div id="popupBox" class="popup">
    <div class="popup-content">
        <form action="<?= ROOT ?>/Student/StudentProgress/addProgressReport" method="post" enctype="multipart/form-data">
            <h2>Add New Progress Report</h2>
            <input 
                type="file" 
                id="fileUpload" 
                name="file" 
                required
                onchange="validateFile(this)"
            >
            <span id="error-id" class="error"></span>
            <button 
                type="submit" 
                id="saveBtn"
            >
            SAVE
            </button>
        </form>
    </div>
</div>
<!-- Toast -->
    <div id="toast-container" class="toast-container"></div>

    <?php if(array_key_exists('success', $data)){ ?>
        <script>
            successToast("<?= $data['success'] ?>");
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php }?>

    <?php if(array_key_exists('erros', $data)){ ?>
        <script>
            errorToast("<?= $data['erros'] ?>");
        </script>
        <?php unset($_SESSION['errors']); ?>
    <?php }?>
    
<!-- script for popup box -->
<script>
    // Get references to elements
    const addNewBtn = document.getElementById('addNewBtn');
    const popupBox = document.getElementById('popupBox');
    const popupContent = document.querySelector('.popup-content');
    const saveBtn = document.getElementById('saveBtn');
    const form = document.querySelector('form');
    const fileUpload = document.getElementById('fileUpload');
    const errorId = document.getElementById('error-id');
    
    addNewBtn.addEventListener('click', () => {
        popupBox.style.display = 'flex'; // Show modal
    });

    saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if(validateFile(fileUpload)){
            form.submit();
        }
    });

    function validateFile(input){
        const file = input.files[0];
        const validMimeType = "application/pdf";
        const validExtension = ".pdf";
        const validSize = 5000000; // 5MB in bytes
        let isValid = true;

        if(file.size === 0){
            errorId.innerHTML = "Please select a file.";
            errorId.style.display = "block";
            input.classList.add("invalid");
            return false;
        }else if(file.size > validSize){
            errorId.innerHTML = "File size exceeds 1MB.";
            errorId.style.display = "block";
            input.classList.add("invalid");
            return false;
        }else{
            errorId.innerHTML = "";
            errorId.style.display = "none";
            input.classList.remove("invalid");
        }
        // Check MIME type
        if (file.type !== validMimeType) {
            isValid = false;
        }

        // Check file extension
        const fileName = file.name.toLowerCase();
        if (!fileName.endsWith(validExtension)) {
            isValid = false;
        }

        if (!isValid) {
            errorId.innerHTML = "Invalid file type. Only PDF is allowed.";
            errorId.style.display = "block";
            input.classList.add("invalid");
            return false;
        } else {
            errorId.innerHTML = "";
            errorId.style.display = "none";
            input.classList.remove("invalid");
            return true;
        }
    }
    // Hide popup when clicking outside the content box
    popupBox.addEventListener('click', (event) => {
        if (!popupContent.contains(event.target)) {
            popupBox.style.display = 'none'; // Hide modal
        }
    });
</script>
</body>
</html>