<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/statisticsPages.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/companyTabs.css">
    <link rel="stylesheet" href="<?= ROOT ?> /assets/css/Components/coordinatorDashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</head>

<body>
    <div class="container">
        <?php $this->renderComponent("coordinatorDashboard") ?>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <i class="material-icons">menu</i>
                    <h1>Companies</h1>
                </div>


            </header>

            <?php $activeTab = 'company-statistics'; ?>
            <?php $this->renderComponent("companyTabs") ?>


            <div class="company-list">
                <div class="analysis-container">
                    <div class="recruitment-analysis">
                        <div class="title">
                            <p>Company Status</p>
                        </div>

                        <div class="graphs">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>

                    <div class="company-performance">
                        <div class="title">
                            <p>Companies Categorized by District</p>
                        </div>
                        <div id="jobRolesChartContainer" style="width: 100%; height: 370px;"></div>

                    </div>


                </div>
            </div>
        </main>
    </div>
    <script src="<?= ROOT ?>/assets/js/script.js"></script>

    <script>
        <?php

        $dataPoints = array(
            array("label" => "Pending", "y" => 12),
            array("label" => "Rejected", "y" => 6),
            array("label" => "Registered", "y" => 26),
        );

        $dataPoints2 = array(
            array("y" => 3373.64, "label" => "Germany"),
            array("y" => 2435.94, "label" => "France"),
            array("y" => 1842.55, "label" => "China"),
            array("y" => 1828.55, "label" => "Russia"),
            array("y" => 1039.99, "label" => "Switzerland"),
            array("y" => 765.215, "label" => "Japan"),
            array("y" => 612.453, "label" => "Netherlands")
        );

        ?>



        window.onload = function () {


            var chart1 = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                backgroundColor: "#fffafa",



                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });

            var chart2 = new CanvasJS.Chart("jobRolesChartContainer", {
                animationEnabled: true,
                theme: "light2",
                
                axisY: {
                    title: "Gold Reserves (in tonnes)"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## tonnes",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart1.render();

            chart2.render();

        }
    </script>
</body>

</html>