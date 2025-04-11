<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/createpassword.css">
    <title>Document</title>
</head>

<body>
    <a class="backbtn" href="<?php echo ROOT ?>/login">
        <i class="fas fa-chevron-left"></i>
    </a>
    <img src="<?= ROOT ?>/assets/img/glogo.png" alt="Gradlink Logo" class="logo-overlay">
    <div class="maincontainer">
        <?php if(isset($data['user']) && !isset($data['user']['otp'])): ?>
            <form method="post" onsubmit="return validotp()">
                <div class="otp-input-container">
                    <label for="otp">Verification Code</label>
                    <p id="otpInstructions" class="otpdetails">
                        Please enter the 6-digit OTP sent to your
                        <?php
                        if (!empty($data['user']['Email'])) {
                            $email = htmlspecialchars($data['user']['Email'], ENT_QUOTES, 'UTF-8');
                            $maskedEmail = preg_replace('/(?<=.).(?=.*@)/', '*', $email);
                            echo "$maskedEmail";
                        }
                        ?>
                        email address.
                    </p>
                    <div class="otp-inputs" id="otpInputs">
                        <input type="text" name="otp[]" maxlength="1" class="otp-box" id="otp1">
                        <input type="text" name="otp[]" maxlength="1" class="otp-box" id="otp2">
                        <input type="text" name="otp[]" maxlength="1" class="otp-box" id="otp3">
                        <input type="text" name="otp[]" maxlength="1" class="otp-box" id="otp4">
                        <input type="text" name="otp[]" maxlength="1" class="otp-box" id="otp5">
                        <input type="text" name="otp[]" maxlength="1" class="otp-box" id="otp6">
                    </div>
                    <p id="otpError" class="error-message"></p>
                    <button type="submit" name="verifyOtp">Verify OTP</button>
                </div>
            </form>
        <?php elseif (isset($data['user']['otp'])): ?>
            <p class="regname">Register Name:
                <?php
                echo htmlspecialchars($data['user']['Name'] ?? '', ENT_QUOTES, 'UTF-8');
                ?>
            </p>
            <p>Register Email:
                <?php
                echo htmlspecialchars($data['user']['Email'] ?? '', ENT_QUOTES, 'UTF-8');
                ?>
            </p>

            <form class="passwordcontainer" method="post" enctype="multipart/form-data" onsubmit="return validatePasswords()">
                <div>
                    <label for="password">Create New Password</label>
                    <input type="text" name="password" id="password" placeholder="password">
                </div>
                <div>
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="text" name="confirmpassword" id="confirmpassword" placeholder="confirm password">
                </div>
                <p id="passwordRequirements" class="details">
                    Password must be at least 8 characters long and include:
                    <br>- At least one uppercase letter
                    <br>- At least one lowercase letter
                    <br>- At least one number
                    <br>- At least one special character (!@#$%^&*)
                </p>
                <input type="file" name="prophoto" id="prophoto" value="<?= ROOT ?>/assets/img/defaultpro.png" accept="image/*" style="display: none;">
                <button type="submit">Save Password</button>
            </form>
        <?php endif; ?>
    </div>

    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <?php if (!empty($data['success'])): ?>
        <script>
            const success = "<?php echo addslashes($data['success']); ?>";
            successToast(success);
        </script>
    <?php endif; ?>
    <?php if (!empty($data['errors'])): ?>
        <script>
            errorToast("<?php echo addslashes($data['errors']); ?>");
        </script>
    <?php endif; ?>


    <script>
        document.querySelectorAll('.otp-box').forEach((input, index, inputs) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus(); // Move to the next box
                }
                if (e.target.value.length === 0 && index > 0) {
                    inputs[index - 1].focus(); // Move to the previous box
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && input.value.length === 0 && index > 0) {
                    inputs[index - 1].focus(); // Go back to the previous box
                }
            });
        });

        function validotp() {
            var otp1 = document.getElementById('otp1').value;
            var otp2 = document.getElementById('otp2').value;
            var otp3 = document.getElementById('otp3').value;
            var otp4 = document.getElementById('otp4').value;
            var otp5 = document.getElementById('otp5').value;
            var otp6 = document.getElementById('otp6').value;
            var otpError = document.getElementById('otpError');

            if (otp1 === "" || otp2 === "" || otp3 === "" || otp4 === "" || otp5 === "" || otp6 === "") {
                otpError.textContent = "OTP must be 6 digits.";
                otpError.style.color = "red";
                return false;
            }

            // Clear error if validation passes
            otpError.textContent = "";
            return true;
        }



        function validatePasswords() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmpassword').value;

            if (!password || !confirmPassword) {
                errorToast("Please fill in all fields.");
                return false; // Prevent form submission
            }
            if (password.length < 8) {
                errorToast("Password must be at least 8 characters long.");
                return false; // Prevent form submission
            }
            if (!/[A-Z]/.test(password)) {
                errorToast("Password must contain at least one uppercase letter.");
                return false; // Prevent form submission
            }
            if (!/[a-z]/.test(password)) {
                errorToast("Password must contain at least one lowercase letter.");
                return false; // Prevent form submission
            }
            if (!/[0-9]/.test(password)) {
                errorToast("Password must contain at least one number.");
                return false; // Prevent form submission
            }
            if (!/[!@#$%^&*]/.test(password)) {
                errorToast("Password must contain at least one special character.");
                return false; // Prevent form submission
            }
            if (password !== confirmPassword) {
                errorToast("Passwords do not match. Please try again.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>

</body>


</html>