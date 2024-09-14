<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/CreateAdvertisement.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar")  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Advertisements</h1>
                    </div>
                    <div class="d_pro">
                        <div class="d_profile">
                            <i class="fas fa-calendar-alt"></i>
                            <i class="fas fa-bell"></i>
                        </div>
                        <div>
                        <a href='../Profile/dashboard'>
                            <img src="<?php echo ROOT ?>/assets/img/wso2.png" class="logo" />
                            <p><span>WSO2</span>Company</p>
                        </a>
                        </div>
                    </div>
                </div>
                <div class="main_container">
                    <div class="sc">
                        <a href="../Advertisements/Dashboard" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h3>Create Interview Schedule</h3>
                        </a>
                    </div>
                    <!-- Form data -->
                    <form class="sub_container" method="POST" action="">
                        <div class="position">
                            <h4>Position:</h4>
                            <select id="position" name="position" required>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Software Engineer">Software Engineer</option>
                                <option value="Wed Developer">Wed Developer</option>
                            </select>
                        </div>
                        <div class="details">
                            <div>
                                <h4>Description:</h4>
                                <textarea name="description" id="description" cols="50" rows="10" required></textarea>
                            </div>
                            <div>
                                <h4>Qualifications:</h4>
                                <textarea name="qualifications" id="qualifications" cols="50" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="perioddeadline">
                            <div class="period">
                                <h4>Internship Period:</h4>
                                <input type="text" id="period" name="period" required/>
                            </div>
                            <div class="period">
                                <h4>Application deadline:</h4>
                                <input type="date" id="deadline" name="deadline" required/>
                            </div>
                        </div>
                        
                        <div class="internt">
                            <div class="interns">
                                <h4>No of interns:</h4>
                                <div class="number-input">
                                    <button class="fbtn" type="button" onclick="decrement()">-</button>
                                    <input type="text" id="interns" name="interns" value="5" readonly required>
                                    <button class="sbtn" type="button" onclick="increment()">+</button>
                                </div>
                            </div>
                            <div class="position">
                                <h4>Work type:</h4>
                                <select id="worktype" name="worktype" required>
                                    <option value="Remote">Remote</option>
                                    <option value="Onsite">Onsite</option>
                                    <option value="Hybrid">Hybrid</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                        </div>
                        <div class="addimg">
                            <h4>Add Image:</h4>
                            <input type="file" id="image" />
                        </div>
                            <button type="submit" id="submit" class="sc_btn">
                                Submit
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function increment() {
            let count = document.getElementById('interns-count').value;
            count = parseInt(count) + 1;
            document.getElementById('interns-count').value = count;
        }

        function decrement() {
            let count = document.getElementById('interns-count').value;
            if (count > 1) { // Prevent going below 1
                count = parseInt(count) - 1;
                document.getElementById('interns-count').value = count;
            }
        }
    </script>
</body>

</html>