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

        $studentModel = new student();
        $studentData = $studentModel->findall();

        $companyModel = new company();
        $companyData = $companyModel->findall();

        $advertisementModel = new C_Advertisement();
        $advertisementData = $advertisementModel->findall();

        $this->view('Coordinator/Settings/DashboardSettings', ['roundData' => $data, 'studentData' => $studentData, 'companyData' => $companyData, 'advertisementData' => $advertisementData]);
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

                if($roundId == 2){
                    $vacancy = 500; // Set vacancy to 0 for round 2
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
    public function importStudents()
    {
        // Start output buffering
        ob_start();
        
        // Set error handler to catch any PHP errors
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            error_log("PHP Error [$errno]: $errstr in $errfile on line $errline");
            throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
        });

        try {
            // Set headers for JSON response
            header('Content-Type: application/json; charset=utf-8');
            header('Cache-Control: no-cache, must-revalidate');
            
            // Log the start of the process
            error_log('Starting student import process');
            
            // Basic checks
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Invalid request method');
            }

            if (!isset($_FILES['excel_file'])) {
                throw new Exception('No file uploaded');
            }

            $file = $_FILES['excel_file'];
            
            // Log file upload details
            error_log('File upload details: ' . print_r($file, true));

            // Check for upload errors
            if ($file['error'] !== UPLOAD_ERR_OK) {
                $uploadErrors = [
                    UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                    UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form',
                    UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
                    UPLOAD_ERR_NO_FILE => 'No file was uploaded',
                    UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
                    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                    UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload'
                ];
                throw new Exception('Upload error: ' . ($uploadErrors[$file['error']] ?? 'Unknown error'));
            }

            // Validate file type
            $allowedTypes = [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel',
                'application/octet-stream' // Sometimes Excel files are sent with this MIME type
            ];
            
            if (!in_array($file['type'], $allowedTypes)) {
                throw new Exception('Invalid file type: ' . $file['type'] . '. Please upload an Excel file (.xlsx or .xls)');
            }

            // Validate file size (5MB max)
            if ($file['size'] > 5 * 1024 * 1024) {
                throw new Exception('File size exceeds 5MB limit');
            }

            // Check if file exists and is readable
            if (!file_exists($file['tmp_name']) || !is_readable($file['tmp_name'])) {
                throw new Exception('Uploaded file is not accessible');
            }

            // Load PhpSpreadsheet using the correct path
            $vendorPath = dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';
            if (!file_exists($vendorPath)) {
                throw new Exception('Composer autoloader not found. Please run composer install.');
            }
            require_once($vendorPath);

            try {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($file['tmp_name']);
                $sheet = $spreadsheet->getActiveSheet();
            } catch (Exception $e) {
                error_log('PhpSpreadsheet error: ' . $e->getMessage());
                throw new Exception('Error reading Excel file: ' . $e->getMessage());
            }

            // Get all data as array
            $data = $sheet->toArray();

            if (empty($data)) {
                throw new Exception('Excel file is empty');
            }

            // Remove header row
            $headers = array_shift($data);

            // Log headers for debugging
            error_log('Excel headers: ' . print_r($headers, true));

            // Validate headers
            $requiredHeaders = ['StudentId', 'Name', 'DegreeName', 'Email', 'NIC', 'ContactNum'];
            $headerDiff = array_diff($requiredHeaders, $headers);
            if (!empty($headerDiff)) {
                throw new Exception('Missing required columns: ' . implode(', ', $headerDiff));
            }

            // Map headers to database columns
            $headerMap = [
                'StudentId' => 'student_id',
                'Name' => 'name',
                'DegreeName' => 'degree',
                'Email' => 'email',
                'NIC' => 'nic',
                'ContactNum' => 'contact_no'
            ];

            // Process data
            $processedData = [];
            foreach ($data as $row) {
                $processedRow = [];
                foreach ($headers as $index => $header) {
                    if (isset($headerMap[$header])) {
                        $processedRow[$headerMap[$header]] = $row[$index] ?? null;
                    }
                }
                $processedRow['status'] = 'active';
                $processedData[] = $processedRow;
            }

            // Log processed data count
            error_log('Processed ' . count($processedData) . ' rows of data');

            // Import data using model
            $model = new StudentImport();
            $result = $model->importStudents($processedData);

            if (!$result['success']) {
                $errorMessage = $result['message'] . "\n";
                
                if (!empty($result['errors'])) {
                    $errorMessage .= "Details:\n" . implode("\n", $result['errors']);
                }
                
                if (!empty($result['duplicates'])) {
                    $errorMessage .= "\n\nNote: " . count($result['duplicates']) . 
                                     " records were updated because they already existed";
                }
                
                throw new Exception($errorMessage);
            }

            // Clear any output buffer
            ob_clean();
            
            // Send success response
            $response = [
                'success' => true,
                'message' => $result['message'],
                'stats' => $result['stats']
            ];
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        } catch (Exception $e) {
            // Clear any output buffer
            ob_clean();
            
            error_log('Student import error: ' . $e->getMessage());
            http_response_code(400);
            
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } catch (Error $e) {
            // Clear any output buffer
            ob_clean();
            
            error_log('PHP Error: ' . $e->getMessage());
            http_response_code(500);
            
            $response = [
                'success' => false,
                'message' => 'An internal server error occurred: ' . $e->getMessage()
            ];
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }
        
        // End output buffering and send response
        ob_end_flush();
        exit;
    }
    public function submitFeedback()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');

            $type = $_POST['type'];
            $companyId = isset($_POST['companyId']) ? $_POST['companyId'] : null;
            $advertisementId = isset($_POST['AdvertisementId']) ? $_POST['AdvertisementId'] : null;
            $studentId = isset($_POST['studentId']) ? $_POST['studentId'] : null;
            $reason = $_POST['description'];

            if(empty($reason)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Please provide a reason for your feedback.'
                ]);
                exit;
            }

            $model = new Admin_notification();
            $data = [
                'type' => 'coordinator_request',
                'company_id' => $companyId,
                'advertisement_id' => $advertisementId,
                'student_id' => $studentId,
                'status' => 'Pending',
                'reason' => $reason,
            ];

            try {
                $result = $model->insert($data);

                if($result) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Feedback submitted successfully.'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to submit feedback. Please try again.'
                    ]);
                }
            }
            catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => 'An error occurred while submitting feedback: ' . $e->getMessage()
                ]);
            }
            exit;
        }
    }
}
