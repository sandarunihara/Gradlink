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

            <div class="tab-content">
                <!-- Company List Tab -->
                <div id="company-list" class="tab-pane active ">
                    <!-- <section class="company-list"> -->
                    <div class="list-header">
                        <h2>This is Round 01</h2>

                    </div>
                </div>

            </div>
            <div class="company-list">
                <table>
                    <thead>
                        <tr>
                            <th>Round ID</th>
                            <th>Round</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($roundData)): ?>
                            <?php foreach ($roundData as $round): ?>
                                <tr>
                                    <td> <?= htmlspecialchars(string: is_array(value: $round) ? $round['round_id'] : $round->round_id) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $round) ? $round['round'] : $round->round) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $round) ? $round['active'] : $round->active) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $round) ? $round['startDate'] : $round->startDate) ?></td>
                                    <td> <?= htmlspecialchars(string: is_array(value: $round) ? $round['endDate'] : $round->endDate) ?></td>


                                    <td><button class="view-btn">View</button></td>
                                </tr>
                                <!-- Add more rows as needed -->
                            <?php endforeach ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="9">No Registered Companies</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal Structure -->
            <div id="roundModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h2>Round Details</h2>
                    <form id="roundForm">
                        <label for="roundId">Round ID:</label>
                        <input type="text" id="roundId" disabled>

                        <label for="round">Round:</label>
                        <input type="text" id="round" disabled>

                        <label for="status">Status:</label>
                        <input type="text" id="status" disabled>

                        <label for="startDate">Start Date:</label>
                        <input type="date" id="startDate" required>

                        <label for="endDate">End Date:</label>
                        <input type="date" id="endDate" required>

                        <button type="submit" class="update-btn">Update</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const viewButtons = document.querySelectorAll(".view-btn");
            const modal = document.getElementById("roundModal");
            const closeBtn = document.querySelector(".close-btn");
            const roundIdField = document.getElementById("roundId");
            const roundField = document.getElementById("round");
            const statusField = document.getElementById("status");
            const startDateField = document.getElementById("startDate");
            const endDateField = document.getElementById("endDate");
            const roundForm = document.getElementById("roundForm");

            viewButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const row = this.closest("tr");
                    roundIdField.value = row.cells[0].innerText;
                    roundField.value = row.cells[1].innerText;
                    statusField.value = row.cells[2].innerText;
                    startDateField.value = row.cells[3].innerText;
                    endDateField.value = row.cells[4].innerText;

                    modal.style.display = "flex";
                });
            });

            closeBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });

            roundForm.addEventListener("submit", function(event) {
                event.preventDefault();
                const today = new Date().toISOString().split("T")[0];
                if (startDateField.value < today) {
                    alert("Start date cannot be in the past!");
                    return;
                }
                if (endDateField.value <= startDateField.value) {
                    alert("End date must be after the start date!");
                    return;
                }
                alert("Round updated successfully!");
                modal.style.display = "none";
            });
        });
    </script>

</html>