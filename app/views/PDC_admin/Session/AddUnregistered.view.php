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
        :root {
            --primary: #4e54c8;
            --primary-dark: #23244a;
            --accent: #3c41a2;
            --background: #f0f0f5;
            --card-bg: #fff;
            --input-bg: #f7f8fa;
            --input-border: #bbbddd;
            --input-focus: #4e54c8;
            --danger: #ef4444;
            --gray: #64748b;
            --dark-gray: #374151;
            --radius: 12px;
            --shadow: 0 4px 20px rgba(67, 97, 238, 0.07);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            background-color: var(--background);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 80px; /* Same as sidebar width */
            flex: 1;
            padding: 40px;
            background-color: var(--background);
            min-height: 100vh;
            transition: margin-left 0.3s;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--primary-dark);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .tab-content {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 32px 24px;
        }

        .company-form {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .filling-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px 32px;
        }

        @media (max-width: 900px) {
            .filling-form {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .form-group label {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 8px;
            letter-spacing: 0.01em;
            transition: color 0.2s;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 14px 16px;
            border: 1.5px solid var(--input-border);
            border-radius: 8px;
            background: var(--input-bg);
            font-size: 1rem;
            color: #23244a;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.04);
            outline: none;
            width: 100%;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--input-focus);
            background: #fff;
            box-shadow: 0 0 0 2px rgba(78, 84, 200, 0.11);
        }

        .form-group input:hover,
        .form-group select:hover,
        .form-group textarea:hover {
            border-color: var(--primary-dark);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #b6b9c6;
            font-size: 0.98rem;
            font-style: italic;
            opacity: 1;
        }

        .format-hint {
            font-size: 0.85rem;
            color: var(--gray);
            margin-top: 6px;
            margin-left: 2px;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.9rem;
            font-weight: 500;
            margin-top: 6px;
            margin-left: 2px;
            display: none;
        }

        .button-line {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-top: 32px;
        }

        .btn {
            padding: 15px 48px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background 0.3s cubic-bezier(0.4,0,0.2,1), 
                        color 0.3s cubic-bezier(0.4,0,0.2,1), 
                        box-shadow 0.3s cubic-bezier(0.4,0,0.2,1), 
                        transform 0.2s cubic-bezier(0.4,0,0.2,1);
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.07);
            display: inline-block;
        }

        .submit-btn {
            background: #4e54c8;
            color: #fff;
            box-shadow: 0 4px 14px rgba(67, 97, 238, 0.11);
        }

        .submit-btn:hover, .submit-btn:focus {
            background: #3c41a2;
            box-shadow: 0 8px 30px rgba(78, 84, 200, 0.18);
            transform: translateY(-2px) scale(1.04);
        }

        .back-btn {
            background: #e0e7ef;
            color: var(--primary-dark);
        }

        .back-btn:hover, .back-btn:focus {
            background: #d1d9f0;
            color: var(--primary);
            transform: translateY(-2px) scale(1.04);
        }

        @media (max-width: 600px) {
            .main-content {
                padding: 18px 2% 18px 2%;
                margin-left: 0;
                margin-top: 60px;
            }
            .tab-content {
                padding: 18px 2% 18px 2%;
            }
            .button-line {
                flex-direction: column;
                gap: 16px;
            }
            .btn {
                width: 100%;
                padding: 14px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">event</i>
                    <h1>Create Session</h1>
                </div>
            </header>

            <div class="tab-content">
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddSession/submitUnreg" id="session-form">
                    <div class="filling-form">
                        <div class="form-group">
                            <label for="session-name">Session Name</label>
                            <input type="text" id="session-name" name="session_name" placeholder="Session Name" required>
                        </div>

                        
                        <div class="form-group" id="company-group">
                            <label for="company-name">Enter Company Name</label>
                            <input type="text" id="company-name" name="company_name" placeholder="Type company name..." required>
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
                                pattern="^[0-9+\s()-]{7,20}$"
                                required>
                            <small class="format-hint">Enter a valid phone number (e.g., +94 98765 43210 , 0733333333)</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Session Description</label>
                            <textarea id="description" name="description" placeholder="Enter session description"></textarea>
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
                    </div>

                    <div class="button-line">
                        <button type="button" class="btn back-btn" onclick="history.back()">Back</button>
                        <button type="submit" class="btn submit-btn">Confirm</button>
                    </div>
                </form>
            </div>
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

                        const  slotHalls = {};

                        data.forEach(item => {
                            if(!slotHalls[item.time_slot]){
                                slotHalls[item.time_slot] = new Set();
                            }
                            slotHalls[item.time_slot].add(item.hall_number)
                        })

                        console.log(slotHalls);

                        const mapped = Object.entries(slotHalls).map(([timeslot , setHalls])=> {
                            return{
                                timeslot,
                                count: setHalls.size
                            }
                        }
                        )

                        console.log(mapped);

                        const unavailableTimeSlots = mapped.filter(({ count }) => 
                            count === allHalls.length
                        ).map(({ timeslot }) => timeslot);
                        
                        console.log(unavailableTimeSlots);


                        const availableTimeSlots = allTimeSlots.filter(slot => !unavailableTimeSlots.includes(slot));

                        console.log(availableTimeSlots);

                        const timeSlotSelect = document.getElementById("time-slot");



                        //const unavailableTimeSlots = data.map(item => (item.time_slot));
                        //const availableTimeSlots = allTimeSlots.filter(slot => !unavailableTimeSlots.includes(slot));
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