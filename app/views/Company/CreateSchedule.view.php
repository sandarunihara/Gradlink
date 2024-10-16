<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Schedulecreate.css">
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
                        <h1>Students Requests</h1>
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
                <div class="sc_main">
                    <div class="sc">
                        <a href="../Schedule/Dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h3>Create Interview Schedule</h3>
                        </a>
                    </div>
                    <form id="schedule-form" class="sc_background">
                        <div class="sc_iner">
                            <div class="sc_pos">
                                <h4>Position:</h4>
                                <select id="position" required>
                                    <option value="qa">Quality Assurance</option>
                                    <option value="se">Software Engineer</option>
                                    <option value="wd">Wed Developer</option>
                                </select>
                            </div>
                            <div class="sc_dateNdur">
                                <div class="sc_date">
                                    <h4>Date Period:</h4>
                                    <input type="date" id="start-date" required />
                                    <p>-</p>
                                    <input type="date" id="end-date" required />
                                </div>
                                <div class="sc_dur">
                                    <h4>Interview Duration:</h4>
                                    <select id="duration" required>
                                        <option value="15">15 min</option>
                                        <option value="30">30 min</option>
                                        <option value="45">45 min</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sc_time">
                                <h4>Select the Day</h4>
                                <button class="sc_tbtn" id="add-time-slot" onclick="addTimeSlot(event)">
                                    <i class="fas fa-plus"></i>
                                    <p>Time Slots</p>
                                </button>
                            </div>
                            <div id="time-slots-container" class="sc_time-slots">
                                <div class="time-slot">
                                    <input type="date" required>
                                    <input type="time" required>
                                    <input type="time" required>
                                    <button></button>
                                </div>
                            </div>
                            <div class="sc_btn">
                                <button type="submit" class="sc_btn" onclick="validateAndShowModal(event)">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>

    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to send the schedule?</p>
            <div class="modal-buttons">
                <button class="yes-btn" onclick="submitForm()">Yes</button>
                <button class="no-btn" onclick="closeConfirmationModal()">No</button>
            </div>
        </div>
    </div>


    <div id="toast-container" class="toast-container"></div>



    <script>
        function addTimeSlot(event) {
            event.preventDefault();
            // Create a new time slot div
            const timeSlotDiv = document.createElement('div');
            timeSlotDiv.className = 'time-slot';

            // Create input elements for date and time range
            const dateInput = document.createElement('input');
            dateInput.type = 'date';

            const startTimeInput = document.createElement('input');
            startTimeInput.type = 'time';

            const endTimeInput = document.createElement('input');
            endTimeInput.type = 'time';

            // Create a delete button
            const deleteButton = document.createElement('button');
            deleteButton.onclick = function() {
                timeSlotDiv.remove();
            };

            const deleticon = document.createElement('i');
            deleticon.className = 'fas fa-trash-alt timedel'

            // Append inputs and delete button to time slot div
            timeSlotDiv.appendChild(dateInput);
            timeSlotDiv.appendChild(startTimeInput);
            timeSlotDiv.appendChild(endTimeInput);
            timeSlotDiv.appendChild(deleteButton);
            deleteButton.appendChild(deleticon);

            // Append time slot div to container
            document.getElementById('time-slots-container').appendChild(timeSlotDiv);


            setTimeout(() => {
                timeSlotDiv.classList.add('show');
            }, 10);
        }

        function removeTimeSlot(element) {
            // Remove the 'show' class to trigger the transition
            element.classList.remove('show');

            // Wait for the transition to end before removing the element
            setTimeout(() => {
                element.remove();
            }, 500); // Match this duration with the CSS transition duration
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



        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const duration = document.getElementById('duration').value;

            if (!position || !startDate || !endDate || !duration) {
                showToast("Please fill in all required fields.");
                return;
            }

            // Show confirmation modal if form is valid
            openConfirmationModal();
        }

        function openConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        function submitForm() {
            document.getElementById('schedule-form').submit();
        }
    </script>
</body>

</html>