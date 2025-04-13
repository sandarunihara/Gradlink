<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

class AddCompany{
    use Controller;
    public function dashboard(){
        $this-> view('PDC_admin/Company/AddCompany');
    }

    public function getnextId()
    {
        $model = new company();
        $companyIdPrev = $model->gethighestadid();
        if (!empty($companyIdPrev)) {
            // Extract the numeric part of the current highest advertisementId
            $numericPart = intval(substr($companyIdPrev, 1)); // Remove the prefix (e.g., 'a')
            $nextId = $numericPart + 1;

            // Determine the number of digits required for the new ID
            $paddingLength = max(3, strlen((string)$nextId));

            // Format the new advertisementId (e.g., 'a001', 'a1000', etc.)
            return 'C' . str_pad($nextId, $paddingLength, '0', STR_PAD_LEFT);
        } else {

            return 'c001';
        }
    }

    public function create()
    {
        $model = new company;
        $companyId = $this->getnextId();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'companyId' => $companyId,
                'company_name' => $_POST['company_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'contact_number' => $_POST['contact_number'] ?? '',
                'contact_person' => $_POST['contact_person'] ?? '',
                'status' => "Pending",
            ];

            $dbColumns = [
                'companyId' => 'CompanyId',
                'company_name' => 'Name',
                'email' => 'Email',
                'contact_number' => 'ContactNum',
                'contact_person' => 'ContactPerson',
                'status' => 'Status',
            ];

            $mappedData = [];
            foreach ($data as $formField => $value) {
                if (isset($dbColumns[$formField])) {
                    $mappedData[$dbColumns[$formField]] = $value;
                }
            }

            $email = $_POST['email'];

            if ($model->validatePendingCompany($data)) {
                $arr = [];
                $arr['Name'] = $mappedData['Name'];
                $arr['Email'] = $mappedData['Email'];

                $result1 = $model->where($arr, [], '', 'do_not_order');
                // echo $result1;
                if (empty($result1)) {
                    //no same company
                    $result = $model->insert($mappedData);
                    
                    if ($result) {

                        $this->sendEmail($email, $companyId);
                        $_SESSION['flash_message'] = [
                            'type' => 'success',
                            'message' => 'Company successfully Added'
                        ];
                    } else {
                        $_SESSION['flash_message'] = [
                            'type' => 'error',
                            'message' => 'Failed to add company'
                        ];
                    }
                } else {
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Company is already Added'
                    ];
                }
            } else {
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Validation Failed'
                ];
            }
        } else {
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error Occured'
            ];
        }
        header('Location: /Gradlink/public/PDC_admin/PendingCompany/dashboard');
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
            $mail->Subject = 'Company Registration - Pending Approval';
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
                                <h1>Company Registration Successful</h1>
                            </div>
                            <p>Dear User,</p>
                            <p>Your company has been added to our system and is currently in the <strong>Pending Approval</strong> status.</p>
                            <p><strong>Your Company ID:</strong> {$companyId}</p>
                            <p>We will notify you once your company is approved.</p>
                            <p>Thank you for your patience.</p>
                            <div class='footer'>
                                &copy; 2025 GRADLINK. All rights reserved.
                            </div>
                        </div>
                    </body>
                </html>
            ";

            if($mail->send()){
                true;
            }
            else{
                false;
            }
            
        } catch (Exception $e) {
            false;
        }
    }
}
