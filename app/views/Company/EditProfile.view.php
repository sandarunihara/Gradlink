<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/editpro.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Profile</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <form method="post" id="pro-form" class=" pro_main" enctype="multipart/form-data">
                    <div class="backbuttoncom">
                        <a href="<?php echo ROOT ?>/company/Profile/dashboard/company/Profile/dashboard" class="backreq">
                            <i class="fas fa-chevron-left"></i>
                            <h3>back</h3>
                        </a>
                    </div>
                    <!-- Cover photo -->
                    <div class="coverphoto">
                        <label for="coverphoto">
                            <img
                                src="<?php echo !empty($data->coverimg) ? ROOT . '/assets/img/Company/' . $data->coverimg : ROOT . '/assets/img/Company/coverpic.jpg'; ?>"
                                id="coverPreview"
                                alt="Cover Preview" />
                        </label>
                        <input type="file" name="coverphoto" id="coverphoto" accept="image/*" required style="display: none;" onchange="previewImage(event, 'coverPreview')">
                    </div>


                    <!-- Profile photo -->
                    <div class="prophoto">
                        <label for="profilephoto">
                            <img
                                src="<?php echo !empty($data->profileimg) ? ROOT . '/assets/img/Company/' . $data->profileimg : ROOT . '/assets/img/Company/companypro.png'; ?>"
                                class="pro_logo"
                                id="profilePreview"
                                width="200"
                                height="200"
                                alt="Profile Preview" />
                        </label>
                        <input type="file" name="profilephoto" id="profilephoto" accept="image/*" required style="display: none;" onchange="previewImage(event, 'profilePreview')">
                    </div>

                    <div class="pro_head">
                        <input class="name" name="Name" value="<?php echo $data->Name ?>"></br>
                        <input name="ShortDesc" required class="ShortDesc" value="<?php echo $data->ShortDesc ?>">
                    </div>
                    <div class="formdata">
                        <div class="firstset">
                            <div class="formrow">
                                <p class="label">Contact Email</p>
                                <input name="Email" required class="email" value="<?php echo $data->Email ?>">
                            </div>
                            <div class="formrow">
                                <p class="label">Contact Person</p>
                                <input name="ContactPerson" required value="<?php echo $data->ContactPerson ?>">
                            </div>
                        </div>
                        <div class="firstset">
                            <div class="formrow">
                                <p class="label">Contact Number</p>
                                <input name="ContactNum" required value="<?php echo $data->ContactNum ?>">
                            </div>
                            <div class="formrow links">
                                <div class="linkedin">
                                    <i class="fab fa-linkedin"></i>
                                    <input name="Linkedin" required value="<?php echo $data->Linkedin ?>">
                                </div>
                                <div class="Website">
                                    <i class="fas fa-globe"></i>
                                    <input name="Website" required value="<?php echo $data->Website ?>">
                                </div>
                            </div>
                        </div>
                        <div class="Address">
                            <div>
                                <label>No/Name</label>
                                <input name="No" required value="<?php echo $data->No ?>">
                            </div>
                            <div>
                                <label>Lane</label>
                                <input name="Lane" required value="<?php echo $data->Lane ?>">
                            </div>
                            <div>
                                <label>City</label>
                                <input name="City" required value="<?php echo $data->City ?>">
                            </div>
                            <div>
                                <label>Province</label>
                                <input name="District" required value="<?php echo $data->District ?>">
                            </div>
                        </div>
                        <!-- <input type="file" id="image" name="image" required style="display: block; width: 100%; height: auto;"/> -->
                        <div class="button">
                            <button type="button" onclick="openconfirmeModal()">Save</button>
                            <button class="discard" onclick="goback()">Discard</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- confire modal -->
    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Update the Profile?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="submitForm()">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmModal()">No</button>
            </div>
        </div>
    </div>


    <div id="loading-overlay" style="display: none;">
        <div class="spinner"></div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>



    <script>
        const existingEmails = <?php echo json_encode(array_values(array_map(function ($company) {
                                    return $company->Email;
                                }, $all_company_data))); ?>;
        
        const existingNames = <?php echo json_encode(array_values(array_map(function ($company) {
                                    return $company->Name;
                                }, $all_company_data))); ?>;
                                console.log(existingNames);
                                
        function isValidEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        function isValidPhone(contactNum) {
            const pattern = /^0(7[01245678]\d{7}|[1-9]{2}\d{7})$/;
            return pattern.test(contactNum);
        }

        function isValidLinkedInURL(url) {
            const pattern = /^https:\/\/(www\.)?linkedin\.com\/(in|pub|company)\/[a-zA-Z0-9_-]+\/?$/;
            return pattern.test(url);
        }


        function isValidWebsiteURL(url) {
            const pattern = /^(https?:\/\/)?(www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}([\/\w.-]*)*\/?$/;
            return pattern.test(url);
        }


        function validateProfileForm() {
            const name = document.querySelector('input[name="Name"]').value.trim();
            const shortDesc = document.querySelector('input[name="ShortDesc"]').value.trim();
            const email = document.querySelector('input[name="Email"]').value.trim();
            const contactPerson = document.querySelector('input[name="ContactPerson"]').value.trim();
            const contactNum = document.querySelector('input[name="ContactNum"]').value.trim();
            const linkedin = document.querySelector('input[name="Linkedin"]').value.trim();
            const website = document.querySelector('input[name="Website"]').value.trim();
            const no = document.querySelector('input[name="No"]').value.trim();
            const lane = document.querySelector('input[name="Lane"]').value.trim();
            const city = document.querySelector('input[name="City"]').value.trim();
            const district = document.querySelector('input[name="District"]').value.trim();
            const coverphoto = document.getElementById('coverphoto').files[0];
            const profilephoto = document.getElementById('profilephoto').files[0];

            if(existingEmails.includes(email)){
                errorToast("Email already exists.Use another one");
                return false;
            }

            if(existingNames.includes(name)){
                errorToast("Name already exists.Use another one");
                return false;
            }

            if (!name) {
                errorToast("Company name is required.");
                return false;
            }

            if (!shortDesc) {
                errorToast("Please enter a short description.");
                return false;
            }

            if (!email || !isValidEmail(email)) {
                errorToast("Please enter a valid email address.");
                return false;
            }

            if (!contactPerson) {
                errorToast("Contact person is required.");
                return false;
            }

            if (!contactNum || !isValidPhone(contactNum)) {
                errorToast("Please enter a valid contact number.");
                return false;
            }

            if (!linkedin || !isValidLinkedInURL(linkedin)) {
                errorToast("LinkedIn profile valid URL is required.");
                return false;
            }

            if (!website || !isValidWebsiteURL(website)) {
                errorToast("Website URL is required.");
                return false;
            }

            if (!no || !lane || !city || !district) {
                errorToast("Complete address information is required.");
                return false;
            }

            return true;
        }


        function goback() {
            window.location.href = "<?php echo ROOT ?>/company/Profile/dashboard";
        }

        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result; // Set the image preview
                };

                reader.readAsDataURL(file);
            } else {
                preview.src = ""; // Clear the preview if no file is selected
            }
        }

        // Get the modal

        // Get the modal popup for confirm update
        function openconfirmeModal() {
            if (validateProfileForm()) {
                document.getElementById('deleteconfirmation-modal').style.display = 'block';
                modal.style.display = 'flex';
            }
        }


        function closeconfirmModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }


        function submitForm() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
            document.getElementById('loading-overlay').style.display = 'flex'; // Show loader
            setTimeout(() => {
                document.getElementById('pro-form').submit();
            }, 300); // slight delay to show animation before form submit
        }
    </script>



</body>

</html>