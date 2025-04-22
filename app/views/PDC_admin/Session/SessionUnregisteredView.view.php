<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Details | PDC Admin</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/session/viewUnregSession.css">
    
</head>

<body>
    <?php 
        if (isset($_SESSION['flash_message'])): 
            $message = htmlspecialchars($_SESSION['flash_message']['message']);
            $type = htmlspecialchars($_SESSION['flash_message']['type']);
            unset($_SESSION['flash_message']);
        ?>
        <script>
            window.__flashMessage = {
                message: "<?= $message ?>",
                type: "<?= $type ?>"
            };
        </script>
    <?php endif; ?>
    
    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>

        <main class="content">
            <header class="header">
                <div class="header-left">
                    <h1><i class="fas fa-calendar-alt"></i> Session Details</h1>
                </div>
            </header>

            <div class="meta-container">
                <div class="meta-item">
                    <i class="fas fa-id-badge"></i>
                    <span>Session ID: <?= htmlspecialchars($session->session_id) ?></span>
                </div>
                <div class="meta-item">
                    <span class="validity" id="check-date"></span>
                </div>
            </div>

            <div class="tabs">
                <button class="tab-btn active" data-tab="sessionInfo">
                    <i class="fas fa-info-circle"></i> Session Information
                </button>
                <button class="tab-btn" data-tab="companyInfo">
                    <i class="fas fa-building"></i> Company Details
                </button>
            </div>

            <div class="tab-content active" id="sessionInfo">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-info-circle"></i> Session Overview</h2>
                    </div>

                    <div class="card-body">
                        <div class="detail-item" style="grid-column: 1 / -1;">
                            <div class="detail-label">Description</div>
                            <div class="detail-value"><?= htmlspecialchars($session->description) ?></div>
                        </div>

                        <div class="details-grid">
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Date</div>
                                    <div class="detail-value"><?= date('F j, Y', strtotime($session->session_date)) ?></div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">Time Slot</div>
                                    <div class="detail-value"><?= htmlspecialchars($session->time_slot) ?></div>
                                </div>
                            </div>
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Venue</div>
                                    <div class="detail-value">
                                        <?= htmlspecialchars($session->hall_number) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">
                            <i class="fas fa-arrow-left"></i> Back to Sessions
                        </button>
                        <div class="card-actions" id="session-actions">
                            <button type="button" class="btn btn-outline" id="edit-toggle-btn">
                                <i class="fas fa-edit"></i> Edit Session
                            </button>
                            <button type="button" class="btn btn-danger" id="delete-btn">
                                <i class="fas fa-trash-alt"></i> Delete Session
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="companyInfo">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-building"></i> Company Information</h2>
                    </div>

                    <div style="display: flex; gap: 1.5rem; margin: 1.5rem;">
                        <div class="avatar" style="background: linear-gradient(135deg, #d1fae5 0%, #6ee7b7 100%); color: #065f46;">
                            <?= substr(htmlspecialchars($session->other_company_name), 0, 1) ?>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #065f46;">
                                <?= htmlspecialchars($session->other_company_name) ?>
                            </h3>
                            <p style="color: var(--gray); font-size: 0.9rem;">
                                ID: NONE
                            </p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="details-grid">
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact Person</div>
                                    <div class="detail-value"><?= htmlspecialchars($session->contact_person) ?></div>
                                </div>
                            </div>
                            <div>
                                <div class="detail-item">
                                    <div class="detail-label">Contact Information</div>
                                    <div class="detail-value">
                                        <i class="fas fa-phone"></i> <?= htmlspecialchars($session->contact_number) ?><br>
                                        <i class="fas fa-envelope"></i> <?= htmlspecialchars($session->email) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="delete-modal">
    <div class="delete-modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <form id="delete-form" method="post" action="<?= ROOT ?>/PDC_admin/ViewSession/removeUnregistered">
            <input type="hidden" name="session_id" id="session-id" value="">
            <input type="hidden" name="email" id="email" value="<?= htmlspecialchars($session->email) ?>">
            <div class="delete-modal-header">
                <h3>Delete Session</h3>
            </div>
            <div class="delete-modal-body">
                <p>Please provide a reason for deletion. This message will be sent to the company's email.</p>
                <div class="modal-message">
                    <i class="fas fa-info-circle"></i>
                    <span>Are you sure you want to delete this session? This action cannot be undone.</span>
                </div>
                <div class="form-group">
                    <label for="delete-reason">Reason for Deletion</label>
                    <textarea id="delete-reason" name="delete_reason" class="form-textarea" placeholder="Enter your reason here..." required></textarea>
                    <p id="modal-message" style="color: red; margin-top: 10px;"></p>
                </div>
            </div>
            <div class="delete-modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Session</button>
            </div>
        </form>
    </div>
