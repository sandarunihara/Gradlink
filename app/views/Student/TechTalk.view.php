<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech-Talk</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css"> 
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">  
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/techTalk.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="side">
        <?php $this->renderComponent("studentSidebar")  ?>
    </div>
    <div class="content">
        <div class="header">
            <?php $this->renderComponent("studentHeader")  ?>
        </div>
        <div class="main-content">
            <article class="tech-talk-post">
                <header class="tech-talk-header">
                    <h2>Future of AI</h2>
                    <p class="tech-talk-company">
                        WSO2
                    </p>
                    <p class="tech-talk-date">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i> December 5, 2024
                    </p>
                    <p class="tech-talk-time">
                        <i class="fas fa-clock" aria-hidden="true"></i> 10:00 AM - 12:00 PM
                    </p>
                    <p class="tech-talk-venue">
                        S104 at UCSC
                    </p>
                </header>
                <section class="tech-talk-details">
                    <p class="tech-talk-description">
                        Join us for an exciting tech-talk exploring the latest advancements in artificial intelligence,
                        featuring insights from industry experts and practical applications for students.
                    </p>
                </section>
            </article>
        </div>
    </div>
</body>
</html>