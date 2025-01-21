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
    <?php $this->renderComponent("studentHeader")  ?>
    <?php $this->renderComponent("studentSidebar")  ?>
    <div class="main-content">
        <article class="tech-talk-post">
            <header class="tech-talk-header">
                <h2><?php echo htmlspecialchars($data['session'][0]->session_name)?></h2>
                <p class="tech-talk-company">
                    <?php echo htmlspecialchars($data['session'][0]->company_name)?>
                </p>
                <p class="tech-talk-date">
                    <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                    <?php 
                        list($year, $dayOfYear) = explode("-", htmlspecialchars($data['session'][0]->session_date));
                        $date = DateTime::createFromFormat('Y-m-d', "$year-01-01");
                        $date->add(new DateInterval("P" . ($dayOfYear - 1) . "D"));
                        $formattedDate = $date->format('F j, Y');
                        echo $formattedDate;
                    ?>

                </p>
                <p class="tech-talk-time">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                    <?php echo htmlspecialchars($data['session'][0]->time_slot)?>
                </p>
                <p class="tech-talk-venue">
                <?php echo htmlspecialchars($data['session'][0]->hall_number)?>
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
</body>
</html>