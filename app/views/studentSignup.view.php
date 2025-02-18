<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student signup</title>
</head>
<body>
    <form id="signupForm" action= "<?=ROOT?>/signup/student" method="post" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="NIC">NIC</label>
        <input type="text" id="NIC" name="NIC" required>

        <label for="contactNumber">Contact Number</label>
        <input type="text" id="contactNumber" name="contactNumber" required>

        <label for="studentId">Student Id</label>
        <input type="text" id="StudentId" name="StudentId" required>

        <label for="degreeName">Degree Name</label>
        <input type="text" id="degreeName" name="degreeName" required>

        <label for="profilePicture">Profile Picture</label>
        <input type="file" id="profilePicture" name="profilePicture" required>

        <label for="cv">CV</label>
        <input type="file" id="cv" name="cv">

        <label for="github">GitHub</label>
        <input type="url" id="github" name="github">

        <label for="linkedin">LinkedIn</label>
        <input type="url" id="linkedin" name="linkedin">

        <!-- <label for="certificates">Certificates</label>
        <input type="text" id="certificateName" name="certificateName">
        <input type="text" id="certificateOrganization" name="certificateOrganization">
        <input type="text" id="credentialUrl" name="credentialUrl"> -->

        <label for="skill">Skills</label>
        <input type="text" id="skill" name="skill">

        <label for="description">Short Description</label>
        <input type="text" id="description" name="description">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>
        
        <button type="submit">Sign up</button>
    </form>
</body>
</html>