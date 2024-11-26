<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/allPages.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentSidebar.css">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/Student/studentHeader.css">
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
            <div class="sub_container">
                <?php if (isset($data) && !empty($data)): ?>
                <div class="display-details">
                    <div class="image">
                        <?php if (!empty($data[0]->image)): ?>
                        <img src="data:image/jpeg;base64,<?php echo $data[0]->image; ?>" class="logo" />
                        <?php else: ?>
                        <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                        <?php endif; ?>
                    </div>
                    <div class="inform">
                        <div>
                            <h4>Position:<span><?php echo $data[0]->position ?></span></h4>
                            <!-- <h4>Internship Period:<span><?php echo $data[0]->period ?></span></h4> -->
                            <h4>No of interns:<span><?php echo $data[0]->numOfInterns ?></span></h4>
                            <h4>Work type:<span><?php echo $data[0]->workingMode ?></span></h4>
                            <h4>Application deadline:<span><?php echo $data[0]->deadline ?></span></h4>
                        </div>
                        <div class="ed-del">
                            <?php if ($data[0]->status === 'Active'): ?>
                            <i class="fas fa-pen"
                                data-position="<?php echo htmlspecialchars($data[0]->position, ENT_QUOTES) ?>"
                                data-description="<?php echo htmlspecialchars($data[0]->description, ENT_QUOTES) ?>"
                                data-qualification="<?php echo htmlspecialchars($data[0]->qualification, ENT_QUOTES) ?>"
                                data-deadline="<?php echo htmlspecialchars($data[0]->deadline, ENT_QUOTES) ?>"
                                data-interns="<?php echo htmlspecialchars($data[0]->numOfInterns, ENT_QUOTES) ?>"
                                data-workingmode="<?php echo htmlspecialchars($data[0]->workingMode, ENT_QUOTES) ?>"
                                data-image="<?php echo htmlspecialchars($data[0]->image, ENT_QUOTES) ?>"
                                onclick="openConfirmationModal(this)">
                            </i>
                            <?php endif; ?>
                            <i class="fas fa-trash" onclick="openconfirmdeleteModal()"></i>

                        </div>
                    </div>
                </div>
                <div class="Qua-des">
                    <div class="Qualifications">
                        <h4>Qualification:</h4>
                        <div class="q-details">
                            <p><?php echo $data[0]->qualification ?></p>
                        </div>
                    </div>

                    <div class="Description">
                        <h4>Description:</h4>
                        <div class="d-details">
                            <p><?php echo $data[0]->description ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>