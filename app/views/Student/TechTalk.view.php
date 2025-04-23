<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Talk</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/techTalk.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php $this->renderComponent("studentHeader", ["title" => "Tech-Talk"])  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <?php if(!isset($data['session']) || empty($data['session'])): ?>
    <div class="main-content">
        <h2 class="no-sessions-message">No Tech-Talks Scheduled Today</h2>
    </div>
    <?php else: ?>
        <div class="main-content">
            <article class="tech-talk-post">
                <header class="tech-talk-header">
                    <h2 class="session-title"></h2>
                    <p class="tech-talk-company">
                        <i class="fas fa-building" aria-hidden="true"></i>
                        <span class="company-name"></span>
                    </p>
                    <div class="session-info-container">
                        <p class="tech-talk-date">
                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                            <span class="session-date"></span>
                        </p>
                        <p class="tech-talk-time">
                            <i class="fas fa-clock" aria-hidden="true"></i>
                            <span class="session-time"></span>
                        </p>
                        <p class="tech-talk-venue">
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="session-venue"></span>
                        </p>
                    </div>
                </header>
                <section class="tech-talk-details">
                    <h3>About This Session:</h3>
                    <p class="tech-talk-description"></p>
                </section>
            </article>
            <div class="button-container">
                <button id="previous-button" class="nav-button" disabled>
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                <span class="session-counter">
                    <span id="current-index">1</span> of <?php echo count($data['session']); ?>
                </span>
                <button id="next-button" class="nav-button">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    <?php endif; ?>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previousButton = document.getElementById('previous-button');
        const nextButton = document.getElementById('next-button');
        const currentIndexDisplay = document.getElementById('current-index');
        let currentIndex = 0;
        const sessions = <?php echo json_encode($data['session'] ?? []); ?>;
        const totalSessions = sessions.length;

        function updateSessionDisplay(index) {
            if (totalSessions === 0) return;
            
            const session = sessions[index];
            document.querySelector('.session-title').textContent = session.session_name || 'Tech Talk';
            document.querySelector('.company-name').textContent = session.Name || 'Guest Company';
            
            // Format date nicely (e.g., "Monday, January 1, 2023")
            const sessionDate = session.session_date ? new Date(session.session_date) : new Date();
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.querySelector('.session-date').textContent = sessionDate.toLocaleDateString('en-US', dateOptions);
            
            document.querySelector('.session-time').textContent = session.time_slot || 'Time not specified';
            document.querySelector('.session-venue').textContent = session.hall_number ? `Hall ${session.hall_number}` : 'Venue not specified';
            document.querySelector('.tech-talk-description').textContent = session.description || 'No description available.';
            
            // Update navigation buttons state
            previousButton.disabled = index === 0;
            nextButton.disabled = index === totalSessions - 1;
            
            // Update counter
            currentIndexDisplay.textContent = index + 1;
        }

        previousButton.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateSessionDisplay(currentIndex);
            }
        });

        nextButton.addEventListener('click', function() {
            if (currentIndex < totalSessions - 1) {
                currentIndex++;
                updateSessionDisplay(currentIndex);
            }
        });

        // Initialize the display with the first session
        if (totalSessions > 0) {
            updateSessionDisplay(currentIndex);
        }
    });
</script>
</body>
</html>