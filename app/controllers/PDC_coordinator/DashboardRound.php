<?php

class DashboardRound
{
    use Controller;
    public function index()
    {
        // echo $_SESSION;

        // echo "<pre>";
        //     print_r($_SESSION);
        //     echo "</pre>";
        $model = new round;
        $data = $model->findall();

        $this->view('Coordinator/Round/dashboardRound', ['roundData' => $data]);
    }

    // public function updateRound()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    //         $model = new round;
    //         $roundId = $_POST['roundId'];
    //         $startDate = $_POST['startDate'];
    //         $endDate = $_POST['endDate'];

    //         // echo "<pre>";
    //         // print_r($_POST);
    //         // echo "</pre>";


    //         $errors = [];

    //         $today = date('Y-m-d');
    //         if ($startDate < $today) {
    //             $errors[] = "Start date cannot be in the past.";
    //         }
    //         if ($endDate < $startDate) {
    //             $errors[] = "End date cannot be before start date.";
    //         }

    //         //check overlapping dates
    //         $existingRounds = $model->findall();
    //         foreach ($existingRounds as $round) {
    //             if ($round->roundId != $roundId) {
    //                 if ($startDate <= $round->endDate && $endDate >= $round->startDate) {
    //                     $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Date range overlaps with '. $round->round];
    //                     // $errors[] = "This date range overlaps with Round " . $round->round;
    //                     break;
    //                 }
    //             }

    //             $active = ($startDate <= $today && $endDate >= $today) ? 1 : 0;

    //             if (empty($errors)) {
    //                 if ($active == 1) {
    //                     $model->deactivateAllRoundsExcept($roundId);
    //                 }

    //                 $success = $model->update($roundId, $startDate, $endDate, $active);
    //                 if ($success) {
    //                     $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Round updated successfully'];
    //                 } else {
    //                     $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Failed to update round'];
    //                 }
    //             } else {
    //                 $_SESSION['flash_message'] = ['type' => 'error', 'message' => implode('<br>', $errors)];
    //             }
    //         }


    //         $this->view('Coordinator/Round/dashboardRound', ['roundData' => $model->findall()]);
    //         // redirect('Coordinator/Round/dashboardRound');


    //     }
    // }


    public function updateRound()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $model = new round;
            $roundId = $_POST['roundId'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            $vacancy = $_POST['vacancy'];

            $errors = [];
            $today = date('Y-m-d');
            $status = $model->getRoundStatus($roundId);

            // Get current round from DB
            $currentRound = $model->getRoundById($roundId);

            // Validation based on status
            if ($status == 1) {
                // Active round
                if ($startDate != $currentRound->startDate) {
                    $errors[] = "Start date cannot be changed for an active round.";
                }
                if ($endDate < $today) {
                    $errors[] = "End date must be today or later for an active round.";
                }
                if ($endDate <= $startDate) {
                    $errors[] = "End date must be after start date.";
                }
            } else {
                // Inactive round
                if ($startDate < $today) {
                    $errors[] = "Start date cannot be in the past for an inactive round.";
                }
                if ($endDate <= $startDate) {
                    $errors[] = "End date must be after start date.";
                }
            }

            // Overlapping validation
            $existingRounds = $model->findall();
            foreach ($existingRounds as $round) {
                if ($round->roundId != $roundId && $round->round != 'None') {
                    if ($startDate <= $round->endDate && $endDate >= $round->startDate) {
                        $errors[] = "Date range overlaps with " . $round->round;
                        break;
                    }
                }
            }

            // Round 2 must start after Round 1 ends
            if ($roundId == 2) {
                $round1 = $model->getRoundById(1);
                if ($startDate <= $round1->endDate) {
                    $errors[] = "Round 2 must start after Round 1 ends.";
                }
            }

            // If no errors, proceed to update
            if (empty($errors)) {
                $active = ($startDate <= $today && $endDate >= $today) ? 1 : 0;

                if ($active == 1) {
                    $model->deactivateAllRoundsExcept($roundId);
                }

                $success = $model->update($roundId, $startDate, $endDate, $active, $vacancy);
                
                    $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Round updated successfully'];
                    // $this->view('Coordinator/Round/dashboardRound', ['roundData' => $model->findall()]);
                    // header("Location: " . ROOT . "/PDC_coordinator/DashboardRound");
                    // exit;
            }  else {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => implode('<br>', $errors),
                    'open_modal' => true,
                    'round_data' => [
                        'roundId' => $roundId,
                        'round' => $currentRound->round,
                        'status' => $currentRound->active,
                        'startDate' => $startDate,
                        'endDate' => $endDate,
                        'vacancy' => $vacancy
                    ]
                ];
            
                // $this->view('Coordinator/Round/dashboardRound', ['roundData' => $model->findall()]);
            }
            // $this->view('Coordinator/Round/dashboardRound', ['roundData' => $model->findall()]);
            header("Location: " . ROOT . "/PDC_coordinator/DashboardRound");
                    exit;
        }
    }
}
