<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tech talk</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Techtalk.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Messages</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="m_main">
                    <div class="m_header">
                        <div class="sender">
                            <a href="http://localhost/Gradlink/public/company/Messages/dashboard" class="backbtn">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <img src="<?php echo ROOT ?>/assets/img/wso2.png" />
                            <div class="m_details">
                                <span class="m_name">PDC</span>
                                <span class="m_detail">Tech talk</span>
                            </div>
                        </div>
                        <div class="m_timedate">
                            <span class="m_time">7.30 p.m</span>
                            <span class="m_date">2024/11/21</span>
                        </div>
                    </div>
                    <div class="m_content">
                        <div class="topic">
                            <h2>Invitation to Conduct a Tech Talk Session for 3rd-Year Students</h2>
                        </div>
                        <div class="message">
                            <p>Dear Company,</p>
                            <p>We are delighted to invite your organization to participate in our Tech Talk Series, designed exclusively for 3rd-year students to enhance their knowledge and prepare them for their upcoming internships.</p>
                            <p>This initiative provides an excellent platform for your company to:Showcase expertise in your domain.Connect with talented students poised to enter the industry.Inspire and mentor the next generation of professionals.</p>
                            <p>Below are the available time slots for the sessions. We kindly request you to book one slot that best fits your schedule for conducting your session. Additionally, we encourage you to engage with participating students through interactive discussions, Q&A sessions, or hands-on activities to create a more impactful experience.</p>
                        </div>
                        <form id="booking-form" action="" method="POST">
                            <table id="time-slot-table">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>2024/11/21</th>
                                        <th>2024/11/23</th>
                                        <th>2024/11/25</th>
                                        <th>2024/11/27</th>
                                        <th>2024/11/28</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>08:00 - 10:00</td>
                                        <td class="slot" data-date="2024/11/21" data-time="08:00-10:00"></td>
                                        <td class="slot" data-date="2024/11/23" data-time="08:00-10:00"></td>
                                        <td class="slot" data-date="2024/11/25" data-time="08:00-10:00"></td>
                                        <td class="slot" data-date="2024/11/27" data-time="08:00-10:00"></td>
                                        <td class="slot" data-date="2024/11/28" data-time="08:00-10:00"></td>
                                    </tr>
                                    <tr>
                                        <td>12:00 - 14:00</td>
                                        <td class="slot" data-date="2024/11/21" data-time="12:00-14:00"></td>
                                        <td class="slot" data-date="2024/11/23" data-time="12:00-14:00"></td>
                                        <td class="slot" data-date="2024/11/25" data-time="12:00-14:00"></td>
                                        <td class="slot" data-date="2024/11/27" data-time="12:00-14:00"></td>
                                        <td class="slot" data-date="2024/11/28" data-time="12:00-14:00"></td>
                                    </tr>
                                    <tr>
                                        <td>15:00 - 17:00</td>
                                        <td class="slot" data-date="2024/11/21" data-time="15:00-17:00"></td>
                                        <td class="slot" data-date="2024/11/23" data-time="15:00-17:00"></td>
                                        <td class="slot" data-date="2024/11/25" data-time="15:00-17:00"></td>
                                        <td class="slot" data-date="2024/11/27" data-time="15:00-17:00"></td>
                                        <td class="slot" data-date="2024/11/28" data-time="15:00-17:00"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="date" id="selected-date">
                            <input type="hidden" name="time" id="selected-time">
                            <button type="submit" id="submit-button" disabled>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>


    <script>
        const slots = document.querySelectorAll('.slot');
        const selectedDateInput = document.getElementById('selected-date');
        const selectedTimeInput = document.getElementById('selected-time');
        const submitButton = document.getElementById('submit-button');

        // Handle slot selection
        slots.forEach(slot => {
            slot.addEventListener('click', () => {
                if (slot.classList.contains('booked')) {
                    errorToast('This slot is already booked.');
                } else {
                    // Unselect previously selected slot
                    document.querySelectorAll('.slot.selected').forEach(selectedSlot => {
                        selectedSlot.classList.remove('selected');
                    });

                    // Mark the clicked slot as selected
                    slot.classList.add('selected');

                    // Update hidden input fields with selected slot data
                    selectedDateInput.value = slot.dataset.date;
                    selectedTimeInput.value = slot.dataset.time;

                    // Enable submit button
                    submitButton.disabled = false;

                    successToast(`You have selected ${slot.dataset.time} on ${slot.dataset.date}.`);
                }
            });
        });

        // Example: Mark a slot as booked programmatically
        slots.forEach(slot => {
            if (slot.dataset.date === '2024/11/23' && slot.dataset.time === '12:00-14:00') {
                slot.classList.add('booked');
            }
        });
    </script>


</body>

</html>