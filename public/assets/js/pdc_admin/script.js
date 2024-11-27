function navigateToViewCompany() {
    window.location.href = "/Gradlink/public/PDC_admin/ViewCompany/dashboard";
}

function navigateToViewStudent() {
    window.location.href = "/Gradlink/public/PDC_admin/ViewStudent/show";
}

function navigateToCompanyOverview() {
    window.location.href = "/Gradlink/public/PDC_admin/AdminCompanyOverview/dashboard";
}

function navigateToStudentOverview() {
    window.location.href = "/Gradlink/public/PDC_admin/AdminStudentOverview/dashboard";
}

function navigateToBlockList() {
    window.location.href = "/Gradlink/public/PDC_admin/BlockCompany/dashboard";
}

function navigateToCompanyList() {
    window.location.href = "/Gradlink/public/PDC_admin/DashboardCompany/dashboard";
}

function navigateToStudentList() {
    window.location.href = "/Gradlink/public/PDC_admin/DashboardStudent/dashboard";
}

function navigateToAddSession() {
    window.location.href = "/Gradlink/public/PDC_admin/AddSession/showAddForm";
}

function navigateToViewSession() {
    window.location.href = "/Gradlink/public/PDC_admin/AdminSessionOverview/dashboard";
}


function navigateToShowSession(sessionId) {
    console.log("Navigating to Session Profile with ID:", sessionId);
    window.location.href = "/Gradlink/public/PDC_admin/ViewSession/show/" + sessionId;
}

function navigateToDelete(sessionId) {
    const userConfirmed = confirm("Are you sure you want to delete this session?");
    if (userConfirmed) {
        window.location.href = "/Gradlink/public/PDC_admin/ViewSession/remove/" + sessionId;
    }
}

function navigateToStudentView(){
    window.location.href = "/Gradlink/public/PDC_admin/AdminStudentOverview/dashboard";
}

function navigateToShowStudent(studentId){
    console.log("navigate to,",studentId);
    window.location.href = "/Gradlink/public/PDC_admin/ViewStudent/show/" + studentId;
}

function navigateToAddStudent(){
    window.location.href = "/Gradlink/public/PDC_admin/AddStudent/showAddForm";
}


// function navigateToUpdate(session_id){
//     window.location.href = "/Gradlink/public/PDC_admin/ViewSession/update/" + session_id;
// }

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM content loaded event fired");
    const editButton = document.getElementById("edit-btn");
    console.log("Edit button:", editButton);
});




document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.getElementById("edit-btn");
    const saveButton = document.getElementById("save-btn");
    const deleteButton = document.getElementById("delete-btn");
    const backButton = document.getElementById("back-btn");    
    const form = document.getElementById("session-form");

    if (form) {
        const inputs = form.querySelectorAll("input");
        const selectors = form.querySelectorAll("select");

        editButton?.addEventListener("click", () => {
            console.log("DOM fully loaded");
            inputs.forEach(input => {
                input.removeAttribute("readonly");
                input.classList.add("editable");
            });

            selectors.forEach(input => {
                input.disabled = false;
                input.classList.add("editable");
            });

            saveButton.style.display = "inline-block";
            deleteButton.style.display = "none";
            backButton.style.display = "inline-block";
            editButton.style.display = "none";
        });

        
        saveButton?.addEventListener("click", () => {
            inputs.forEach(input => input.removeAttribute("readonly"));
            selectors.forEach(select => select.removeAttribute("disabled"));
            navigateToUpdate();
        });


        saveButton.style.display = "none";
        deleteButton.style.display = "inline-block";
        backButton.style.display = "inline-block";

    };
});

document.addEventListener("DOMContentLoaded", () => {
    const studentEditButton = document.getElementById("edit-btn-student");
    const studentSaveButton = document.getElementById("save-btn-student");
    const studentForm = document.getElementById("student-form");
    const studentInputs = studentForm.querySelectorAll("input");
    const studentSelectors = studentForm.querySelectorAll("select");

    if (studentForm) {
        studentEditButton.addEventListener("click", () => {
            studentInputs.forEach(input => input.removeAttribute("readonly"));
            studentSelectors.forEach(select => select.disabled = false);
            studentSaveButton.style.display = "inline-block";
            studentEditButton.style.display = "none";
        });

        studentSaveButton.addEventListener("click", () => {
            if (confirm("Are you sure you want to save the changes?")) {
                studentForm.submit();
            }
        });
    }
});

function navigateToUpdate(){
    const userConfirmed = confirm("Are you sure you want to update this session?");
    if (userConfirmed) {
        document.getElementById("session-form").submit();
    }
}


document.addEventListener("DOMContentLoaded", () => {
    const dateInput = document.getElementById('session-date');
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const dd = String(today.getDate()).padStart(2, '0');

    const minDate = `${yyyy}-${mm}-${dd}`;
    dateInput.setAttribute('min', minDate);
});


function navigateToDeleteStudent(studentId){
    const userConfirmed = confirm("Are you sure you want to delete this student?");
    if (userConfirmed) {
        window.location.href = "/Gradlink/public/PDC_admin/ViewStudent/remove/" + studentId;
    }
}