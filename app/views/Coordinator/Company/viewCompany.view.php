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
        document.addEventListener('DOMContentLoaded', function() {
            // Get all necessary elements
            const chatToggle = document.querySelector('.chat-toggle-btn');
            const chatContainer = document.querySelector('.chat-container');
            const closeBtn = document.querySelector('.chat-close-btn');
            const chatMessages = document.querySelector('.chat-messages');
            const chatInput = document.querySelector('.chat-input input');
            const sendBtn = document.querySelector('.send-btn');

            // Debug: Check if elements are found
            console.log('Chat Toggle:', chatToggle);
            console.log('Chat Container:', chatContainer);
            console.log('Close Button:', closeBtn);

            // Get company ID - Fix: Properly handle the company ID as a string
            const companyId = '<?= isset($companyData->CompanyId) ? htmlspecialchars($companyData->CompanyId) : '' ?>';
            let lastMessageId = 0;
            let chatActive = false;
            let messageCheckInterval;

            // Initialize chat
            function initChat() {
                if (!companyId) {
                    console.error('Company ID not found');
                    return;
                }

                console.log('Initializing chat with company ID:', companyId);
                
                // Load initial messages
                loadChatMessages();
                
                // Start checking for new messages every 5 seconds
                messageCheckInterval = setInterval(checkForNewMessages, 5000);
                
                // Clean up interval when chat is closed
                chatContainer.addEventListener('transitionend', function(e) {
                    if (e.propertyName === 'right' && !chatContainer.classList.contains('active')) {
                        clearInterval(messageCheckInterval);
                    }
                });
            }

            // Load existing chat messages
            function loadChatMessages() {
                console.log('Loading messages for company ID:', companyId);
                fetch(`<?= ROOT ?>/PDC_coordinator/ViewCompany/getMessages?id=${companyId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text().then(text => {
                            try {
                                return JSON.parse(text);
                            } catch (e) {
                                console.error('Invalid JSON response:', text);
                                throw new Error('Invalid JSON response from server');
                            }
                        });
                    })
                    .then(messages => {
                        if (!Array.isArray(messages)) {
                            console.error('Invalid messages format:', messages);
                            return;
                        }

                        console.log('Loaded messages:', messages);
                        chatMessages.innerHTML = '';
                        
                        if (messages.length > 0) {
                            messages.forEach(message => {
                                addMessageToChat(message, false);
                            });
                            
                            // Set lastMessageId to the latest message's ID
                            lastMessageId = messages[messages.length - 1].id;
                            console.log('Set lastMessageId to:', lastMessageId);

                            // Mark messages as read after loading
                            markMessagesAsRead();
                        } else {
                            console.log('No messages found');
                            lastMessageId = 0;
                        }

                        scrollToBottom();
                    })
                    .catch(error => {
                        console.error('Error loading messages:', error);
                        showMessageError('Failed to load messages. Please try again.');
                    });
            }

            // Mark messages as read
            function markMessagesAsRead() {
                if (!companyId) return;
                
                fetch(`<?= ROOT ?>/PDC_coordinator/ViewCompany/markAsRead`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `company_id=${companyId}`
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Messages marked as read:', data);
                })
                .catch(error => {
                    console.error('Error marking messages as read:', error);
                });
            }

            // Check for new messages
            function checkForNewMessages() {
                if (!chatActive || !companyId) {
                    console.log('Chat not active or no company ID, skipping check');
                    return;
                }

                console.log('Checking for new messages with last ID:', lastMessageId);
                fetch(`<?= ROOT ?>/PDC_coordinator/ViewCompany/checkNewMessages/${companyId}?last_id=${lastMessageId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text().then(text => {
                            try {
                                return JSON.parse(text);
                            } catch (e) {
                                console.error('Invalid JSON response:', text);
                                throw new Error('Invalid JSON response from server');
                            }
                        });
                    })
                    .then(data => {
                        console.log('New messages response:', data);
                        if (data.status === 'success' && data.messages && data.messages.length > 0) {
                            console.log('Found new messages:', data.messages);
                            data.messages.forEach(message => {
                                addMessageToChat(message, false);
                            });
                            
                            lastMessageId = data.messages[data.messages.length - 1].id;
                            console.log('Updated lastMessageId to:', lastMessageId);
                            
                            if (isNearBottom()) {
                                scrollToBottom();
                            }
                            
                            if (!chatContainer.classList.contains('active')) {
                                showNewMessageNotification(data.new_count);
                            }
                        } else {
                            console.log('No new messages found');
                        }
                    })
                    .catch(error => {
                        console.error('Error checking new messages:', error);
                    });
            }

            // Send a new message
            function sendMessage() {
                const messageText = chatInput.value.trim();
                if (messageText && companyId) {
                    console.log('Sending message:', messageText);
                    // Add message to UI immediately (optimistic update)
                    const tempMessage = {
                        id: 'temp-' + Date.now(),
                        message: messageText,
                        time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
                        isMe: true
                    };
                    
                    addMessageToChat(tempMessage, true);
                    chatInput.value = '';
                    scrollToBottom();
                    
                    // Send to server
                    fetch(`<?= ROOT ?>/PDC_coordinator/ViewCompany/sendMessage`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `message=${encodeURIComponent(messageText)}&company_id=${companyId}`
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text().then(text => {
                            try {
                                return JSON.parse(text);
                            } catch (e) {
                                console.error('Invalid JSON response:', text);
                                throw new Error('Invalid JSON response from server');
                            }
                        });
                    })
                    .then(data => {
                        console.log('Send message response:', data);
                        if (data.status === 'success') {
                            const tempMsgElement = document.querySelector(`[data-temp-id="${tempMessage.id}"]`);
                            if (tempMsgElement) {
                                tempMsgElement.removeAttribute('data-temp-id');
                                tempMsgElement.dataset.messageId = data.message_id;
                            }
                            
                            lastMessageId = data.message_id;
                        } else {
                            showMessageError('Failed to send message', messageText);
                        }
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);
                        showMessageError('Failed to send message', messageText);
                    });
                }
            }

            // Add message to chat UI
            function addMessageToChat(message, isTemp) {
                const messageElement = document.createElement('div');
                messageElement.className = `message ${message.isMe ? 'sent' : 'received'}`;
                
                if (isTemp) {
                    messageElement.dataset.tempId = message.id;
                } else {
                    messageElement.dataset.messageId = message.id;
                }
                
                messageElement.innerHTML = `
                    <div class="message-content">
                        <p>${message.message}</p>
                        <span class="message-time">${message.time}</span>
                    </div>
                `;
                
                chatMessages.appendChild(messageElement);
            }

            // Show message error
            function showMessageError(error, originalMessage) {
                const errorElement = document.createElement('div');
                errorElement.className = 'message-error';
                errorElement.textContent = error;
                chatMessages.appendChild(errorElement);
                
                // Put the original message back in the input
                chatInput.value = originalMessage;
                chatInput.focus();
                
                setTimeout(() => {
                    errorElement.remove();
                }, 3000);
            }

            // Check if scroll is near bottom
            function isNearBottom() {
                return chatMessages.scrollTop + chatMessages.clientHeight + 50 >= chatMessages.scrollHeight;
            }

            // Scroll to bottom of chat
            function scrollToBottom() {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Show new message notification
            function showNewMessageNotification(count) {
                const notification = document.createElement('div');
                notification.className = 'chat-notification-badge';
                notification.textContent = count;
                chatToggle.appendChild(notification);
                
                // Add animation
                chatToggle.classList.add('pulse');
                setTimeout(() => {
                    chatToggle.classList.remove('pulse');
                }, 1000);
            }

            // Toggle chat visibility
            if (chatToggle && chatContainer) {
                chatToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    console.log('Toggle button clicked');
                    
                    chatContainer.classList.toggle('active');
                    chatActive = chatContainer.classList.contains('active');
                    
                    console.log('Chat active:', chatActive);
                    
                    // Remove notification badge when opening
                    if (chatActive) {
                        const badge = chatToggle.querySelector('.chat-notification-badge');
                        if (badge) badge.remove();
                        loadChatMessages();
                    }
                });
            }

            // Close chat
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    chatContainer.classList.remove('active');
                    chatActive = false;
                });
            }

            // Send message on button click
            if (sendBtn) {
                sendBtn.addEventListener('click', sendMessage);
            }

            // Send message on Enter key
            if (chatInput) {
                chatInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        sendMessage();
                    }
                });
            }

            // Initialize chat when page loads
            initChat();
        });
    </script>

</body>

</html>