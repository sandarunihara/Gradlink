<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

class ViewAdvertisement {
    use Controller;

    public function show($advertisementId) {
        $model = new C_Advertisement;
        $data = $model->findwithcompany($advertisementId);
        //var_dump($data);
        if ($data) {
            $this->view('PDC_admin/Advertisement/AdvertisementView', ['data' => $data]);
        } else {
            echo "No data found";
        }
    }

    public function deactivate($advertisementId , $reason , $action){
        $model = new C_Advertisement;
        $action = new Action_logs;


        $companyDet = $model -> findwithcompany($advertisementId);
        $CompanyId = $companyDet->CompanyId;
        $mail = $companyDet->Email;

        $actor_id = $_SESSION['USER']->AssistantId;

        $data = [
            'status' => 'Deactive'
        ];

        $actionData = [
            'actor_id' => $actor_id,
            'actor_role' => 'admin',
            'target_id' => $advertisementId,
            'target_type' => 'advertisement',
            'action_type' => 'deactivate',
            'reason' => $reason,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        //show($actionData);

        $updatedStatus = $model->update($advertisementId,$data,'advertisementId');

        //show($updatedStatus);

        if($updatedStatus && $updatedStatus['status'] === 'success'){
            $this->sendEmail($mail , $CompanyId , $action , $advertisementId , $reason);
            if($action->insert($actionData)){
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Advertisement successfully deactivated'
                ];
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Error: Could not log the action.'
                ];
            }
        }
        else{
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error: Could not deactivate the advertisement.'
            ];
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activate($advertisementId , $action){
        $model = new C_Advertisement;
        $notification  = new Admin_notification;

        $x = $notification->findbyAdvertisementId($advertisementId);

        $companyDet = $model->findwithcompany($advertisementId);

        if ($companyDet && is_object($companyDet)) {
            $CompanyId = $companyDet->CompanyId;
            $mail = $companyDet->Email;
            
            $data = [
                'status' => 'Active'
            ];
        } else {
            // Handle the error: maybe redirect or show an error message
            echo "Company details not found for advertisement ID: $advertisementId";
            exit;
        }

        $notificationId = $x->id;
        

        $notificationData = [
            'type' => 'advertisement_request',
            'company_id' => $CompanyId,
            'advertisement_id' => $advertisementId,
            'status' => 'Approved',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $updatedNotification = $notification->update($notificationId, $notificationData, 'id');
        //show($updatedNotification);

        $updatedStatus = $model->update($advertisementId,$data,'advertisementId');
        if($updatedStatus && $updatedStatus['status'] === 'success' && $updatedNotification && $updatedNotification['status'] === 'success'){
            $this->sendEmail($mail , $CompanyId , $action , $advertisementId);
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'Advertisement successfully activated'
            ];
        }
        else{
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error: Could not activate the advertisement.'
            ];
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function reject($advertisementId , $reason , $action){
        $model = new C_Advertisement;
        $action = new Action_logs;

        $companyDet = $model -> findwithcompany($advertisementId);
        $CompanyId = $companyDet->CompanyId;
        $mail = $companyDet->Email;

        $actor_id = $_SESSION['USER']->AssistantId;

        $data = [
            'status' => 'Rejected'
        ];

        $actionData = [
            'actor_id' => $actor_id,
            'actor_role' => 'admin',
            'target_id' => $advertisementId,
            'target_type' => 'advertisement',
            'action_type' => 'reject',
            'reason' => $reason,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        $updatedStatus = $model->update($advertisementId,$data,'advertisementId');
        if($updatedStatus && $updatedStatus['status'] === 'success'){
            if($action->insert($actionData)){
                $_SESSION['flash_message'] = [
                    'type' => 'success',
                    'message' => 'Advertisement successfully rejected'
                ];
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Error: Could not log the action.'
                ];
            }
        }
        else{
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error: Could not reject the advertisement.'
            ];
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function handleAction(){
        if(isset($_POST['action']) && isset($_POST['advertisementId'])){
            $action = $_POST['action'];
            $advertisementId = $_POST['advertisementId'];
            $reason = $_POST['reason'];
            $mail = $_POST['mail'];
            if($action === 'deactivate'){
                $this->deactivate($advertisementId , $reason , $action);
            }
            else if($action === 'activate'){
                $this->activate($advertisementId , $action);
            }
            else if($action === 'reject'){
                $this->reject($advertisementId , $reason , $action);
            }
        }
    }

    private function sendEmail($email, $companyId, $action, $advertisementId, $reason = ''){
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
            if($action === 'deactivate'){
                $mail->Subject = 'Advertisement Deactivation';
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
                                    background: #dc3545;
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
                                    <h1>Advertisement Deactivated</h1>
                                </div>
                                <p>Dear User,</p>
                                <p>We regret to inform you that your advertisement has been <strong>deactivated</strong> on our platform.</p>
                                <p><strong>Advertisement ID:</strong> {$advertisementId}</p>
                                <p><strong>Reason for Deactivation:</strong> {$reason}</p>
                                <p>If you have any questions or believe this action was taken in error, please contact our support team for further assistance.</p>
                                <p>Thank you for your understanding.</p>
                                <div class='footer'>
                                    &copy; 2025 GRADLINK. All rights reserved.
                                </div>
                            </div>
                        </body>
                    </html>

                ";
                }
                else if($action === 'activate'){
                    $mail->Subject = 'Advertisement Activation';
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
                                        background: #28a745;
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
                                        <h1>Advertisement Activated</h1>
                                    </div>
                                    <p>Dear User,</p>
                                    <p>We are pleased to inform you that your advertisement has been <strong>activated</strong> on our platform.</p>
                                    <p><strong>Advertisement ID:</strong> {$advertisementId}</p>
                                    <p>If you have any questions or believe this action was taken in error, please contact our support team for further assistance.</p>
                                    <p>Thank you for your understanding.</p>
                                    <div class='footer'>
                                        &copy; 2025 GRADLINK. All rights reserved.
                                    </div>
                                </div>
                            </body>
                        </html>
                    ";
                }
                else if($action === 'reject'){
                    $mail->Subject = 'Advertisement Rejection';
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
                                        background: #ffc107;
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
                                        <h1>Advertisement Rejected</h1>
                                    </div>
                                    <p>Dear User,</p>
                                    <p>We regret to inform you that your advertisement has been <strong>rejected</strong> on our platform.</p>
                                    <p><strong>Advertisement ID:</strong> {$advertisementId}</p>
                                    <p><strong>Reason for Rejection:</strong> {$reason}</p>
                                    <p>If you have any questions or believe this action was taken in error, please contact our support team for further assistance.</p>
                                    <p>Thank you for your understanding.</p>
                                    <div class='footer'>
                                        &copy; 2025 GRADLINK. All rights reserved.
                                    </div>
                                </div>
                            </body>
                        </html>
                    ";
                }
            if($mail->send()){
                //var_dump($action);
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