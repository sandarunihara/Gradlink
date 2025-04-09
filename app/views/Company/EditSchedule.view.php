<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/EditSchedule.css">
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
                        <h1>Edit Interview Schedule</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="sr_main">
                    <div class="sc">
                        <h3></h3>
                    </div>
                    <form id="schedule-form" class="sc_background" method="post">
                        <div class="sc_iner">
                            <a href="http://localhost/Gradlink/public/company/Schedule/dashboard" class="sc_container">
                                <i class="fas fa-chevron-left"></i>
                                <h3>BACK</h3>
                            </a>
                            <div class="sc_con">
                                <div class="is_con1">
                                    <div class="sc_pos">
                                        <h4><span class="starmark">*</span>Position:</h4>
                                        <input type="text" id="position" name="position" value="<?php echo $addata[0]->position ?>"  readonly />
                                    </div>
                                    <div class="sc_dateNdur">
                                        <div class="sc_date">
                                            <h4><span class="starmark">*</span>Student Name :</h4>
                                            <input type="text" id="name" name="name" value="<?php echo $data[0]->Name ?>"  readonly />
                                        </div>
                                    </div>
                                    <div class="sc_dateNdur">
                                        <div class="sc_date">
                                            <h4><span class="starmark">*</span>Date :</h4>
                                            <input type="date" id="date" name="date"  value="<?php echo $interview_data[0]->Date ?>"/>
                                        </div>
                                    </div>
                                    <div class="sc_time">
                                        <h4><span class="starmark">*</span>Select Time Period</h4>
                                        <div id="time-slots-container" class="sc_time-slots">
                                            <div class="time-slot">
                                                <input type="time" id="starttime" name="starttime" value="<?php echo $interview_data[0]->StartTime ?>">
                                                <p>-</p>
                                                <input type="time" id="endtime" name="endtime" value="<?php echo $interview_data[0]->EndTime ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="is_con2">
                                    <div class="sc_dateNdur2">
                                        <div class="additional_info">
                                            <h4>Additional Information </h4>
                                            <textarea id="message" name="message" cols="70" rows="8" placeholder="Enter your message..."></textarea>
                                        </div>
                                        <div class="sc_btn">
                                            <button type="submit" class="sc_btn" onclick="validateAndShowModal(event)">
                                                Schedule Interview
                                            </button>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Toast message from session -->
    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            window.__flashMessage = <?php echo json_encode($_SESSION['flash']); ?>;
        </script>
    <?php   
        unset($_SESSION['flash']);
    endif;
    ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


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
            const unavailableDates = <?php echo json_encode($unavailable_date); ?>;
            flatpickr("#date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: unavailableDates.map(date => new Date(date))
            });
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