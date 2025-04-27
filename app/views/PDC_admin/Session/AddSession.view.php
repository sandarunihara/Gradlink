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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/session/addSession.css?v=<?= time() ?>">

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
                <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddSession/submit" id="session-form">
                    <div class="filling-form">
                        <div class="form-group">
                            <label for="session-name">Session Name</label>
                            <input type="text" id="session-name" name="session_name" placeholder="Session Name">
                            <p class="error-message">Session Name cannot be empty</p>
                        </div>

                        <div class="form-group">
                            <label for="company-name">Company Name</label>
                            <select id="company-name" name="company_name">
                                <option value="">Select Company</option>
                                <?php 
                                    foreach($companyData as $company){
                                        echo "<option value='{$company->CompanyId}'>{$company->Name}</option>";
                                    }
                                ?>
                            </select>
                            <p class="error-message">Company Name cannot be empty</p>
                        </div>

                        <div class="form-group" style="display: none;">
                            <input type="text" name="CompanyId" id="company-id">
                        </div>

                        <div class="form-group">
                            <label for="email-address">Email Address</label>
                            <input type="email" id="email-address" name="email" placeholder="Company Email">
                            <p class="error-message">Email cannot be empty</p>

                        </div>

                        <div class="form-group">
                            <label for="contact-person">Contact Person</label>
                            <input type="text" id="contact-person" name="contact_person" placeholder="Contact Person">
                            <p class="error-message">Contact Person cannot be empty</p>
                        </div>

                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="text" id="contact-number" name="contact_number" placeholder="Contact Number" 
                                >
                            <small class="format-hint">Enter a valid phone number (e.g. 0733333333)</small>
                            <p class="error-message basic">Contact Number cannot be empty</p>
                            <p class="error-message pattern">Contact Number not in valid pattern</p>
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
                                >

                            <p class="error-message">Session Date cannot be empty</p>

                        </div>

                        <div class="form-group">
                            <label for="time-slot">Time Slot</label>
                            <select id="time-slot" name="time_slot">
                            </select>
                            <p class="error-message">Time Slot cannot be empty</p>
                        </div>

                        <div class="form-group">
                            <label for="hall-number">Hall Name</label>
                            <select id="hall-number" name="hall_number">
                            </select>
                            <p class="error-message">Hall Name cannot be empty</p>
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

            console.log(companyData);

            const allTimeSlots = [
                            "9:00 AM - 11:00 AM",
                            "11:00 AM - 1:00 PM",
                            "1:00 PM - 3:00 PM",
                            "3:00 PM - 5:00 PM"
                        ];

            const allHalls = ["W001", "S104", "S202" ,"W004"];



            companyName.addEventListener("change", function(){
                const selectedCom = this.value;
                //console.log(companyName.value);
                //console.log(selectedCom);
                const selectedCompany = companyData.find(c => c.CompanyId == companyName.value);
                //console.log(selectedCompany);
                if(selectedCompany){
                    companyId.value = selectedCompany.CompanyId;
                    email.value = selectedCompany.Email;
                    contactPerson.value = selectedCompany.ContactPerson;
                    contactNumber.value = selectedCompany.ContactNum;
                }
                
            })

            // hallname.addEventListener("change", function () {
            //     const selectedHall = this.value;

            //     fetch(`<?= ROOT ?>/PDC_admin/AddSession/GetAvailability?type=hall&value=${selectedHall}`)
            //         .then(response => response.json())
            //         .then(data => {
            //             console.log("Fetched data:", data);

            //             const timeSlotSelect = document.getElementById("time-slot");
            //             const dateSelect = document.getElementById('session-date');
            //             dateSelect.value = "";
            //             timeSlotSelect.value = "";
            //             timeSlotSelect.innerHTML = '<option value="" >Select Time Slot</option>';

            //             const unavailableTimeSlots = data.map(item => item.time_slot);

            //             const availableTimeSlots = allTimeSlots.filter(slot => !unavailableTimeSlots.includes(slot));

            //             availableTimeSlots.forEach(slot => {
            //                 const option = document.createElement("option");
            //                 option.value = slot;
            //                 option.textContent = slot;
            //                 timeSlotSelect.appendChild(option);
            //             });
            //         })
            //         .catch(error => {
            //             console.error("Error fetching availability:", error);
            //         });
            // });


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


            const sessionform = document.querySelector('.company-form')

            sessionform.addEventListener('submit' , function(e){

                let haserror = false

                const errors = document.querySelectorAll('.error-message');
                errors.forEach(msg => msg.style.display = 'none');

                function showError(fieldId) {
                    const field = document.getElementById(fieldId)
                    const errorMsg = field.closest('.form-group').querySelector('.error-message')
                    if (errorMsg) errorMsg.style.display = 'block'
                    return true
                }

                if (document.getElementById('session-name').value.trim() === "") {
                    haserror = showError('session-name')
                }

                if(document.getElementById('company-name').value.trim() === ""){
                    haserror = showError('company-name')
                }

                if (document.getElementById('email-address').value.trim() === "") {
                    haserror = showError('email-address')
                }

                if (document.getElementById('contact-person').value.trim() === "") {
                    haserror = showError('contact-person')
                }

                if (document.getElementById('session-date').value.trim() === "") {
                    haserror = showError('session-date')
                }

                if (document.getElementById('time-slot').value.trim() === "") {
                    haserror = showError('time-slot')
                }

                if (document.getElementById('hall-number').value.trim() === "") {
                    haserror = showError('hall-number')
                }

                const number = document.getElementById('contact-number')
                const numberValue = number.value.trim()
                if (numberValue === "") {
                    number.closest('.form-group').querySelector('.error-message.basic').style.display = 'block'
                    haserror = true
                } else if (!/^\d{10}$/.test(numberValue)) {
                    number.closest('.form-group').querySelector('.error-message.pattern').style.display = 'block'
                    haserror = true
                }

                if (haserror) {
                    e.preventDefault()
                }

            })





        })

    </script>
</body>
</html>