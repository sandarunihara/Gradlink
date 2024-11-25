<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/SendAdvertisements.css">
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
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="full-s">
                    <div class="main_container">
                        <a href="../dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h5>BACK</h5>
                        </a>
                        <div class="sub_container">
                            <?php if (isset($data) && !empty($data)): ?>
                                <div class="display-details">
                                    <div class="image">
                                        <?php if (!empty($data[0]->image)): ?>
                                            <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                                        <?php else: ?>
                                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="inform">
                                        <div>
                                            <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                                            <!-- <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4> -->
                                            <h4>No of interns:<span><?php echo $data[0]->numOfInterns ?></span></h4>
                                            <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                                            <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                                        </div>
                                        <div class="ed-del">
                                            <?php if ($data[0]->status === 'Active'): ?>
                                                <i class="fas fa-pen"
                                                    data-position="<?php echo htmlspecialchars($data[0]->position, ENT_QUOTES) ?>"
                                                    data-description="<?php echo htmlspecialchars($data[0]->description, ENT_QUOTES) ?>"
                                                    data-qualification="<?php echo htmlspecialchars($data[0]->qualification, ENT_QUOTES) ?>"
                                                    data-deadline="<?php echo htmlspecialchars($data[0]->deadline, ENT_QUOTES) ?>"
                                                    data-interns="<?php echo htmlspecialchars($data[0]->numOfInterns, ENT_QUOTES) ?>"
                                                    data-workingmode="<?php echo htmlspecialchars($data[0]->workingMode, ENT_QUOTES) ?>"
                                                    data-image="<?php echo htmlspecialchars($data[0]->image, ENT_QUOTES) ?>"
                                                    onclick="openConfirmationModal(this)">
                                                </i>
                                            <?php endif; ?>
                                            <i class="fas fa-trash" onclick="openconfirmdeleteModal()"></i>

                                        </div>
                                    </div>
                                </div>
                                <div class="Qua-des">
                                    <div class="Qualifications">
                                        <h4>Qualification:</h4>
                                        <div class="q-details">
                                            <p><?php echo $data[0]->qualification ?></p>
                                        </div>
                                    </div>

                                    <div class="Description">
                                        <h4>Description:</h4>
                                        <div class="d-details">
                                            <p><?php echo $data[0]->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <form id="ad-form" class="supersub_container" method="POST" enctype="multipart/form-data" action="">
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
                        <textarea
                            name="description"
                            id="description"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                    <div>
                        <h4>Qualifications:</h4>
                        <textarea
                            name="qualification"
                            id="qualification"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                </div>
                <div class="perioddeadline">
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
                            <input
                                type="text"
                                id="numOfInterns"
                                name="numOfInterns"
                                value="5"
                                readonly
                                required />
                            <button class="sbtn" type="button" onclick="increment()">+</button>
                        </div>
                    </div>
                    <div class="position">
                        <h4>Work type:</h4>
                        <select id="workingMode" name="workingMode" required>
                            <option value="Remote">Remote</option>
                            <option value="Onsite">Onsite</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>
                </div>
                <div class="addimg">
                    <label for="image" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Change an Image
                    </label>
                    <input type="file" id="image" name="image" required />
                    <span id="file-name"></span>
                </div>
                <div class="sc_btn">
                    <button class="cancel_btn" onclick="closeConfirmationModal()">
                        Cancel
                    </button>
                    <button type="submit" class="sub_btn" onclick="validateAndShowModal(event)">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Update the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="submitForm()">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmupdateModal()">No</button>
            </div>
        </div>
    </div>

    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Delete the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmDelete('<?php echo $data[0]->advertisementId; ?>')">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmdeleteModal()">No</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        // Increment and decrement the number of interns
        function increment() {
            let count = document.getElementById('numOfInterns').value;
            count = parseInt(count) + 1;
            document.getElementById('numOfInterns').value = count;
        }

        function decrement() {
            let count = document.getElementById('numOfInterns').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('numOfInterns').value = count;
            }
        }

        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualification = document.getElementById('qualification').value;
            const deadline = document.getElementById('deadline').value;
            const numOfInterns = document.getElementById('numOfInterns').value;
            const workingMode = document.getElementById('workingMode').value;
            // image is not in the script

            if (!position || !description || !qualification || !deadline || !numOfInterns || !workingMode) {
                errorToast("Please fill in all required fields.");
                return;
            }
            // Show confirmation modal if form is valid
            openconfirmupdateModal()
        }

        function openConfirmationModal(element) {
            const position = element.dataset.position;
            const description = element.dataset.description;
            const qualification = element.dataset.qualification;
            const deadline = element.dataset.deadline;
            const numOfInterns = element.dataset.interns;
            const workingMode = element.dataset.workingmode;
            const image = element.dataset.image;
            // console.log(image);


            // Now populate the modal fields
            document.getElementById('position').value = position;
            document.getElementById('description').value = description;
            document.getElementById('qualification').value = qualification;
            document.getElementById('deadline').value = deadline;
            document.getElementById('numOfInterns').value = numOfInterns;
            document.getElementById('workingMode').value = workingMode;

            // Show the file name when a file is selected
            document.getElementById('image').addEventListener('change', function() {
                const fileName = this.files[0]?.name || '';
                document.getElementById('file-name').textContent = fileName;
            });


            const modal = document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

        }

        function submitForm() {
            document.getElementById('ad-form').submit();
            successToast("Advertisement updated successfully");
        }


        // Get the modal popup for confirm update

        function openconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'none';
        }

        // Get the modal popup for confirm delete
        function openconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }

        function confirmDelete(id) {
            window.location.href = '../delete/' + id;
            successToast("Advertisement deleted successfully");
        }
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/SendAdvertisements.css">
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
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="full-s">
                    <div class="main_container">
                        <a href="../dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h5>BACK</h5>
                        </a>
                        <div class="sub_container">
                            <?php if (isset($data) && !empty($data)): ?>
                                <div class="display-details">
                                    <div class="image">
                                        <?php if (!empty($data[0]->image)): ?>
                                            <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                                        <?php else: ?>
                                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="inform">
                                        <div>
                                            <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                                            <!-- <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4> -->
                                            <h4>No of interns:<span><?php echo $data[0]->numOfInterns ?></span></h4>
                                            <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                                            <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                                        </div>
                                        <div class="ed-del">
                                            <?php if ($data[0]->status === 'Active'): ?>
                                                <i class="fas fa-pen"
                                                    data-position="<?php echo htmlspecialchars($data[0]->position, ENT_QUOTES) ?>"
                                                    data-description="<?php echo htmlspecialchars($data[0]->description, ENT_QUOTES) ?>"
                                                    data-qualification="<?php echo htmlspecialchars($data[0]->qualification, ENT_QUOTES) ?>"
                                                    data-deadline="<?php echo htmlspecialchars($data[0]->deadline, ENT_QUOTES) ?>"
                                                    data-interns="<?php echo htmlspecialchars($data[0]->numOfInterns, ENT_QUOTES) ?>"
                                                    data-workingmode="<?php echo htmlspecialchars($data[0]->workingMode, ENT_QUOTES) ?>"
                                                    data-image="<?php echo htmlspecialchars($data[0]->image, ENT_QUOTES) ?>"
                                                    onclick="openConfirmationModal(this)">
                                                </i>
                                            <?php endif; ?>
                                            <i class="fas fa-trash" onclick="openconfirmdeleteModal()"></i>

                                        </div>
                                    </div>
                                </div>
                                <div class="Qua-des">
                                    <div class="Qualifications">
                                        <h4>Qualification:</h4>
                                        <div class="q-details">
                                            <p><?php echo $data[0]->qualification ?></p>
                                        </div>
                                    </div>

                                    <div class="Description">
                                        <h4>Description:</h4>
                                        <div class="d-details">
                                            <p><?php echo $data[0]->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <form id="ad-form" class="supersub_container" method="POST" enctype="multipart/form-data" action="">
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
                        <textarea
                            name="description"
                            id="description"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                    <div>
                        <h4>Qualifications:</h4>
                        <textarea
                            name="qualification"
                            id="qualification"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                </div>
                <div class="perioddeadline">
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
                            <input
                                type="text"
                                id="numOfInterns"
                                name="numOfInterns"
                                value="5"
                                readonly
                                required />
                            <button class="sbtn" type="button" onclick="increment()">+</button>
                        </div>
                    </div>
                    <div class="position">
                        <h4>Work type:</h4>
                        <select id="workingMode" name="workingMode" required>
                            <option value="Remote">Remote</option>
                            <option value="Onsite">Onsite</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>
                </div>
                <div class="addimg">
                    <label for="image" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Change an Image
                    </label>
                    <input type="file" id="image" name="image" required />
                    <span id="file-name"></span>
                </div>
                <div class="sc_btn">
                    <button class="cancel_btn" onclick="closeConfirmationModal()">
                        Cancel
                    </button>
                    <button type="submit" class="sub_btn" onclick="validateAndShowModal(event)">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Update the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="submitForm()">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmupdateModal()">No</button>
            </div>
        </div>
    </div>

    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Delete the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmDelete('<?php echo $data[0]->advertisementId; ?>')">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmdeleteModal()">No</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        // Increment and decrement the number of interns
        function increment() {
            let count = document.getElementById('numOfInterns').value;
            count = parseInt(count) + 1;
            document.getElementById('numOfInterns').value = count;
        }

        function decrement() {
            let count = document.getElementById('numOfInterns').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('numOfInterns').value = count;
            }
        }

        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualification = document.getElementById('qualification').value;
            const deadline = document.getElementById('deadline').value;
            const numOfInterns = document.getElementById('numOfInterns').value;
            const workingMode = document.getElementById('workingMode').value;
            // image is not in the script

            if (!position || !description || !qualification || !deadline || !numOfInterns || !workingMode) {
                errorToast("Please fill in all required fields.");
                return;
            }
            // Show confirmation modal if form is valid
            openconfirmupdateModal()
        }

        function openConfirmationModal(element) {
            const position = element.dataset.position;
            const description = element.dataset.description;
            const qualification = element.dataset.qualification;
            const deadline = element.dataset.deadline;
            const numOfInterns = element.dataset.interns;
            const workingMode = element.dataset.workingmode;
            const image = element.dataset.image;
            // console.log(image);


            // Now populate the modal fields
            document.getElementById('position').value = position;
            document.getElementById('description').value = description;
            document.getElementById('qualification').value = qualification;
            document.getElementById('deadline').value = deadline;
            document.getElementById('numOfInterns').value = numOfInterns;
            document.getElementById('workingMode').value = workingMode;

            // Show the file name when a file is selected
            document.getElementById('image').addEventListener('change', function() {
                const fileName = this.files[0]?.name || '';
                document.getElementById('file-name').textContent = fileName;
            });


            const modal = document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

        }

        function submitForm() {
            document.getElementById('ad-form').submit();
            successToast("Advertisement updated successfully");
        }


        // Get the modal popup for confirm update

        function openconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'none';
        }

        // Get the modal popup for confirm delete
        function openconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }

        function confirmDelete(id) {
            window.location.href = '../delete/' + id;
            successToast("Advertisement deleted successfully");
        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/SendAdvertisements.css">
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
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="full-s">
                    <div class="main_container">
                        <a href="../dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h5>BACK</h5>
                        </a>
                        <div class="sub_container">
                            <?php if (isset($data) && !empty($data)): ?>
                                <div class="display-details">
                                    <div class="image">
                                        <?php if (!empty($data[0]->image)): ?>
                                            <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                                        <?php else: ?>
                                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="inform">
                                        <div>
                                            <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                                            <!-- <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4> -->
                                            <h4>No of interns:<span><?php echo $data[0]->numOfInterns ?></span></h4>
                                            <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                                            <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                                        </div>
                                        <div class="ed-del">
                                            <?php if ($data[0]->status === 'Active'): ?>
                                                <i class="fas fa-pen"
                                                    data-position="<?php echo htmlspecialchars($data[0]->position, ENT_QUOTES) ?>"
                                                    data-description="<?php echo htmlspecialchars($data[0]->description, ENT_QUOTES) ?>"
                                                    data-qualification="<?php echo htmlspecialchars($data[0]->qualification, ENT_QUOTES) ?>"
                                                    data-deadline="<?php echo htmlspecialchars($data[0]->deadline, ENT_QUOTES) ?>"
                                                    data-interns="<?php echo htmlspecialchars($data[0]->numOfInterns, ENT_QUOTES) ?>"
                                                    data-workingmode="<?php echo htmlspecialchars($data[0]->workingMode, ENT_QUOTES) ?>"
                                                    data-image="<?php echo htmlspecialchars($data[0]->image, ENT_QUOTES) ?>"
                                                    onclick="openConfirmationModal(this)">
                                                </i>
                                            <?php endif; ?>
                                            <i class="fas fa-trash" onclick="openconfirmdeleteModal()"></i>

                                        </div>
                                    </div>
                                </div>
                                <div class="Qua-des">
                                    <div class="Qualifications">
                                        <h4>Qualification:</h4>
                                        <div class="q-details">
                                            <p><?php echo $data[0]->qualification ?></p>
                                        </div>
                                    </div>

                                    <div class="Description">
                                        <h4>Description:</h4>
                                        <div class="d-details">
                                            <p><?php echo $data[0]->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <form id="ad-form" class="supersub_container" method="POST" enctype="multipart/form-data" action="">
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
                        <textarea
                            name="description"
                            id="description"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                    <div>
                        <h4>Qualifications:</h4>
                        <textarea
                            name="qualification"
                            id="qualification"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                </div>
                <div class="perioddeadline">
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
                            <input
                                type="text"
                                id="numOfInterns"
                                name="numOfInterns"
                                value="5"
                                readonly
                                required />
                            <button class="sbtn" type="button" onclick="increment()">+</button>
                        </div>
                    </div>
                    <div class="position">
                        <h4>Work type:</h4>
                        <select id="workingMode" name="workingMode" required>
                            <option value="Remote">Remote</option>
                            <option value="Onsite">Onsite</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>
                </div>
                <div class="addimg">
                    <label for="image" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Change an Image
                    </label>
                    <input type="file" id="image" name="image" required />
                    <span id="file-name"></span>
                </div>
                <div class="sc_btn">
                    <button class="cancel_btn" onclick="closeConfirmationModal()">
                        Cancel
                    </button>
                    <button type="submit" class="sub_btn" onclick="validateAndShowModal(event)">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Update the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="submitForm()">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmupdateModal()">No</button>
            </div>
        </div>
    </div>

    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Delete the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmDelete('<?php echo $data[0]->advertisementId; ?>')">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmdeleteModal()">No</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        // Increment and decrement the number of interns
        function increment() {
            let count = document.getElementById('numOfInterns').value;
            count = parseInt(count) + 1;
            document.getElementById('numOfInterns').value = count;
        }

        function decrement() {
            let count = document.getElementById('numOfInterns').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('numOfInterns').value = count;
            }
        }

        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualification = document.getElementById('qualification').value;
            const deadline = document.getElementById('deadline').value;
            const numOfInterns = document.getElementById('numOfInterns').value;
            const workingMode = document.getElementById('workingMode').value;
            // image is not in the script

            if (!position || !description || !qualification || !deadline || !numOfInterns || !workingMode) {
                errorToast("Please fill in all required fields.");
                return;
            }
            // Show confirmation modal if form is valid
            openconfirmupdateModal()
        }

        function openConfirmationModal(element) {
            const position = element.dataset.position;
            const description = element.dataset.description;
            const qualification = element.dataset.qualification;
            const deadline = element.dataset.deadline;
            const numOfInterns = element.dataset.interns;
            const workingMode = element.dataset.workingmode;
            const image = element.dataset.image;
            // console.log(image);


            // Now populate the modal fields
            document.getElementById('position').value = position;
            document.getElementById('description').value = description;
            document.getElementById('qualification').value = qualification;
            document.getElementById('deadline').value = deadline;
            document.getElementById('numOfInterns').value = numOfInterns;
            document.getElementById('workingMode').value = workingMode;

            // Show the file name when a file is selected
            document.getElementById('image').addEventListener('change', function() {
                const fileName = this.files[0]?.name || '';
                document.getElementById('file-name').textContent = fileName;
            });


            const modal = document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

        }

        function submitForm() {
            document.getElementById('ad-form').submit();
            successToast("Advertisement updated successfully");
        }


        // Get the modal popup for confirm update

        function openconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'none';
        }

        // Get the modal popup for confirm delete
        function openconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }

        function confirmDelete(id) {
            window.location.href = '../delete/' + id;
            successToast("Advertisement deleted successfully");
        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/SendAdvertisements.css">
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
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="full-s">
                    <div class="main_container">
                        <a href="../dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h5>BACK</h5>
                        </a>
                        <div class="sub_container">
                            <?php if (isset($data) && !empty($data)): ?>
                                <div class="display-details">
                                    <div class="image">
                                        <?php if (!empty($data[0]->image)): ?>
                                            <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                                        <?php else: ?>
                                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="inform">
                                        <div>
                                            <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                                            <!-- <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4> -->
                                            <h4>No of interns:<span><?php echo $data[0]->numOfInterns ?></span></h4>
                                            <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                                            <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                                        </div>
                                        <div class="ed-del">
                                            <?php if ($data[0]->status === 'Active'): ?>
                                                <i class="fas fa-pen"
                                                    data-position="<?php echo htmlspecialchars($data[0]->position, ENT_QUOTES) ?>"
                                                    data-description="<?php echo htmlspecialchars($data[0]->description, ENT_QUOTES) ?>"
                                                    data-qualification="<?php echo htmlspecialchars($data[0]->qualification, ENT_QUOTES) ?>"
                                                    data-deadline="<?php echo htmlspecialchars($data[0]->deadline, ENT_QUOTES) ?>"
                                                    data-interns="<?php echo htmlspecialchars($data[0]->numOfInterns, ENT_QUOTES) ?>"
                                                    data-workingmode="<?php echo htmlspecialchars($data[0]->workingMode, ENT_QUOTES) ?>"
                                                    data-image="<?php echo htmlspecialchars($data[0]->image, ENT_QUOTES) ?>"
                                                    onclick="openConfirmationModal(this)">
                                                </i>
                                            <?php endif; ?>
                                            <i class="fas fa-trash" onclick="openconfirmdeleteModal()"></i>

                                        </div>
                                    </div>
                                </div>
                                <div class="Qua-des">
                                    <div class="Qualifications">
                                        <h4>Qualification:</h4>
                                        <div class="q-details">
                                            <p><?php echo $data[0]->qualification ?></p>
                                        </div>
                                    </div>

                                    <div class="Description">
                                        <h4>Description:</h4>
                                        <div class="d-details">
                                            <p><?php echo $data[0]->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <form id="ad-form" class="supersub_container" method="POST" enctype="multipart/form-data" action="">
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
                        <textarea
                            name="description"
                            id="description"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                    <div>
                        <h4>Qualifications:</h4>
                        <textarea
                            name="qualification"
                            id="qualification"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                </div>
                <div class="perioddeadline">
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
                            <input
                                type="text"
                                id="numOfInterns"
                                name="numOfInterns"
                                value="5"
                                readonly
                                required />
                            <button class="sbtn" type="button" onclick="increment()">+</button>
                        </div>
                    </div>
                    <div class="position">
                        <h4>Work type:</h4>
                        <select id="workingMode" name="workingMode" required>
                            <option value="Remote">Remote</option>
                            <option value="Onsite">Onsite</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>
                </div>
                <div class="addimg">
                    <label for="image" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Change an Image
                    </label>
                    <input type="file" id="image" name="image" required />
                    <span id="file-name"></span>
                </div>
                <div class="sc_btn">
                    <button class="cancel_btn" onclick="closeConfirmationModal()">
                        Cancel
                    </button>
                    <button type="submit" class="sub_btn" onclick="validateAndShowModal(event)">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Update the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="submitForm()">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmupdateModal()">No</button>
            </div>
        </div>
    </div>

    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Delete the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmDelete('<?php echo $data[0]->advertisementId; ?>')">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmdeleteModal()">No</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        // Increment and decrement the number of interns
        function increment() {
            let count = document.getElementById('numOfInterns').value;
            count = parseInt(count) + 1;
            document.getElementById('numOfInterns').value = count;
        }

        function decrement() {
            let count = document.getElementById('numOfInterns').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('numOfInterns').value = count;
            }
        }

        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualification = document.getElementById('qualification').value;
            const deadline = document.getElementById('deadline').value;
            const numOfInterns = document.getElementById('numOfInterns').value;
            const workingMode = document.getElementById('workingMode').value;
            // image is not in the script

            if (!position || !description || !qualification || !deadline || !numOfInterns || !workingMode) {
                errorToast("Please fill in all required fields.");
                return;
            }
            // Show confirmation modal if form is valid
            openconfirmupdateModal()
        }

        function openConfirmationModal(element) {
            const position = element.dataset.position;
            const description = element.dataset.description;
            const qualification = element.dataset.qualification;
            const deadline = element.dataset.deadline;
            const numOfInterns = element.dataset.interns;
            const workingMode = element.dataset.workingmode;
            const image = element.dataset.image;
            // console.log(image);


            // Now populate the modal fields
            document.getElementById('position').value = position;
            document.getElementById('description').value = description;
            document.getElementById('qualification').value = qualification;
            document.getElementById('deadline').value = deadline;
            document.getElementById('numOfInterns').value = numOfInterns;
            document.getElementById('workingMode').value = workingMode;

            // Show the file name when a file is selected
            document.getElementById('image').addEventListener('change', function() {
                const fileName = this.files[0]?.name || '';
                document.getElementById('file-name').textContent = fileName;
            });


            const modal = document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

        }

        function submitForm() {
            document.getElementById('ad-form').submit();
            successToast("Advertisement updated successfully");
        }


        // Get the modal popup for confirm update

        function openconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'none';
        }

        // Get the modal popup for confirm delete
        function openconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }

        function confirmDelete(id) {
            window.location.href = '../delete/' + id;
            successToast("Advertisement deleted successfully");
        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/SendAdvertisements.css">
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
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="full-s">
                    <div class="main_container">
                        <a href="../dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h5>BACK</h5>
                        </a>
                        <div class="sub_container">
                            <?php if (isset($data) && !empty($data)): ?>
                                <div class="display-details">
                                    <div class="image">
                                        <?php if (!empty($data[0]->image)): ?>
                                            <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                                        <?php else: ?>
                                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="inform">
                                        <div>
                                            <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                                            <!-- <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4> -->
                                            <h4>No of interns:<span><?php echo $data[0]->numOfInterns ?></span></h4>
                                            <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                                            <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                                        </div>
                                        <div class="ed-del">
                                            <?php if ($data[0]->status === 'Active'): ?>
                                                <i class="fas fa-pen"
                                                    data-position="<?php echo htmlspecialchars($data[0]->position, ENT_QUOTES) ?>"
                                                    data-description="<?php echo htmlspecialchars($data[0]->description, ENT_QUOTES) ?>"
                                                    data-qualification="<?php echo htmlspecialchars($data[0]->qualification, ENT_QUOTES) ?>"
                                                    data-deadline="<?php echo htmlspecialchars($data[0]->deadline, ENT_QUOTES) ?>"
                                                    data-interns="<?php echo htmlspecialchars($data[0]->numOfInterns, ENT_QUOTES) ?>"
                                                    data-workingmode="<?php echo htmlspecialchars($data[0]->workingMode, ENT_QUOTES) ?>"
                                                    data-image="<?php echo htmlspecialchars($data[0]->image, ENT_QUOTES) ?>"
                                                    onclick="openConfirmationModal(this)">
                                                </i>
                                            <?php endif; ?>
                                            <i class="fas fa-trash" onclick="openconfirmdeleteModal()"></i>

                                        </div>
                                    </div>
                                </div>
                                <div class="Qua-des">
                                    <div class="Qualifications">
                                        <h4>Qualification:</h4>
                                        <div class="q-details">
                                            <p><?php echo $data[0]->qualification ?></p>
                                        </div>
                                    </div>

                                    <div class="Description">
                                        <h4>Description:</h4>
                                        <div class="d-details">
                                            <p><?php echo $data[0]->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <form id="ad-form" class="supersub_container" method="POST" enctype="multipart/form-data" action="">
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
                        <textarea
                            name="description"
                            id="description"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                    <div>
                        <h4>Qualifications:</h4>
                        <textarea
                            name="qualification"
                            id="qualification"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                </div>
                <div class="perioddeadline">
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
                            <input
                                type="text"
                                id="numOfInterns"
                                name="numOfInterns"
                                value="5"
                                readonly
                                required />
                            <button class="sbtn" type="button" onclick="increment()">+</button>
                        </div>
                    </div>
                    <div class="position">
                        <h4>Work type:</h4>
                        <select id="workingMode" name="workingMode" required>
                            <option value="Remote">Remote</option>
                            <option value="Onsite">Onsite</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>
                </div>
                <div class="addimg">
                    <label for="image" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Change an Image
                    </label>
                    <input type="file" id="image" name="image" required />
                    <span id="file-name"></span>
                </div>
                <div class="sc_btn">
                    <button class="cancel_btn" onclick="closeConfirmationModal()">
                        Cancel
                    </button>
                    <button type="submit" class="sub_btn" onclick="validateAndShowModal(event)">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Update the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="submitForm()">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmupdateModal()">No</button>
            </div>
        </div>
    </div>

    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Delete the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmDelete('<?php echo $data[0]->advertisementId; ?>')">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmdeleteModal()">No</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        // Increment and decrement the number of interns
        function increment() {
            let count = document.getElementById('numOfInterns').value;
            count = parseInt(count) + 1;
            document.getElementById('numOfInterns').value = count;
        }

        function decrement() {
            let count = document.getElementById('numOfInterns').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('numOfInterns').value = count;
            }
        }

        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualification = document.getElementById('qualification').value;
            const deadline = document.getElementById('deadline').value;
            const numOfInterns = document.getElementById('numOfInterns').value;
            const workingMode = document.getElementById('workingMode').value;
            // image is not in the script

            if (!position || !description || !qualification || !deadline || !numOfInterns || !workingMode) {
                errorToast("Please fill in all required fields.");
                return;
            }
            // Show confirmation modal if form is valid
            openconfirmupdateModal()
        }

        function openConfirmationModal(element) {
            const position = element.dataset.position;
            const description = element.dataset.description;
            const qualification = element.dataset.qualification;
            const deadline = element.dataset.deadline;
            const numOfInterns = element.dataset.interns;
            const workingMode = element.dataset.workingmode;
            const image = element.dataset.image;
            // console.log(image);


            // Now populate the modal fields
            document.getElementById('position').value = position;
            document.getElementById('description').value = description;
            document.getElementById('qualification').value = qualification;
            document.getElementById('deadline').value = deadline;
            document.getElementById('numOfInterns').value = numOfInterns;
            document.getElementById('workingMode').value = workingMode;

            // Show the file name when a file is selected
            document.getElementById('image').addEventListener('change', function() {
                const fileName = this.files[0]?.name || '';
                document.getElementById('file-name').textContent = fileName;
            });


            const modal = document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

        }

        function submitForm() {
            document.getElementById('ad-form').submit();
            successToast("Advertisement updated successfully");
        }


        // Get the modal popup for confirm update

        function openconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'none';
        }

        // Get the modal popup for confirm delete
        function openconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }

        function confirmDelete(id) {
            window.location.href = '../delete/' + id;
            successToast("Advertisement deleted successfully");
        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/SendAdvertisements.css">
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
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="full-s">
                    <div class="main_container">
                        <a href="../dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h5>BACK</h5>
                        </a>
                        <div class="sub_container">
                            <?php if (isset($data) && !empty($data)): ?>
                                <div class="display-details">
                                    <div class="image">
                                        <?php if (!empty($data[0]->image)): ?>
                                            <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                                        <?php else: ?>
                                            <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                                        <?php endif; ?>
                                    </div>
                                    <div class="inform">
                                        <div>
                                            <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                                            <!-- <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4> -->
                                            <h4>No of interns:<span><?php echo $data[0]->numOfInterns ?></span></h4>
                                            <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                                            <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                                        </div>
                                        <div class="ed-del">
                                            <?php if ($data[0]->status === 'Active'): ?>
                                                <i class="fas fa-pen"
                                                    data-position="<?php echo htmlspecialchars($data[0]->position, ENT_QUOTES) ?>"
                                                    data-description="<?php echo htmlspecialchars($data[0]->description, ENT_QUOTES) ?>"
                                                    data-qualification="<?php echo htmlspecialchars($data[0]->qualification, ENT_QUOTES) ?>"
                                                    data-deadline="<?php echo htmlspecialchars($data[0]->deadline, ENT_QUOTES) ?>"
                                                    data-interns="<?php echo htmlspecialchars($data[0]->numOfInterns, ENT_QUOTES) ?>"
                                                    data-workingmode="<?php echo htmlspecialchars($data[0]->workingMode, ENT_QUOTES) ?>"
                                                    data-image="<?php echo htmlspecialchars($data[0]->image, ENT_QUOTES) ?>"
                                                    onclick="openConfirmationModal(this)">
                                                </i>
                                            <?php endif; ?>
                                            <i class="fas fa-trash" onclick="openconfirmdeleteModal()"></i>

                                        </div>
                                    </div>
                                </div>
                                <div class="Qua-des">
                                    <div class="Qualifications">
                                        <h4>Qualification:</h4>
                                        <div class="q-details">
                                            <p><?php echo $data[0]->qualification ?></p>
                                        </div>
                                    </div>

                                    <div class="Description">
                                        <h4>Description:</h4>
                                        <div class="d-details">
                                            <p><?php echo $data[0]->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="confirmation-modal" class="modal">
        <div class="modal-content">
            <form id="ad-form" class="supersub_container" method="POST" enctype="multipart/form-data" action="">
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
                        <textarea
                            name="description"
                            id="description"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                    <div>
                        <h4>Qualifications:</h4>
                        <textarea
                            name="qualification"
                            id="qualification"
                            cols="50"
                            rows="10"
                            required></textarea>
                    </div>
                </div>
                <div class="perioddeadline">
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
                            <input
                                type="text"
                                id="numOfInterns"
                                name="numOfInterns"
                                value="5"
                                readonly
                                required />
                            <button class="sbtn" type="button" onclick="increment()">+</button>
                        </div>
                    </div>
                    <div class="position">
                        <h4>Work type:</h4>
                        <select id="workingMode" name="workingMode" required>
                            <option value="Remote">Remote</option>
                            <option value="Onsite">Onsite</option>
                            <option value="Hybrid">Hybrid</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>
                </div>
                <div class="addimg">
                    <label for="image" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Change an Image
                    </label>
                    <input type="file" id="image" name="image" required />
                    <span id="file-name"></span>
                </div>
                <div class="sc_btn">
                    <button class="cancel_btn" onclick="closeConfirmationModal()">
                        Cancel
                    </button>
                    <button type="submit" class="sub_btn" onclick="validateAndShowModal(event)">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Update the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="submitForm()">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmupdateModal()">No</button>
            </div>
        </div>
    </div>

    <div id="deleteconfirmation-modal" class="updatemodal">
        <div class="updatemodal-content">
            <h2>Are you sure?</h2>
            <p>Do you want to Delete the Advertisements?</p>
            <div class="updatemodal-buttons">
                <button class="updateyes-btn" onclick="confirmDelete('<?php echo $data[0]->advertisementId; ?>')">Yes</button>
                <button class="updateno-btn" onclick="closeconfirmdeleteModal()">No</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        // Increment and decrement the number of interns
        function increment() {
            let count = document.getElementById('numOfInterns').value;
            count = parseInt(count) + 1;
            document.getElementById('numOfInterns').value = count;
        }

        function decrement() {
            let count = document.getElementById('numOfInterns').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('numOfInterns').value = count;
            }
        }

        // Get the modal popup

        function validateAndShowModal(event) {
            event.preventDefault();
            // Validate form data before opening modal
            const position = document.getElementById('position').value;
            const description = document.getElementById('description').value;
            const qualification = document.getElementById('qualification').value;
            const deadline = document.getElementById('deadline').value;
            const numOfInterns = document.getElementById('numOfInterns').value;
            const workingMode = document.getElementById('workingMode').value;
            // image is not in the script

            if (!position || !description || !qualification || !deadline || !numOfInterns || !workingMode) {
                errorToast("Please fill in all required fields.");
                return;
            }
            // Show confirmation modal if form is valid
            openconfirmupdateModal()
        }

        function openConfirmationModal(element) {
            const position = element.dataset.position;
            const description = element.dataset.description;
            const qualification = element.dataset.qualification;
            const deadline = element.dataset.deadline;
            const numOfInterns = element.dataset.interns;
            const workingMode = element.dataset.workingmode;
            const image = element.dataset.image;
            // console.log(image);


            // Now populate the modal fields
            document.getElementById('position').value = position;
            document.getElementById('description').value = description;
            document.getElementById('qualification').value = qualification;
            document.getElementById('deadline').value = deadline;
            document.getElementById('numOfInterns').value = numOfInterns;
            document.getElementById('workingMode').value = workingMode;

            // Show the file name when a file is selected
            document.getElementById('image').addEventListener('change', function() {
                const fileName = this.files[0]?.name || '';
                document.getElementById('file-name').textContent = fileName;
            });


            const modal = document.getElementById('confirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';

        }

        function submitForm() {
            document.getElementById('ad-form').submit();
            successToast("Advertisement updated successfully");
        }


        // Get the modal popup for confirm update

        function openconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmupdateModal() {
            document.getElementById('updateconfirmation-modal').style.display = 'none';
        }

        // Get the modal popup for confirm delete
        function openconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'block';
            modal.style.display = 'flex'; // Use flex for centering modal
        }

        function closeconfirmdeleteModal() {
            document.getElementById('deleteconfirmation-modal').style.display = 'none';
        }

        function confirmDelete(id) {
            window.location.href = '../delete/' + id;
            successToast("Advertisement deleted successfully");
        }
    </script>

</body>

</html>