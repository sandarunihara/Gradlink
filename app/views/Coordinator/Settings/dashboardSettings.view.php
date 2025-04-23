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
                                    <option value="S1001">S1001</option>
                                    <option value="S1002">S1002</option>
                                </select>
                            </div>

                            <div class="search-group">
                                <label for="student-name"></label>
                                <select id="student-name" class="search-select">
                                    <option value="">Select Student Name</option>
                                    <option value="John Doe">John Doe</option>
                                    <option value="Jane Smith">Jane Smith</option>
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
                                    <option value="C2001">C2001</option>
                                    <option value="C2002">C2002</option>
                                </select>
                            </div>

                            <div class="search-group">
                                <label for="company-name"></label>
                                <select id="company-name" class="search-select">
                                    <option value="">Select Company Name</option>
                                    <option value="Tech Corp">Tech Corp</option>
                                    <option value="Innovate LLC">Innovate LLC</option>
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
                                    <option value="A3001">A3001</option>
                                    <option value="A3002">A3002</option>
                                </select>
                            </div>

                            <div class="search-group">
                                <label for="ad-company"></label>
                                <select id="ad-company" class="search-select">
                                    <option value="">Select Company Name</option>
                                    <option value="Tech Corp">Tech Corp</option>
                                    <option value="Innovate LLC">Innovate LLC</option>
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

            // Sample data (in a real app, this would come from an API)
            const studentData = {
                'S1001': {
                    name: 'John Doe',
                    email: 'john.doe@university.edu',
                    degree: 'Computer Science',
                    status: 'Active',
                    adsApplied: 3
                },
                'S1002': {
                    name: 'Jane Smith',
                    email: 'jane.smith@university.edu',
                    degree: 'Business Administration',
                    status: 'Pending',
                    adsApplied: 1
                }
            };

            const companyData = {
                'C2001': {
                    name: 'Tech Corp',
                    email: 'contact@techcorp.com',
                    status: 'Verified',
                    contact: 'Michael Johnson'
                },
                'C2002': {
                    name: 'Innovate LLC',
                    email: 'hr@innovate.com',
                    status: 'Pending Verification',
                    contact: 'Sarah Williams'
                }
            };

            const advertisementData = {
                'A3001': {
                    company: 'Tech Corp',
                    position: 'Software Developer Intern',
                    status: 'Open',
                    interns: 5,
                    mode: 'Remote'
                },
                'A3002': {
                    company: 'Innovate LLC',
                    position: 'Marketing Intern',
                    status: 'Closed',
                    interns: 2,
                    mode: 'Hybrid'
                }
            };

            // Student search functionality
            const studentIdSelect = document.getElementById('student-id');
            const studentNameSelect = document.getElementById('student-name');

            studentIdSelect.addEventListener('change', function() {
                const studentId = this.value;
                if (studentId && studentData[studentId]) {
                    const student = studentData[studentId];
                    document.getElementById('student-email').value = student.email;
                    document.getElementById('student-degree').value = student.degree;
                    document.getElementById('student-status').value = student.status;
                    document.getElementById('student-ads-applied').value = student.adsApplied;
                    studentNameSelect.value = student.name;
                }
            });

            studentNameSelect.addEventListener('change', function() {
                const studentName = this.value;
                if (studentName) {
                    // Find student by name
                    for (const [id, student] of Object.entries(studentData)) {
                        if (student.name === studentName) {
                            document.getElementById('student-email').value = student.email;
                            document.getElementById('student-degree').value = student.degree;
                            document.getElementById('student-status').value = student.status;
                            document.getElementById('student-ads-applied').value = student.adsApplied;
                            studentIdSelect.value = id;
                            break;
                        }
                    }
                }
            });

            // Company search functionality
            const companyIdSelect = document.getElementById('company-id');
            const companyNameSelect = document.getElementById('company-name');

            companyIdSelect.addEventListener('change', function() {
                const companyId = this.value;
                if (companyId && companyData[companyId]) {
                    const company = companyData[companyId];
                    document.getElementById('company-email').value = company.email;
                    document.getElementById('company-status').value = company.status;
                    document.getElementById('company-contact').value = company.contact;
                    companyNameSelect.value = company.name;
                }
            });

            companyNameSelect.addEventListener('change', function() {
                const companyName = this.value;
                if (companyName) {
                    // Find company by name
                    for (const [id, company] of Object.entries(companyData)) {
                        if (company.name === companyName) {
                            document.getElementById('company-email').value = company.email;
                            document.getElementById('company-status').value = company.status;
                            document.getElementById('company-contact').value = company.contact;
                            companyIdSelect.value = id;
                            break;
                        }
                    }
                }
            });

            // Advertisement search functionality
            const adIdSelect = document.getElementById('ad-id');
            const adCompanySelect = document.getElementById('ad-company');

            adIdSelect.addEventListener('change', function() {
                const adId = this.value;
                if (adId && advertisementData[adId]) {
                    const ad = advertisementData[adId];
                    document.getElementById('ad-position').value = ad.position;
                    document.getElementById('ad-status').value = ad.status;
                    document.getElementById('ad-interns').value = ad.interns;
                    document.getElementById('ad-mode').value = ad.mode;
                    adCompanySelect.value = ad.company;
                }
            });

            adCompanySelect.addEventListener('change', function() {
                const companyName = this.value;
                if (companyName) {
                    // Find ad by company name (in a real app, there might be multiple)
                    for (const [id, ad] of Object.entries(advertisementData)) {
                        if (ad.company === companyName) {
                            document.getElementById('ad-position').value = ad.position;
                            document.getElementById('ad-status').value = ad.status;
                            document.getElementById('ad-interns').value = ad.interns;
                            document.getElementById('ad-mode').value = ad.mode;
                            adIdSelect.value = id;
                            break;
                        }
                    }
                }
            });

            // Submit button functionality
            const submitBtns = document.querySelectorAll('.submit-btn');
            submitBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const activeTab = document.querySelector('.tab-content.active').id;
                    alert(`Changes for ${activeTab} submitted successfully!`);
                    // In a real app, you would send data to server here
                });
            });
        });
    </script>

</body>

</html>