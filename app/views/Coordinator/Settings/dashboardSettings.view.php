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
    </style>
</head>

<body>
    
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>

        <!-- rounds -->
        <main class="main-content">
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
        });
    </script>
</body>

</html>