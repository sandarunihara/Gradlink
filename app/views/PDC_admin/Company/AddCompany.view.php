<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Company</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/addCompany.css?time=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php 
        if (isset($_SESSION['flash_message'])): 
            $message = htmlspecialchars($_SESSION['flash_message']['message']);
            $type = htmlspecialchars($_SESSION['flash_message']['type']);
            unset($_SESSION['flash_message']);
        ?>
        <script>
            window.__flashMessage = {
                message: "<?= $message ?>",
                type: "<?= $type ?>"
            };
        </script>
    <?php endif; ?>

    <div class="container">
        <div class="sidebar">
            <?php $this->renderComponent("pdc_adminsidebar") ?>

        </div>
        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>Register Company</h1>
                </div>
            </header>
            
            <div class="tab-content">

                <div id="company-list" class="tab-pane active">
                    <section class="company-info">
                        <form class="company-form" method="POST" action="<?= ROOT ?>/PDC_admin/AddCompany/create">
                            
                            <div class="filling-form">
                                <div class="form-group">
                                    <label for="company-name">Company Name</label>
                                    <input type="text" id="company-name" placeholder="Company name" name="company_name" />
                                    <p class="error-message">Company Name cannot be empty</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email-address">Email Address</label>
                                    <input type="email" id="email-address" placeholder="Email" name="email"/>
                                    <p class="error-message">Email cannot be empty</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact-person">Contact Person</label>
                                    <input type="text" id="contact-person" placeholder="Name" name="contact_person"/>
                                    <p class="error-message">Contact Person cannot be empty</p>
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact-number">Contact Number</label>
                                    <input type="text" id="contact-number" placeholder="Mobile" name="contact_number"/>
                                    <small class="format-hint">Enter a valid phone number (e.g. 0733333333)</small>
                                    <p class="error-message basic">Contact Number cannot be empty</p>
                                    <p class="error-message pattern">Contact Number Pattern not valid</p>
                                    </div>
                            </div>

                            <div class="button-line">
                                <button class="btn back-btn" onclick="history.back()"><b>Back</b></button>
                                <button class="btn submit-btn" type="submit"><b>Submit</b></button> 
                            </div>

                        </form>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"></script>

    <script>

        const companyForm = document.querySelector('.company-form')

        companyForm.addEventListener('submit', function(e){
            let iserror = false

            const errors = document.querySelectorAll('.error-message');
            errors.forEach(msg => msg.style.display = 'none');

            const companyName = document.getElementById('company-name');
            if(companyName.value.trim() === ""){
                companyName.nextElementSibling.style.display = 'block';
                iserror = true
            }

            const companyEmail = document.getElementById('email-address')
            if(companyEmail.value.trim() === ""){
                companyEmail.nextElementSibling.style.display = 'block'
                iserror = true
            }

            const person = document.getElementById('contact-person')
            if(person.value.trim() === ""){
                person.nextElementSibling.style.display = 'block'
                iserror = true
            }

            const contactNumber = document.getElementById('contact-number');
            const contactNumberValue = contactNumber.value.trim();
            if (contactNumberValue === "") {
                contactNumber.parentElement.querySelector('.error-message.basic').style.display = 'block';
                iserror = true;
            } else if (!/^\d{10}$/.test(contactNumberValue)) {
                contactNumber.parentElement.querySelector('.error-message.pattern').style.display = 'block';
                iserror = true;
            }


            if(iserror){
                e.preventDefault();
            }





        })

    </script>
</body>

</html>
