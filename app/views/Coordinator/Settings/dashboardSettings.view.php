<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Round/dashboardRound.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Components/coordinatorDashboard.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
        }

        .toast-message {
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease;
        }

        .toast-message.show {
            opacity: 1;
            transform: translateX(0);
        }

        .toast-content {
            flex-grow: 1;
        }

        .toast-close-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            margin-left: 15px;
            font-size: 18px;
            padding: 0;
        }

        .toast-success {
            background-color: #4caf50;
        }

        .toast-error {
            background-color: #f44336;
        }

        .toast-warning {
            background-color: #ff9800;
        }

        .toast-info {
            background-color: #2196f3;
        }

        /* Import Student Data Section */
    </style>
</head>

<body>

    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>

        <!-- Main content container -->
        <main class="main-content">
            <!-- Rounds Section -->
            <section class="rounds-section">
                <header class="header">
                    <div class="header-left">
                        <h1>Rounds</h1>
                    </div>
                </header>

                <?php if (isset($_SESSION['flash_message'])): ?>
                    <script>
                        window.__flashMessage = {
                            message: "<?= $_SESSION['flash_message']['message'] ?>",
                            type: "<?= htmlspecialchars($_SESSION['flash_message']['type']) ?>",
                            openModal: <?= json_encode($_SESSION['flash_message']['open_modal'] ?? false) ?>,
                            roundFormData: <?= json_encode($_SESSION['flash_message']['round_data'] ?? []) ?>
                        };
                    </script>
                <?php unset($_SESSION['flash_message']);
                endif; ?>

                <div class="rounds-container">
                    <?php if (!empty($roundData)): ?>
                        <div class="rounds-grid">
                            <?php foreach ($roundData as $round): ?>
                                <div class="round-card <?= ($round->active == 1) ? 'active' : '' ?>"
                                    data-status="<?= htmlspecialchars($round->active) ?>">
                                    <div class="card-header">
                                        <h3><?= htmlspecialchars($round->round) ?></h3>
                                        <span class="status-badge <?= ($round->active == 1) ? 'active' : 'inactive' ?>">
                                            <?= ($round->active == 1) ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="info-item">
                                            <span class="label">Round ID:</span>
                                            <span class="value"><?= htmlspecialchars($round->roundId) ?></span>
                                        </div>
                                        <?php if (strtolower($round->round) !== 'none'): ?>
                                            <div class="info-item">
                                                <span class="label">Duration:</span>
                                                <span class="value">
                                                    <?= htmlspecialchars($round->startDate) ?> to <?= htmlspecialchars($round->endDate) ?>
                                                </span>
                                            </div>

                                            <div class="info-item">
                                                <span class="label">No of applications per student:</span>
                                                <span class="value"><?= htmlspecialchars($round->vacancy) ?></span>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="card-footer">
                                        <?php if (strtolower($round->round) !== 'none'): ?>
                                            <button class="btn manage-btn">
                                                <i class="fas fa-cog"></i> Manage
                                            </button>
                                        <?php else: ?>
                                            <button class="btn manage-btn" disabled>
                                                <i class="fas fa-cog"></i> Manage
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <img src="<?= ROOT ?>/assets/images/no-rounds.svg" alt="No rounds">
                            <h3>No Rounds Configured</h3>
                            <p>There are currently no internship rounds scheduled.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- Import Student Data Section -->
            <section class="import-section">
                <header class="header">
                    <div class="header-left">
                        <h1>Import Student Data</h1>
                    </div>
                </header>

                <div class="upload-container">
                    <form id="uploadForm" enctype="multipart/form-data" action="<?= ROOT ?>/PDC_coordinator/DashboardSettings/importStudents" method="POST">
                        <div class="file-upload" id="dropZone">
                            <i class="bi bi-file-earmark-excel fs-1 text-primary"></i>
                            <h5>Drag & Drop Excel File Here</h5>
                            <p class="text-muted">or</p>
                            <input type="file" id="fileInput" name="excel_file" class="d-none" accept=".xlsx, .xls" required>
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('fileInput').click()">
                                Browse Files
                            </button>
                            <div class="template-download">
                                <a href="<?= ROOT ?>/downloads/student_import_template.xlsx" download class="text-decoration-none">
                                    <i class="bi bi-download"></i> Download Template
                                </a>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" id="submitBtn" class="btn btn-success w-100" disabled>
                                <i class="bi bi-upload"></i> Import Data
                            </button>
                        </div>
                    </form>

                    <div class="preview-table" id="previewTable" style="display: none;">
                        <h5 class="mt-4">Preview (First 5 Rows)</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mt-2">
                                <thead class="table-light">
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Degree</th>
                                        <th>Email</th>
                                        <th>NIC</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="previewBody"></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="alert alert-info mt-3" id="instructions">
                        <h5><i class="bi bi-info-circle"></i> Instructions:</h5>
                        <ul>
                            <li>File must be in Excel format (.xlsx or .xls)</li>
                            <li>Columns must match the template exactly</li>
                            <li>First row should contain column headers</li>
                            <li>Maximum file size: 5MB</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="admin-container">
                <header class="header">
                    <div class="header-left">
                        <h1>Notify Admin</h1>
                    </div>
                </header>

                <div class="admin-info">
                    <div class="tabs">
                        <button class="tab-btn active" data-tab="student">Student</button>
                        <button class="tab-btn" data-tab="company">Company</button>
                        <button class="tab-btn" data-tab="advertisement">Advertisement</button>
                    </div>

                    <div class="tab-content active" id="student">
                        <h2>Student Information</h2>
                        <div class="search-options">
                            <div class="search-group">
                                <label for="student-id"></label>
                                <select id="student-id" class="search-select">
                                    <option value="">Select Student ID</option>
                                    <?php foreach ($studentData as $student): ?>
                                        <option value="<?= htmlspecialchars($student->StudentId) ?>"
                                            data-applications="<?= htmlspecialchars($student->noOfAppliedAds) ?>"
                                            data-email="<?= htmlspecialchars($student->Email) ?>"
                                            data-degree="<?= htmlspecialchars($student->DegreeName) ?>"
                                            data-name="<?= htmlspecialchars($student->Name) ?>"
                                            data-status="<?= htmlspecialchars($student->Status) ?>">
                                            <?= htmlspecialchars($student->StudentId) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="search-group">
                                <label for="student-name"></label>
                                <select id="student-name" class="search-select">
                                    <option value="">Select Student Name</option>
                                    <?php foreach ($studentData as $student): ?>
                                        <option value="<?= htmlspecialchars($student->Name) ?>"
                                            data-id="<?= htmlspecialchars($student->StudentId) ?>"
                                            data-email="<?= htmlspecialchars($student->Email) ?>"
                                            data-degree="<?= htmlspecialchars($student->DegreeName) ?>"
                                            data-ads_applied="<?= htmlspecialchars($student->noOfAppliedAds) ?>"
                                            data-status="<?= htmlspecialchars($student->Status) ?>">
                                            <?= htmlspecialchars($student->Name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="info-form">
                            <div class="form-group">
                                <label for="student-email">Email:</label>
                                <input type="email" id="student-email" readonly>
                            </div>

                            <div class="form-group">
                                <label for="student-degree">Degree:</label>
                                <input type="text" id="student-degree" readonly>
                            </div>

                            <div class="form-group">
                                <label for="student-status">Application Status:</label>
                                <input type="text" id="student-status" readonly>
                            </div>

                            <div class="form-group">
                                <label for="student-ads-applied">No. of Advertisements Applied:</label>
                                <input type="number" id="student-ads-applied" readonly>
                            </div>

                            <div class="form-group">
                                <label for="student-description">Description:</label>
                                <textarea id="student-description" rows="4"></textarea>
                            </div>

                            <button class="submit-btn">Submit</button>
                        </div>
                    </div>

                    <div class="tab-content" id="company">
                        <h2>Company Information</h2>
                        <div class="search-options">
                            <div class="search-group">
                                <label for="company-id"></label>
                                <select id="company-id" class="search-select">
                                    <option value="">Select Company ID</option>
                                    <?php foreach ($companyData as $company): ?>
                                        <option value="<?= htmlspecialchars($company->CompanyId) ?>"
                                            data-name="<?= htmlspecialchars($company->Name) ?>"
                                            data-email="<?= htmlspecialchars($company->Email) ?>"
                                            data-status="<?= htmlspecialchars($company->Status) ?>"
                                            data-contact="<?= htmlspecialchars($company->ContactPerson) ?>">
                                            <?= htmlspecialchars($company->CompanyId) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="search-group">
                                <label for="company-name"></label>
                                <select id="company-name" class="search-select">
                                    <option value="">Select Company Name</option>
                                    <?php foreach ($companyData as $company): ?>
                                        <option value="<?= htmlspecialchars($company->Name) ?>"
                                            data-id="<?= htmlspecialchars($company->CompanyId) ?>"
                                            data-email="<?= htmlspecialchars($company->Email) ?>"
                                            data-status="<?= htmlspecialchars($company->Status) ?>"
                                            data-contact="<?= htmlspecialchars($company->ContactPerson) ?>">
                                            <?= htmlspecialchars($company->Name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="info-form">
                            <div class="form-group">
                                <label for="company-email">Email:</label>
                                <input type="email" id="company-email" readonly>
                            </div>

                            <div class="form-group">
                                <label for="company-status">Status:</label>
                                <input type="text" id="company-status" readonly>
                            </div>

                            <div class="form-group">
                                <label for="company-contact">Contact Person:</label>
                                <input type="text" id="company-contact" readonly>
                            </div>

                            <div class="form-group">
                                <label for="company-description">Description:</label>
                                <textarea id="company-description" rows="4"></textarea>
                            </div>

                            <button class="submit-btn">Submit</button>
                        </div>
                    </div>

                    <div class="tab-content" id="advertisement">
                        <h2>Advertisement Information</h2>
                        <div class="search-options">
                            <div class="search-group">
                                <label for="ad-id"></label>
                                <select id="ad-id" class="search-select">
                                    <option value="">Select Advertisement ID</option>
                                    <?php foreach ($advertisementData as $ad): ?>
                                        <?php
                                        $companyName = isset($companyNames[$ad->CompanyId]) ? $companyNames[$ad->CompanyId] : 'Unknown Company';
                                        ?>
                                        <option value="<?= htmlspecialchars($ad->advertisementId) ?>"
                                            data-company="<?= htmlspecialchars($companyName) ?>"
                                            data-company-id="<?= htmlspecialchars($ad->CompanyId) ?>"
                                            data-position="<?= htmlspecialchars($ad->position) ?>"
                                            data-status="<?= htmlspecialchars($ad->status) ?>"
                                            data-interns="<?= htmlspecialchars($ad->numOfInterns) ?>"
                                            data-mode="<?= htmlspecialchars($ad->workingMode) ?>"
                                            data-description="<?= htmlspecialchars($ad->description) ?>">
                                            <?= htmlspecialchars($ad->advertisementId) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>


                            </div>
                            <div class="search-group">
                                <label for="ad-company-search"></label>
                                <select id="ad-company-search" class="search-select">
                                    <option value="">Select Company</option>
                                    <?php foreach ($companyData as $company): ?>
                                        <option value="<?= htmlspecialchars($company->CompanyId) ?>"
                                            data-id="<?= htmlspecialchars($company->CompanyId) ?>"
                                            data-name="<?= htmlspecialchars($company->Name) ?>">
                                            <?= htmlspecialchars($company->Name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                        </div>

                        <div class="info-form">


                            <div class="form-group">
                                <label for="ad-position">Position:</label>
                                <input type="text" id="ad-position" readonly>
                            </div>

                            <div class="form-group">
                                <label for="ad-status">Status:</label>
                                <input type="text" id="ad-status" readonly>
                            </div>

                            <div class="form-group">
                                <label for="ad-interns">No. of Interns:</label>
                                <input type="number" id="ad-interns" readonly>
                            </div>

                            <div class="form-group">
                                <label for="ad-mode">Working Mode:</label>
                                <input type="text" id="ad-mode" readonly>
                            </div>

                            <div class="form-group">
                                <label for="ad-description">Description:</label>
                                <textarea id="ad-description" rows="4"></textarea>
                            </div>

                            <button class="submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
                <section />

                <!-- Round Management Modal -->
                <div id="roundModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2>Round Configuration</h2>
                            <span class="close-btn">&times;</span>
                        </div>
                        <form id="roundForm" method="POST" action="<?= ROOT ?>/PDC_coordinator/DashboardSettings/updateRound">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="roundId">Round ID</label>
                                    <input type="text" id="roundId" name="roundId" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="round">Round Name</label>
                                    <input type="text" id="round" name="round" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="status-display" id="status"></div>
                                </div>
                                <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" id="startDate" name="startDate" required>
                                </div>
                                <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input type="date" id="endDate" name="endDate" required>
                                </div>
                                <div class="form-group">
                                    <label for="vacancy">Applications per Student</label>
                                    <input type="number" id="vacancy" name="vacancy" min="1" required>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn primary-btn">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
        </main>
    </div>

    <!-- SheetJS (xlsx) for client-side parsing -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize Toast System
            const toastSystem = new ToastSystem();

            // Set minimum dates for date inputs
            const today = new Date().toISOString().split("T")[0];
            // document.getElementById("startDate").min = today;
            document.getElementById("endDate").min = today;

            // Modal handling
            const modal = document.getElementById("roundModal");
            const manageButtons = document.querySelectorAll(".manage-btn");
            const closeBtn = document.querySelector(".close-btn");

            manageButtons.forEach(button => {
                button.addEventListener("click", function() {
                    if (button.disabled) return;

                    const card = this.closest(".round-card");
                    const status = card.getAttribute("data-status");

                    document.getElementById("roundId").value = card.querySelector(".info-item .value").innerText;
                    document.getElementById("round").value = card.querySelector("h3").innerText;

                    const statusDisplay = document.getElementById("status");
                    statusDisplay.innerHTML = status == "1" ?
                        '<span class="status-badge active">Active</span>' :
                        '<span class="status-badge inactive">Inactive</span>';

                    const dates = card.querySelector(".info-item:nth-child(2) .value").innerText.split(" to ");
                    if (dates.length === 2) {
                        document.getElementById("startDate").value = dates[0].trim();
                        document.getElementById("endDate").value = dates[1].trim();
                    }

                    modal.style.display = "flex";
                });
            });

            closeBtn.addEventListener("click", () => modal.style.display = "none");
            window.addEventListener("click", (e) => e.target === modal ? modal.style.display = "none" : null);

            // Handle form submission with validation
            document.getElementById("roundForm").addEventListener("submit", function(e) {
                const startDate = new Date(document.getElementById("startDate").value);
                const endDate = new Date(document.getElementById("endDate").value);

                if (startDate > endDate) {
                    e.preventDefault();
                    toastSystem.show("End date must be after start date", "error");
                    return false;
                }

                const vacancy = document.getElementById("vacancy").value;
                if (vacancy < 1) {
                    e.preventDefault();
                    toastSystem.show("Applications per student must be at least 1", "error");
                    return false;
                }

                return true;
            });

            // Handle flash messages and modal auto-open
            if (window.__flashMessage) {
                const {
                    message,
                    type,
                    openModal,
                    roundFormData
                } = window.__flashMessage;

                // Show toast message
                toastSystem.show(message, type);

                // Handle modal auto-open if needed
                if (openModal && roundFormData) {
                    modal.style.display = "flex";
                    document.getElementById("roundId").value = roundFormData.roundId || "";
                    document.getElementById("round").value = roundFormData.round || "";

                    const statusDisplay = document.getElementById("status");
                    statusDisplay.innerHTML = roundFormData.status === "1" ?
                        '<span class="status-badge active">Active</span>' :
                        '<span class="status-badge inactive">Inactive</span>';

                    document.getElementById("startDate").value = roundFormData.startDate || "";
                    document.getElementById("endDate").value = roundFormData.endDate || "";
                    document.getElementById("vacancy").value = roundFormData.vacancy || "";
                }
            }

            // File upload handling
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('fileInput');
            const submitBtn = document.getElementById('submitBtn');
            const previewTable = document.getElementById('previewTable');
            const previewBody = document.getElementById('previewBody');
            const uploadForm = document.getElementById('uploadForm');

            // Handle drag and drop events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropZone.classList.add('highlight');
            }

            function unhighlight() {
                dropZone.classList.remove('highlight');
            }

            // Handle dropped files
            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files);
            }

            // Handle file input change
            fileInput.addEventListener('change', function() {
                handleFiles(this.files);
            });

            function handleFiles(files) {
                if (files.length === 0) return;

                const file = files[0];

                // Validate file type
                if (!file.name.match(/\.(xlsx|xls)$/i)) {
                    toastSystem.show('Please upload an Excel file (.xlsx or .xls)', 'error');
                    return;
                }

                // Validate file size
                if (file.size > 5 * 1024 * 1024) {
                    toastSystem.show('File size exceeds 5MB limit', 'error');
                    return;
                }

                // Update file input (for FormData submission)
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                const reader = new FileReader();
                reader.onload = function(e) {
                    try {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, {
                            type: 'array'
                        });

                        // Get the first sheet
                        const firstSheet = workbook.Sheets[workbook.SheetNames[0]];

                        // Convert to JSON
                        const jsonData = XLSX.utils.sheet_to_json(firstSheet);

                        // Display preview
                        displayPreview(jsonData);

                        // Enable submit button
                        submitBtn.disabled = false;
                    } catch (error) {
                        console.error('Error parsing Excel file:', error);
                        toastSystem.show('Error reading Excel file. Please check the format.', 'error');
                    }
                };
                reader.onerror = function() {
                    toastSystem.show('Error reading file', 'error');
                };
                reader.readAsArrayBuffer(file);
            }

            function displayPreview(data) {
                // Clear previous preview
                previewBody.innerHTML = '';

                if (data.length === 0) {
                    previewTable.style.display = 'none';
                    return;
                }

                // Show only first 5 rows
                const previewRows = data.slice(0, 5);

                previewRows.forEach(row => {
                    const tr = document.createElement('tr');

                    // Add cells for each expected column
                    const columns = ['student_id', 'name', 'degree', 'email', 'nic', 'contact_no', 'status'];

                    columns.forEach(col => {
                        const td = document.createElement('td');
                        td.textContent = row[col] || '';
                        tr.appendChild(td);
                    });

                    previewBody.appendChild(tr);
                });

                // Show preview table
                previewTable.style.display = 'block';
            }

            // Handle form submission
            uploadForm.addEventListener('submit', async function(e) {
                e.preventDefault();

                if (fileInput.files.length === 0) {
                    toastSystem.show('Please select a file first', 'error');
                    return;
                }

                const formData = new FormData(this);
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

                try {
                    console.log('Starting file upload...');

                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    console.log('Response status:', response.status);
                    console.log('Response headers:', Object.fromEntries(response.headers.entries()));

                    // Get the response text first
                    const responseText = await response.text();
                    console.log('Raw response:', responseText);

                    let result;
                    try {
                        // Parse the text as JSON
                        result = JSON.parse(responseText);
                    } catch (parseError) {
                        console.error('JSON parse error:', parseError);
                        console.error('Response text that failed to parse:', responseText);
                        throw new Error('Invalid JSON response from server. Please check the server logs.');
                    }

                    if (!response.ok) {
                        throw new Error(result.message || `HTTP error! status: ${response.status}`);
                    }

                    if (result.success) {
                        toastSystem.show(result.message || 'Students imported successfully!', 'success');

                        // Reset form
                        this.reset();
                        previewTable.style.display = 'none';
                        previewBody.innerHTML = '';
                        submitBtn.disabled = true;
                    } else {
                        toastSystem.show(result.message || 'Error importing students', 'error');
                        console.error('Import error:', result);
                    }
                } catch (error) {
                    console.error('Upload error:', error);
                    toastSystem.show(error.message || 'An error occurred during upload', 'error');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-upload"></i> Import Data';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Remove active class from all buttons and contents
                    tabBtns.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked button and corresponding content
                    btn.classList.add('active');
                    const tabId = btn.getAttribute('data-tab');
                    document.getElementById(tabId).classList.add('active');
                });
            });




            // Student ID dropdown change
            document.getElementById('student-id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Update other dropdown
                    document.getElementById('student-name').value = selectedOption.dataset.name;

                    // Auto-fill form fields from data attributes
                    document.getElementById('student-email').value = selectedOption.dataset.email;
                    document.getElementById('student-degree').value = selectedOption.dataset.degree;
                    document.getElementById('student-status').value = selectedOption.dataset.status;
                    document.getElementById('student-ads-applied').value = selectedOption.dataset.applications;

                    // You would need to fetch ads_applied count via AJAX
                    // For now we'll just clear it
                }
            });

            // Student Name dropdown change
            document.getElementById('student-name').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Update other dropdown
                    document.getElementById('student-id').value = selectedOption.dataset.id;

                    // Auto-fill form fields from data attributes
                    document.getElementById('student-email').value = selectedOption.dataset.email;
                    document.getElementById('student-degree').value = selectedOption.dataset.degree;
                    document.getElementById('student-ads-applied').value = selectedOption.dataset.applications;
                    document.getElementById('student-status').value = selectedOption.dataset.status;

                    // You would need to fetch ads_applied count via AJAX
                    // For now we'll just clear it
                }
            });

            // Company search functionality
            // Company ID dropdown change
            document.getElementById('company-id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Update other dropdown
                    document.getElementById('company-name').value = selectedOption.dataset.name;

                    // Auto-fill form fields from data attributes
                    document.getElementById('company-email').value = selectedOption.dataset.email;
                    document.getElementById('company-status').value = selectedOption.dataset.status;
                    document.getElementById('company-contact').value = selectedOption.dataset.contact;
                } else {
                    // Clear fields if no selection
                    clearCompanyFields();
                }
            });

            // Company Name dropdown change
            document.getElementById('company-name').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Update other dropdown
                    document.getElementById('company-id').value = selectedOption.dataset.id;

                    // Auto-fill form fields from data attributes
                    document.getElementById('company-email').value = selectedOption.dataset.email;
                    document.getElementById('company-status').value = selectedOption.dataset.status;
                    document.getElementById('company-contact').value = selectedOption.dataset.contact;
                } else {
                    // Clear fields if no selection
                    clearCompanyFields();
                }
            });

            // Advertisement ID dropdown change
            document.getElementById('ad-id').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Update company search dropdown with company ID
                    document.getElementById('ad-company-search').value = selectedOption.dataset.companyId;

                    // Auto-fill form fields from data attributes
                    // document.getElementById('ad-company').value = selectedOption.dataset.company;
                    document.getElementById('ad-position').value = selectedOption.dataset.position;
                    document.getElementById('ad-status').value = selectedOption.dataset.status;
                    document.getElementById('ad-interns').value = selectedOption.dataset.interns;
                    document.getElementById('ad-mode').value = selectedOption.dataset.mode;
                } else {
                    // Clear fields if no selection
                    clearAdvertisementFields();
                }
            });

            // Company search dropdown change
            document.getElementById('ad-company-search').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    // Find and select the first advertisement for this company
                    const adSelect = document.getElementById('ad-id');
                    let foundAd = false;

                    for (let option of adSelect.options) {
                        if (option.dataset.companyId === selectedOption.value) {
                            adSelect.value = option.value;
                            foundAd = true;

                            // Trigger the change event to fill all fields
                            const event = new Event('change');
                            adSelect.dispatchEvent(event);
                            break;
                        }
                    }

                    if (!foundAd) {
                        // If no advertisements found for this company, clear fields
                        clearAdvertisementFields();
                    }
                } else {
                    // Clear fields if no selection
                    clearAdvertisementFields();
                }
            });

            // Clear all fields
            function clearStudentFields() {
                document.getElementById('student-id').value = '';
                document.getElementById('student-name').value = '';
                document.getElementById('student-email').value = '';
                document.getElementById('student-degree').value = '';
                document.getElementById('student-status').value = '';
                document.getElementById('student-ads-applied').value = '';
                document.getElementById('student-description').value = '';
            }

            function clearCompanyFields() {
                document.getElementById('company-id').value = '';
                document.getElementById('company-name').value = '';
                document.getElementById('company-email').value = '';
                document.getElementById('company-status').value = '';
                document.getElementById('company-contact').value = '';
                document.getElementById('company-description').value = '';
            }

            function clearAdvertisementFields() {
                document.getElementById('ad-id').value = '';
                document.getElementById('ad-company-search').value = '';
                document.getElementById('ad-position').value = '';
                document.getElementById('ad-status').value = '';
                document.getElementById('ad-interns').value = '';
                document.getElementById('ad-mode').value = '';
                document.getElementById('ad-description').value = '';
            }

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (this.getAttribute('data-tab') !== 'advertisement') {
                        clearAdvertisementFields();
                    }
                });
            });

            document.querySelector('.submit-btn').addEventListener('click', function() {

                const activeTab = document.querySelector('.tab-btn.active').getAttribute('data-tab');
                let type, companyId = null,
                    advertisementId = null,
                    studentId = null;

                if (activeTab === 'student') {
                    type = 'student';
                    studentId = document.getElementById('student-id').value;
                } else if (activeTab === 'company') {
                    type = 'company';
                    companyId = document.getElementById('company-id').value;
                } else if (activeTab === 'advertisement') {
                    type = 'advertisement';
                    advertisementId = document.getElementById('ad-id').value;
                }

                const description = document.getElementById(`${activeTab}-description`).value;

                const data = {
                    type: type,
                    student_id: studentId,
                    company_id: companyId,
                    advertisement_id: advertisementId,
                    description: description
                };

                fetch('<?= ROOT ?>/PDC_coordinator/DashboardSettings/submitFeedback', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastSystem.show(data.message, 'Notification submitted successfully!', 'success');
                            
                            clearAdvertisementFields();
                            clearCompanyFields();
                            clearStudentFields();
                        } else {
                            toastSystem.show(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastSystem.show('An error occurred while submitting the notification', 'error');
                    });
            });
        });
    </script>

</body>

</html>