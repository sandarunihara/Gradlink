<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Session</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f0f4f8;
            display: flex;
        }

        .container {
            display: flex;
            width: 100%;
        }

        .content {
            width: 95%;
            padding: 40px 5%;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-left: 5%;
            height: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-left h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-right img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-info span {
            font-weight: 600;
        }

        .user-info small {
            font-size: 12px;
            color: #6b7280;
        }

        .company-info {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .company-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            margin-top: 15px;
            padding: 15px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background-color: #fafafa;
            width: 100%;
            font-size: 14px;
            color: #333;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group input::placeholder {
            color: #aaa;
            font-size: 14px;
            font-style: italic;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2b36b7;
            outline: none;
            box-shadow: 0 0 8px rgba(43, 54, 183, 0.5);
        }

        .form-group input:hover,
        .form-group select:hover {
            border-color: #1e3c72;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        }

        .form-group input:focus::placeholder {
            color: transparent;
        }

        .error {
            color: #ef4444;
            font-size: 12px;
            font-weight: 500;
            margin-top: 5px;
            display: block;
        }

        .button-line {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            grid-column: 1 / -1;
        }

        .back-btn,
        .confirm-btn {
            padding: 16px 48px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover,
        .confirm-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .back-btn:active,
        .confirm-btn:active {
            transform: translateY(2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .back-btn {
            background: #e5e7eb;
            color: #4b5563;
            width: 240px;
        }

        .back-btn:hover {
            background: #d1d5db;
        }

        .confirm-btn {
            background: #1e3c72;
            color: white;
            width: 240px;
        }

        .confirm-btn:hover {
            background: #172554;
        }

        .format-hint {
            display: block;
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .button-line {
                flex-direction: column;
                gap: 15px;
            }

            .back-btn,
            .confirm-btn {
                width: 100%;
            }
            
            .company-form {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">event</i>
                    <h1>Create Session</h1>
                </div>
            </header>

            <section class="company-info">
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddSession/submitUnreg" id="session-form">
                    <div class="form-group">
                        <label for="session-name">Session Name</label>
                        <input type="text" id="session-name" name="session_name" placeholder="Session Name" required>
                    </div>

                    
                    <div class="form-group" id="company-group">
                        <label for="company-name">Enter Company Name</label>
                        <input type="text" id="company-name" name="company_name" placeholder="Type company name...">
                    </div>

                    <div class="form-group">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" name="email" placeholder="Company Email" required>
                    </div>

                    <div class="form-group">
                        <label for="contact-person">Contact Person</label>
                        <input type="text" id="contact-person" name="contact_person" placeholder="Contact Person" required>
                    </div>

                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number" placeholder="Contact Number" 
                            pattern="^07\d{8}$"
                            required>
                        <small class="format-hint">Format: 0XXXXXXXXX (e.g., 0771234567)</small>
                    </div>

                    <div class="form-group">
                        <label for="session-date">Session Date</label>
                        <input type="date" 
                            id="session-date" 
                            name="session_date" 
                            placeholder="Session Date" 
                            min="<?= date('Y-m-d') ?>" 
                            required>
                    </div>

                    <div class="form-group">
                        <label for="time-slot">Time Slot</label>
                        <select id="time-slot" name="time_slot" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="hall-number">Hall Name</label>
                        <select id="hall-number" name="hall_number" required>
                        </select>
                    </div>

                    <div class="button-line">
                        <button type="button" class="back-btn" onclick="history.back()">Back</button>
                        <button type="submit" class="confirm-btn">Confirm</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
    <script>

        document.addEventListener("DOMContentLoaded", function(){

            function navigateToViewSession() {
                window.location.href = "<?= ROOT ?>/PDC_admin/ViewSession";
            }

            const companyName = document.getElementById("company-name");
            const companyId = document.getElementById("company-id");
            const email = document.getElementById("email-address");
            const contactPerson = document.getElementById("contact-person");
            const contactNumber = document.getElementById("contact-number");

            const hallname = document.getElementById('hall-number');
            const timeslot = document.getElementById('time-slot');
            const date = document.getElementById('session-date');

            const companyData = <?php echo json_encode($companyData); ?>;

            const allTimeSlots = [
                            "9:00 AM - 11:00 AM",
                            "11:00 AM - 1:00 PM",
                            "1:00 PM - 3:00 PM",
                            "3:00 PM - 5:00 PM"
                        ];

            const allHalls = ["W001", "S104", "S202" ,"W004"];


            date.addEventListener("change", function (){
                const selectedDate = this.value;
                //console.log("Selected date:", selectedDate);
                fetch(`<?= ROOT ?>/PDC_admin/AddSession/GetAvailability?type=date&value=${selectedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        //console.log("Fetched data:", data);

                        const timeSlotSelect = document.getElementById("time-slot");

                        const unavailableTimeSlots = data.map(item => item.time_slot);
                        const availableTimeSlots = allTimeSlots.filter(slot => !unavailableTimeSlots.includes(slot));
                        //console.log(availableTimeSlots);

                        timeSlotSelect.innerHTML = '<option value="" >Select Time Slot</option>';
                        availableTimeSlots.forEach(slot => {
                            const option = document.createElement("option");
                            option.value = slot;
                            option.textContent = slot;
                            timeSlotSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching availability:", error);
                    });
            })

            timeslot.addEventListener("change", function () {
                const selectedDate = date.value;
                const selectedSlot = this.value;

                if (!selectedDate || !selectedSlot) return;

                fetch(`<?= ROOT ?>/PDC_admin/AddSession/GetAvailability?type=date&value=${selectedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        const hallSelect = document.getElementById("hall-number");

                        hallSelect.innerHTML = '<option value="">Select Hall</option>';

                        const unavailableHalls = data.filter(item => item.time_slot === selectedSlot).map(item => item.hall_number);
                        const availableHalls = allHalls.filter(hall => !unavailableHalls.includes(hall));

                        console.log(availableHalls);

                        availableHalls.forEach(hall => {
                            const option = document.createElement("option");
                            option.value = hall;
                            option.textContent = hall;
                            hallSelect.appendChild(option);
                        });

                    })
                    .catch(error => {
                        console.error("Error filtering halls based on time slot:", error);
                    });
            });
        })

    </script>
</body>
</html>