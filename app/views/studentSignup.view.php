<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student signup</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSignup.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 

</head>
<body>
    <div class="container">
        <header>Student Signup</header>
        <form id="signupForm" action="<?=ROOT?>/signup/student" method="post" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Personal Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                placeholder="Enter your name" 
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
                            >
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
                                placeholder="Enter your contact number (e.g. 071-234-5678)"
                                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" 
                                required
                            >
                        </div>
                        <div class="input-field">
                            <label>Student ID</label>
                            <input 
                                type="text" 
                                id="StudentId" 
                                name="StudentId" 
                                placeholder="Enter your student ID (e.g. 2021CS123)" 
                                required
                            >
                        </div>
                        <div class="input-field">
                            <label>Degree Name</label>
                            <select name="degreeName" id="degreeName" required>
                                <option value="" disabled selected hidden>Degree Name</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Information Systems">Information Systems</option>
                            </select>
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
            <div class="form second">
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
                            name="ShortDesc" 
                            placeholder="Enter a brief description about yourself (50 words)" 
                            cols="50" 
                            rows="5"
                            required
                        ></textarea>
                    </div>
                </div>
                <div class="details certificates">
                    <span class="title">Certificates</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Certificates</label>
                            <input 
                                type="text" 
                                id="certificate" 
                                name="certificate" 
                                placeholder="Enter your certificates (e.g. CCNA, etc.)"
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form third">
                <div class="details documents">
                    <span class="title">Documents</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Profile Picture</label>
                            <input 
                                type="file" 
                                id="profilePicture" 
                                name="profilePicture" 
                                required
                            >
                        </div>
                        <div class="input-field">
                            <label>CV</label>
                            <input 
                                type="file" 
                                id="cv" 
                                name="cv"
                            >
                        </div>
                    </div>
                </div>
                <div class="details security">
                    <span class="title">Security</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Enter password" 
                                required
                            >
                        </div>
                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input 
                                type="password"
                                id="confirmPassword" 
                                name="confirmPassword" 
                                placeholder="Confirm password" 
                                required
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button id="prevBtn">
                    <span class="btnText">Previous</span>
                </button>
                <button id="nextBtn">
                    <span class="btnText">Next</span>
                </button>
                <button type="submit" id="submitBtn">
                    <span class="btnText">Sign up</span>
                </button>
            </div>
        </form>
    </div>
    <script src="<?=ROOT?>/assets/js/Student/signup.js"></script>
</body>
</html>