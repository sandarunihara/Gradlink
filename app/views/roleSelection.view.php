<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Selection</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/roleSelection.css">
</head>
<body>

    <div class="container">
        <h2>Please select your role</h2>
        
        <div class="roles">
            <div class="role" id="student" onclick="selectRole('student')">
                <img src="<?=ROOT?>/assets/img/studentG.png" alt="">
                <p>Student</p>
            </div>
            <div class="role" id="company" onclick="selectRole('company')">
                <img src="<?=ROOT?>/assets/img/companyG.png" alt="">
                <p>Company</p>
            </div>
            <div class="role" id="assistant" onclick="selectRole('assistant')">
                <img src="<?=ROOT?>/assets/img/assistantG.png" alt="">
                <p>PDC Assistant</p>
            </div>
            <div class="role" id="coordinator" onclick="selectRole('coordinator')">
                <img src="<?=ROOT?>/assets/img/coordinatorG.png" alt="">
                <p>PDC Coordinator</p>
            </div>
        </div>
        <button id="continue-btn" disabled onclick="continueToPage()">Continue</button>
    </div>
</body>
</html>
<script>
    let selectedRole = "";

    function selectRole(role){
        const continueBtn = document.getElementById('continue-btn');
        continueBtn.disabled = false;

        document.querySelectorAll('.role').forEach(roleElement => {
            roleElement.classList.remove('active');
            let img = roleElement.querySelector('img');
            if (img) {
                img.src = img.src.replace('B', 'G');
            }
            
        });
        selectedRole = role;
        const selectedRoleElement = document.getElementById(role);
        selectedRoleElement.classList.add('active');

        let img = selectedRoleElement.querySelector('img');
        if (img) {
            img.src = `<?=ROOT?>/assets/img/${role}B.png`;
        }
    }
    function continueToPage(){
        if (!selectedRole) return;
        let url = "<?=ROOT?>/signup/" + selectedRole;
        window.location.href = url;
    }
</script>
