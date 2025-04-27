<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internships</title>
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
    <?php $this->renderComponent("studentHeader", ["title" => "Internships"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <div class="filter">
            <div>
                <div class="search-container">
                    <input id="searchInput" type="text" placeholder="Search Company" oninput="searchCompany(this.value)">
                </div>
                <i class="fas fa-search" id="searchIcon"></i>
            </div>
            <div class="filter-by-job">
                <i class="fas fa-filter"></i>
                <select id="positionSelect" onchange="searchByPosition()">
                    <option value="all">All Jobs</option>
                    <?php foreach ($data['differentRoles'] as $position) { ?>
                        <option 
                            value="<?= htmlspecialchars($position); ?>"
                        >
                            <?= htmlspecialchars($position); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="job-container">
            <?php if (isset($data['AdDetails']) && !empty($data['AdDetails'])): ?>
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
                                    src="<?php echo ROOT .'/assets/img/Company/advertisements/' .  $AdDetail->image; ?>" 
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
        <form action="<?= ROOT ?>/Student/StudentAd/advertisement/" method="post" enctype="multipart/form-data">
            <h2>Upload Your CV</h2>
            <input 
                type="file" 
                id="cvUpload" 
                name="file" 
                onchange="validateFile(this)"
                class="cv-upload"
            >
            <span id="errorId" class="error"></span>
            <?php if(isset($data['cv']) && !empty($data['cv'])){ ?>
                <?php foreach ($data['cv'] as $cv): ?>
                    <div class="cv-container">
                        <input
                            type="radio"
                            name="cvId"
                            id="cvId"
                            value="<?= htmlspecialchars($cv->CV); ?>"
                        >
                        <label for="cvId" class="cv-label" id="cvLabel">
                            <?= htmlspecialchars($cv->position . ' - ' . $cv->Name); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
            <button 
                type="submit"
                id="okBtn"
            >
            OK
            </button>
        </form>
    </div>
</div>
<!-- Toast -->
<div id="toast-container" class="toast-container"></div>

<?php if(array_key_exists('success', $_SESSION)){ ?>
        <script>
            successToast("<?= $_SESSION['success'] ?>");
        </script>
    <?php unset($_SESSION['success']);?>
<?php }?>

<?php if(array_key_exists('errors', $_SESSION)){ ?>
        <script>
            errorToast("<?= $_SESSION['errors'] ?>");
        </script>
    <?php unset($_SESSION['errors']);?>
<?php }?>

<script src="<?=ROOT?>/assets/js/Student/internship.js"></script>
</body>
</html>