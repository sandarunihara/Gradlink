<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Coordinator/Company/viewPendingCompany.css">
</head>

<body>
    <div class="container">
    <?php $this->renderComponent("coordinatorDashboard")  ?>

        <main class="content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Advertisement</h1>
                </div>

                <div class="header-right">
                    <i class="material-icons">notifications</i>
                    <img src="<?= ROOT ?>/assets/images/profile_img.jpg" alt="">

                    <div class="user-info">
                        <span>Jonitha Cathrine</span>
                        <small>Admin</small>
                    </div>
                </div>
            </header>
            <section class="company-info">
                <form class="company-form">
                    <div class="form-group">
                        <label for="company-name">Company Name</label>
                        <input type="text" id="company-name" placeholder="Creative Pixels" readonly>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <input type="text" id="position" placeholder="UI Designer Intern" readonly>
                    </div>
                    <div class="form-group">
                        <label for="interns">Number of Interns</label>
                        <input type="number" id="interns" placeholder="3" readonly>
                    </div>
                    <div class="form-group">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" placeholder="10/10/2024" readonly>
                    </div>
                    <div class="form-group">
                        <label for="end-date">End Date</label>
                        <input type="date" id="end-date" placeholder="20/10/2024" readonly>
                    </div>
                    <div class="form-group">
                        <label for="working-mode">Working Mode</label>
                        <input type="text" id="working-mode" placeholder="Hybrid (3 days in-office, 2 days remote)" readonly>
                    </div>
                    <div class="form-group">
                        <label for="requirements">Requirements</label>
                        <textarea id="requirements" placeholder="Familiarity with design tools such as Figma, Sketch, or Adobe XD
Basic understanding of responsive design principles
A creative portfolio demonstrating design work (coursework, personal projects, etc.)
Good communication and teamwork skills
Ability to work in a fast-paced environment and adapt to feedback" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label for="qualifications">Qualifications</label>
                        <textarea id="qualifications" placeholder="Currently pursuing a degree or diploma in UI/UX Design, Graphic Design, or a related field
Strong attention to detail and problem-solving skills
Knowledge of color theory, typography, and layout design
Understanding of user-centered design principles is a plus" readonly></textarea>
                    </div>
                    
                </form>
            </section>
        </main>
    </div>
</body>

</html>