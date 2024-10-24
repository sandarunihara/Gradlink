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
        <div class="side">
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Advertisements</h1>
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
                <div class="main_container">
                    <div class="sc">
                        <a href="../Advertisements/Dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h3>Create Interview Schedule</h3>
                        </a>
                    </div>
                    <!-- Form data -->
                    <form id="ad-form" class="sub_container" method="POST" action="">
                        <div class="position">
                            <h4>Position:</h4>
                            <select id="position" name="position" required>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Software Engineer">Software Engineer</option>
                                <option value="Wed Developer">Wed Developer</option>
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
                                <h4>Internship Period:</h4>
                                <input type="text" id="period" name="period" required />
                            </div>
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
                                    <option value="Remote">Remote</option>
                                    <option value="Onsite">Onsite</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                        </div>
                        <div class="addimg">
                            <h4>Add Image:</h4>
                            <input type="file" id="image" />
                            <!-- this is not in the script  -->
                        </div>
                        <button type="submit" class="sc_btn" onclick="validateAndShowModal(event)">
                            Submit
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
                    <img src="<?php echo ROOT ?>/assets/img/interns.png" class="logo" />
                </div>
                <div class="inform">
                    <h4>Position:<span> </span></h4>
                    <h4>Internship Period:<span></span></h4>
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


    <script>
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


        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualifications = document.getElementById('qualifications').value;
            const period = document.getElementById('period').value;
            const deadline = document.getElementById('deadline').value;
            const interns = document.getElementById('interns').value;
            const worktype = document.getElementById('worktype').value;
            // image is not in the script

            if (!position || !description || !qualifications || !period || !deadline || !interns || !worktype) {
                showToast("Please fill in all required fields.");
                return;
            }

            // Update the modal content with the form data
            document.querySelector('.modal-details h4:nth-child(1) span').textContent = position;
            document.querySelector('.modal-details h4:nth-child(2) span').textContent = period;
            document.querySelector('.modal-details h4:nth-child(3) span').textContent = interns;
            document.querySelector('.modal-details h4:nth-child(4) span').textContent = worktype;
            document.querySelector('.modal-details h4:nth-child(5) span').textContent = deadline;
            
            document.querySelector('.q-details p').textContent = qualifications;
            document.querySelector('.d-details p').textContent = description;

            // Show confirmation modal if form is valid
            openConfirmationModal();
        }

        function openConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

            // const modal = document.getElementById("confirmation-modal");
            // modal.classList.add("fade-out");

            // // Hide the modal after the animation ends
            // modal.addEventListener("animationend", function () {
            //     modal.style.display = "none";
            //     modal.classList.remove("fade-out"); // Remove class after the animation
            // });

        }

        function submitForm() {
            document.getElementById('ad-form').submit();
        }


        // toast model
        function showToast(message) {
            const toastContainer = document.getElementById('toast-container');

            // Create a new toast element
            const toast = document.createElement('div');
            toast.className = 'toast-message';

            // Set the message and add a close button
            toast.innerHTML = `${message}<span class="toast-close-btn" onclick="closeToast(this)">✖</span>`;

            // Append the toast to the container
            toastContainer.appendChild(toast);

            // Automatically remove the toast after 5 seconds
            setTimeout(() => {
                toast.remove();
            }, 5000);
        }

        function closeToast(toastElement) {
            toastElement.parentElement.remove();
        }
    </script>
</body>

</html>