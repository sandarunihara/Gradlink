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

function navigateToShowCompany(companyId){
    window.location.href = "/Gradlink/public/PDC_admin/ViewCompany/show/" + companyId;
}

function navigateToAdvertisementView(advertisementId){
    //console.log("navigate to,",advertisementId);
    window.location.href = "/Gradlink/public/PDC_admin/viewAdvertisement/show/" + advertisementId;
};

function unblockCompany(companyId){
    const userConfirmed = confirm("Are you sure you want to unblock this company?");
    if (userConfirmed) {
        window.location.href = "/Gradlink/public/PDC_admin/BlockCompany/unblock/" + companyId;
    }
}


function blockCompany(companyId) {
    document.getElementById('block-reason').dataset.companyId = companyId;

    document.getElementById('block-modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('block-modal').style.display = 'none';
}

function submitBlockReason(companyId) {
    const reason = document.getElementById('block-reason').value;

    if (!reason.trim()) {
        alert("Please provide a reason for blocking the company.");
        return;
    }

    const userConfirmed = confirm("Are you sure you want to block this company?");
    if (userConfirmed) {
        const encodedReason = encodeURIComponent(reason);
        window.location.href = `/Gradlink/public/PDC_admin/ViewCompany/block/${companyId}?reason=${encodedReason}`;
    }
}


function navigateToAddStudent(){
    window.location.href = "/Gradlink/public/PDC_admin/AddStudent/showAddForm";
}

function navigateToAddCompany(){
    window.location.href = "/Gradlink/public/PDC_admin/AddCompany/dashboard";
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

        editButton.addEventListener("click", () => {
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

        
        saveButton.addEventListener("click", () => {
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
    const regId = document.getElementById("student-id");

    if (studentForm) {
        studentEditButton.addEventListener("click", () => {
            studentInputs.forEach(input => {
                if (input !== regId) {
                    input.removeAttribute("readonly");
                }
            });
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


function searchCompany() {
    const query = document.getElementById('search-query').value.toLowerCase();
    const tableBody = document.getElementById('company-table-body');
    const rows = tableBody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let match = false;

        for (let j = 0; j < cells.length; j++) {
            if (cells[j].innerText.toLowerCase().includes(query)) {
                match = true;
                break;
            }
        }

        if (match) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

function blockStudent(studentId){
    if(confirm("Are you sure you want to block this student?")){
        window.location.href = "/Gradlink/public/PDC_admin/ViewStudent/block/" + studentId;
    }
}

function unblockStudent(studentId){
    if(confirm("Are you sure you want to unblock this student?")){
        window.location.href = "/Gradlink/public/PDC_admin/ViewStudent/unblock/" + studentId;
    }
}

function navigateToDeactivateAdd(advertisementId){
    window.location.href = '/Gradlink/public/PDC_admin/ViewAdvertisement/deactivate/' + advertisementId;
}

function navigateToActivateAdd(advertisementId){
    window.location.href = '/Gradlink/public/PDC_admin/ViewAdvertisement/activate/' + advertisementId;
}

function navigateToRejectAdd(advertisementId){
    window.location.href = '/Gradlink/public/PDC_admin/ViewAdvertisement/reject/' + advertisementId;
}

function openModal(adid, action, email) {
    let modal = document.getElementById("actionModal");
    let reasonContainer = document.getElementById("reasonContainer");
    let confirmationMessage = document.getElementById("confirmationMessage");

    document.getElementById("hiddenAdId").value = adid;
    document.getElementById("hiddenAction").value = action;
    document.getElementById("hiddenEmail").value = email;

    if (action === "activate") {
        confirmationMessage.innerHTML = "<p>Are you sure you want to activate this advertisement?</p>";
        reasonContainer.style.display = "none";
    } else {
        confirmationMessage.innerHTML = "";
        reasonContainer.style.display = "block";
    }

    modal.style.display = "block";
}

function closeModal() {
    document.getElementById("actionModal").style.display = "none";
}


function navigateToViewApplication(studentId, advertisementId){
    //console.log("navigate to,",studentId, advertisementId);
    window.location.href = "/Gradlink/public/PDC_admin/AdminApplicationOverview/show/" + studentId + "/" + advertisementId;
}


function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    
    // Hide all tab contents
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    
    // Remove "active" class from all tab buttons
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    
    // Show the selected tab and add "active" class
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("active");
}

// Automatically open "Student Details" tab on page load
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("StudentDetails").style.display = "block";
    document.querySelector(".tab-btn").classList.add("active");
});


function updateDateTime() {
    const now = new Date();

    const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = now.toLocaleDateString('en-US', dateOptions);

    const formattedTime = now.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit', 
        hour12: true 
    });

    document.getElementById('date-time').textContent = `${formattedDate} | ${formattedTime}`;
}

setInterval(updateDateTime, 1000);


updateDateTime();
