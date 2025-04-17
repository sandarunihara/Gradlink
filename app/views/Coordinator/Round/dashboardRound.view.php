<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rounds</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Round/dashboardRound.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">

</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Rounds</h1>
                </div>

            </header>

            <?php if (!empty($_SESSION['flash_message'])): ?>
                <div class="flash-message <?= $_SESSION['flash_message']['type'] ?>">
                    <?= $_SESSION['flash_message']['message'] ?>
                    <?php unset($_SESSION['flash_message']); ?>
                </div>
            <?php endif; ?>

            <div class="tab-content">
                <!-- Company List Tab -->
                <div id="company-list" class="tab-pane active ">
                    <!-- <section class="company-list"> -->
                    <div class="list-header">
                        <h2>This is Round 01</h2>

                    </div>
                </div>

            </div>
            <div class="round-cards-container">
                <?php if (!empty($roundData)): ?>
                    <?php foreach ($roundData as $round): ?>
                        <div class="round-card" data-status="<?= htmlspecialchars($round->active) ?>">
                            <h3><?= htmlspecialchars($round->round) ?></h3>
                            <p><strong>Round ID:</strong> <?= htmlspecialchars($round->roundId) ?></p>
                            <p><strong>Status:</strong> <?= htmlspecialchars($round->active) ?></p>

                            <?php if (strtolower($round->round) !== 'none'): ?>
                                <p><strong>Start Date:</strong> <?= htmlspecialchars($round->startDate) ?></p>
                                <p><strong>End Date:</strong> <?= htmlspecialchars($round->endDate) ?></p>
                                <button class="view-btn">View</button>
                            <?php else: ?>
                                <button class="view-btn" disabled style="opacity: 0.5; cursor: not-allowed;">View</button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No Registered Rounds</p>
                <?php endif; ?>
            </div>

            <!-- Modal Structure -->
            <div id="roundModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Round Details</h2>
                    <form id="roundForm" method="POST" action="<?= ROOT ?>/PDC_coordinator/DashboardRound/updateRound">
                        <label for="roundId">Round ID:</label>
                        <input type="text" id="roundId" name="roundId" readonly>

                        <label for="round">Round:</label>
                        <input type="text" id="round" name="round" readonly>

                        <label for="status">Status:</label>
                        <input type="text" id="status" name="status" disabled>

                        <label for="startDate">Start Date:</label>
                        <input type="date" id="startDate" name="startDate" required>

                        <label for="endDate">End Date:</label>
                        <input type="date" id="endDate" name="endDate" required>

                        <button type="submit" class="update-btn">Update</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split("T")[0];

            // Highlight today's round
            document.querySelectorAll(".round-card").forEach(card => {
                const status = card.getAttribute("data-status");
                if (status === "1" || status === 1) {
                    card.classList.add("active-round");
                }
            });

            const viewButtons = document.querySelectorAll(".view-btn");
            const modal = document.getElementById("roundModal");
            const closeBtn = document.querySelector(".close-btn");
            const roundIdField = document.getElementById("roundId");
            const roundField = document.getElementById("round");
            const statusField = document.getElementById("status");
            const startDateField = document.getElementById("startDate");
            const endDateField = document.getElementById("endDate");
            const roundForm = document.getElementById("roundForm");

            // Open modal and load data
            viewButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const card = this.closest(".round-card");

                    roundIdField.value = card.querySelector("p:nth-child(2)").innerText.split(": ")[1];
                    roundField.value = card.querySelector("h3").innerText.replace("Round ", "");
                    statusField.value = card.querySelector("p:nth-child(3)").innerText.split(": ")[1];
                    startDateField.value = card.querySelector("p:nth-child(4)").innerText.split(": ")[1];
                    endDateField.value = card.querySelector("p:nth-child(5)").innerText.split(": ")[1];

                    modal.style.display = "flex";
                });
            });

            // Close modal when clicking the close button
            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            // Close modal when clicking outside the modal
            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });

            // Handle form submission with validation
            roundForm.addEventListener("submit", function(event) {
                const today = new Date().toISOString().split("T")[0];

                if (startDateField.value < today) {
                    alert("Start date cannot be in the past!");
                    event.preventDefault();
                    return;
                }
                if (endDateField.value <= startDateField.value) {
                    alert("End date must be after the start date!");
                    event.preventDefault();
                    return;
                }

                // Allow normal form submission
            });

        });
    </script>

</html>