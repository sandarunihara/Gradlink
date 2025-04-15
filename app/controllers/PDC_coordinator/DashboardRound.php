<?php

class DashboardRound
{
    use Controller;
    public function index()
    {
        $model = new round;
        $data = $model->findall();

        $this->view('Coordinator/Round/dashboardRound', ['roundData' => $data]);
    }

    public function updateRound()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $model = new round;
            $roundId = $_POST['roundId'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";


            $errors = [];

            $today = date('Y-m-d');
            if ($startDate < $today) {
                $errors[] = "Start date cannot be in the past.";
            }
            if ($endDate < $startDate) {
                $errors[] = "End date cannot be before start date.";
            }

            //check overlapping dates
            $existingRounds = $model->findall();
            foreach ($existingRounds as $round) {
                if ($round->roundId != $roundId) {
                    if ($startDate <= $round->endDate && $endDate >= $round->startDate) {
                        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Date range overlaps with '. $round->round];
                        // $errors[] = "This date range overlaps with Round " . $round->round;
                        break;
                    }
                }
                
                $active = ($startDate <= $today && $endDate >= $today) ? 1 : 0;

                if (empty($errors)) {
                    if ($active == 1) {
                        $model->deactivateAllRoundsExcept($roundId);
                    }
        
                    $success = $model->update($roundId, $startDate, $endDate, $active);
                    if ($success) {
                        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Round updated successfully'];
                    } else {
                        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Failed to update round'];
                    }
                } else {
                    $_SESSION['flash_message'] = ['type' => 'error', 'message' => implode('<br>', $errors)];
                }
            }

            // 
            $this->view('Coordinator/Round/dashboardRound', ['roundData' => $model->findall()]);
            // redirect('Coordinator/Round/dashboardRound');


        }
    }
}
