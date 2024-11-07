function navigateToViewCompany() {
    window.location.href = "/Gradlink/public/viewCompany";
}

function navigateToAddCompany() {
    window.location.href = "/Gradlink/public/addCompany";
}

function naviagteToViewPendingCompany() {
    window.location.href = "/Gradlink/public/viewPendingCompany";
}

function navigateToBlockList() {
    window.location.href = "/Gradlink/public/blockedCompanies";
}

function naviagteToDashboardCompany() {
    alert("hey");
    window.location.href = "/Gradlink/public/dashboardCompany";
}

function naviagteToViewPendingAdvertisement() {
    window.location.href = "/Gradlink/public/viewPendingAdvertisement";

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
