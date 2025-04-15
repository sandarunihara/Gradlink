<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

    class BlockStudent{
        use Controller;
        public function dashboard(){
            $model = new student;
            $studentData = $model->findAllBlocked();
            $this-> view('PDC_admin/Student/StudentBlock' , [
                'studentData' => $studentData,
                'activeTab' => 'Blocked-Students'
            ]);
        }

        public function unblock(){
            $model = new student;
            $studentId = $_POST['StudentId'];
            $studentData = $model->find($studentId);
            if($studentData->block == 1){
                $updatedStatus = $model->update($studentId , ['block' => 0] , 'StudentId');
                if($updatedStatus && $updatedStatus['status'] === 'success'){
                    $this->sendEmail($studentData->Email, $studentId);
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Student unblocked successfully'
                    ];
                }
                else{
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Failed to unblock Student'
                    ];
                }
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Student is already unblocked'
                ];
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']); // back to the previous page
            exit;
        }

        private function sendEmail($email, $studentId){
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
                $mail->Subject = 'Student Status - unblocked';
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
                                    background:rgb(5, 161, 26);
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
                                    <h1>Student Unblocked</h1>
                                </div>
                                <p>Dear User,</p>
                                <p>Your has been added to our system agian and is currently in the <strong>Not applied</strong> status.</p>
                                <p><strong>Your Student ID:</strong> {$studentId}</p>
                                <p>Thank you for your patience.</p>
                                <div class='footer'>
                                    &copy; 2025 GRADLINK. All rights reserved.
                                </div>
                            </div>
                        </body>
                    </html>
                ";
    
                if($mail->send()){
                    echo "Email sent successfully to {$email}";
                }
                else{
                    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
                }
                
            } catch (Exception $e) {
                echo "Email could not be sent. Error: {$mail->ErrorInfo}";
            }
        }

}