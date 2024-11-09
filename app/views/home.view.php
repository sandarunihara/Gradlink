<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradlink</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/home.css">
</head>

<body >
        <div class="f-container " >
            <div class="l-container">
                <div class="logo">
                    <img class="glogo" src="<?php echo ROOT ?>/assets/img/grad.png" alt="" height="300" width="400">
                </div>
                <p class="wel-s"><span class="welcome">Welcome</span> to the <br /><span class="ui">Undergraduate Internship</span></br><span class="ms"> Management System</span></p>
                <p class="wel-p">Connecting talents with opportunities and bridging the gap </br> between academic and industry.</p>
                <div class="btns">
                    <a href="<?php echo ROOT ?>/login" class="login">Login</a>
                    <a href="<?php echo ROOT ?>/Home/userrole" class="register">Register</a>
                </div>
            </div>
            <div class="r-container">
                <div class="ucscdiv">
                    <img class="ucsc" src="<?php echo ROOT ?>/assets/img/ucsclogo.jpg" alt="" height="100" width="100">
                </div>
                <div class="image1" id="image1">
                    <p class="first1">Shaping future leaders <br />today</p>
                    <p class="second1">Where academia <br /> meets industry</p>
                    <img class="bg" src="<?php echo ROOT ?>/assets/img/home1.png" alt="" height="500" width="700">
                </div>
                <div class="image2" id="image2">
                    <p class="first2">Your pathway to success <br />starts here</p>
                    <p class="second2">connecting talent with <br /> opportunity</p>
                    <img class="bg" src="<?php echo ROOT ?>/assets/img/home2.png" alt="" height="500" width="740">
                </div>
                <div class="image3" id="image3">
                    <p class="first3">Step into your <br />future</p>
                    <p class="second3">where potential meets <br /> opportunity</p>
                    <img class="bg" src="<?php echo ROOT ?>/assets/img/home3.png" alt="" height="500" width="700">
                </div>
            </div>
        </div>
        <footer>
            <p>© 2024 UCSC - All Rights Reserved | Contact:<a class="sup" href="#">support@ucsc.edu</a></p>
            <div class="icon">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-linkedin"></i>
            </div>
        </footer>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const images = [document.getElementById('image1'), document.getElementById('image2'), document.getElementById('image3')];
            let currentIndex = 0;

            function showImage(index) {
                // Set all images to 'image-hide' before showing the next one
                images.forEach((img, i) => {
                    img.classList.remove('image-show');
                    img.classList.add('image-hide');
                });

                // Show the current image
                images[index].classList.remove('image-hide');
                images[index].classList.add('image-show');
            }

            function nextImage() {
                // Hide the current image after the transition
                images[currentIndex].classList.remove('image-show');
                images[currentIndex].classList.add('image-hide');

                // Move to the next image
                currentIndex = (currentIndex + 1) % images.length;
                showImage(currentIndex);
            }

            // Initial display
            showImage(currentIndex);

            // Change image every 5 seconds
            setInterval(nextImage, 5000);
        });

    document.addEventListener("DOMContentLoaded", () => {
        const links = document.querySelectorAll('.login, .register');

        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                document.body.classList.add('page-exit');

                // Ensure the navigation waits exactly until the exit animation finishes
                setTimeout(() => {
                    window.location.href = link.href;
                }, 950); // Match with the CSS animation time (slightly less for seamless effect)
            });
        });
    });


    </script>

</body>

</html>