<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/profile.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/toast.css"> 
    <script src="<?php echo ROOT ?>/assets/js/student/toast.js"></script> 
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

</head>
<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Profile"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <div class="student-profile">
            <!-- Profile Header -->
            <div class="student-profile-header">
                <!-- Profile Picture -->
                <div class="student-profile-picture">
                    <img 
                        id="profile-pic"
                        src="<?=ROOT?>/assets/img/Student/<?php echo htmlspecialchars($_SESSION['USER']->ProfilePic)?>" 
                        alt="Profile Picture"
                        >
                </div>
                
                <!-- Profile Info (Name & Major) -->
                <div class="student-profile-info-1">
                    <h2><?php echo $data['Student'] -> Name?></h2>
                    <p class="student-major"><?php echo htmlspecialchars($data['Student'] -> DegreeName)?></p>
                </div>

                <!-- Student Info (Email, ID, Contact) -->
                <div class="student-profile-info-2">
                    <p><span><?php
                        $studentId = $data['Student'] -> StudentId;
                        $part1 = substr($studentId, 0, 4);                            
                        $part2 = strtoupper(substr($studentId, 4, 2));                           
                        $part3 = substr($studentId, 6);                            
                        $studentId = "$part1/$part2/$part3";
                        echo htmlspecialchars($studentId);
                    ?></span></p>
                    <p><span><?php echo htmlspecialchars($data['Student'] -> Email)?></span></p>
                    <p><span><?php echo htmlspecialchars($data['Student'] -> ContactNum)?></span></p>
                </div>

                <!-- Links (LinkedIn, GitHub) -->
                <?php
                    $linkedinURL = $data['Student'] -> Linkedin;
                    $githubURL = $data['Student'] -> Github;
                    if (!preg_match('/^https?:\/\//', $linkedinURL) ) {
                        $linkedinURL = 'https://' . $linkedinURL;
                    }
                    if (!preg_match('/^https?:\/\//', $githubURL) ) {
                        $githubURL = 'https://' . $githubURL;
                    }
                ?>
                <div class="student-profile-info-3">
                    <p><a href="<?php echo htmlspecialchars($linkedinURL); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></p>
                    <p><a href="<?php echo htmlspecialchars($githubURL); ?>" target="_blank"><i class="fab fa-github"></i></a></p>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="student-profile-content">
                <!-- Skills Section -->
                <div class="student-skill">
                    <div class="skills">
                        <?php
                            if($data['Skills'] == 0){
                                echo "<p>No skills added</p>";
                            }else{
                                for ($i = 0; $i < count($data['Skills']); $i++) {
                                    echo "<p>" . htmlspecialchars($data['Skills'][$i] -> Skill) . "</p>";
                                }
                            }
                        ?>
                    </div>
                </div>

                <!-- Short Description Section -->
                <div class="student-short-description">
                    <p>
                        <?php echo htmlspecialchars($data['Student'] -> ShortDesc)?>
                    </p>
                </div>
            </div>
            <!-- Footer Section -->
            <div class="student-profile-footer">
                <div class="student-edit">
                    <button onclick="location.href='<?=ROOT?>/Student/StudentProfile/ProfileEdit';">Update Profile</button>
                </div>
                <?php if($data['Student'] -> cv != null){ ?>
                    <div class="cv-download">
                        <a href="<?=ROOT?>/assets/uploads/cv/ <?php echo htmlspecialchars($data['Student'] -> cv)?>" target="_blank">
                            <button>
                                <i class="fas fa-file-arrow-down"></i> 
                                <span>Download Resume</span>
                            </button>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>   
    <!-- Toast -->
    <div id="toast-container" class="toast-container"></div>

    <?php if(array_key_exists('success', $_SESSION)){ ?>
        <script>
            successToast("<?php echo $_SESSION['success']?>");
        </script>
        <?php unset($_SESSION['success']);?>
    <?php } ?>
    <?php if(array_key_exists('errors', $_SESSION)){ ?>
        <script>
            errorToast("<?php echo $_SESSION['errors']?>");
        </script>
        <?php unset($_SESSION['errors']);?>
    <?php } ?>

    <!-- Popup Box -->
    <div id="popupBox" class="popup hidden">
        <div class="popup-content">
            <form action="<?=ROOT?>/Student/StudentProfile/changeProfilePicture" method="POST" enctype="multipart/form-data">
                <input 
                    type="file" 
                    id="SelectedprofilePicture" 
                    name="SelectedprofilePicture" 
                    onchange="isValidProfilePicture(this)"
                >
                <span id="profilePictureError" class="error"></span>
                <div id="image-crop" style="display: none;">
                    <div class="crop-container">
                        <img id="previewImage" />
                    </div>
                    <input type="hidden" name="profilePicture" id="profilePicture">

                    <button type="submit" id="cropBtn">Crop & Save</button>
                </div>
            </form>
        </div>
    </div>
<script>
    function isValidProfilePicture(input) {
        const MAX_SIZE = 500 * 1024;

        if (input.files.length === 0) {
            profilePictureError.innerHTML = "Please upload a file.";
            profilePictureError.style.display = "block";
            return false;
        }
        const fileName = input.files[0].name.toLowerCase();
        const pattern = /\.(jpg|png)$/i;

        if (!pattern.test(fileName)) {
            profilePictureError.innerHTML = "Invalid file type. Only JPG or PNG allowed.";
            profilePictureError.style.display = "block";
            input.classList.add("invalid");
            return false;
        } else {
            profilePictureError.innerHTML = "";
            profilePictureError.style.display = "none";
            input.classList.remove("invalid");
            return true;
        }
        if (input.files[0].size > MAX_SIZE) {
            profilePictureError.innerHTML = "File size must be less than 500KB.";
            profilePictureError.style.display = "block";
            input.classList.add("invalid");
            return false;
        }
    }
    let cropper;
    const profilePic = document.getElementById('profile-pic');
    const popupBox = document.getElementById('popupBox');
    const popupContent = document.querySelector('.popup-content');

    const input = document.getElementById('SelectedprofilePicture');
    const previewImage = document.getElementById('previewImage');
    const imageCrop = document.getElementById('image-crop'); 

    const profilePicture = document.getElementById('profilePicture');

    const form = document.querySelector('form');

    profilePic.addEventListener('click',  () => {
    popupBox.classList.remove('hidden');
    });

    popupBox.addEventListener('click', (event) => {
    if (!popupContent.contains(event.target)) {
        popupBox.classList.add('hidden');
        imageCrop.style.display = 'none';
        input.value = '';
        profilePictureError.style.display = "none";
    }
    });

    input.addEventListener('change',  (e) =>{
    if(isValidProfilePicture(e.target)){
        imageCrop.style.display = 'block';

        const file = e.target.files[0];
        const url = URL.createObjectURL(file);
        previewImage.src = url;
    
        if (cropper) {
        cropper.destroy();
        }
    
        previewImage.onload = () => {
        cropper = new Cropper(previewImage, {
            aspectRatio: 1,
            viewMode: 1,
            minCropBoxWidth: 100,
            minCropBoxHeight: 100,
            responsive: true,
            autoCropArea: 1,
        });
        };
    }else{
        imageCrop.style.display = 'none';
    }

    });

    document.getElementById('cropBtn').addEventListener('click', (e) => {
        e.preventDefault();

        popupBox.classList.add('hidden');
        imageCrop.style.display = 'none';

        input.value = '';
        profilePictureError.style.display = "none";

        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400
        });

        // Convert to base64 and assign to hidden input
        profilePicture.value = canvas.toDataURL('image/jpg');

        setTimeout(() => form.submit(), 100);

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

</body>
</html>



