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
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Students Requests</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="sc_main">
                    <div class="sc">
                        <a href="http://localhost/Gradlink/public/company/ShortlistedStudents/studentprofile/<?php echo $addata[0]->advertisementId  ?>/<?php echo $data[0]->StudentId  ?>" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h3>Create Interview Schedule</h3>
                            
                            
                        </a>
                    </div>
                    <form id="schedule-form" class="sc_background" method="post">
                        <div class="sc_iner">
                            <div class="sc_pos">
                                <h4>Position:</h4>
                                <select id="position" name="position" required>
                                    <option value="<?php echo $addata[0]->position ?>"><?php echo $addata[0]->position ?></option>
                                </select>
                            </div>
                            <div class="sc_dateNdur">
                                <div class="sc_date">
                                    <h4>Student Name :</h4>
                                    <input type="text" id="name" name="name" value="<?php echo $data[0]->Name ?>" required />
                                </div>
                            </div>
                            <div class="sc_dateNdur">
                                <div class="sc_date">
                                    <h4>Date :</h4>
                                    <input type="date" id="date" name="date" required />
                                </div>
                            </div>
                            <div class="sc_time">
                                <h4>Select Time Period</h4>
                            </div>
                            <div id="time-slots-container" class="sc_time-slots">
                                <div class="time-slot">
                                    <input type="time" id="starttime" name="starttime" required>
                                    <p>-</p>
                                    <input type="time" id="endtime" name="endtime" required>
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
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>



    <script>
        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const date = document.getElementById('date').value;
            const name = document.getElementById('name').value;
            const starttime = document.getElementById('starttime').value;
            const endtime = document.getElementById('endtime').value;

            if (!position || !date || !name || !starttime || !endtime) {
                errorToast("Please fill in all required fields.");
                return;
            }

            // Show confirmation modal if form is valid
            openConfirmationModal();
        }
        document.addEventListener("DOMContentLoaded", () => {
        const dateInput = document.getElementById('date');
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate() + 1).padStart(2, '0');

        const minDate = `${yyyy}-${mm}-${dd}`;
        dateInput.setAttribute('min', minDate);
        });

        function openConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'block';
            const modal = document.getElementById("confirmation-modal");
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