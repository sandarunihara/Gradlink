const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const tab = document.getElementsByClassName("tab");
const regForm = document.getElementById("regForm");
const step = document.getElementsByClassName("step");
const cv = document.getElementById("cv");
const emailError = document.getElementById("emailError");
const contactNumberError = document.getElementById("contactNumberError");
const studentIdError = document.getElementById("studentIdError");
const descriptionError = document.getElementById("descriptionError");
const profilePictureError = document.getElementById("profilePictureError");
const cvError = document.getElementById("cvError");
const nicError = document.getElementById("nicError");

var currentTab = 0;

showTab(currentTab);

// This function will display the specified tab of the form
function showTab(n) {
  var x = tab;
  x[n].style.display = "block";

  if (n == 0) {
    prevBtn.style.display = "none";
  } else {
    prevBtn.style.display = "inline";
  }
  if (n == x.length - 1) {
    nextBtn.innerHTML = "Submit";
  } else {
    nextBtn.innerHTML = "Next";
  }

  fixStepIndicator(n);
}

// This function will figure out which tab to display
function nextPrev(n) {
  var x = tab;

  if (n == 1 && !validateForm()) return false;

  x[currentTab].style.display = "none";

  currentTab = currentTab + n;

  if (currentTab >= x.length) {
    regForm.submit();

    return false;
  }

  showTab(currentTab);
}

// This function deals with validation of the form fields
function validateForm() {
  var x,
    y,
    i,
    valid = true;

  let results = [];
  x = tab;
  y = x[currentTab].querySelectorAll("input[required], textarea[required]");

  for (i = 0; i < y.length; i++) {
    if (y[i].name == "email") {
      results.push(validMail(y[i]));
    }
    if (y[i].name == "contactNumber") {
      results.push(validContactNumber(y[i]));
    }
    if (y[i].name == "nic") {
      results.push(validNIC(y[i]));
    }
    if (y[i].name == "studentId") {
      results.push(validStudentIndex(y[i]));
    }
    if (y[i].name == "shortDesc") {
      results.push(isShortDescriptionValid(y[i]));
    }
    if (y[i].name == "profilePicture") {
      results.push(isValidProfilePicture(y[i]));
    }
    if (y[i].name == "cv") {
      results.push(isValidCV(y[i]));
    }
    if (y[i].value == "") {
      y[i].className += " invalid";
      valid = false;
    } else {
      y[i].classList.remove("invalid");
    }
  }

  //console.log(results);
  if (results.includes(false)) {
    valid = false;
  }
  if (valid) {
    step[currentTab].className += " finish";
  }
  return valid;
}

// This function removes the "active" class of all steps
function fixStepIndicator(n) {
  var i,
    x = step;

  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }

  x[n].className += " active";
}

function validMail(input) {
  const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!pattern.test(input.value)) {
    emailError.innerHTML = "Invalid email address";
    emailError.style.display = "block";
    input.classList.add("invalid");
    return false;
  } else {
    emailError.innerHTML = "";
    emailError.style.display = "none";
    input.classList.remove("invalid");
    return true;
  }
}
function validNIC(input) {
  const pattern = /^\d{12}$/;

  if (!pattern.test(input.value)) {
    nicError.innerHTML = "Invalid NIC number";
    nicError.style.display = "block";
    input.classList.add("invalid");
    return false;
  }else{
    nicError.innerHTML = "";
    nicError.style.display = "none";
    input.classList.remove("invalid");
    return true;
  }
}
function validContactNumber(number) {
  const numValue = number.value.trim();
  if (!/^\d{10}$/.test(numValue)) {
    contactNumberError.innerHTML = "Invalid contact number";
    contactNumberError.style.display = "block";
    number.classList.add("invalid");
    return false;
  } else {
    contactNumberError.innerHTML = "";
    contactNumberError.style.display = "none";
    number.classList.remove("invalid");
    return true;
  }
}
function validStudentIndex(index) {
  const pattern = /^\d{4}(cs|is)\d{3}$/;
  if (!pattern.test(index.value)) {
    studentIdError.innerHTML = "Invalid student index number";
    studentIdError.style.display = "block";
    index.classList.add("invalid");
    return false;
  } else {
    studentIdError.innerHTML = "";
    studentIdError.style.display = "none";
    index.classList.remove("invalid");
    return true;
  }
}

function isShortDescriptionValid(description) {
  const words = description.value.trim().split(/\s+/);
  if (words.length > 50) {
    descriptionError.innerHTML = "Description is too long";
    descriptionError.style.display = "block";
    return false;
  } else {
    descriptionError.innerHTML = "";
    descriptionError.style.display = "none";
    return true;
  }
}
function isValidProfilePicture(input) {
  if (input.files.length === 0) {
    profilePictureError.innerHTML = "Please upload a file.";
    profilePictureError.style.display = "block";
    return false;
  }

  const fileName = input.files[0].name.toLowerCase();
  const pattern = /\.(jpg|jpeg|png)$/i;

  if (!pattern.test(fileName)) {
    profilePictureError.innerHTML =
      "Invalid file type. Only JPG, JPEG, or PNG allowed.";
    profilePictureError.style.display = "block";
    input.classList.add("invalid");
    return false;
  } else {
    profilePictureError.innerHTML = "";
    profilePictureError.style.display = "none";
    input.classList.remove("invalid");
    return true;
  }
}
function isValidCV(input) {

  const file = input.files[0];
  const validMimeType = "application/pdf";
  const validExtension = ".pdf";
  let isValid = true;

  // Check MIME type
  if (file.type !== validMimeType) {
    isValid = false;
  }

  // Check file extension
  const fileName = file.name.toLowerCase();
  if (!fileName.endsWith(validExtension)) {
    isValid = false;
  }

  if (!isValid) {
    cvError.innerHTML = "Invalid file type. Only PDF is allowed.";
    cvError.style.display = "block";
    input.classList.add("invalid");
    return false;
  } else {
    cvError.innerHTML = "";
    cvError.style.display = "none";
    input.classList.remove("invalid");
    return true;
  }
}

