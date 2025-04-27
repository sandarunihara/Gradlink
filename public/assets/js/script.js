
function navigateToViewCompany(company_id) {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewCompany?id=" + encodeURIComponent(company_id);

}

function navigateToViewAdvertisement(advertisement_id) {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewAdvertisement?id=" + encodeURIComponent(advertisement_id);

}
function navigateToAddCompany() {
    window.location.href = "/Gradlink/public/pdc_coordinator/addCompany";
}

function navigateToViewPendingCompany(company_id) {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewPendingCompany?id=" + encodeURIComponent(company_id);
}

function navigateToBlockList() {
    window.location.href = "/Gradlink/public/pdc_coordinator/blockedCompanies";
}

function navigateToDashboardCompany() {
    // alert("hey");
    window.location.href = "/Gradlink/public/pdc_coordinator/dashboardCompany";
}

function navigateToDashboardStudent() {
    window.location.href = "/Gradlink/public/pdc_coordinator/dashboardStudent";
}

function navigateToStudentProfile(student_id) {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewStudent?id=" + encodeURIComponent(student_id);
}

function naviagteToViewPendingAdvertisement(advertisement_id) {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewPendingAdvertisement?id=" + encodeURIComponent(advertisement_id);

}

function navigateToDasboardAdvertisement() {
    window.location.href = "/Gradlink/public/pdc_coordinator/dashboardAdvertisement/active";
}

function navigateToComplaints() {
    window.location.href = "/Gradlink/public/pdc_coordinator/dashboardComplaints";
}

function clickDeleteBtn(company_id) {
    const userConfirmed = confirm("Are you sure you want to delete this Company?");
    if (userConfirmed) {
        window.location.href = "/Gradlink/public/pdc_coordinator/viewCompany/delete/" + company_id;
    }
}

function clickDeleteBtninPending(company_id){
    const userConfirmed = confirm("Are you sure you want to delete this Pending Company?");
    if (userConfirmed) {
        window.location.href = "/Gradlink/public/pdc_coordinator/viewPendingCompany/delete/" + company_id;
    }
}

function SendAnEmail(company_id){
    window.location.href = "/Gradlink/public/pdc_coordinator/viewPendingCompany/emailSend?id=" + encodeURIComponent(company_id);
}

function enableEditing() {
    // Hide Edit button and show Save button
    document.getElementById('update-btn').style.display = 'none';
    document.getElementById('save-btn').style.display = 'inline-block';

    // Get all input and textarea elements
    const inputs = document.querySelectorAll('input, textarea');

    // Remove readonly attribute from all inputs and textareas
    inputs.forEach(input => {
        input.removeAttribute('readonly');
    });
}


function saveForm() {
    // Hide Save button and show Edit button
    document.getElementById('save-btn').style.display = 'none';
    document.getElementById('update-btn').style.display = 'inline-block';

    // Get all input and textarea elements
    const inputs = document.querySelectorAll('input, textarea');

    // Add readonly attribute back to all inputs and textareas
    inputs.forEach(input => {
        input.setAttribute('readonly', true);
    });
}
//Advertisement Dashboard Pending ad status


document.getElementById("status").addEventListener("change", function () {
    var statusDropdown = this;
    var selectedValue = statusDropdown.value;

    // Remove all status classes first
    statusDropdown.classList.remove("pending", "approved", "rejected");

    // Add the corresponding class
    if (selectedValue === "pending") {
        statusDropdown.classList.add("pending");
    } else if (selectedValue === "approved") {
        statusDropdown.classList.add("approved");
    } else if (selectedValue === "rejected") {
        statusDropdown.classList.add("rejected");
    }
});




// Trigger the change event on page load to apply the correct initial color
document.getElementById("status").dispatchEvent(new Event("change"));


