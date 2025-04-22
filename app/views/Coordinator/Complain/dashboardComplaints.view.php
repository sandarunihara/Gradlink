<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Coordinator/Complain/dashboardComplain.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Complaints</h1>

                </div>



            </header>
            <?php $activeTab = 'complaint-list'; ?>
            <?php $this->renderComponent("complaintTabs") ?>

            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="student">Student Complaints</button>
                <button class="filter-btn" data-filter="company">Company Complaints</button>
            </div>

            <?php if (!empty($_SESSION['flash_message'])): ?>
                <div class="flash-message <?= $_SESSION['flash_message']['type'] ?>">
                    <?= $_SESSION['flash_message']['message'] ?>
                    <?php unset($_SESSION['flash_message']); ?>
                </div>
            <?php endif; ?>

            <p class="flash-message">
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <span class="<?= $_SESSION['flash_message']['type'] ?>">
                        <?= $_SESSION['flash_message']['message'] ?>
                    </span>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php endif; ?>
            </p>
            <div class="complaints-grid" id="complaintsGrid">
                <!-- Example card; dynamically generate from PHP or JS -->
                <?php foreach ($complaints as $complaint): ?>
                    <div class="complaint-card" data-type="<?= htmlspecialchars($complaint->type) ?>">
                        <div class="card-header">
                            <div class="profile-info">
                                <!-- <img src="<?= ROOT ?>/assets/images/default-profile.png" alt="profile"> -->
                                <div class="identity">
                                    <h3>
                                        <?= $complaint->type === 'student' ? htmlspecialchars($complaint->StudentName) : htmlspecialchars($complaint->CompanyName) ?>
                                    </h3>
                                    <p><?= ucfirst(htmlspecialchars($complaint->type)) ?></p>
                                </div>
                            </div>
                            <div class="timestamp">
                                <p><?= date('Y/m/d', strtotime($complaint->CreatedAt)) ?></p>
                                <p><?= date('g:i A', strtotime($complaint->CreatedAt)) ?></p>
                            </div>
                        </div>

                        <div class="card-body">
                            <p><strong><?= htmlspecialchars($complaint->Topic) ?></strong></p>
                            <p> <?= htmlspecialchars($complaint->Description) ?></p>
                        </div>

                        <div class="card-footer">
                            <button class="reply-btn">Add Reply</button>
                            <button class="mark-reviewed-btn" data-id="<?= htmlspecialchars($complaint->ComplaintId) ?>">
                                <i class="fas fa-check"></i> Mark as Reviewed
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Reply Popup Modal -->
                <div id="replyModal" class="modal hidden">
                    <div class="modal-content">
                        <span class="close-btn">&times;</span>
                        <form id="replyForm" method="POST" action="<?= ROOT ?>/PDC_coordinator/dashboardComplaints/addReply">
                            <input type="hidden" name="complaintId" id="modalComplaintId">

                            <p><strong>Name:</strong> <span id="modalName"></span></p>
                            <p><strong>Topic:</strong> <span id="modalTopic"></span></p>
                            <p><strong>Description:</strong></p>
                            <p id="modalDescription" class="description-box"></p>

                            <label for="replyText"><strong>Your Reply:</strong></label>
                            <textarea name="reply" id="replyText" rows="5" required></textarea>

                            <div class="modal-buttons">
                                <button type="submit" class="submit-btn">Submit Reply</button>
                                <button type="button" class="close-btn secondary-btn"></button>
                            </div>
                        </form>
                    </div>
                </div>




                <!-- More complaint cards dynamically added -->
            </div>

        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        document.querySelectorAll('.mark-reviewed-btn').forEach(button => {

            button.addEventListener('click', () => {
                const complaintId = button.getAttribute('data-id');

                console.log(complaintId);

                fetch("<?= ROOT ?>/PDC_coordinator/dashboardComplaints/markReviewed", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: "id=" + encodeURIComponent(complaintId)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            location.reload();
                            button.closest('.complaint-card').remove();
                            alert(data.message);
                        } else {
                            alert('Failed to update status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            const replyModal = document.getElementById('replyModal');
            const replyForm = document.getElementById('replyForm');

            // Open popup with data
            document.querySelectorAll('.reply-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const card = button.closest('.complaint-card');
                    const name = card.querySelector('.identity h3').innerText;
                    const topic = card.querySelector('.card-body strong').innerText;
                    const description = card.querySelector('.card-body p:nth-of-type(2)').innerText;
                    const complaintId = card.querySelector('.mark-reviewed-btn').getAttribute('data-id');

                    document.getElementById('modalName').innerText = name;
                    document.getElementById('modalTopic').innerText = topic;
                    document.getElementById('modalDescription').innerText = description;
                    document.getElementById('modalComplaintId').value = complaintId;

                    replyModal.classList.remove('hidden');
                });
            });

            // Close logic
            const closeModal = () => {
                replyModal.classList.add('hidden');
                replyForm.reset();
            };

            document.querySelectorAll('.close-btn').forEach(btn => {
                btn.addEventListener('click', closeModal);
            });

            // Close when clicking outside modal
            replyModal.addEventListener('click', (e) => {
                if (e.target === replyModal) closeModal();
            });
        });


        // Close the modal
        document.querySelector('.close-btn').addEventListener('click', () => {
            document.getElementById('replyModal').classList.add('hidden');
        });


        document.addEventListener("DOMContentLoaded", () => {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const complaintCards = document.querySelectorAll('.complaint-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const filter = button.getAttribute('data-filter');

                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    complaintCards.forEach(card => {
                        if (filter === 'all' || card.getAttribute('data-type') === filter) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });

   
        
    </script>


</body>

</html>