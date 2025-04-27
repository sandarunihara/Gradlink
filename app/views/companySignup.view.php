<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Company Signup</title>
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
  <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/companySignup.css">

</head>

<body>
  <div class="container">
    <form id="companyForm" action="" method="POST" enctype="multipart/form-data">
      <div class="header">Company Signup</div>

      <!-- Tab 1 -->
      <div class="tab">
        <span class="title">Company Information</span>
        <div class="fields">
          <div class="input-field">
            <label>Company Name</label>
            <input id="name" type="text" name="company_name" required />
            <span class="error-message" id="nameError"></span>
          </div>
          <div class="input-field">
            <label>Email</label>
            <input id="email" type="email" name="email" required />
            <span class="error-message" id="emailError"></span>
          </div>
          <div class="input-field">
            <label>Contact Person</label>
            <input id="contactPerson" type="text" name="contact_person" required />
            <span class="error-message" id="contactPersonError"></span>
          </div>
          <div class="input-field">
            <label>Contact Number</label>
            <input id="contactNumber" type="tel" name="contact_number" required />
            <span class="error-message" id="contactNumberError"></span>
          </div>
          <div class="input-field-group" style="flex: 1 1 100%;">
            <label>Address</label>
            <div class="fields address-fields">
              <div class="input-field">
                <input id="addressNo" type="text" name="address_no" placeholder="No." required />
                <span class="error-message" id="addressNoError"></span>
              </div>
              <div class="input-field">
                <input id="addressLane" type="text" name="address_lane" placeholder="Lane" required />
                <span class="error-message" id="addressLaneError"></span>
              </div>
              <div class="input-field">
                <input id="addressCity" type="text" name="address_city" placeholder="City" required />
                <span class="error-message" id="addressCityError"></span>
              </div>
              <div class="input-field">
                <select id="addressDistrict" name="address_district" required>
                  <option value="">Select District</option>
                  <option value="Colombo">Colombo</option>
                  <option value="Gampaha">Gampaha</option>
                  <option value="Kalutara">Kalutara</option>
                  <option value="Kandy">Kandy</option>
                  <option value="Galle">Galle</option>
                  <option value="Matara">Matara</option>
                  <option value="Kurunegala">Kurunegala</option>
                  <option value="Anuradhapura">Anuradhapura</option>
                  <option value="Jaffna">Jaffna</option>
                  <!-- Add other districts as needed -->
                </select>
                <span class="error-message" id="addressDistrictError"></span>
              </div>

            </div>
          </div>

          <div class="input-field" style="flex: 1 1 100%;">
            <label>LinkedIn</label>
            <input id="linkedin" type="url" name="linkedin" />
            <span class="error-message" id="linkedinError"></span>
          </div>
          <div class="input-field" style="flex: 1 1 100%;">
            <label>Website</label>
            <input id="website" type="url" name="website" />
            <span class="error-message" id="websiteError"></span>
          </div>
        </div>
      </div>

      <!-- Tab 2 -->
      <div class="tab">
        <span class="title">Company Profile</span>
        <div class="input-field" style="flex: 1 1 100%;">
          <label>Description</label>
          <textarea id="description" name="description" required></textarea>
          <span class="error-message" id="descriptionError"></span>
        </div>
        <div class="fields">
          <div class="input-field">
            <label>Profile Picture</label>
            <input id="profilePicture" type="file" name="profile_pic" required />
            <span class="error-message" id="profilePictureError"></span>
          </div>
          <div class="input-field">
            <label>Cover Picture</label>
            <input id="coverPicture" type="file" name="cover_pic" required />
            <span class="error-message" id="coverPictureError"></span>
          </div>
        </div>
      </div>

      <!-- Tab 3 -->
      <div class="tab">
        <span class="title">Security</span>
        <div class="fields">
          <div class="input-field" style="flex: 1 1 100%;">
            <label for="password">Password</label>
            <div class="password-toggle-wrapper">
              <input id="password" type="password" name="password" required />
              <button type="button" class="toggle-password" onclick="togglePasswordVisibility('password')">Show</button>
            </div>

            <span class="error-message" id="passwordError"></span>
            <div id="passwordRules" class="password-rules">
              Password must be at least 8 characters and include:
              <ul>
                <li id="rule-length">✔ At least 8 characters</li>
                <li id="rule-uppercase">✔ One uppercase letter</li>
                <li id="rule-lowercase">✔ One lowercase letter</li>
                <li id="rule-number">✔ One number</li>
                <li id="rule-special">✔ One special character (!@#$%^&*)</li>
              </ul>
            </div>
          </div>
          <div class="input-field" style="flex: 1 1 100%;">
            <label for="confirmPassword">Confirm Password</label>
            <div class="password-toggle-wrapper">
              <input id="confirmPassword" type="password" name="confirm_password" required />
              <button type="button" class="toggle-password" onclick="togglePasswordVisibility('confirmPassword')">Show</button>
            </div>

            <span class="error-message" id="confirmPasswordError"></span>
          </div>
        </div>
      </div>



      <div class="submit-buttons">
        <button type="button" onclick="nextPrev(-1)" id="prevBtn">Previous</button>
        <button type="button" onclick="nextPrev(1, event)" id="nextBtn">Next</button>
      </div>

      <div class="circles">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
      </div>
    </form>
  </div>

  <div id="Recruit-modal" class="updatemodal">
    <div class="updatemodal-content">
      <h2>Are you sure?</h2>
      <p>Do you want to Register as Company?</p>
      <div class="updatemodal-buttons">
        <button class="updateyes-btn" onclick="confirmAction()">Yes</button>
        <button class="updateno-btn" onclick="closeRecruitConfirmModal()">No</button>
      </div>
    </div>
  </div>

  <div id="loading-overlay" style="display: none;">
    <div class="spinner"></div>
  </div>

  <div id="toast-container" class="toast-container"></div>
  <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>


  <script>
    const existingEmails = <?php echo json_encode(array_map(function ($company) {
                              return $company->Email;
                            }, $alldata)); ?>;
    
    const existingNames = <?php echo json_encode(array_map(function ($company) {
                              return $company->Name;
                            }, $alldata)); ?>;

    let currentTab = 0;

    function validateForm() {
      let isValid = true;

      const fields = [{
          id: "name",
          message: "Company name is required",
          type:"name"
        },
        {
          id: "description",
          message: "Description is required"
        },
        {
          id: "email",
          message: "Valid email is required",
          type: "email"
        },
        {
          id: "contactPerson",
          message: "Contact person is required"
        },
        {
          id: "contactNumber",
          message: "Contact number must be 10 digits starting with 0",
          type: "phone",
        },
        {
          id: "addressNo",
          message: "Address No. is required"
        },
        {
          id: "addressLane",
          message: "Address Lane is required"
        },
        {
          id: "addressCity",
          message: "City is required"
        },
        {
          id: "addressDistrict",
          message: "District is required"
        },
        {
          id: "linkedin",
          message: "Valid linkedin is required",
          type: "linkedin"
        },
        {
          id: "website",
          message: "Valid website is required",
          type: "url"
        },
        {
          id: "profilePicture",
          essage: "Profile picture is required",
          type: "file",
        },
        {
          id: "coverPicture",
          message: "Cover picture is required",
          type: "file"
        },
        {
          id: "password",
          message: "Password is invalid",
          type: "password"
        },
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
          } else if (field.type === "email") {
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
              showError = true;
              field.message = "Enter a valid email";
            } else if (existingEmails.includes(value)) {
              showError = true;
              field.message = "This email is already in use";
            }
          } else if (field.type === "url" && !/^https?:\/\/.+\..+/.test(value)) {
            showError = true;
            field.message = "Enter a valid URL";
          }else if (field.type === "name" && existingNames.includes(value)) {
            showError = true;
            field.message = "This company is already registered";
          }else if (field.type === "linkedin" && !/^https:\/\/(www\.)?linkedin\.com\/(in|pub|company)\/[a-zA-Z0-9_-]+\/?$/.test(value)) {
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

    document.getElementById("password").addEventListener("input", function() {
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
      document.getElementById("loading-overlay").style.display = "flex"; // Show loader
      setTimeout(() => {
        document.getElementById("companyForm").submit();
      }, 300); // slight delay to show animation before form submit
    }
  </script>


  <!-- Toast message from session -->
  <?php if (isset($_SESSION['flash'])): ?>
    <script>
      window.__flashMessage = <?php echo json_encode($_SESSION['flash']); ?>;
    </script>
  <?php
    unset($_SESSION['flash']);
  endif;
  ?>

</body>

</html>