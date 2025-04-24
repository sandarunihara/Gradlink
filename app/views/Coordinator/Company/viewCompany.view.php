<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/viewCompany.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <?php if (isset($_SESSION['flash_message'])): ?>
        <script>
            window.__flashMessage = {
                message: <?= json_encode($_SESSION['flash_message']['message']) ?>,
                type: <?= json_encode($_SESSION['flash_message']['type']) ?>
            };
            window.__flashClearUrl = '/clear-flash'; // Your endpoint
        </script>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard")  ?>

        <a href="<?= ROOT ?>/PDC_coordinator/dashboardCompany" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <main class="content">
            <div class="company-header">
                <div class="cover-image" style="background-image: url('<?= ROOT ?>/<?= !empty($companyData->coverimg) ? htmlspecialchars($companyData->coverimg) : 'assets/images/default-cover.jpg' ?>')">
                    <div class="company-logo" style="background-image: url('<?= ROOT ?>/<?= !empty($companyData->profileimg) ? htmlspecialchars($companyData->profileimg) : 'assets/images/default-profile.png' ?>')">
                        <?php if (empty($companyData->profileimg)): ?>
                            <div class="initials"><?= substr(htmlspecialchars($companyData->Name), 0, 1) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="company-title">
                    <h1><?= htmlspecialchars($companyData->Name) ?></h1>
                    <span class="company-status <?= $companyData->Status === 'Blocked' ? 'status-blocked' : 'status-active' ?>">
                        <i class="fas fa-<?= $companyData->Status === 'Blocked' ? 'ban' : 'check-circle' ?>"></i>
                        <?= htmlspecialchars($companyData->Status) ?>
                    </span>
                </div>
            </div>

            <!-- Company Information Cards -->
            <div class="company-info-container">
                <!-- Basic Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-building"></i>
                        <h2>Company Information</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Company ID</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->CompanyId) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Contact Person</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->ContactPerson) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->Email) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->ContactNum) ?></div>
                        </div>
                    </div>
                </div>

                <!-- Address Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-map-marker-alt"></i>
                        <h2>Address</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Street No</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->No) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Street Lane</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->Lane) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">City</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->City) ?></div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">District</span>
                            <div class="info-value"><?= htmlspecialchars($companyData->District) ?></div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        <h2>Additional Details</h2>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Description</span>
                        <div class="info-value" style="border-bottom: none; padding-bottom: 0;"><?= htmlspecialchars($companyData->ShortDesc) ?></div>
                    </div>
                </div>

                <!-- Social Media Card -->
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-share-alt"></i>
                        <h2>Social Media</h2>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Website</span>
                            <div class="info-value">
                                <?php if (!empty($companyData->Website)): ?>
                                    <a href="<?= htmlspecialchars($companyData->Website) ?>" target="_blank">Visit Website</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">LinkedIn</span>
                            <div class="info-value">
                                <?php if (!empty($companyData->Linkedin)): ?>
                                    <a href="<?= htmlspecialchars($companyData->Linkedin) ?>" target="_blank">View Profile</a>
                                <?php else: ?>
                                    Not provided
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Container -->
                <div class="chat-container">
                    <div class="chat-header">
                        <div class="chat-user-info">
                            <div class="chat-user-avatar" style="background-image: url('<?= ROOT ?>/<?= !empty($companyData->profileimg) ? htmlspecialchars($companyData->profileimg) : 'assets/images/default-profile.png' ?>')">
                                <?php if (empty($companyData->profileimg)): ?>
                                    <div class="initials"><?= substr(htmlspecialchars($companyData->Name), 0, 1) ?></div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <h3><?= htmlspecialchars($companyData->Name) ?></h3>
                                <span class="chat-status">Online</span>
                            </div>
                        </div>
                        <button class="chat-close-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="chat-messages">
                        <!-- Sample messages - these would be dynamically loaded from your backend -->
                        <div class="message received">
                            <div class="message-content">
                                <p>Hello, we're interested in your internship program.</p>
                                <span class="message-time">10:30 AM</span>
                            </div>
                        </div>
                        <div class="message sent">
                            <div class="message-content">
                                <p>That's great! We'd be happy to discuss opportunities.</p>
                                <span class="message-time">10:32 AM</span>
                            </div>
                        </div>
                        <div class="message received">
                            <div class="message-content">
                                <p>When would be a good time for a meeting?</p>
                                <span class="message-time">10:33 AM</span>
                            </div>
                        </div>
                    </div>

                    <div class="chat-input">
                        <button class="attachment-btn">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <input type="text" placeholder="Type a message...">
                        <button class="send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>

                <!-- Chat Toggle Button -->
                <button class="chat-toggle-btn">
                    <i class="fas fa-comment-dots"></i>
                </button>
            </div>



            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn btn-back" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> Back
                </button>

            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        // Chat toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const chatToggle = document.querySelector('.chat-toggle-btn');
            const chatContainer = document.querySelector('.chat-container');
            const closeBtn = document.querySelector('.chat-close-btn');

            chatToggle.addEventListener('click', function() {
                chatContainer.classList.toggle('active');
            });

            closeBtn.addEventListener('click', function() {
                chatContainer.classList.remove('active');
            });

            // Simulate sending a message (in a real app, this would be handled via AJAX)
            const chatInput = document.querySelector('.chat-input input');
            const sendBtn = document.querySelector('.send-btn');
            const chatMessages = document.querySelector('.chat-messages');

            function sendMessage() {
                const messageText = chatInput.value.trim();
                if (messageText) {
                    const now = new Date();
                    const timeString = now.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    const messageElement = document.createElement('div');
                    messageElement.className = 'message sent';
                    messageElement.innerHTML = `
                <div class="message-content">
                    <p>${messageText}</p>
                    <span class="message-time">${timeString}</span>
                </div>
            `;

                    chatMessages.appendChild(messageElement);
                    chatInput.value = '';
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }
            }

            sendBtn.addEventListener('click', sendMessage);
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        });
    </script>

</body>

</html>