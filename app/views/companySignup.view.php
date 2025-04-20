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
      <p>Do you want to Recruit this Student?</p>
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

  <script src="<?php echo ROOT ?>/assets/js/company/signup_page.js"></script>
  
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