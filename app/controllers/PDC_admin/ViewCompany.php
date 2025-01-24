<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

    class ViewCompany{
        use Controller;
        public function show($companyId){
            $model = new company;
            $companyData = $model->findById($companyId);
            //var_dump($companyData);
            if($companyData){
                $this->view('PDC_admin/Company/CompanyView' , ['companyData' => $companyData]);
            }
            else{
                echo "No data found";
            }
        }

        public function block($companyId){
            $model = new company;
            $companyData = $model->findById($companyId);
            $reason = $_GET['reason'] ?? '';
            $email = $companyData->Email;

            if($companyData->Status == "Ongoing"){
                
                $updatedStatus = $model->update($companyId , ['Status' => 'Blocked'] , 'companyId');
                if($updatedStatus && $updatedStatus['status'] === 'success'){
                    echo "Company blocked successfully";
                    $getresult = $this->sendEmail($email, $companyId, $reason);
                    var_dump($getresult);
                    redirect('PDC_admin/AdminCompanyOverview/dashboard');
                    exit;
                }
                else{
                    echo "Failed to block";
                }
            }
        }


        private function sendEmail($email, $companyId, $reason) {
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
                $mail->Subject = 'Company Blocked';
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
                                    <p>We are writing to inform you that your company with ID <strong>{$companyId}</strong> has been blocked in our system.</p>
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