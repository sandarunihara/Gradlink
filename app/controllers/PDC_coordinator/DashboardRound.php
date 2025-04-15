<?php

class DashboardRound
{
    use Controller;
    public function index()
    {
        $model = new round;
        $data = $model->findall();

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Round/dashboardRound');
        } else {
            $roundData = [];

            foreach ($data as $roundDetail) {
                $roundData[] = [
                    'roundId' => $roundDetail->roundId,
                    'round' => $roundDetail->round,
                    'active' => $roundDetail->active,
                    'startDate' => $roundDetail->startDate,
                    'endDate' => $roundDetail->endDate
                ];
            }
            $this->view('Coordinator/Round/dashboardRound', ['roundData' => $roundData]);
        }


    }

    public function updateRound()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new round;
            $roundId = $_POST['roundId'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];

            $errors = [];

            $today = date('Y-m-d');
            if($startDate < $today){
                $errors[] = "Start date cannot be in the past.";
            }
            if($endDate < $startDate){
                $errors[] = "End date cannot be before start date.";
            }

            //check overlapping dates
            $existingRounds = $model->findall();
            foreach ($existingRounds as $round) {
                if ($round->roundId == $roundId) {
                    if ($startDate <= $round->endDate && $endDate >= $round->startDate) {
                        $errors[] = "This date range overlaps with Round " . $round->round;
                        break;
                    }
                }

                if(empty($errors)){
                    $success = $model->update($roundId, $startDate, $endDate);
                    if ($success) {
                        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Round updated successfully'];
                    } else {
                        $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Failed to update round'];
                    }
                }else{
                    $_SESSION['flash_message'] = ['type' => 'error', 'message' => implode('<br>', $errors)];
                }

            }

            // 
            // $this->view('Coordinator/Round/dashboardRound' );

            
        }
    }
}