<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

class ShortlistedStudents
{
    use Controller;
    public function dashboard()
    {

        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $model = new C_Dashboard;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");
        if (empty($data)) {
            $this->view('Company/ShortlistedStudents', ['data' => []]);
            exit();
        }

        $advertisementIds = [];
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata = [];
        $hasShortlisted = false;
        $hasRecruited = false;
        foreach ($advertisementIds as $id) {
            $data = $model->findreq($id);
            if (empty($data)) {
                $_SESSION['hasShortlisted'] = $hasShortlisted;
                $_SESSION['hasRecruited'] = $hasRecruited;
                $this->view('Company/ShortlistedStudents', ['data' => $reqdata]);
                exit();
            }
            // if (is_array($data) || is_object($data)) {
            foreach ($data as $item) {
                if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled') {
                    $hasShortlisted = true;
                }
                if ($item->Jobstatus === 'Recruit') {
                    $hasRecruited = true;
                }
                if ($item->Jobstatus == 'Shortlist' || $item->Jobstatus == 'Interview Scheduled') {
                    $reqdata[] = [
                        "StudentId" => $item->StudentId,
                        'AdvertisementId' => $item->advertisementId,
                        'Student Name' => $item->Name,
                        'Student Degree' => $item->DegreeName,
                        'Position' => $item->position,
                        'Action' => $item->Jobstatus
                    ];
                }
                // }
            }
        }

