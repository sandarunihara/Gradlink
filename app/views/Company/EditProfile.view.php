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
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Profile</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                            <a href='../Profile/dashboard'>
                                <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                                <p><span>WSO2</span>Company</p>
                            </a>
                        </div>
                    </div>
                </div>
                <form method="post" id="pro-form" class=" pro_main" enctype="multipart/form-data">
                    
                    <!-- Cover photo -->
                    <div class="coverphoto">
                        <label for="coverphoto">
                            <img
                            src="<?php echo !empty($data->coverimg)? 'data:image/jpeg;base64,' . $data->coverimg : ROOT . '/assets/img/Company/coverpic.jpg'; ?>" 
                            id="coverPreview"
                            alt="Cover Preview" />
                        </label>
                        <input type="file" name="coverphoto" id="coverphoto" accept="image/*" required style="display: none;" onchange="previewImage(event, 'coverPreview')">
                    </div>

                    
                    <!-- Profile photo -->
                    <div class="prophoto">
                        <label for="profilephoto">
                            <img
                            src="<?php echo !empty($data->profileimg)? 'data:image/jpeg;base64,' . $data->profileimg : ROOT . '/assets/img/Company/companypro.png'; ?>"
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
                            <button class="discard">Discard</button>
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




    <script>
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

            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }


        function submitForm() {
            document.getElementById('pro-form').submit();
            successToast("Advertisement updated successfully");
        }
    </script>



</body>

</html>