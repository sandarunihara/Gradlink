<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/profileEdit.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Profile Edit"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <!-- Student Profile Update Box -->
    <div class="container">
        <form id="updateForm" action= "<?=ROOT?>/Student/StudentProfile/profileEdit" method="post" enctype="multipart/form-data">
            <div class="box">
                <!-- GitHub URL Input -->
                <label for="github">GitHub</label>
                <input 
                    type="url" 
                    id="github" 
                    name="Github" 
                    placeholder="Enter GitHub Profile URL" 
                    value="<?= htmlspecialchars($data['Student'] -> Github) ?>"
                    required
                    oninput="validateGithub(this)"
                >
                <span id="githubError" class="error"></span>
            </div>
            <div class="box">
                <!-- LinkedIn URL Input -->
                <label for="linkedin">LinkedIn</label>
                <input 
                    type="url" 
                    id="linkedin" 
                    name="Linkedin" 
                    placeholder="Enter LinkedIn Profile URL" 
                    value="<?= htmlspecialchars($data['Student'] -> Linkedin) ?>"
                    required
                    oninput="validateLinkedin(this)"
                >
                <span id="linkedinError" class="error"></span>
            </div>
            <div class="box">
                <!--Contact Number Input -->
                <label for="contact">Contact Number</label>
                <input 
                    type="tel" 
                    id="contact" 
                    name="Contact" 
                    placeholder="Enter your contact number (e.g. 071-234-5678)"
                    value="<?= htmlspecialchars($data['Student'] -> ContactNum) ?>"
                    required
                    oninput="validateContact(this)"
                >
                <span id="contactError" class="error"></span>
            </div>
            <div class="box">
                <label for="skill">Skills</label>
                <!-- Skills Input -->
                <input 
                    type="text"
                    id="skill"
                    name="Skill"
                    placeholder="Enter skill (e.g. Java, Python, etc.)"
                    value = "<?php 
                                if (!empty($data['Skills'])) {
                                    echo htmlspecialchars(implode(',', array_map(fn($skill) => $skill->Skill, $data['Skills'])));
                                }
                            ?>"
                >
            </div>

            <div class="box">
                <!-- Short Description Textarea -->
                <label for="description">Short Description</label>
                <textarea 
                    id="description" 
                    name="ShortDesc" 
                    placeholder="Enter a brief description about yourself (50 words)" 
                    cols="50" 
                    rows="5"
                    required
                    oninput="validateShortDescription(this)"
                ><?= htmlspecialchars($data['Student'] -> ShortDesc) ?></textarea>
                <span id="descriptionError" class="error"></span>
            </div>
            <div class=box>
                <!-- profile photo -->
                <label for="profilePic">Profile Picture</label>
                <input type="file"
                    id="profilePhoto" 
                    name="ProfilePhoto" 
                    accept="image/*"
                    onchange="previewImage(event)"
                    required
                >
            </div>
            <div class=box>
                <!-- CV Upload -->
                <label for="cv">CV</label>
                <input 
                    type="file" 
                    id="cv" 
                    name="CV" 
                    accept=".pdf, .doc, .docx"
                    required
                >
            </div>
            <div class="button-container">
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    disabled
                    name="submit" 
                >                     
                    Save

                </button>
            </div>
        </form>
    </div>
    <script src="<?=ROOT?>/assets/js/Student/updateProfile.js"></script>
</body>
</html>

