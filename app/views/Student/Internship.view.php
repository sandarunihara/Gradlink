<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Opportunities</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/internship.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
</head>

<body>
    <?php $this->renderComponent("studentHeader")  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <div class="filter">
            <div class="search-container">
                <input id="searchInput" type="text" placeholder="Search Company">
                <i class="fas fa-search"></i>
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
        <div class="job-container">
            <?php if (isset($data) && !empty($data)): ?>
                <?php foreach ($data['AdDetails'] as $AdDetail): ?>
                    <div class="job-card">
                        <div class="view-button">
                            <button
                                class = "viewBtn"
                                data-advertisement-id="<?= htmlspecialchars($AdDetail->advertisementId); ?>"
                            >
                                View
                            </button>
                        </div>
                        <div class="image">
                            <?php if (!empty($AdDetail->image)): ?>
                                <img 
                                    src="data:image/jpeg;base64,<?= $AdDetail->image; ?>" 
                                    alt="Advertisement Image"
                                    class="logo"
                                >
                            <?php else: ?>
                                <img 
                                    src="default-placeholder.jpg" 
                                    alt="Default Placeholder"
                                    class="logo" 
                                />
                            <?php endif; ?>
                        </div>
                        <div class="job-details">
                            <h3><?= htmlspecialchars($AdDetail->position); ?></h3>
                            <p><?= htmlspecialchars($AdDetail->Name); ?></p>
                        </div>
                        <?php
                        $hasApplied = false;
                        if (isset($data['AppliedCompanies']) && !empty($data['AppliedCompanies'])):
                            foreach ($data['AppliedCompanies'] as $appliedCompany) {
                                if ($appliedCompany->AdvertisementId == $AdDetail->advertisementId) {
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
                            <div class="apply-button">
                                <button 
                                    class="applyBtn" 
                                    data-advertisement-id="<?= htmlspecialchars($AdDetail->advertisementId); ?>"
                                >
                                Apply
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h3>No advertisements found</h3>
            <?php endif; ?>
        </div>
    </div>
<!-- Popup Box -->
<div id="popupBox" class="popup hidden">
    <div class="popup-content">
        <form action="<?= ROOT ?>/Student/StudentAd/applyAdvertisement/" method="post" enctype="multipart/form-data">
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
<!-- Toast -->
<div id="toast-container" class="toast-container"></div>

<?php if(array_key_exists('isInsert', $_SESSION)){ ?>
    <?php if($_SESSION['isInsert']){?>
        <script>
            successToast("Application submitted successfully");
        </script>
    <?php }else{ ?>
        <script>
            errorToast("Failed to submit application");
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
    const applyButtons = document.querySelectorAll('.applyBtn');
    const viewButtons = document.querySelectorAll('.viewBtn');
    const popupBox = document.getElementById('popupBox');
    const popupContent = document.querySelector('.popup-content');
    const okBtn = document.getElementById('okBtn');
    const form = document.querySelector('form');


    // Show popup when any "Apply" button is clicked
    applyButtons.forEach(button => {
        button.addEventListener('click', () => {
            popupBox.classList.remove('hidden');
            const advertisementId = button.getAttribute('data-advertisement-id');
            form.action = form.action + '?advertisementId=' + encodeURIComponent(advertisementId);
        });
    });
    // show advertisement when view button is clicked
    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const advertisementId = button.getAttribute('data-advertisement-id');
            const url = '<?=ROOT?>' + '/Student/StudentAd/viewAdvertisement/' + '?advertisementId=' + encodeURIComponent(advertisementId);
            window.location.href = url;
        });
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