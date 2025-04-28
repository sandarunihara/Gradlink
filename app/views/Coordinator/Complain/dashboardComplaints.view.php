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

            <?php if (isset($_SESSION['flash_message'])): ?>
                <script>
                    window.__flashMessage = {
                        message: "<?= $_SESSION['flash_message']['message'] ?>",
                        type: "<?= htmlspecialchars($_SESSION['flash_message']['type']) ?>"
                    };
                </script>
            <?php endif; ?>

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

    <!-- Toast Container -->
    <div id="toast-container" class="toast-container"></div>

    <script src="<?= ROOT ?>/assets/js/toast.js"></script>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const toastSystem = new ToastSystem();

            // Handle flash messages
            if (window.__flashMessage) {
                const { message, type } = window.__flashMessage;
                toastSystem.show(message, type);
            }

            document.querySelectorAll('.mark-reviewed-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const complaintId = button.getAttribute('data-id');

                    fetch("<?= ROOT ?>/PDC_coordinator/dashboardComplaints/markReviewed", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: "id=" + encodeURIComponent(complaintId)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastSystem.show(data.message, 'success');
                            button.closest('.complaint-card').remove();
                        } else {
                            toastSystem.show('Failed to update status.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastSystem.show('An error occurred while updating the status.', 'error');
                    });
                });
            });

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

            // Handle form submission
            replyForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        toastSystem.show(data.message, 'success');
                        closeModal();
                        location.reload();
                    } else {
                        toastSystem.show(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastSystem.show('An error occurred while adding the reply.', 'error');
                });
            });

            // Filter functionality
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