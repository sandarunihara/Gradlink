<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/complaintView.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/backIcon.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php
        $complaintId = $data['Complaint'] -> ComplaintId;
        $description = $data['Complaint'] -> Description;
        $status = $data['Complaint'] -> Status;
        $delete = $data['Complaint'] -> Delete;
    ?>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
            <a href="<?=ROOT?>/Student/StudentComplaint/complaint" class="backreq">
                <svg class="back-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
                <h3>Back</h3>
            </a>
            <div id="view-complaint-box">
                <div class="complaint-description-box">
                    <h2>Complaint Description</h2>
                    <p class="complaint-description">
                        <?=$description?>
                    </p>
                </div>
                <div class="complaint-description-box">
                    <h2>Coordinator's Response</h2>
                    <p class="complaint-description">
                        <?php
                        if($status === "notReviewed"){
                            echo "No response yet";
                        }else{
                            $reply = $data['CoordinatorComplaint'] -> Reply;
                            echo $reply;
                        }
                        ?>
                    </p>
                </div>
                <?php
                    if($delete == 1){
                ?>
                <button id="complaintDeleteBtn">Delete Complaint</button>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Confirmation Modal -->
    <div id="deleteConfirmationModal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to delete the complaint?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmDelete()">Yes</button>
                <button class="updateno-btn" onclick="closeConfirmDeleteModal()">No</button>
            </div>
        </div>
    </div>
    <!-- Toast -->
    <?php if(array_key_exists('isSuccess', $data)): ?>
        <div id="toast-container" class="toast-container"></div>

        <?php if ($data['isSuccess'] == 0): ?>
            <script>
                errorToast("Failed to delete complaint");
            </script>
        <?php endif; ?>
        <?php if ($data['isSuccess'] == 1): ?>
            <script>
                successToast("Complaint Deleted Successfully");
            </script>
        <?php endif; ?>
    <?php endif; ?>
<script>
    // Get references to modal and buttons
    const complaintDeleteBtn = document.getElementById('complaintDeleteBtn');
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const yesButton = document.querySelector('.updateyes-btn');
    const noButton = document.querySelector('.updateno-btn');

    // Show confirmation modal when "Delete Complaint" is clicked
    complaintDeleteBtn.addEventListener('click', () => {
        deleteConfirmationModal.style.display = 'flex'; // Show modal
    });

    // Close confirmation modal when "No" button is clicked
    function closeConfirmDeleteModal() {
        deleteConfirmationModal.style.display = 'none'; // Hide modal
    }

    // Handle the "Yes" button click (confirm delete)
    function confirmDelete() {
        const complaintId = <?php echo $complaintId; ?>; // Pass complaint ID from PHP to JavaScript

        // Redirect to the delete route for the complaint
        window.location.href = `<?=ROOT?>/Student/StudentComplaint/deleteComplaint/${complaintId}`;
    }
</script>
</body>
</html>



