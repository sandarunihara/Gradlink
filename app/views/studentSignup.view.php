<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student signup</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSignup.css"> 

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
                            <label>First Name</label>
                            <input 
                                type="text" 
                                id="fname" 
                                name="fname" 
                                placeholder="Enter your first name" 
                                required
                            >
                        </div>
                        <div class="input-field">
                            <label>Last Name</label>
                            <input 
                                type="text" 
                                id="lname" 
                                name="lname" 
                                placeholder="Enter your last name" 
                                required
                            >
                        </div>
                        <div class="input-field">
                            <label>Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="Enter your email" 
                                required
                                oninput="validMail(this)"
                            >
                            <span id="emailError" class="error"></span>
                        </div>
                        <div class="input-field">
                            <label>NIC</label>
                            <input 
                                type="text" 
                                id="NIC" 
                                name="NIC" 
                                placeholder="Enter your NIC" 
                                required
                            >
                        </div>
                        <div class="input-field">
                            <label>Contact Number</label>
                            <input 
                                type="tel" 
                                id="contactNumber" 
                                name="contactNumber" 
                                placeholder="Enter your contact number (e.g. 0712345678)"
                                required
                                oninput="validContactNumber(this)"
                            >
                            <span id="contactNumberError" class="error"></span>
                        </div>
                        <div class="input-field">
                            <label>Student ID</label>
                            <input 
                                type="text" 
                                id="userId" 
                                name="userId" 
                                placeholder="Enter your student ID (e.g. 2021CS123)" 
                                required
                                oninput="validStudentIndex(this)"
                            >
                            <span id="studentIdError" class="error"></span>
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
                                required
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
                            placeholder="Enter a brief description about yourself (50 words)" 
                            cols="50" 
                            rows="5"
                            required
                            oninput="isShortDescriptionValid(this)"
                        ></textarea>
                        <span id="descriptionError" class="error"></span>
                    </div>
                </div>
                <!-- <div class="details documents">
                    <span class="title">Documents</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Profile Picture</label>
                            <input 
                                type="file" 
                                id="profilePicture" 
                                name="profilePicture" 
                                required
                                onchange="isValidProfilePicture(this)"
                            >
                            <span id="profilePictureError" class="error"></span>
                        </div>
                        <div class="input-field">
                            <label>CV</label>
                            <input 
                                type="file" 
                                id="cv" 
                                name="cv"
                                required
                                onchange="isValidCV(this)"
                            >
                            <span id="cvError" class="error"></span>
                        </div>
                    </div>
                </div> -->
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
    </div>
    <script src="<?=ROOT?>/assets/js/Student/signup.js"></script>
</body>
</html>