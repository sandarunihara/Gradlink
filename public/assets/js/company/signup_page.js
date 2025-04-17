let currentTab = 0;
function validateForm() {
  let isValid = true;

  const fields = [
    { id: "name", message: "Company name is required" },
    { id: "description", message: "Description is required" },
    { id: "email", message: "Valid email is required", type: "email" },
    { id: "contactPerson", message: "Contact person is required" },
    {
      id: "contactNumber",
      message: "Contact number must be 10 digits starting with 0",
      type: "phone",
    },
    { id: "addressNo", message: "Address No. is required" },
    { id: "addressLane", message: "Address Lane is required" },
    { id: "addressCity", message: "City is required" },
    { id: "addressDistrict", message: "District is required" },
    { id: "linkedin", message: "Valid linkedin is required", type: "url" },
    { id: "website", message: "Valid website is required", type: "url" },
    {
      id: "profilePicture",
      essage: "Profile picture is required",
      type: "file",
    },
    { id: "coverPicture", message: "Cover picture is required", type: "file" },
    { id: "password", message: "Password is invalid", type: "password" },
    {
      id: "confirmPassword",
      message: "Passwords do not match",
      type: "confirm",
    },
  ];

  const currentTabEl = document.getElementsByClassName("tab")[currentTab];

  fields.forEach((field) => {
    const input = document.getElementById(field.id);
    const errorSpan = document.getElementById(field.id + "Error");
  
    // Only validate if the field is in the current tab
    if (input && currentTabEl.contains(input)) {
      let value = input.value.trim();
      let showError = false;
  
      if (!value && field.type !== "file") {
        showError = true;
      } else if (
        field.type === "email" &&
        !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)
      ) {
        showError = true;
        field.message = "Enter a valid email";
      } else if (field.type === "url" && !/^https?:\/\/.+\..+/.test(value)) {
        showError = true;
        field.message = "Enter a valid URL";
      } else if (field.type === "phone" && !/^0\d{9}$/.test(value)) {
        showError = true;
        field.message = "Contact number must be 10 digits starting with 0";
      } else if (field.type === "file" && input.files.length === 0) {
        showError = true;
      } else if (field.type === "password") {
        const passwordRegex =
          /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
        if (!passwordRegex.test(value)) {
          showError = true;
          field.message = "Password doesn't meet the complexity requirements.";
        }
      } else if (field.type === "confirm") {
        const password = document.getElementById("password").value.trim();
        if (value !== password) {
          showError = true;
          field.message = "Passwords do not match";
        }
      }
  
      if (showError) {
        errorSpan.textContent = field.message;
        errorSpan.style.display = "block";
        input.classList.add("invalid");
        isValid = false;
      } else {
        errorSpan.textContent = "";
        errorSpan.style.display = "none";
        input.classList.remove("invalid");
      }
    }
  });
  

  return isValid;
}
showTab(currentTab);

function showTab(n) {
  let x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  document.getElementById("prevBtn").style.display =
    n === 0 ? "none" : "inline";
  document.getElementById("nextBtn").innerHTML =
    n === x.length - 1 ? "Submit" : "Next";
  fixStepIndicator(n);
}

function nextPrev(n, event = null) {
  let x = document.getElementsByClassName("tab");

  if (n === 1 && !validateForm()) {
    return; // Stop if form is not valid
  }

  // Don't hide the current tab yet if it's the final step and we need confirmation
  if (n === 1 && currentTab === x.length - 1) {
    // Trigger confirmation modal
    openRecruitConfirmModal(event);
    return; // Don't change tab yet
  }

  x[currentTab].style.display = "none";
  currentTab += n;

  if (currentTab >= x.length) {
    // This won't be reached now due to modal, but keeping it safe
    document.getElementById("companyForm").submit();
    return;
  }

  showTab(currentTab);
}

function fixStepIndicator(n) {
  let steps = document.getElementsByClassName("step");
  for (let i = 0; i < steps.length; i++) {
    steps[i].classList.remove("active");
  }
  if (steps[n]) steps[n].classList.add("active");
}

document.getElementById("password").addEventListener("input", function () {
  const password = this.value;
  const rules = {
    length: password.length >= 8,
    uppercase: /[A-Z]/.test(password),
    lowercase: /[a-z]/.test(password),
    number: /[0-9]/.test(password),
    special: /[!@#$%^&*]/.test(password),
  };

  for (let rule in rules) {
    const element = document.getElementById(`rule-${rule}`);
    if (rules[rule]) {
      element.classList.add("valid");
      element.classList.remove("invalid");
    } else {
      element.classList.add("invalid");
      element.classList.remove("valid");
    }
  }
});

function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    const toggleBtn = input.nextElementSibling;
    if (input.type === "password") {
      input.type = "text";
      toggleBtn.textContent = "Hide";
    } else {
      input.type = "password";
      toggleBtn.textContent = "Show";
    }
  }
  

function openRecruitConfirmModal(event) {
  if (event) event.preventDefault();
  document.getElementById("Recruit-modal").style.display = "flex";
}

function closeRecruitConfirmModal() {
  document.getElementById("Recruit-modal").style.display = "none";
}

function confirmAction() {
  // Hide modal first
  closeRecruitConfirmModal();
  // Then submit the form
  document.getElementById("companyForm").submit();
}