        $_SESSION['hasShortlisted'] = $hasShortlisted;
        $_SESSION['hasRecruited'] = $hasRecruited;
        $this->view('Company/ShortlistedStudents', ['data' => $reqdata]);
    }

    public function studentprofile($advertisementId, $StudentId)
    {
        $model = new C_Student;
        $data = $model->findbyId($StudentId);
        $updatemodel = new C_Dashboard;
        $studentad_data = $updatemodel->find(['StudentId' => $StudentId, 'advertisementId' => $advertisementId], 'studentadvertisement');
        $studentJobstatus = $studentad_data[0]->Jobstatus;
        $company = new company;
        $companydata = $company->findById($_SESSION['USER']->CompanyId);
        $interviewschedule = 0;
        $interviewmodel = new interview_time_slot;
        $interviewdata = $interviewmodel->find(['StudentId' => $StudentId, 'CompanyId' => $_SESSION['USER']->CompanyId]);
        if (!empty($interviewdata)) {
            $interviewschedule = 1;
        } else {
            $interviewschedule = 0;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_action'])) {
            $updatedata = [
                'Jobstatus' => $_POST['submit_action']
            ];
            $studentdata = [
                'Status' => $_POST['submit_action']
            ];
            $result = $updatemodel->update($StudentId, $advertisementId, $updatedata);
            $studentUpdate = $model->update($StudentId, $studentdata, 'StudentId');
            if ($result['status']) {
                // Redirect to the same page after successful submission
                $success = "Student Job Status updated successfully.";
                if (!empty($data[0]->Email) && !empty($companydata[0]->Email)) {
                    $studentemail = $data[0]->Email;
                    $studentname = $data[0]->Name;
                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                        $mail->SMTPAuth = true;
                        $mail->Username = 'sandarunihara15@gmail.com'; // Your email
                        $mail->Password = 'gwko wgdm ffqx fzcm'; // Your app password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
                        $mail->Port = 587;
                        $mail->setFrom($companydata[0]->Email, $companydata[0]->Name);
                        $mail->addAddress($studentemail);
                        $mail->isHTML(true);
                        $mail->Subject = 'Congratulations on Your Internship Selection!';
                        $mail->Body = "
                                        <html>
                                            <head>
                                                <style>
                                                    body {
                                                        font-family: Arial, sans-serif;
                                                        line-height: 1.6;
                                                        color: #333;
                                                        background-color: #f9f9f9;
                                                        padding: 0;
                                                        margin: 0;
                                                    }
                                                    .email-container {
                                                        max-width: 600px;
                                                        margin: 20px auto;
                                                        background: #ffffff;
                                                        border: 1px solid #ddd;
                                                        border-radius: 8px;
                                                        overflow: hidden;
                                                    }
                                                    .header {
                                                        background-color: #03B754;
                                                        color: #ffffff;
                                                        padding: 20px;
                                                        text-align: center;
                                                    }
                                                    .header h1 {
                                                        margin: 0;
                                                        font-size: 24px;
                                                    }
                                                    .content {
                                                        padding: 20px;
                                                    }
                                                    .content p {
                                                        margin: 10px 0;
                                                    }
                                                    .footer {
                                                        background-color: #f4f4f4;
                                                        text-align: center;
                                                        padding: 10px;
                                                        font-size: 12px;
                                                        color: #666;
                                                        border-top: 1px solid #ddd;
                                                    }
                                                </style>
                                            </head>
                                            <body>
                                                <div class='email-container'>
                                                    <div class='header'>
                                                        <h1>Welcome to {$companydata[0]->Name}!</h1>
                                                    </div>
                                                    <div class='content'>
                                                        <p>Dear {$data[0]->Name},</p>
                                                        <p>We are thrilled to inform you that you have been selected for an internship at <strong>{$companydata[0]->Name}</strong>. This role offers you a unique opportunity to learn, grow, and contribute to our team.</p>
                                                        <p>Details regarding your onboarding process and responsibilities will be shared soon. If you have any immediate questions, please don't hesitate to contact us at <strong>{$companydata[0]->ContactNum}</strong>.</p>
                                                        <p>We are excited to welcome you aboard and look forward to a fruitful collaboration.</p>
                                                        <p>Warm regards,</p>
                                                        <p><strong>{$companydata[0]->Name}</strong></p>
                                                    </div>
                                                    <div class='footer'>
                                                        <p>&copy; {$companydata[0]->Name} | All rights reserved.</p>
                                                    </div>
                                                </div>
                                            </body>
                                        </html>";

                        $mail->send();
                        $data['success'] = "OTP sent to your email. Please check your inbox.";
                    } catch (Exception $e) {
                        $data['errors'] = "Failed to send email. Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $error = "Email not found";
                }
                header('Location: http://localhost/Gradlink/public/company/RecruitStudents/dashboard');
                exit;
            } else {
                $error = "There was an issue update the Student Job Status.";
                $this->view('Company/Studentpro', ['data' => $data, 'adId' => $advertisementId, 'error' => $error, 'url' => 'http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard', 'studentJobstatus' => $studentJobstatus, 'interviewschedule' => $interviewschedule]);
                exit;
            }
        }

        $this->view('Company/Studentpro', ['data' => $data, 'adId' => $advertisementId, 'url' => 'http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard', 'studentJobstatus' => $studentJobstatus, 'interviewschedule' => $interviewschedule]);
    }

    public function interviewschedule($studentId, $advertisementId)
    {

        $studentmodel = new C_Student;
        $data = $studentmodel->findbyId($studentId);
        $advertisementmodel = new C_Advertisement;
        $addata = $advertisementmodel->find(['advertisementId' => $advertisementId]);
        $updatemodel = new C_Dashboard;
        $company = new company;
        $companydata = $company->findById($_SESSION['USER']->CompanyId);
        $studentdata = $data[0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new interview_time_slot;
            $data = [
                'StudentId' => $studentId,
                'CompanyId' => $_SESSION['USER']->CompanyId,
                'Date' => $_POST['date'],
                'StartTime' => $_POST['starttime'],
                'EndTime' => $_POST['endtime']
            ];

            $updatedata = [
                'Jobstatus' => 'Interview Scheduled'
            ];

            $updateresult = $updatemodel->update($studentId, $advertisementId, $updatedata);
            $result = $model->insert($data);
            if ($result && $updateresult['status']) {
                $success = "Interview Schedule created successfully.";
                if (!empty($studentdata->Email) && !empty($companydata[0]->Email)) {
                    $studentemail = $studentdata->Email;
                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
                        $mail->SMTPAuth = true;
                        $mail->Username = 'sandarunihara15@gmail.com'; // Your email
                        $mail->Password = 'gwko wgdm ffqx fzcm'; // Your app password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
                        $mail->Port = 587;
                        $mail->setFrom($companydata[0]->Email, $companydata[0]->Name);
                        $mail->addAddress($studentemail);
                        $mail->isHTML(true);
                        $mail->Subject = "Details of Your Scheduled Interview with {$companydata[0]->Name}";
                        $mail->Body = "
                                        <html>
                                            <head>
                                                <style>
                                                    body {
                                                        font-family: Arial, sans-serif;
                                                        line-height: 1.6;
                                                        color: #333;
                                                        background-color: #f9f9f9;
                                                        padding: 0;
                                                        margin: 0;
                                                    }
                                                    .email-container {
                                                        max-width: 600px;
                                                        margin: 20px auto;
                                                        background: #ffffff;
                                                        border: 1px solid #ddd;
                                                        border-radius: 8px;
                                                        overflow: hidden;
                                                    }
                                                    .header {
                                                        background-color: #007bff;
                                                        color: #ffffff;
                                                        padding: 20px;
                                                        text-align: center;
                                                    }
                                                    .header h1 {
                                                        margin: 0;
                                                        font-size: 24px;
                                                    }
                                                    .content {
                                                        padding: 20px;
                                                    }
                                                    .content p {
                                                        margin: 10px 0;
                                                    }
                                                    .footer {
                                                        background-color: #f4f4f4;
                                                        text-align: center;
                                                        padding: 10px;
                                                        font-size: 12px;
                                                        color: #666;
                                                        border-top: 1px solid #ddd;
                                                    }
                                                </style>
                                            </head>
                                            <body>
                                                <div class='email-container'>
                                                    <div class='header'>
                                                        <h1>Interview Details</h1>
                                                    </div>
                                                    <div class='content'>
                                                        <p>Dear {$studentdata->Name},</p>
                                                        <p>This is to inform you about the details of your scheduled interview for a potential internship at <strong>{$companydata[0]->Name}</strong>.</p>
                                                        <p><strong>Interview Details:</strong></p>
                                                        <ul>
                                                            <li><strong>Date:</strong> {$data['Date']}</li>
                                                            <li><strong>Start Time:</strong> {$data['StartTime']}</li>
                                                            <li><strong>End Time:</strong> {$data['EndTime']}</li>
                                                        </ul>
                                                        <p>If you have any questions or need to reschedule, please contact us at <strong>{$companydata[0]->ContactNum}</strong>.</p>
                                                        <p>We look forward to your participation in the interview.</p>
                                                        <p>Best regards,</p>
                                                        <p><strong>{$companydata[0]->Name}</strong></p>
                                                    </div>
                                                    <div class='footer'>
                                                        <p>&copy; {$companydata[0]->Name}. All rights reserved.</p>
                                                    </div>
                                                </div>
                                            </body>
                                        </html>";

                        $mail->send();
                        $data['success'] = "OTP sent to your email. Please check your inbox.";
                    } catch (Exception $e) {
                        $data['errors'] = "Failed to send email. Error: {$mail->ErrorInfo}";
                    }
                }
                header('Location: http://localhost/Gradlink/public/company/ShortlistedStudents/studentprofile/' . $advertisementId . '/' . $studentId);
                exit;
            } else {
                $error = "There was an issue creating the Interview Schedule.";
                $this->view('Company/CreateSchedule', ['error' => $error]);
                exit;
            }
        }
        $this->view('Company/CreateSchedule', ['data' => $data, 'addata' => $addata]);
    }
}
