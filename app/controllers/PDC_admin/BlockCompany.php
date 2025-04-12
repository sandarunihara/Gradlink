<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

    class BlockCompany{
        use Controller;
        public function dashboard(){
            $model = new company;
            $companyData = $model->findAllBlocked();
            $this->view('PDC_admin/Company/CompanyBlock', [
                'companyData' => $companyData,
                'activeTab' => 'blocked-companies'
            ]);
            
        }

        public function unblock(){
            $model = new company;
            $companyId = $_POST['companyId'];
            $companyData = $model->findById($companyId);
            if($companyData->Status == "Blocked"){
                $updatedStatus = $model->update($companyId , ['Status' => 'Ongoing'] , 'companyId');
                if($updatedStatus && $updatedStatus['status'] === 'success'){
                    $this->sendEmail($companyData->Email, $companyId);
                    $_SESSION['flash_message'] = [
                        'type' => 'success',
                        'message' => 'Company unblocked successfully'
                    ];
                }
                else{
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Failed to unblock company'
                    ];
                }
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Company is already unblocked'
                ];
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']); // back to the previous page
            exit;
        }

        private function sendEmail($email, $companyId){
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
                $mail->Subject = 'Company Status - unblocked';
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
                                    <h1>Company Unblocked</h1>
                                </div>
                                <p>Dear User,</p>
                                <p>Your company has been added to our system agian and is currently in the <strong>Ongoing</strong> status.</p>
                                <p><strong>Your Company ID:</strong> {$companyId}</p>
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