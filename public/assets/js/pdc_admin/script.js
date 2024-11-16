function navigateToViewCompany() {
    window.location.href = "/Gradlink/public/PDC_admin/ViewCompany/dashboard";
}

function naviagteToViewStudent() {
    window.location.href = "/Gradlink/public/PDC_admin/ViewStudent/dashboard";
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

// function navigateToUpdate(session_id){
//     window.location.href = "/Gradlink/public/PDC_admin/ViewSession/update/" + session_id;
// }


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

function navigateToUpdate(){
    const userConfirmed = confirm("Are you sure you want to update this session?");
    if (userConfirmed) {
        document.getElementById("session-form").submit();
    }
}