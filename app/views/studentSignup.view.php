<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student signup</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSignup.css"> 
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">


</head>
<body>
    <div class="container">
        <form id="regForm" action="<?=ROOT?>/signup/createpassword" method="post" enctype="multipart/form-data">
            <div class="header">
                Student Signup
            </div>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">
                <div class="user-details">
                    <span class="title">
                        Personal Details
                    </span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Student ID</label>
                            <input 
                                type="text" 
                                id="studentId" 
                                name="studentId" 
                                placeholder="Enter your student ID (e.g. 2021cs111)" 
                                oninput="validStudentIndex(this)"
                                required
                            >
                            <span id="studentIdError" class="error"></span>
                        </div>
                        <div class="input-field">
                            <label>Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                readonly
                            >
                        </div>
                        <div class="input-field">
                            <label>Contact Number</label>
                            <input 
                                type="tel" 
                                id="contactNumber" 
                                name="contactNumber" 
                                readonly
                            >
                        </div>
                        <div class="input-field">
                            <label>NIC</label>
                            <input 
                                type="text" 
                                id="NIC" 
                                name="nic" 
                                readonly
                            >
                        </div>
                        <div class="input-field">
                            <label>Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                readonly
                            >
                        </div>
                    </div>
                </div>
                <div class="details links">
                    <span class="title">Professional Links</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>GitHub</label>
                            <input 
                                type="url" 
                                id="github" 
                                name="github" 
                                placeholder="Enter GitHub URL"
                            >
                        </div>
                        <div class="input-field">
                            <label>LinkedIn</label>
                            <input 
                                type="url" 
                                id="linkedin" 
                                name="linkedin" 
                                placeholder="Enter LinkedIn URL"
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab">
                <div class="details skills">
                    <span class="title">Skills</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Skills</label>
                            <input 
                                type="text" 
                                id="skill" 
                                name="skill" 
                                placeholder="Enter your skills (e.g. Java, Python, etc.)"
                            >
                        </div>
                    </div>
                </div>
                <div class="details description">
                    <span class="title">Description</span>
                    <div class="input-field">
                        <label>Short Description</label>
                        <textarea
                            id="description" 
                            name="shortDesc" 
                            placeholder="Enter a brief description about yourself" 
                            cols="50" 
                            rows="5"
                            oninput="isShortDescriptionValid(this)"
                        ></textarea>
                        <span id="descriptionError" class="error"></span>
                    </div>
                </div>
                <div class="details documents">
                    <span class="title">Documents</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Profile Picture</label>
                            <input 
                                type="file" 
                                id="SelectedprofilePicture" 
                                name="SelectedprofilePicture" 
                                oninput="openCropper(this)"
                            >
                            <span id="profilePictureError" class="error"></span>
                            <input type="hidden" name="profilePicture" id="profilePicture">
                        </div>
                    </div>
                </div>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div class="circles">
                <span class="step"></span>
                <span class="step"></span>
            </div>
        </form>
        <!-- Popup Box -->
        <div id="popupBox" class="popup">
            <div class="popup-content">
                <div id="image-crop" style="display: none;">
                    <div class="crop-container">
                        <img id="previewImage"/>
                    </div>

                    <button type="button" id="cropBtn">Crop</button>
                </div>

            </div>
        </div>
    </div>
    <script>
        const BASE_URL = "<?= ROOT ?>";
    </script>
    <script src="<?=ROOT?>/assets/js/Student/signup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</body>
</html>