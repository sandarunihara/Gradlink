<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";
    class AddSession{
        use Controller;
        public function dashboard(){

            $model = new PDC_Session;
            $data = $model->findall();

            if($data == false || empty($data)){
                $this->view('PDC_admin/Session/AddSession');
            }

            else{
                $sessionData = [];

                foreach($data as $session){
                    $sessionData[] = [
                        'session_id' => $session->session_id,
                        'session_name' => $session->session_name,
                        'company_name' => $session->company_name,
                        'email' => $session->email,
                        'contact_person' => $session->contact_person,
                        'contact_number' => $session->contact_number,
                        'hall_number' => $session->hall_number,
                        'session_date' => $session->session_date,
                        'time_slot' => $session->time_slot
                    ];
                }
                $this->view('PDC_admin/Session/SessionOverview', ['sessionData' => $sessionData]);
            }
        }
        
        public function showAddForm() {

            $model = new company;
            $session = new PDC_Session;
            $data = $model->findAllOngoing();
            

            //show($data);
            $this->view('PDC_admin/Session/AddSession' , [
                'companyData' => $data
            ]);
        }

        public function showAddAddUnregisteredForm(){
            $model = new company;
            $session = new PDC_Session;
            $data = $model->findAllOngoing();
            

            //show($data);
            $this->view('PDC_admin/Session/AddUnregistered' , [
                'companyData' => $data
            ]);
        }

        public function GetAvailability(){
            $type = $_GET['type'];
            $data = $_GET['value'];
            $model = new PDC_Session;
            $modelunreg = new PDC_Unreg_Session;
            
            if($type == 'hall'){
                $response = $model->getAvailableTimeSlotsAndDates($data);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
            else if($type == 'date'){
                $response1 = $model->getAvailableHallAndTimeSlots($data);
                $response2 = $modelunreg->getAvailableHallAndTimeSlots($data);
                $response = array_merge($response1, $response2);
                header('Content-Type: application/json');
                echo json_encode($response);
                exit;
            }
        }

        public function submit(){
            $model = new PDC_Session;

            $data = [
                'session_name' => $_POST['session_name'],
                'company_name' => $_POST['company_name'],
                'CompanyId' => $_POST['CompanyId'],
                'email' => $_POST['email'],
                'contact_person' => $_POST['contact_person'],
                'contact_number' => $_POST['contact_number'],
                'hall_number' => $_POST['hall_number'],
                'session_date' => $_POST['session_date'],
                'time_slot' => $_POST['time_slot']
            ];

            //show($data);

            if($data['company_name'] != 'other'){
                $result = $model->insert($data);

                if($result){
                    $this->sendEmail($data);
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Session successfully Added'
                    ];
                }
                else{
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Failed to add session'
                    ];
                }

                header('Location: /Gradlink/public/PDC_admin/AdminSessionOverview/dashboard');
                exit;
            }
            else{
                $data['company_name'] = $data['otherCompany'];
                unset($data['otherCompany']);
                $result = $model->insert($data);

                if($result){
                    $this->sendEmail($data);
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Session successfully Added'
                    ];
                }
                else{
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Failed to add session'
                    ];
                }

                header('Location: /Gradlink/public/PDC_admin/AdminSessionOverview/dashboard');
                exit;
            }

            
        }

        public function submitUnreg(){

            $model = new PDC_Unreg_Session;
            //show($_POST);
            $data = [
                'session_name' => $_POST['session_name'],
                'other_company_name' => $_POST['company_name'],
                'email' => $_POST['email'],
                'contact_person' => $_POST['contact_person'],
                'contact_number' => $_POST['contact_number'],
                'hall_number' => $_POST['hall_number'],
                'session_date' => $_POST['session_date'],
                'time_slot' => $_POST['time_slot']
            ];

            $result = $model->insert($data);
            if($result){
                $this->sendEmail($data);
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Session successfully Added'
                ];
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Failed to add session'
                ];
            }
            header('Location: /Gradlink/public/PDC_admin/AdminSessionOverview/unregistered');

        }

        private function sendEmail($data) {
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'gradlink6@gmail.com';
                $mail->Password = 'sesk zjnj mhvb uxlh';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
        
                $mail->setFrom('gradlink6@gmail.com', 'Gradlink - PDC');
                $mail->addAddress($data['email']);
        
                $formattedDate = date('F j, Y', strtotime($data['session_date']));
        
                $mail->isHTML(true);
                $mail->Subject = 'Session Scheduled Successfully';
                $mail->Body = "
                    <html>
                        <head>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.6;
                                    color: #333;
                                }
                                .container {
                                    padding: 20px;
                                    border: 1px solid #ddd;
                                    border-radius: 8px;
                                    background: #f9f9f9;
                                    max-width: 600px;
                                    margin: 0 auto;
                                }
                                .header {
                                    background: #007bff;
                                    color: white;
                                    padding: 15px;
                                    text-align: center;
                                    border-radius: 8px 8px 0 0;
                                    margin-bottom: 20px;
                                }
                                .details {
                                    margin-bottom: 20px;
                                }
                                .detail-row {
                                    margin-bottom: 10px;
                                }
                                .detail-label {
                                    font-weight: bold;
                                    display: inline-block;
                                    width: 150px;
                                }
                                .footer {
                                    text-align: center;
                                    font-size: 12px;
                                    margin-top: 20px;
                                    color: #666;
                                    border-top: 1px solid #eee;
                                    padding-top: 10px;
                                }
                            </style>
                        </head>
                        <body>
                            <div class='container'>
                                <div class='header'>
                                    <h2>Session Scheduled Successfully</h2>
                                </div>
                                
                                <p>Dear {$data['contact_person']},</p>
                                
                                <p>Your session with has been successfully scheduled. Below are the details:</p>
                                
                                <div class='details'>
                                    <div class='detail-row'>
                                        <span class='detail-label'>Session Name:</span>
                                        {$data['session_name']}
                                    </div>
                                    <div class='detail-row'>
                                        <span class='detail-label'>Company Name:</span>
                                        {$data['company_name']}
                                    </div>
                                    <div class='detail-row'>
                                        <span class='detail-label'>Date:</span>
                                        {$formattedDate}
                                    </div>
                                    <div class='detail-row'>
                                        <span class='detail-label'>Time Slot:</span>
                                        {$data['time_slot']}
                                    </div>
                                    <div class='detail-row'>
                                        <span class='detail-label'>Venue:</span>
                                        {$data['hall_number']}
                                    </div>
                                    <div class='detail-row'>
                                        <span class='detail-label'>Contact Number:</span>
                                        {$data['contact_number']}
                                    </div>
                                </div>
                                
                                <p>If you need to make any changes, please contact us immediately.</p>
                                
                                <div class='footer'>
                                    &copy; " . date('Y') . " GRADLINK - Professional Development Center. All rights reserved.
                                </div>
                            </div>
                        </body>
                    </html>
                ";
        
                return $mail->send();
                
            } catch (Exception $e) {
                // Log the error if needed
                error_log("Email sending failed: " . $e->getMessage());
                return false;
            }
        }
            
    }