document.addEventListener("DOMContentLoaded", function () {
    const formSections = document.querySelectorAll(".form");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    const submitBtn = document.getElementById("submitBtn");

    let currentStep = 0;

    // Function to show the correct form step
    function showStep(step) {
        formSections.forEach((section, index) => {
            if (index === step) {
                section.classList.add("active");
            } else {
                section.classList.remove("active");
            }
        });

        // Update button visibility
        prevBtn.style.display = step === 0 ? "none" : "inline-block";
        nextBtn.style.display = step === formSections.length - 1 ? "none" : "inline-block";
        submitBtn.style.display = step === formSections.length - 1 ? "inline-block" : "none";
    }

    // Event listeners for navigation buttons
    nextBtn.addEventListener("click", function (e) {
        e.preventDefault();
        if (currentStep < formSections.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener("click", function (e) {
        e.preventDefault();
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    });

    // Initial call to show the first step
    showStep(currentStep);
});
