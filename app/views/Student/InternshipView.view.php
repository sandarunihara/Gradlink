<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/internshipView.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/backIcon.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php $this->renderComponent("studentHeader")  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <a href="<?=ROOT?>/Student/StudentAd/advertisement" class="backreq">
            <svg class="back-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            <h3>Back</h3>
        </a>
        <div class="sub_container">
            <?php if (isset($data) && !empty($data)): ?>
            <div class="display-details">
                <div class="image">
                    <?php if (!empty($data[0]->image)): ?>
                    <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                    <?php else: ?>
                    <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                    <?php endif; ?>
                </div>
                <div class="inform">
                    <div>
                        <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                        <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                        <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                    </div>
                </div>
            </div>
            <div class="Qua-des">
                <div class="Qualifications">
                    <h4>Qualification:</h4>
                    <div class="q-details">
                        <p><?php echo $data[0]->qualification ?></p>
                    </div>
                </div>

                <div class="Description">
                    <h4>Description:</h4>
                    <div class="d-details">
                        <p><?php echo $data[0]->description ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php 
            $hasApplied = false;
            if (isset($data['AppliedCompanies']) && !empty($data['AppliedCompanies'])):
                foreach ($data['AppliedCompanies'] as $appliedCompany) {
                    if ($appliedCompany->AdvertisementId == $data[0]->advertisementId) {
                        $hasApplied = true;
                        break;
                    }
                }
            endif;
            if ($hasApplied): ?>
                <div class="applied-container">
                    <p>Applied</p>
                </div>
            <?php else: ?>
                <div class="apply-container">
                    <button
                        id="applyBtn"
                        data-advertisement-id="<?= htmlspecialchars($data[0]->advertisementId); ?>"
                    >
                    Apply
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
<!-- Popup Box -->
<div id="popupBox" class="popup hidden">
    <div class="popup-content">
        <form action="<?= ROOT ?>/Student/StudentAd/advertisement/" method="post" enctype="multipart/form-data">
            <h2>Upload Your CV</h2>
            <input type="file" id="cvUpload" accept=".pdf" name="file" required>
            <br><br>
            <button 
                type="submit"
                id="okBtn" 
                name="submit"
            >
            OK
            </button>
        </form>
    </div>
</div>
<!-- script for popup box -->
<script>
    // Get references to elements
    const applyBtn = document.getElementById('applyBtn');
    const popupBox = document.getElementById('popupBox');
    const popupContent = document.querySelector('.popup-content');
    const okBtn = document.getElementById('okBtn');
    const form = document.querySelector('form');


    // Show popup when any "Apply" button is clicked
    applyBtn.addEventListener('click', () => {
        popupBox.classList.remove('hidden');
        const advertisementId = applyBtn.getAttribute('data-advertisement-id');
        form.action = form.action + '?advertisementId=' + encodeURIComponent(advertisementId);

    });

    // Hide popup and handle file upload when "OK" button is clicked
    okBtn.addEventListener('click', () => {
        const cvFile = document.getElementById('cvUpload').files;
        if(cvFile.length !== 0) {
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