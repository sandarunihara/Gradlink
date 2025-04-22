<?php

class DashboardSettings
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

        $this->view('Coordinator/Settings/DashboardSettings', ['roundData' => $data]);
    }


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
            } else {
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
            header("Location: " . ROOT . "/PDC_coordinator/DashboardSettings");
            exit;
        }
    }

    // public function importStudents()
    // {
    //     header('Content-Type: application/json');

    //     try {
    //         // Basic checks
    //         if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    //             throw new Exception('Invalid request method');
    //         }

    //         if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
    //             throw new Exception('No file uploaded or upload error');
    //         }

    //         $file = $_FILES['excel_file'];

    //         // Load PhpSpreadsheet
    //         require_once(ROOT . '/vendor/autoload.php');

    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //         $spreadsheet = $reader->load($file['tmp_name']);
    //         $sheet = $spreadsheet->getActiveSheet();

    //         // Get all data as array
    //         $data = $sheet->toArray();

    //         // Remove header row if exists
    //         array_shift($data);

    //         // Prepare database connection
    //         $model = new StudentImport;

    //         // Insert all rows
    //         foreach ($data as $row) {
    //             $db->insert($table, [
    //                 'student_id' => $row[0] ?? null,
    //                 'name' => $row[1] ?? null,
    //                 'degree' => $row[2] ?? null,
    //                 'email' => $row[3] ?? null,
    //                 'nic' => $row[4] ?? null,
    //                 'contact_no' => $row[5] ?? null,
    //                 'status' => $row[6] ?? 'active'
    //             ]);
    //         }

    //         echo json_encode([
    //             'success' => true,
    //             'message' => 'Excel data imported successfully'
    //         ]);
    //     } catch (Exception $e) {
    //         http_response_code(400);
    //         echo json_encode([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    //     exit;
    // }
}
