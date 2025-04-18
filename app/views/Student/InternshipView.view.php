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
    <?php $this->renderComponent("studentHeader", ["title" => "Internships"])  ?>
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
            <span id="defaultMessage" class="hidden"></span>
            <br>
            <input 
                type="file" 
                id="cvUpload" 
                name="file" 
                onchange="validateFile(this)"
                class="cv-upload"
            >
            <span id="errorId" class="error"></span>
            <button
                type="button"
                id="defaultCV"
                default-cv = '<?php echo json_encode($_SESSION['USER'] -> cv);?>'
            >
            Choose Default Resume
            </button>
            <br>
            <button 
                type="submit"
                id="okBtn"
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
    const errorId = document.getElementById('errorId');
    const cvUpload = document.getElementById('cvUpload');
    const defaultCV = document.getElementById('defaultCV');
    const defaltMessage = document.getElementById('defaultMessage');

    // Show popup when any "Apply" button is clicked
    applyBtn.addEventListener('click', () => {
        popupBox.classList.remove('hidden');
        const advertisementId = applyBtn.getAttribute('data-advertisement-id');
        form.action = form.action + '?advertisementId=' + encodeURIComponent(advertisementId);

    });
    defaultCV.addEventListener('click', ()=> {
        const cv = JSON.parse(defaultCV.getAttribute('default-cv'));

        const fileNameWithoutExtension = cv.split('.').slice(0, -1).join('.');
        const extension = cv.split('.').pop();
        let masked;

        if(fileNameWithoutExtension.length < 5){
            masked = cv;
        }else{
            const visiblePart = fileNameWithoutExtension.slice(-5);
            masked = "***" + visiblePart + "." + extension;
        }

        cvUpload.style.display = "none";
        defaltMessage.innerText = masked;
        defaltMessage.classList.remove('hidden');

        const defaultInput = document.createElement('input');
        defaultInput.type = 'hidden';
        defaultInput.name = 'use_default_cv';
        defaultInput.value = cv;
        form.appendChild(defaultInput);

    });
    okBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if(cvUpload.value){
            if(validateFile(cvUpload)){
                form.submit();
            }
        }else{
            form.submit();
        }

    });
    function validateFile(input){
        const file = input.files[0];
        const validMimeType = "application/pdf";
        const validExtension = ".pdf";
        const validSize = 5000000; // 5MB in bytes
        let isValid = true;

        if(file === undefined){
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
            popupBox.classList.add('hidden');
        }
    });
</script>
</body>

</html>