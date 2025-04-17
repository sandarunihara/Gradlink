<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Fix.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/Companysidebar.css">
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/Company/StudentsR.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="body">
    <div class="dashboard">
        <div class="side">
            <?php $this->renderComponent("companysidebar", ['hasShortlisted' => $_SESSION['hasShortlisted'], 'hasRecruited' => $_SESSION['hasRecruited']])  ?>
        </div>
        <div id="content">
            <div class="main">
                <div class="d">
                    <div>
                        <h1>Students Requests</h1>
                    </div>
                    <?php $this->renderComponent("companyheader") ?>
                </div>
                <div class="sr_main">
                    <div class="sr_search">
                        <div class="filterbar">
                            <select class="role-select">
                                <option value="all">All Positions</option>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Software Engineer">Software Engineer</option>
                                <option value="Web Developer">Web Developer</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Machine Learning">Machine Learning</option>
                                <option value="Data Analyst">Data Analyst</option>
                                <option value="Full Stack Developer">Full Stack Developer</option>
                                <option value="Backend Developer">Backend Developer</option>
                                <option value="Frontend Developer">Frontend Developer</option>
                                <option value="DevOps Engineer">DevOps Engineer</option>
                                <option value="Cloud Architect">Cloud Architect</option>
                                <option value="Cybersecurity Analyst">Cybersecurity Analyst</option>
                                <option value="AI Engineer">AI Engineer</option>
                                <option value="Mobile App Developer">Mobile App Developer</option>
                                <option value="Blockchain Developer">Blockchain Developer</option>
                                <option value="Game Developer">Game Developer</option>
                                <option value="UI/UX Designer">UI/UX Designer</option>
                                <option value="Product Manager">Product Manager</option>
                                <option value="System Administrator">System Administrator</option>
                                <option value="Network Engineer">Network Engineer</option>
                                <option value="Technical Support Engineer">Technical Support Engineer</option>
                                <option value="Embedded Systems Engineer">Embedded Systems Engineer</option>
                                <option value="Cloud Engineer">Cloud Engineer</option>
                                <option value="Software Architect">Software Architect</option>
                                <option value="Solutions Architect">Solutions Architect</option>
                                <option value="IT Consultant">IT Consultant</option>
                                <option value="Quality Engineer">Quality Engineer</option>
                                <option value="Business Intelligence Analyst">Business Intelligence Analyst</option>
                                <option value="RPA Developer">RPA Developer</option>
                                <option value="ERP Consultant">ERP Consultant</option>
                                <option value="Salesforce Developer">Salesforce Developer</option>
                                <option value="SAP Consultant">SAP Consultant</option>
                            </select>
                            <div class="sr_filter-container">
                                <!-- <i class="fas fa-filter"></i> -->
                                <select class="status-select">
                                    <option value="all">All Status</option>
                                    <option value="Shortlisted">Shortlisted</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                            <div class="sr_search-container">
                                <input id="searchInput" type="text" placeholder="Search by Skills" autocomplete="off" oninput="showSuggestions()">
                                <i class="fas fa-search"></i>
                                <div id="suggestions" class="suggestions-box"></div>
                            </div>
                        </div>
                        <div>
                            <?php if ($_SESSION['hasShortlisted'] == 1) : ?>
                                <a href="../ShortlistedStudents/dashboard" class="shortbutton">
                                    <button class="export-btn">Shortlisted List</button>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sr_t">
                        <div class="sr_table">
                            <!-- Table -->
                            <div>
                                <table class="student-table">
                                    <thead class="sr_table_t">
                                        <th>
                                            <h5>Student Name</h5>
                                        </th>
                                        <th>
                                            <h5>Student Degree</h5>
                                        </th>
                                        <th>
                                            <h5>Position</h5>
                                        </th>
                                        <th>
                                            <h5>Action</h5>
                                        </th>
                                        <th>
                                            <h5></h5>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($data) && !empty($data)): ?>
                                            <?php foreach ($data as $student): ?>
                                                <?php
                                                $status = $student['Action'];


                                                switch ($status) {
                                                    case 'Recruit':
                                                        $statusText = 'Recruit';
                                                        $statusClass = 'Recruit';
                                                        break;
                                                    case 'Reject':
                                                        $statusText = 'Rejected';
                                                        $statusClass = 'Reject';
                                                        break;
                                                    case 'Interview Scheduled':
                                                        $statusText = 'Interview Scheduled';
                                                        $statusClass = 'Sendemail';
                                                        break;
                                                    case 'Interview Expired':
                                                        $statusText = 'Interview Expired';
                                                        $statusClass = 'Sendemail';
                                                        break;
                                                    case 'Shortlist':
                                                        $statusText = 'Shortlisted';
                                                        $statusClass = 'Shortlist';
                                                        break;
                                                    default:
                                                        $statusText = 'Pending';
                                                        $statusClass = 'Pending';
                                                        break;
                                                }

                                                ?>
                                                <tr class="sr_row">
                                                    <td class="name"><?php echo htmlspecialchars($student['Student Name']); ?></td>
                                                    <td class="degree"><?php echo htmlspecialchars($student['Student Degree']); ?></td>
                                                    <td class="position"><?php echo htmlspecialchars($student['Position']); ?></td>
                                                    <td class="skill" style="display: none;">
                                                        <?php
                                                        $skills = explode(', ', $student['Skills']); // Convert comma-separated string to array
                                                        foreach ($skills as $skill) {
                                                            echo "<div>" . htmlspecialchars($skill) . "</div>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="<?php echo $statusClass; ?>">
                                                            <span class="action"><?php echo $statusText; ?></span>
                                                        </div>
                                                    </td>
                                                    <?php if ($statusText != 'Rejected'): ?>
                                                        <td class="viewpro">
                                                            <a href="../StudentsRequests/studentprofile/<?php echo $student["AdvertisementId"]; ?>/<?php echo $student["StudentId"]; ?>" class="profile-link">
                                                                <button class="view-profile-btn">View Profile</button>
                                                            </a>
                                                        </td>
                                                    <?php elseif ($statusText == 'Rejected'): ?>
                                                        <td class="viewpro">
                                                            <a href="../StudentsRequests/studentprofile/<?php echo $student["AdvertisementId"]; ?>/<?php echo $student["StudentId"]; ?>" class="profile-link">
                                                                <button class="view-profile-btn-with-remove">View Profile</button>
                                                            </a>

                                                            <!-- <i class="removebtn fas fa-trash-alt fa-trash-alty"></i> -->
                                                        </td>
                                                    <?php endif ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="5">No students found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($removedlist) && !empty($removedlist)): ?>
                        <?php
                        $names = array_map(function ($student) {
                            return htmlspecialchars($student['Student Name']);
                        }, $removedlist);

                        $nameList = implode(', ', $names);
                        ?>

                        <div class="removed-message">
                            <strong><?php echo $nameList; ?></strong> have been recruited by another company and are therefore no longer under consideration.
                            <form method="POST" action="">

                                <button type="submit" value="close" name="submit">sub</button>
                            </form>
                        </div>
                    <?php endif; ?>



                </div>
            </div>
        </div>
    </div>



    <div id="toast-container" class="toast-container"></div>
    <script src="<?php echo ROOT ?>/assets/js/toast.js"></script>

    <script>
        const skillsList = [
            //  Programming Languages
            "JavaScript", "Python", "Java", "C", "C++", "C#", "TypeScript", "Go", "Swift", "Kotlin", "Dart", "Rust", "Ruby", "PHP", "Perl", "R", "MATLAB",

            //  Frontend Frameworks & Libraries
            "React", "Vue.js", "Angular", "Svelte", "Next.js", "Nuxt.js", "Bootstrap", "Tailwind CSS", "jQuery",

            //  Backend Frameworks & Technologies
            "Node.js", "Express.js", "Spring Boot", "Django", "Flask", "FastAPI", "Ruby on Rails", "ASP.NET Core", "Laravel", "CodeIgniter",

            //  Mobile Development
            "Flutter", "React Native", "SwiftUI", "Jetpack Compose", "Ionic", "Xamarin",

            //  Databases & Query Languages
            "MySQL", "PostgreSQL", "MongoDB", "SQLite", "Firebase", "Oracle", "Microsoft SQL Server", "Redis", "GraphQL", "Cassandra", "MariaDB", "DynamoDB",

            //  DevOps & Cloud
            "Docker", "Kubernetes", "AWS", "Azure", "Google Cloud", "Terraform", "Jenkins", "GitHub Actions", "CI/CD", "Ansible",

            //  Version Control & Tools
            "Git", "GitHub", "GitLab", "Bitbucket", "SVN",

            //  Cybersecurity & Networking
            "Ethical Hacking", "Penetration Testing", "Cybersecurity", "Cryptography", "Network Security", "Wireshark", "Metasploit",

            //  AI, ML, and Data Science
            "TensorFlow", "PyTorch", "Keras", "Scikit-learn", "Pandas", "NumPy", "Matplotlib", "OpenCV", "NLTK", "Hugging Face", "Stable Diffusion",

            //  IoT & Embedded Systems
            "Arduino", "ESP32", "Raspberry Pi", "MicroPython", "Embedded C",

            //  Game Development
            "Unity", "Unreal Engine", "Godot", "Cocos2d", "Phaser.js",

            //  Blockchain & Web3
            "Solidity", "Ethereum", "Polygon", "Hyperledger", "Smart Contracts",

            //  UI/UX & Design Tools
            "Figma", "Adobe XD", "Sketch", "Photoshop", "Illustrator",

            //  Other Technologies
            "WebSockets", "REST API", "GraphQL API", "MQTT", "WebRTC"
        ];

        function showSuggestions() {
            const input = document.getElementById('searchInput');
            const query = input.value.toLowerCase();
            const suggestionsBox = document.getElementById('suggestions');

            if (query.length === 0) {
                suggestionsBox.style.display = "none";
                return;
            }

            let matches = skillsList.filter(skill => skill.toLowerCase().includes(query)); // Exact match filtering

            // If no exact matches, use fuzzy matching (similar words)
            if (matches.length === 0) {
                matches = skillsList.filter(skill => fuzzyMatch(query, skill.toLowerCase()));
            }

            suggestionsBox.innerHTML = "";
            if (matches.length > 0) {
                matches.forEach(skill => {
                    const div = document.createElement("div");
                    div.textContent = skill;
                    div.onclick = function() {
                        input.value = skill; // Set input value to the selected skill
                        suggestionsBox.style.display = "none"; // Hide suggestions
                        filterTable(); // Call the existing filter function
                    };
                    suggestionsBox.appendChild(div);
                });
                suggestionsBox.style.display = "block";
            } else {
                suggestionsBox.style.display = "none";
            }
        }

        // Simple fuzzy matching function (checks how similar two words are)
        function fuzzyMatch(query, skill) {
            let mistakes = 0;
            let i = 0,
                j = 0;

            while (i < query.length && j < skill.length) {
                if (query[i] !== skill[j]) {
                    mistakes++;
                    if (mistakes > 2) return false; // Allow small errors (2 character mismatches)
                } else {
                    i++;
                }
                j++;
            }
            return true;
        }

        // Hide suggestions when clicking outside
        document.addEventListener("click", function(event) {
            if (!event.target.closest(".sr_search-container")) {
                document.getElementById("suggestions").style.display = "none";
            }
        });




        // Add click handler for profile links
        document.addEventListener('click', function(e) {
            const profileLink = e.target.closest('.profile-link');
            if (profileLink) {
                e.preventDefault();

                // Get current filter values
                const position = document.querySelector('.role-select').value;
                const status = document.querySelector('.status-select').value;
                const skillSearch = document.getElementById('searchInput').value

                // Build new URL with parameters
                const newUrl = `${profileLink.href}?position=${encodeURIComponent(position)}&status=${encodeURIComponent(status)}&skill=${encodeURIComponent(skillSearch)}`;

                // Navigate to the new URL
                window.location.href = newUrl;
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            // Read URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const position = urlParams.get('position') || 'all';
            const status = urlParams.get('status') || 'all';
            const skillSearch = urlParams.get('skill') || '';

            // Set filter values
            document.querySelector('.role-select').value = position;
            document.querySelector('.status-select').value = status;
            document.getElementById('searchInput').value = skillSearch;

            // Apply initial filters
            filterTable();
        });



        document.getElementById('searchInput').addEventListener('input', filterTable);
        document.querySelector('.role-select').addEventListener('change', filterTable);
        document.querySelector('.status-select').addEventListener('change', filterTable);

        function filterTable() {
            const selectedRole = document.querySelector('.role-select').value.toLowerCase();
            const selectedStatus = document.querySelector('.status-select').value.toLowerCase();
            const skillSearch = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('.sr_row');

            // Update URL without reload
            const params = new URLSearchParams();
            params.set('position', selectedRole);
            params.set('status', selectedStatus);
            params.set('skill', skillSearch);
            window.history.replaceState(null, '', '?' + params.toString());

            rows.forEach(row => {
                // const studentName = row.querySelector('.name').textContent.toLowerCase();
                const studentPosition = row.querySelector('.position').textContent.toLowerCase(); // Position
                const studentStatus = row.querySelector('.action').textContent.toLowerCase(); // Adjusted to get text directly from the div
                const studentSkills = Array.from(row.querySelectorAll('.skill div')).map(skill => skill.textContent.toLowerCase());

                // const matchesSearch = studentName.includes(searchValue);
                const matchesRole = (selectedRole === "all" || studentPosition.toLowerCase() === selectedRole);
                const matchesStatus = (selectedStatus === "all" || studentStatus === selectedStatus.toLowerCase());
                const matchesSkill = (skillSearch === "" || studentSkills.some(skill => skill.includes(skillSearch)));

                // Show row if it matches search, role filter, and status filter
                if (matchesSkill && matchesRole && matchesStatus) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        }
    </script>

    <!-- Toast message from session -->
    <?php if (isset($_SESSION['flash'])): ?>
        <script>
            window.__flashMessage = <?php echo json_encode($_SESSION['flash']); ?>;
        </script>
    <?php
        unset($_SESSION['flash']);
    endif;
    ?>


</body>

</html>