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
                    <?php foreach($data['AdDetails'] as $AdDetail): ?>
                        <div class="job-card">
                            <div class="view-button">
                                <button
                                    onclick="location.href='<?=ROOT?>/Student/StudentAd/viewAdvertisement/<?php echo $AdDetail->advertisementId; ?>';">
                                    View
                                </button>
                            </div>
                            <div class="image">
                                <?php if (!empty($AdDetail->image)): ?>
                                    <img 
                                        src="data:image/jpeg;base64,<?php echo $AdDetail->image; ?>" 
                                        alt="error loading image"
                                        class="logo"
                                    >
                                <!-- Optionally, you can set a default image here -->
                                <?php else: ?>
                                    <img 
                                        src="" 
                                        class="logo" /> 
                                <?php endif; ?>
                            </div>
                            <div class="job-details">
                                <h3><?php echo $AdDetail->position; ?></h3>
                                <p><?php echo $AdDetail->Name; ?></p>
                            </div>
                            <div class="apply-button" id="applyBtn">
                                <button>Apply</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h3>No advertisements found</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
  <!-- Popup Box -->
  <div id="popupBox" class="popup hidden">
    <div class="popup-content">
      <h2>Upload Your CV</h2>
      <input type="file" id="cvUpload" accept=".pdf,.doc,.docx">
      <br><br>
      <button id="okBtn" class="btn-ok">OK</button>
    </div>
  </div>
  <script>
        // Get references to elements
        const applyBtn = document.getElementById('applyBtn');
        const popupBox = document.getElementById('popupBox');
        const popupContent = document.querySelector('.popup-content');
        const okBtn = document.getElementById('okBtn');

        // Show popup when "Apply" button is clicked
        applyBtn.addEventListener('click', () => {
        popupBox.classList.remove('hidden');
        });

        // Hide popup when "OK" button is clicked
        okBtn.addEventListener('click', () => {
        const cvFile = document.getElementById('cvUpload').files[0];
        if (cvFile) {
            alert(`CV Uploaded: ${cvFile.name}`);
            popupBox.classList.add('hidden');
        } else {
            alert('Please upload your CV!');
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