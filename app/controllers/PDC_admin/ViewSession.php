<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

class ViewSession {
    use Controller;

    public function show($sessionId) {
        $model = new PDC_Session;
        $data = $model->find($sessionId);
        //show($data);

        if ($data) {
            $this->view('PDC_admin/Session/SessionView', ['session' => $data]);
        } else {
            echo "No data found";
        }
    }

    public function showUnregistered($sessionId) {
        $model = new PDC_Unreg_Session;
        $data = $model->find($sessionId);
        //show($data);

        if ($data) {
            $this->view('PDC_admin/Session/SessionUnregisteredView', ['session' => $data]);
        } else {
            echo "No data found";
        }
    }

    public function remove()
    {
        $model = new PDC_Session;
        //show($_POST);
        $sessionId = $_POST['session_id'];
        $reason = $_POST['delete_reason'];
        $email = $_POST['email'];
        $data = $model->delete($sessionId,'session_id');
        //show($data);
        if ($data) {
            $this->sendEmail($email , $reason);
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Session successfully deleted'
            ];
            header('Location: ' . ROOT . '/PDC_admin/AdminSessionOverview/dashboard');
            exit;
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error: Could not delete the session.'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function removeUnregistered(){
        $model = new PDC_Unreg_Session;
        //show($_POST);
        $sessionId = $_POST['session_id'];
        $reason = $_POST['delete_reason'];
        $email = $_POST['email'];
        $data = $model->delete($sessionId,'session_id');
        //show($data);
        if ($data) {
            $this->sendEmail($email , $reason);
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Session successfully deleted'
            ];
            header('Location: ' . ROOT . '/PDC_admin/AdminSessionOverview/unregistered');
            exit;
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error: Could not delete the session.'
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function edit($sessionId)
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            //var_dump($_POST);
            $model = new PDC_Session;
            $errors = [];

            $data = [
                'session_name' => $_POST['session_name'],
                'company_name' => $_POST['company_name'],
                'email' => $_POST['email'],
                'contact_person' => $_POST['contact_person'],
                'contact_number' => $_POST['contact_number'],
                'hall_number' => $_POST['hall_number'],
                'session_date' => $_POST['session_date'],
                'time_slot' => $_POST['time_slot']
            ];

            //var_dump(is_array($data));

            $model = new PDC_Session;
            if($model->validate($data)){
                $updatedStatus = $model->update($sessionId,$data,'session_id');

                if($updatedStatus && $updatedStatus['status'] === 'success'){
                    redirect('PDC_admin/AdminSessionOverview/dashboard');
                    exit;
                }
                else{
                    $errors['general'] = "Error: Could not update the student.";
                }    
            }
            else{
                $errors = $model->errors;
            }
        }
        $data = $model->find($sessionId);
            if (!$data) {
                $errors['general'] = "No student data found for the given ID.";
            }
            $this->view('PDC_admin/Session/SessionView', ['session' => $data, 'errors' => $errors]);
        
        }

        private function sendEmail($email, $reason) {
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
                $mail->Subject = 'Session Deleted';
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
                                    <h1>Session Deleted Notification</h1>
                                </div>
                                <div class='content'>
                                    <p>Dear User,</p>
                                    <p>We are writing to inform you that your session has been deleted from our system.</p>
                                    <p><strong>Reason for Deleting:</strong></p>
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