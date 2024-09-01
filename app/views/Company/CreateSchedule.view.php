<div>
    <div class="d">
        <div class="d_topic">
            <h1>Schedule</h1>
        </div>
        <div class="d_pro">
            <div>
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div>
                <i class="fas fa-bell"></i>
            </div>
            <div>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>
    </div>
    <div class="sc_main">
        <div class="sc">
            <div class="sc_container">
                <i class="fas fa-chevron-left"></i>
                <h3>Create Interview Schedule</h3>
            </div>
        </div>
        <div class="sc_background">
            <div class="sc_iner">
                <div class="sc_pos">
                    <h4>Position:</h4>
                    <select id="position">
                        <option value="qa">Quality Assurance</option>
                        <option value="se">Software Engineer</option>
                        <option value="wd">Wed Developer</option>
                    </select>
                </div>
                <div class="sc_dateNdur">
                    <div class="sc_date">
                        <h4>Date Period:</h4>
                        <input type="date" />
                        <p>-</p>
                        <input type="date" />
                    </div>
                    <div class="sc_dur">
                        <h4>Interview Duration:</h4>
                        <select id="duration">
                            <option value="15">15 min</option>
                            <option value="30">30 min</option>
                            <option value="45">45 min</option>
                        </select>
                    </div>
                </div>
                <div class="sc_time">
                    <h4>Select the Day</h4>
                    <button class="sc_tbtn" id="add-time-slot" onclick="addTimeSlot()">
                        <i class="fas fa-plus"></i>
                        <p>Time Slots</p>
                    </button>
                </div>
                <div id="time-slots-container" class="sc_time-slots">
                    <div class="time-slot">
                        <input type="date">
                        <input type="time">
                        <input type="time">
                        <button ></button>
                    </div>
                </div>
                <div class="sc_btn">
                    <button type="submit" class="sc_btn">
                        Submit
                    </button>
                </div>
            </div>
        </div>



    </div>
</div>
<script>
    function addTimeSlot() {
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
</script>