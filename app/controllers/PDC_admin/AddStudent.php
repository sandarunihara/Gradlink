


<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

    class AddStudent{
        use Controller;
        public function dashboard(){

            $model = new student;
            $data = $model->findall();

            if($data == false || empty($data)){
                $this->view('PDC_admin/Student/AddStudent');
            }
            else{
                $studentData = [];

                foreach($data as $student){
                    $studentData[] = [
                        'StudentId' => $student->StudentId,
                        'Name' => $student->Name,
                        'DegreeName' => $student->DegreeName,
                        'Status' => $student->Status,
                        'ShortDesc' => $student->ShortDesc,
                        'Email' => $student->Email,
                        'ContactNum' => $student->ContactNum,
                        'Github' => $student->Github,
                        'Linkedin' => $student->Linkedin
                    ];
                }
                $this->view('PDC_admin/Student/StudentOverview', [
                    'studentData' => $studentData,
                    'activeTab' => 'Not-Applied'
                ]);
            }
        }
        
        public function showAddForm() {
            $this->view('PDC_admin/Student/AddStudent');
        }

        public function submit(){
            $model = new student;
            $data = [
                'StudentId' => $_POST['StudentId'],
                'NIC' => $_POST['NIC'],
                'Name' => $_POST['Name'],
                'Email' => $_POST['Email'],
                'DegreeName' => $_POST['DegreeName'],
                'Status' => $_POST['Status'],
                'ContactNum' => $_POST['ContactNum'],
            ];

            if($model->validate($data)){
                if($model->validateRegisteredStudents($data)){
                    $arr = [];
                    $arr['StudentId'] = $data['StudentId'];
                    $arr['NIC'] = $data['NIC'];
                    $arr['Name'] = $data['Name'];
                    $arr['Email'] = $data['Email'];

                    $result1 = $model->orWhere($arr, [], '', 'do_not_order');
                    if(empty($result1)){
                        $result = $model->insert($data);
                        if ($result) {
                            $this->sendEmail($data['Email'], $data['StudentId']);
                            $_SESSION['flash_message'] = [
                                'type' => 'success',
                                'message' => 'Student successfully Registered'
                            ];
                        } else {
                            $_SESSION['flash_message'] = [
                                'type' => 'error',
                                'message' => 'Failed to register Student'
                            ];
                        }

                    }
                    else{
                        $conflic = [];
                            $existing = $result1[0];

                            if($existing->StudentId == $data['StudentId']){
                                $conflic[] = "Student ID already exists";
                            }
                            if($existing->NIC == $data['NIC']){
                                $conflic[] = "NIC already exists";
                            }
                            if($existing->Email == $data['Email']){
                                $conflic[] = "Email already exists";
                            }
                            if($existing->Name == $data['Name']){
                                $conflic[] = "Name already exists";
                            }
                            
                            $_SESSION['flash_message'] = [
                                'type' => 'error',
                                'message' => 'Student cannot be registered: ' . implode(', ', array_unique($conflic))
                            ];
                    }
                }
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Validation Failed'
                ];
            }
            header('Location: /Gradlink/public/PDC_admin/AdminStudentOverview/dashboard');
            exit;
        }


        private function sendEmail($Email, $StudentId){
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
                $mail->addAddress($Email);
    
                $mail->isHTML(true);
                $mail->Subject = 'Student Registration - Pending Approval';
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
                                }
                                .header {
                                    background: #007bff;
                                    color: white;
                                    padding: 10px;
                                    text-align: center;
                                    border-radius: 8px 8px 0 0;
                                }
                                .footer {
                                    text-align: center;
                                    font-size: 12px;
                                    margin-top: 10px;
                                    color: #666;
                                }
                            </style>
                        </head>
                        <body>
                            <div class='container'>
                                <div class='header'>
                                    <h1>Student Registration Successful</h1>
                                </div>
                                <p>Dear User,</p>
                                <p>Your are been added to our system and is currently in the <strong>Not applied</strong> status.</p>
                                <p><strong>Your Student ID:</strong> {$StudentId}</p>
                                <p>Use this ID for create password.</p>
                                <p>Thank you for your patience.</p>
                                <div class='footer'>
                                    &copy; 2025 GRADLINK. All rights reserved.
                                </div>
                            </div>
                        </body>
                    </html>
                ";
    
                if($mail->send()){
                    echo "Email sent successfully to {$Email}";
                }
                else{
                    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
                }
                
            } catch (Exception $e) {
                echo "Email could not be sent. Error: {$mail->ErrorInfo}";
            }
        }

            
    }