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
            <?php $this->renderComponent("companysidebar",['hasShortlisted'=>$_SESSION['hasShortlisted'],'hasRecruited'=>$_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Advertisements</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="main_container">
                    <div class="sc">
                        <a href="../Advertisements/send" class="sc_container">
                            <i class="fas fa-chevron-left"></i>
                            <h3>Back</h3>
                        </a>
                    </div>
                    <div class="sub_container">
                        <div class="position">
                            <h4>Position:</h4>
                            <select id="position">
                                <option value="qa">Quality Assurance</option>
                                <option value="se">Software Engineer</option>
                                <option value="wd">Wed Developer</option>
                            </select>
                        </div>
                        <div class="details">
                            <div>
                                <h4>Description:</h4>
                                <textarea name="description" id="description" cols="50" rows="10"></textarea>
                            </div>
                            <div>
                                <h4>Qualifications:</h4>
                                <textarea name="qualifications" id="qualifications" cols="50" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="perioddeadline">
                            <div class="period">
                                <h4>Internship Period:</h4>
                                <input type="text" id="period" />
                            </div>
                            <div class="period">
                                <h4>Application deadline:</h4>
                                <input type="date" id="period" />
                            </div>
                        </div>
                        
                        <div class="internt">
                            <div class="interns">
                                <h4>No of interns:</h4>
                                <div class="number-input">
                                    <button class="fbtn" type="button" onclick="decrement()">-</button>
                                    <input type="text" id="interns-count" value="5" readonly>
                                    <button class="sbtn" type="button" onclick="increment()">+</button>
                                </div>
                            </div>
                            <div class="position">
                                <h4>Work type:</h4>
                                <select id="position">
                                    <option value="qa">Remote</option>
                                    <option value="se">Onsite</option>
                                    <option value="wd">Hybrid</option>
                                    <option value="wd">Flexible</option>
                                </select>
                            </div>
                        </div>
                        <div class="addimg">
                            <h4>Add Image:</h4>
                            <input type="file" id="image" accept="image/*" />
                        </div>
                        <a href="../Advertisements/send">
                            <button type="submit" class="sc_btn">
                                Submit
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const dateInput = document.getElementById('period');
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); 
            const dd = String(today.getDate()+1).padStart(2, '0');

            const minDate = `${yyyy}-${mm}-${dd}`;
            dateInput.setAttribute('min', minDate);
        });

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