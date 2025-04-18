<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

    class ViewStudent{
        use Controller;

        public function show($studentId) {
            $model = new student;
            $applyDetails = new student_advertisement;
            $company = new company;
            $action = new Action_logs;

            $studentData = $model->find($studentId);
            //$id = $studentData[0] -> StudentId;
            $studentapply = $applyDetails->findAppliedCompanies($studentId);
            //var_dump($studentapply);
            $count = $applyDetails->noOfAppliedCompanies($studentId);

            $actor_id = $_SESSION['USER']->AssistantId;

            $actionDet = $action->findDetails($studentId,$actor_id);

            //show($actionDet);

            $data = [
                'studentData' => $studentData,
                'noOfAppliedAds' => $count,
                'applications'=> [],
                'block' => $studentData->block,
                'actionDet' => $actionDet,
            ];

            
            if (is_array($studentapply) || is_object($studentapply)) {
                foreach ($studentapply as $apply) {
                    $data['applications'][] = [
                        'Jobstatus' => $apply->Jobstatus,
                        'CreatedAt' => $apply->CreatedAt,
                        'position' => $apply->position,
                        'ComName' => $apply->Name,
                        'CompanyLogo' => $apply->profileimg
                    ];
                }
            } else {
                $studentapply = [];
            }

            //show($data);
            
            $this-> view('PDC_admin/Student/StudentView' , $data);
        }

        // public function remove($studentId){
        //     $model = new student;
        //     $data = $model->delete($studentId,'StudentId');
        //     if ($data) {
        //         redirect('PDC_admin/AdminStudentOverview/dashboard');
        //         exit;
        //     } else {
        //         echo "Error: Could not delete the session.";
        //     }
        // }

        public function edit($studentId)
        {
            $model = new student;
            $errors = [];
            //var_dump($_POST);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'StudentId' => $_POST['StudentId'],
                    'NIC' => $_POST['NIC'],
                    'Name' => $_POST['Name'],
                    'Email' => $_POST['Email'],
                    'ContactNum' => $_POST['ContactNum'],
                    'DegreeName' => $_POST['DegreeName'],
                    'Status' => $_POST['Status'],
                    'ShortDesc' => $_POST['ShortDesc'],
                ];

                $current = $model->find($studentId);

                $changedData = [];

                $fields = [
                    'StudentId',
                    'NIC',
                    'Name',
                    'Email',
                    'ContactNum',
                    'DegreeName',
                    'Status',
                    'ShortDesc'
                ];

                foreach($fields as $field){
                    if(isset($_POST[$field]) && $_POST[$field] != $current->$field){
                        $changedData[$field] = $_POST[$field];
                    }
                }

                if (empty($changedData)) {
                    $_SESSION['flash_message'] = [
                        'type' => 'info',
                        'message' => 'No changes were made'
                    ];
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                if ($model->validate($changedData , true)) {
                    $checkFields = array_intersect(['StudentId', 'NIC', 'Email', 'Name'], array_keys($changedData));
                    $conflict = false;
                    $conflictMessage = [];

                    //show($checkFields);

                    foreach ($checkFields as $field) {
                        $existing = $model->firstMatch([$field => $changedData[$field]]);
                        if ($existing && $existing->StudentId != $studentId) {
                            $conflict = true;
                            $conflictMessage[] = "The $field is already in use.";
                        }
                    }

                    // var_dump($conflictMessage);
                    // var_dump($conflict);    
                    // var_dump($existing);
                        
                if(!$conflict){
                    $updatedStatus = $model->update($studentId, $changedData, 'StudentId');
                        if ($updatedStatus && $updatedStatus['status'] === 'success'){
                            $_SESSION['flash_message'] = [
                                'type' => 'success',
                                'message' => 'Student successfully Updated'
                            ];

                            if(isset($changedData['StudentId'])){
                                $new = $changedData['StudentId'];
                                header('Location: ' . ROOT . '/PDC_admin/ViewStudent/show/' . $new);
                                exit;
                            };
                        }
                        else{
                            $_SESSION['flash_message'] = [
                                'type' => 'error',
                                'message' => 'Error: Could not update the student.'
                            ];
                        }
                }
                else{
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Student cannot be updated: ' . implode(', ', $conflictMessage)
                    ];
                }
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Validation failed for the provided data'
                ];
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
            }
        }

        public function block() {
            $model = new student;
            $action = new Action_logs;

            $studentId = $_POST['StudentId'];
            $reason = $_POST['block_reason'];

            $actor_id = $_SESSION['USER']->AssistantId;

            $actionData = [
                'actor_id' => $actor_id,
                'actor_role' => 'admin',
                'target_id' => $studentId,
                'target_type' => 'student',
                'action_type' => 'block',                                                                                                        
                'reason' => $reason,
                'timestamp' => date('Y-m-d H:i:s')
            ];
            
            try {
                $studentData = $model->find($studentId);
                
                if (!$studentData) {
                    throw new Exception("Student not found");
                }
        
                if (isset($studentData->block) && $studentData->block == 1) {
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Student is already blocked'
                    ];
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                $stdChange = [
                    'Status' => 'Blocked',
                    'block' => 1,
                    'block_count' => $studentData->block_count + 1,
                    'last_blocked_at' => date('Y-m-d H:i:s')
                ];

                $updatedStatus = $model->update($studentId, $stdChange , 'StudentId');
                
                if ($updatedStatus['status'] === 'success') {
                    if($action->insert($actionData)){
                        $this->sendEmail($studentData->Email, $studentId, $reason);
                    
                        $_SESSION['flash_message'] = [
                            'type' => 'success',
                            'message' => 'Student blocked successfully'
                        ];
                    }
                    else{
                        $_SESSION['flash_message'] = [
                            'type' => 'error',
                            'message' => 'Failed to log action'
                        ];
                    }
                } else {
                    throw new Exception($updatedStatus['message']);
                }
                
            } catch (Exception $e) {
                show($e->getMessage());
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Failed to block student: ' . $e->getMessage()
                ];
            }
            
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        private function sendEmail($email, $studentId, $reason) {
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'gradlink6@gmail.com'; // Your email
                $mail->Password = 'sesk zjnj mhvb uxlh'; // Your app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
                $mail->Port = 587;
        
                $mail->setFrom('gradlink6@gmail.com', 'Gradlink');
                $mail->addAddress($email);
        
                $mail->isHTML(true);
                $mail->Subject = 'Student Blocked';
                $mail->Body = "
                    <html>
                        <head>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.6;
                                    color: #333;
                                    margin: 0;
                                    padding: 0;
                                    background-color: #f9f9f9;
                                }
                                .container {
                                    max-width: 600px;
                                    margin: 30px auto;
                                    padding: 20px;
                                    background: #ffffff;
                                    border-radius: 8px;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                }
                                .header {
                                    background: #f7e6e5;
                                    color: red;
                                    padding: 15px;
                                    text-align: center;
                                    border-radius: 8px 8px 0 0;
                                }
                                .footer {
                                    text-align: center;
                                    font-size: 12px;
                                    margin-top: 20px;
                                    color: #777;
                                }
                                .content {
                                    padding: 20px;
                                    font-size: 16px;
                                    color: #333;
                                    line-height: 1.6;
                                }
                                .reason {
                                    padding: 15px;
                                    border-radius: 5px;
                                    margin-top: 15px;
                                    color: black;
                                    font-weight: bold;
                                }
                            </style>
                        </head>
                        <body>
                            <div class='container'>
                                <div class='header'>
                                    <h1>Company Blocked Notification</h1>
                                </div>
                                <div class='content'>
                                    <p>Dear User,</p>
                                    <p>We are writing to inform you that your with Student ID <strong>{$studentId}</strong> has been blocked in our system.</p>
                                    <p><strong>Reason for Blocking:</strong></p>
                                    <div class='reason'>
                                        {$reason}
                                    </div>
                                    <p>If you believe this is an error or need more information, please contact our support team.</p>
                                    <p>Thank you for your understanding.</p>
                                </div>
                                <div class='footer'>
                                    &copy; 2025 GRADLINK. All rights reserved.
                                </div>
                            </div>
                        </body>
                    </html>
                ";
        
                if ($mail->send()) {
                    echo "Email sent successfully to {$email}";
                } else {
                    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
                }
        
            } catch (Exception $e) {
                echo "Email could not be sent. Error: {$mail->ErrorInfo}";
            }
        }

    }