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
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/backIcon.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Profile Edit"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <a href="<?=ROOT?>/Student/StudentProfile/profile" class="backreq">
            <svg class="back-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
            <h3>Back</h3>
        </a>
        <!-- Student Profile Update Box -->
        <div class="update-box">
            <form id="updateForm" action= "<?=ROOT?>/Student/StudentProfile/profileEdit" method="post" enctype="multipart/form-data">
                <div class="box1">
                    <!-- GitHub URL Input -->
                    <label for="github">GitHub</label>
                    <input 
                        type="url" 
                        id="github" 
                        name="Github" 
                        placeholder="Enter GitHub Profile URL" 
                        value="<?= htmlspecialchars($data['Student'] -> Github) ?>"
                        required
                        oninput="validateForm()"
                    >
                    
                    <!-- LinkedIn URL Input -->
                    <label for="linkedin">LinkedIn</label>
                    <input 
                        type="url" 
                        id="linkedin" 
                        name="Linkedin" 
                        placeholder="Enter LinkedIn Profile URL" 
                        value="<?= htmlspecialchars($data['Student'] -> Linkedin) ?>"
                        required
                        oninput="validateForm()"
                    >
                </div>
                <div class="box2">
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

                <div class="box3">
                    <!-- Short Description Textarea -->
                    <label for="description">Short Description</label>
                    <textarea 
                        id="description" 
                        name="ShortDesc" 
                        placeholder="Enter a brief description about yourself (50 words)" 
                        cols="50" 
                        rows="5"
                        required
                        oninput="validateForm()"
                    ><?= htmlspecialchars($data['Student'] -> ShortDesc) ?></textarea>
                </div>

                <!-- Error Message -->
                <span class="error-message" id="formError"></span>

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
    </div>
    <script src="<?=ROOT?>/assets/js/Student/updateProfile.js"></script>
</body>
</html>