</div>

    <!-- Update Session Modal -->
    <div id="update-modal" class="update-modal">
        <div class="update-modal-content">
            <div class="update-modal-header">
                <h3><i class="fas fa-edit"></i> Update Session Details</h3>
                <span class="close" onclick="closeUpdateModal()">&times;</span>
            </div>
            <div class="update-modal-body">
                <form id="sessionUpdateForm" method="post" action="<?= ROOT ?>/PDC_admin/ViewSession/editUnreg/<?= htmlspecialchars($session->session_id) ?>">
                    
                    <div class="form-group">
                        <label for="session-name" class="form-label">Session Name</label>
                        <input type="text" id="session-name" name="session_name" placeholder="Session Name" 
                            value="<?= htmlspecialchars($session->session_name) ?>" 
                        required>
                    </div>

                    <div class="form-group" style="display: none;">
                        <input type="text" name="session_id" id="session-id" 
                            value="<?= htmlspecialchars($session->session_id) ?>"
                        >
                    </div>

                    <div class="form-group" style="display: none;">
                        <input type="text" name="email" id="company-email" 
                            value="<?= htmlspecialchars($session->email) ?>"
                        >
                    </div>

                    <div class="form-group" style="display: none;">
                        <input type="text" name="contact_number" id="contact-number" 
                            value="<?= htmlspecialchars($session->contact_number) ?>"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Session Description</label>
                        <textarea id="description" name="description" class="form-control form-textarea"><?= !empty($session->description) ? htmlspecialchars($session->description) : '' ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="session-date" class="form-label">Session Date</label>
                            <input type="date"
                                id="session-date" 
                                name="session_date" 
                                placeholder="Session Date"
                                min="<?= date('Y-m-d') ?>" 
                                required>
                        </div>

                        <div class="form-group">
                            <label for="time" class="form-label">Time Slot</label>
                            <select id="time-slot" name="time_slot" 
                                value="<?= htmlspecialchars($session->time_slot) ?>"
                                required>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="hall-number" class="form-label">Hall Name</label>
                            <select id="hall-number" name="hall_number" 
                                value="<?= htmlspecialchars($session->hall_number) ?>"
                                required>
                            </select>
                        </div>
                    </div>
                    
                    <div class="update-modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeUpdateModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/toast.js"></script>


    <script>

        function closeDeleteModal(){
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('show');
            document.getElementById('delete-reason').value = '';
            document.getElementById('modal-message').innerText = '';
        }

        function closeUpdateModal() {
            const modal = document.getElementById('update-modal');
            modal.classList.remove('active');
        }

        const deletebtn = document.getElementById('delete-btn');
        const updateBtn = document.getElementById('edit-toggle-btn');
            
        deletebtn.addEventListener('click', function() {
            const sessionId = <?= json_encode($session->session_id) ?>;
            document.getElementById('session-id').value = sessionId;
            document.getElementById('delete-modal').classList.add('show');
        });

        updateBtn.addEventListener('click', function() {
            document.getElementById('update-modal').classList.add('active');
        });


        document.addEventListener('DOMContentLoaded', function() {

            const actions = document.getElementById('session-actions');
            const sessionDate = new Date("<?= $session->session_date ?>");
            const currentDate = new Date();

            if(sessionDate < currentDate){
                actions.style.display = 'none';
            } else {
                actions.style.display = 'flex';
            }

            // Tab functionality
            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all buttons and content
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
                    
                    // Add active class to clicked button and corresponding content
                    btn.classList.add('active');
                    const tabId = btn.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });

            const hallname = document.getElementById('hall-number');
            const timeslot = document.getElementById('time-slot');
            const date = document.getElementById('session-date');

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

            
        });
    </script>
</body>
</html>