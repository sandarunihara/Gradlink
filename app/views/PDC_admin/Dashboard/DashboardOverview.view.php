<!DOCTYPE html>
<html lang="en">
 
<head>
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/dashboard/overviewDashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/PDC_admin/pdc_adminsidebar.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>

    <div class="container">
        <?php $this->renderComponent("pdc_adminsidebar") ?>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Dashboard</h1>
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

            <div class='round-type'>1st Round</div>


            <div class="main-cards">
                <div class='card' onclick='navigateToCompanyList();'>
                    <div class='card-inner'>
                        <i class="material-icons">business</i>
                        <h3>Company</h3>
                    </div>
                    <h1>35</h1>
                </div>

                <div class='card' onclick='navigateToStudentView();'>
                    <div class='card-inner'>
                        <i class="material-icons">school </i>
                        <h3>Student</h3>
                    </div>
                    <h1><?= htmlspecialchars($stdcount) ?></h1>
                </div>
            </div>
            <div class="analysis-container">
            <div class="recruitment-analysis">
                <div class="title">
                    <p>Recruitment Analysis</p>
                </div>
                <div class="graphs">
                    <div id="donutchart-cs" style="width: 90%; height: 200px;"></div>
                    <div id="donutchart-is" style="width: 90%; height: 200px;"></div>
                </div>
            </div>

    <div class="company-performance">
        <div class="title">
            <p>Company Performance Analysis</p>
        </div>
        <div id="curve_chart" style="width: 90%; height: 300px;"></div>
    </div>
</div>

            

        </main> 

        <script type="text/javascript">
            google.charts.load("current", { packages: ["corechart"] });
            google.charts.setOnLoadCallback(drawAllCharts);

            function drawAllCharts() {
                // Computer Science Degree Pie Chart
                var dataCs = google.visualization.arrayToDataTable([
                    ['Status', 'Number of students'],
                    ['Selected', 80],
                    ['Rejected', 20],
                    ['Pending', 70],
                    ['Not Applied', 12]
                ]);

                var optionsCs = {
                    title: 'Computer Science Degree',
                    pieHole: 0.4,
                };

                var chartCs = new google.visualization.PieChart(document.getElementById('donutchart-cs'));
                chartCs.draw(dataCs, optionsCs);

                // Information System Degree Pie Chart
                var dataIs = google.visualization.arrayToDataTable([
                    ['Status', 'Number of students'],
                    ['Selected', 60],
                    ['Rejected', 10],
                    ['Pending', 10],
                    ['Not Applied', 20]
                ]);

                var optionsIs = {
                    title: 'Information System Degree',
                    pieHole: 0.4,
                };

                var chartIs = new google.visualization.PieChart(document.getElementById('donutchart-is'));
                chartIs.draw(dataIs, optionsIs);

                // Curve Chart for Company Performance
                var dataCurve = google.visualization.arrayToDataTable([
                    ['Year', 'CS', 'IS'],
                    ['2016', 130, 80],
                    ['2017', 117, 46],
                    ['2018', 66, 112],
                    ['2019', 103, 54],
                    ['2020', 100, 84],
                    ['2021', 150, 94],
                    ['2022', 180, 34]
                ]);
                
                var optionsCurve = {
                    title: 'Intership',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                };

                var curveChart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                curveChart.draw(dataCurve, optionsCurve);
            }
        </script>
    <script src="<?= ROOT ?>/assets/js/pdc_admin/script.js"></script>
</body>

</html>