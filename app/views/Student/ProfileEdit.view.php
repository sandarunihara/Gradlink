<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Edit</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/profileEdit.css"> 
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
        <div class="page-header">
            <h1>Profile Edit</h1>
        </div>
        <div class="main-content">
            <!-- Student Profile Update Box -->
            <div class="update-box">
                <div class="update-box-content">
                    <form>
                        <div class="box1">
                            <label for="github">GitHub</label>
                            <input 
                                type="url" 
                                id="github" 
                                name="github" 
                                placeholder="Enter GitHub Profile URL" 
                                value="<?= htmlspecialchars($data['Student'] -> Github) ?>"
                                required
                            >
                            
                            <label for="linkedin">LinkedIn</label>
                            <input 
                                type="url" 
                                id="linkedin" 
                                name="linkedin" 
                                placeholder="Enter LinkedIn Profile URL" 
                                value="<?= htmlspecialchars($data['Student'] -> Linkedin) ?>"
                                required
                            >
                            <label for="skills">Skills</label>
                            <input 
                                type="text" 
                                id="skills" 
                                name="skills" 
                                placeholder="Enter your skills separated by commas" 
                                value="JavaScript, Node.js, Python"
                                required
                            >
                        </div>
                        <div class="box2">
                            <label for="description">Short Description</label>
                            <textarea id="description" name="description" placeholder="Enter a brief description about yourself(max 50 words)" required>
                                <?= htmlspecialchars($data['Student'] -> ShortDesc) ?>
                            </textarea>
                            <label for="cv">Curriculum Vitae</label>
                            <input 
                                type="file" 
                                id="cv" 
                                name="cv" 
                                accept=".pdf"
                                placeholder="Upload your CV"
                                required
                            >
                        </div>
                        <a href="<?=ROOT?>/Student/StudentProfile/profileEdit"><button type="submit" class="save-btn">Save</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

