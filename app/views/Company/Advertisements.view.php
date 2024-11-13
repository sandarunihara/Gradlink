<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Advertisements.css">
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
                <div>
                    <div class="overview">
                        <h2>Overview</h2>
                        <div class="stats">
                            <div class="stat-card">
                                <h2>Total Student Applied</h2>
                                <p><?php echo $numOfapplyStudents ?></p>
                            </div>
                            <div class="stat-card">
                                <h2>Active Advertisements</h2>
                                <p><?php echo $activeCount; ?></p>
                            </div>
                            <div class="stat-card">
                                <h2>Deactive Advertisements</h2>
                                <p><?php echo $deactiveCount; ?></p>
                            </div>
                        </div>
                        <div class="posts">
                            <div class="post_fil">
                                <h2>Posts</h2>
                                <select id="status" name="status" required onchange="filterPosts()">
                                    <option value="All">All</option>
                                    <option value="Active">Active</option>
                                    <option value="Deactive">Deactive</option>
                                </select>
                            </div>
                            <div class="ss_create">
                                <a href="../Advertisements/create">
                                    <button>
                                        <i class="fas fa-plus"></i>
                                        <h4>Create Posts</h4>
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="allpost">
                            <?php if (isset($data) && !empty($data)): ?>
                                <?php foreach ($data as $advertisement): ?>
                                    <div class="postcard" data-status="<?php echo $advertisement->status; ?>">
                                        <div class="image">
                                            <?php if (!empty($advertisement->image)): ?>
                                                <img src="data:image/jpeg;base64,<?php echo $advertisement->image; ?>" class="logo" />
                                            <?php else: ?>
                                                <img src="" class="logo" /> <!-- Optionally, you can set a default image here -->
                                            <?php endif; ?>
                                            <a href="../Advertisements/send/<?php echo $advertisement->advertisementId; ?>" class="top-left-link">View</a>
                                        </div>
                                        <div class="postdetails">
                                            <p>Position:<span class="position"><?php echo $advertisement->position; ?></span></p>
                                            <p>Type:<span><?php echo $advertisement->workingMode; ?></span></p>
                                            <p>No of interns:<span><?php echo $advertisement->numOfInterns; ?></span></p>
                                            <p>status:<span style="color: <?php echo ($advertisement->status === 'Active') ? 'green' : 'red'; ?>"><?php echo $advertisement->status; ?></span></p>
                                            <p>Deadline:<span><?php echo $advertisement->deadline; ?></span></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h3>No advertisements found</h3>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>
    <script>
        function filterPosts() {
            // Get the selected status
            const selectedStatus = document.getElementById('status').value;

            // Get all post cards
            const postCards = document.querySelectorAll('.postcard');

            // Loop through each post card and toggle visibility based on the selected status
            postCards.forEach(post => {
                const postStatus = post.getAttribute('data-status');

                if (selectedStatus === 'All' ||  selectedStatus=== postStatus) {
                    post.style.display = 'block';
                } else {
                    post.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>