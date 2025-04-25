const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const tab = document.getElementsByClassName("tab");
const regForm = document.getElementById("regForm");
const step = document.getElementsByClassName("step");
const studentIdError = document.getElementById("studentIdError");
const descriptionError = document.getElementById("descriptionError");

const popupBox = document.getElementById('popupBox');
const popupContent = document.querySelector('.popup-content');
const input = document.getElementById('SelectedprofilePicture');

const previewImage = document.getElementById('previewImage');
const imageCrop = document.getElementById('image-crop'); 
const profilePictureError = document.getElementById('profilePictureError');
const profilePicture = document.getElementById('profilePicture');

let cropper;

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

async function validateForm() {
  const x = tab;
  const y = x[currentTab].querySelectorAll("input[name ='SelectedprofilePicture'], textarea[name='shortDesc']");
  let valid = true;
  const results = [];

  for (let i = 0; i < y.length; i++) {
    const input = y[i];
    if (input.name === "studentId") {
      results.push(await validStudentIndex(input));
    } else if (input.name === "shortDesc") {
      results.push(isShortDescriptionValid(input));
    } else if (input.name === "SelectedprofilePicture") {
      results.push(isValidProfilePicture(input));
    } else {
      if (input.value === "") {
        input.classList.add("invalid");
        valid = false;
      } else {
        input.classList.remove("invalid");
      }
    }
  }

  if (results.includes(false)) valid = false;

  if (valid) step[currentTab].className += " finish";

  return valid;
}

async function nextPrev(n) {
  if (n === 1 && !(await validateForm())) return false;

  tab[currentTab].style.display = "none";
  currentTab += n;

  if (currentTab >= tab.length) {
    regForm.submit();
    return false;
  }

  showTab(currentTab);
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

async function validStudentIndex(index) {
  const pattern = /^\d{4}(cs|is)\d{3}$/;
  
  if (!pattern.test(index.value)) {
    studentIdError.innerHTML = "Invalid student index number";
    studentIdError.style.display = "block";
    index.classList.add("invalid");
    return false;
  }

  studentIdError.innerHTML = "";
  studentIdError.style.display = "none";
  index.classList.remove("invalid");

  try {
    const response = await fetch(`${BASE_URL}/signup/fetchStudentDetails`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'studentId=' + encodeURIComponent(index.value),
    });

    const data = await response.json();

    if (data.success) {
      document.getElementById("email").value = data.student.Email;
      document.getElementById("contactNumber").value = data.student.ContactNum;
      document.getElementById("NIC").value = data.student.NIC;
      document.getElementById("name").value = data.student.Name;
      return true;
    } else {
      studentIdError.textContent = data.message;
      studentIdError.style.display = "block";
      index.classList.add("invalid");

      // Clear fields
      document.getElementById("email").value = "";
      document.getElementById("contactNumber").value = "";
      document.getElementById("NIC").value = "";
      document.getElementById("name").value = "";

      return false;
    }
  } catch (error) {
    console.error("Fetch error:", error);
    studentIdError.textContent = "Error fetching student details";
    studentIdError.style.display = "block";
    index.classList.add("invalid");
    return false;
  }
}



function isShortDescriptionValid(description) {
  if (description.value.trim() === "") {
    description.classList.add("invalid");
    descriptionError.innerHTML = "Description is required.";
    descriptionError.style.display = "block";
    return false;
  } else {
    description.classList.remove("invalid");
    descriptionError.innerHTML = "";
    descriptionError.style.display = "none";
    return true;
  }
}
function isValidProfilePicture(input) {
  const MAX_SIZE = 500 * 1024;
  if (!input.files) {
    profilePictureError.innerHTML = "Profile picture is required.";
    profilePictureError.style.display = "block";
    input.classList.add("invalid");
    return false;
  }
  if (input.files.length === 0) {
    profilePictureError.innerHTML = "Please upload a file.";
    profilePictureError.style.display = "block";
    input.classList.add("invalid");
    return false;
  }
  if (input.files[0].size > MAX_SIZE) {
    profilePictureError.innerHTML = "File size must be less than 500KB.";
    profilePictureError.style.display = "block";
    input.classList.add("invalid");
    SelectedprofilePicture.value ='';
    return false;
  }

  const fileName = input.files[0].name.toLowerCase();
  const pattern = /\.(jpg|png)$/i;

  if (!pattern.test(fileName)) {
    profilePictureError.innerHTML = "Invalid file type. Only JPG or PNG allowed.";
    profilePictureError.style.display = "block";
    input.classList.add("invalid");
    SelectedprofilePicture.value = '';
    return false;
  } else {
    profilePictureError.innerHTML = "";
    profilePictureError.style.display = "none";
    input.classList.remove("invalid");
    return true;
  }
}

popupBox.addEventListener('click', (event) => {
  if (!popupContent.contains(event.target)) {
    popupBox.classList.remove("show");
    SelectedprofilePicture.value = '';
  }
});
function openCropper(input){
    if(isValidProfilePicture(input)){
      popupBox.classList.add("show");

      imageCrop.style.display = 'block';
  
      const file = input.files[0];
      const url = URL.createObjectURL(file);
      previewImage.src = url;
    
      if (cropper) {
        cropper.destroy();
      }
    
      previewImage.onload = () => {
        cropper = new Cropper(previewImage, {
          aspectRatio: 1,
          viewMode: 1,
          minCropBoxWidth: 100,
          minCropBoxHeight: 100,
          responsive: true,
          autoCropArea: 1,
        });
      };
    }
  }

document.getElementById('cropBtn').addEventListener('click', () => {
  popupBox.classList.remove("show");
  imageCrop.style.display = 'none';


  if (!cropper) return;

  const canvas = cropper.getCroppedCanvas({
    width: 400,
    height: 400
  });

  // Convert to base64 and assign to hidden input
  profilePicture.value = canvas.toDataURL('image/jpg');
});


