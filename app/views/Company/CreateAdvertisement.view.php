<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/CreateAdvertisement.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">

        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="main_container">
                    <div class="sc">
                        <a href="../Advertisements/dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h3>Create Interview Schedule</h3>
                        </a>
                    </div>
                    <!-- Form data -->
                    <form id="ad-form" class="sub_container" method="POST" action="" enctype="multipart/form-data">
                        <div class="position">
                            <h4>Position:</h4>
                            <select id="position" name="position" required>
                                <option value="" disabled selected>Select a position</option>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Software Engineer">Software Engineer</option>
                                <option value="Web Developer">Web Developer</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Machine Learning">Machine Learning</option>
                                <option value="Data Analyst">Data Analyst</option>
                                <option value="Full Stack Developer">Full Stack Developer</option>
                                <option value="Backend Developer">Backend Developer</option>
                                <option value="Frontend Developer">Frontend Developer</option>
                                <option value="DevOps Engineer">DevOps Engineer</option>
                                <option value="Cloud Architect">Cloud Architect</option>
                                <option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
                                <option value="AI Engineer">AI Engineer</option>
                                <option value="Mobile App Developer">Mobile App Developer</option>
                                <option value="Blockchain Developer">Blockchain Developer</option>
                                <option value="Game Developer">Game Developer</option>
                                <option value="UI/UX Designer">UI/UX Designer</option>
                                <option value="Product Manager">Product Manager</option>
                                <option value="System Administrator">System Administrator</option>
                                <option value="Network Engineer">Network Engineer</option>
                                <option value="Technical Support Engineer">Technical Support Engineer</option>
                                <option value="Embedded Systems Engineer">Embedded Systems Engineer</option>
                                <option value="Cloud Engineer">Cloud Engineer</option>
                                <option value="Software Architect">Software Architect</option>
                                <option value="Solutions Architect">Solutions Architect</option>
                                <option value="IT Consultant">IT Consultant</option>
                                <option value="Quality Engineer">Quality Engineer</option>
                                <option value="Business Intelligence Analyst">Business Intelligence Analyst</option>
                                <option value="RPA Developer">RPA Developer</option>
                                <option value="ERP Consultant">ERP Consultant</option>
                                <option value="Salesforce Developer">Salesforce Developer</option>
                                <option value="SAP Consultant">SAP Consultant</option>

                            </select>
                        </div>
                        <div class="details">
                            <div>
                                <h4>Description:</h4>
                                <textarea name="description" id="description" cols="50" rows="10" required></textarea>
                            </div>
                            <div>
                                <h4>Qualifications:</h4>
                                <textarea name="qualifications" id="qualifications" cols="50" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="perioddeadline">
                            <div class="period">
                                <h4>Application deadline:</h4>
                                <input type="date" id="deadline" name="deadline" required />
                            </div>
                        </div>

                        <div class="internt">
                            <div class="interns">
                                <h4>No of interns:</h4>
                                <div class="number-input">
                                    <button class="fbtn" type="button" onclick="decrement()">-</button>
                                    <input type="text" id="interns" name="interns" value="5" readonly required>
                                    <button class="sbtn" type="button" onclick="increment()">+</button>
                                </div>
                            </div>
                            <div class="position">
                                <h4>Work type:</h4>
                                <select id="worktype" name="worktype" required>
                                    <option value="" disabled selected>Select a worktype</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Onsite">Onsite</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                        </div>
                        <div class="addimg">
                            <h4>Add Image:</h4>
                            <label for="image" class="custom-file-upload">
                                <i class="fas fa-upload"></i> Choose an Image
                            </label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" id="image" name="image" required />
                            <span id="file-name">No file chosen</span>
                        </div>

                        <button type="submit" class="sc_btn" onclick="validateAndShowModal(event)">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!--    **************** MODAL *******************      -->

    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <div class="modal-details">
                <div class="image">
                    <img src="" class="logo" />
                </div>
                <div class="inform">
                    <h4>Position:<span></span></h4>
                    <h4>No of interns:<span></span></h4>
                    <h4>Work type:<span></span></h4>
                    <h4>Application deadline:<span></span></h4>
                </div>
            </div>
            <div class="Qua-des">
                <div class="Qualifications">
                    <h4>Qualifications:</h4>
                    <div class="q-details">
                        <p></p>
                    </div>
                </div>

                <div class="Description">
                    <h4>Description:</h4>
                    <div class="d-details">
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="modal-buttons">
                <button class="cancel-btn" onclick="closeConfirmationModal()">Cancel</button>
                <div class="btn-m">
                    <a href="../Advertisements/dashboard">
                        <button class="no-btn">Discard</button>
                    </a>
                    <button class="yes-btn" onclick="submitForm()">Post</button>
                </div>
            </div>

        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const dateInput = document.getElementById('deadline');
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate() + 1).padStart(2, '0');

            const minDate = `${yyyy}-${mm}-${dd}`;
            dateInput.setAttribute('min', minDate);
        });

        function increment() {
            let count = document.getElementById('interns').value;
            count = parseInt(count) + 1;
            document.getElementById('interns').value = count;
        }

        function decrement() {
            let count = document.getElementById('interns').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('interns').value = count;
            }
        }

        // Show the file name when a file is selected
        document.getElementById('image').addEventListener('change', function() {
            const fileName = this.files[0]?.name || "No file chosen";
            document.getElementById('file-name').textContent = fileName;
        });

        // Get the modal 

        function validateAndShowModal(event) {
            event.preventDefault();

            // Get form data
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualifications = document.getElementById('qualifications').value;
            const deadline = document.getElementById('deadline').value;
            const interns = document.getElementById('interns').value;
            const worktype = document.getElementById('worktype').value;
            const image = document.getElementById('image').files[0];

            const maxFileSize = 0.9 * 1024 * 1024; // 5MB
            if (image && image.size > maxFileSize) {
                errorToast("The image file size exceeds the maximum allowed size of 5MB.");
                return; // Prevent further form submission
            }

            if (!position) {
                errorToast("Please select a position from the dropdown.");
                return;
            }
            if (!description) {
                errorToast("Description is required. Please provide the necessary details.");
                return;
            }
            if (!qualifications) {
                errorToast("Qualifications is required. Please provide the necessary details.");
                return;
            }
            if (!deadline) {
                errorToast("Deadline is required. Please specify a valid date.");
                return;
            }
            if (!interns) {
                errorToast("Please enter a valid number of interns required.");
                return;
            }
            if (!worktype) {
                errorToast("Please select a worktype from the dropdown.");
                return;
            }
            if (!image) {
                errorToast("Please upload an image.");
                return;
            }
            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            if (!allowedTypes.includes(image.type)) {
                errorToast("Invalid file type. Please upload a PNG, JPEG, or JPG image.");
                return;
            }

            // Read the image file as a data URL
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageUrl = e.target.result; // This is the base64 encoded image

                // Update the modal content with the form data
                document.querySelector('.modal-details h4:nth-child(1) span').textContent = position;
                document.querySelector('.modal-details h4:nth-child(2) span').textContent = interns;
                document.querySelector('.modal-details h4:nth-child(3) span').textContent = worktype;
                document.querySelector('.modal-details h4:nth-child(4) span').textContent = deadline;

                document.querySelector('.q-details p').textContent = qualifications;
                document.querySelector('.d-details p').textContent = description;

                // Set the image src in the modal
                document.querySelector('.modal-details .image img').src = imageUrl;

                // Show the confirmation modal
                openConfirmationModal();
            };
            reader.readAsDataURL(image); // This converts the image to base64
        }

        function openConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'block';
            const modal = document.getElementById("confirmation-modal");
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

        }
        const errorMessage = <?php echo json_encode($data['error'] ?? '') ?>;
        if (errorMessage) {
            errorToast(errorMessage);
        }


        function submitForm() {
            document.getElementById('ad-form').submit();
            successToast("Advertisement created successfully");
        }
    </script>
</body>

</html>