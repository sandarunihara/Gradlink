


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
                $this->view('PDC_admin/Student/StudentOverview', ['studentData' => $studentData]);
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
                $model->insert($data);
                if($model){
                    $this->sendEmail($data['Email'], $data['StudentId']);
                    //echo "succefully added";
                    redirect('PDC_admin/AddStudent/dashboard');
                }
                else{
                    echo "failed to add";
                }
            }
            else{
                $errors = $model->errors;
                $this->view('PDC_admin/Student/AddStudent', [
                    'errors' => $model->errors,
                    'old_data' => $data
                ]);
            }
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