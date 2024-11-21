
function navigateToViewCompany(company_id) {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewCompany?id=" +encodeURIComponent(company_id);

}

function navigateToAddCompany() {
    window.location.href = "/Gradlink/public/pdc_coordinator/addCompany";
}

function navigateToViewPendingCompany(company_id) {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewPendingCompany?id=" +encodeURIComponent(company_id);
}

function navigateToBlockList() {
    window.location.href = "/Gradlink/public/pdc_coordinator/blockedCompanies";
}

function navigateToDashboardCompany() {
    // alert("hey");
    window.location.href = "/Gradlink/public/pdc_coordinator/dashboardCompany";
}

function naviagteToViewPendingAdvertisement() {
    window.location.href = "/Gradlink/public/pdc_coordinator/viewPendingAdvertisement";

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


document.getElementById("status").addEventListener("change", function() {
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


