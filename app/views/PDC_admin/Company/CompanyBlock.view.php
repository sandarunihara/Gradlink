<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Blocked Companies</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/company/blockCompany.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>

    <body>

        <div class="side">
                
        </div>

        <div class="container">
            <main class="main-content">
                <header class="header">
                    <div class="header-left">
                        <h1>Blocked Companies</h1>
                    </div>

                    <div class="header-right">
                        <i class="material-icons">notifications</i>
                        <img src="<?= ROOT ?>/assets/img/profile_img.jpg" alt="">

                        <div class="user-info">
                            <span>John</span>
                            <small>Admin</small>
                        </div>
                    </div>
                </header>

                <section class="company-list">
                    <div class="list-header">
                        <h2>Blocked List</h2>
                        <div class="search-box">
                            <input type="text" placeholder="Search Company" />
                            <button> Search
                            </button>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Contact Person</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>WSO2</td>
                                <td>Tharindu Perera</td>
                                <td>tharindu@gmail.com</td>
                                <td>071 273 4321</td>
                                <td><button class="view-btn" onclick="navigateToViewCompany();" >View</button></td>
                            </tr>

                            <tr>
                                <td>WSO2</td>
                                <td>Tharindu Perera</td>
                                <td>tharindu@gmail.com</td>
                                <td>071 273 4321</td>
                                <td><button class="view-btn" onclick="navigateToViewCompany();" >View</button></td>
                            </tr>

                            <tr>
                                <td>WSO2</td>
                                <td>Tharindu Perera</td>
                                <td>tharindu@gmail.com</td>
                                <td>071 273 4321</td>
                                <td><button class="view-btn" onclick="navigateToViewCompany();" >View</button></td>
                            </tr>

                            <tr>
                                <td>WSO2</td>
                                <td>Tharindu Perera</td>
                                <td>tharindu@gmail.com</td>
                                <td>071 273 4321</td>
                                <td><button class="view-btn" onclick="navigateToViewCompany();" >View</button></td>
                            </tr>

                            <tr>
                                <td>WSO2</td>
                                <td>Tharindu Perera</td>
                                <td>tharindu@gmail.com</td>
                                <td>071 273 4321</td>
                                <td><button class="view-btn" onclick="navigateToViewCompany();" >View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <div class="action-buttons">
                <div class="button-line">
                    <div class="action-buttons">
                        <button class="btn back-btn">Back</button>
                    </div>
                </div>
                </div>

            </main>
            
        </div>
        <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>


    </body>

</html>