<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

class Schedule
{
    use Controller;
    public function dashboard()
    {

        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $interviewmodel = new interview_time_slot;
        $admodal = new C_Advertisement;
        $appliedadmodal=new C_Dashboard;
        $companyId = [
            'CompanyId' => $user->CompanyId
        ];
        $ad_data = $admodal->find($companyId);
        $data = [];
        foreach ($ad_data as $ad_data) {
            $interview_para = [
                'advertisementId' => $ad_data->advertisementId
            ];
            $data[] = $interviewmodel->find($interview_para);
        }
        $interviewdata = [];
        $currentDate = date('Y-m-d');
        foreach ($data as $item) {
            if (!empty($item)) {
                foreach ($item as $item) {
                    // show($adkeys);
                    if($item->Date < $currentDate){
                        $adkeys=[
                            'StudentId'=>$item->StudentId,
                            'advertisementId'=>$item->advertisementId
                        ];
                        $da=$appliedadmodal->find($adkeys,'studentadvertisement');
                        if($da[0]->Jobstatus == 'Interview Scheduled'){
                            $appliedadmodal->update($item->StudentId,$item->advertisementId,['Jobstatus'=>'Interview Expired']);
                        }
                        if($da[0]->Jobstatus == 'Reject' || $da[0]->Jobstatus == 'Recruit'){
                            $interviewmodel->delete($item->InterviewId,'InterviewId');
                        }
                    }else{
                        $studentmodel = new C_Student;
                        $studentdata = $studentmodel->findbyId($item->StudentId);
                        $studentadvertisement = new student_advertisement;
                        $studentaddata = $studentadvertisement->findstudentad($item->advertisementId, $item->StudentId);
                        $interviewdata[] = [
                            'Position' => $studentaddata[0]->position,
                            'StudentName' => $studentdata[0]->Name,
                            'StudentId' => $studentdata[0]->StudentId,
                            'advertisementId' => $item->advertisementId,
                            'Date' => $item->Date,
                            'StartTime' => $item->StartTime,
                            'EndTime' => $item->EndTime
                        ];
                    }
                }
            }
        }

        $this->view('Company/Schedule', ['data' => $interviewdata]);
    }

    public function editschedule($advertisementId, $studentId)
    {

        $studentmodel = new C_Student;
        $data = $studentmodel->findbyId($studentId);
        $advertisementmodel = new C_Advertisement;
        $addata = $advertisementmodel->find(['advertisementId' => $advertisementId]);
        $updatemodel = new C_Dashboard;
        $company = new company;
        $companydata = $company->findById($_SESSION['USER']->CompanyId);
        $studentdata = $data[0];
        $model = new interview_time_slot;
        $interview_para=[
            'StudentId' => $studentId,
            'advertisementId' => $advertisementId
        ];
        $interview_data=$model->find($interview_para);
        $interview_date=$interview_data[0]->Date;
        $interview_id=$interview_data[0]->InterviewId;
        // show($interview_data[0]->InterviewId);
        $interview_para = [
            'StudentId' => $studentId
        ];
        $student_before_shedule = $model->find($interview_para);
        $unavailable_date = [];
        if (!empty($student_before_shedule)) {
            foreach ($student_before_shedule as $interviewdate) {
                if($interviewdate->Date != $interview_date)
                $unavailable_date[] = $interviewdate->Date;
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'StudentId' => $studentId,
                'advertisementId' => $advertisementId,
                'Date' => $_POST['date'],
                'StartTime' => $_POST['starttime'],
                'EndTime' => $_POST['endtime']
            ];
            if (!empty($_POST['message'])) {
                $extraMessage = $_POST['message'];
            }

            $updatedata = [
                'Jobstatus' => 'Interview Scheduled'
            ];

            $updateresult = $updatemodel->update($studentId, $advertisementId, $updatedata);
            $result = $model->update($interview_id,$data,'InterviewId');
            if ($result['status']=='success' && $updateresult['status']) {
                $success = "Interview Schedule created successfully.";
                if (!empty($studentdata->Email) && !empty($companydata->Email)) {
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
                        $mail->setFrom($companydata->Email, $companydata->Name);
                        $mail->addAddress($studentemail);
                        $mail->isHTML(true);
                        $mail->Subject = "Details of Your Re-Scheduled Interview with {$companydata->Name}";
                        $mail->Body = "<html>
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
                                                    .messagebox {
                                                        margin-top: 20px;
                                                        padding: 15px;
                                                        background-color: #f4f4f4;
                                                        border-left: 4px solid #007bff;
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
                                                        <p>This is to inform you about the details of your Re-Scheduled interview for a potential internship at <strong>{$companydata->Name}</strong>.</p>
                                                        <p><strong>Interview Details:</strong></p>
                                                        <ul>
                                                            <li><strong>Date:</strong> {$data['Date']}</li>
                                                            <li><strong>Start Time:</strong> {$data['StartTime']}</li>
                                                            <li><strong>End Time:</strong> {$data['EndTime']}</li>
                                                        </ul>
                                                        
                                                        <!-- Display the extra message if it's entered -->
                                                        <?php if (!empty($extraMessage)) { ?>
                                                            <div class='messagebox'>
                                                                <p><strong>Additional Message:</strong></p>
                                                                <p>{$extraMessage}</p>
                                                            </div>
                                                        <?php } ?>

                                                        <p>If you have any questions or need to reschedule, please contact us at <strong>{$companydata->ContactNum}</strong>.</p>
                                                        <p>We look forward to your participation in the interview.</p>
                                                        <p>Best regards,</p>
                                                        <p><strong>{$companydata->Name}</strong></p>
                                                    </div>
                                                    <div class='footer'>
                                                        <p>&copy; {$companydata->Name}. All rights reserved.</p>
                                                    </div>
                                                </div>
                                            </body>
                                            </html>";

                        $mail->send();
                        $_SESSION['flash'] = [
                            'type' => 'success',
                            'message' => 'Interview is updated and student has been notified'
                        ];
                        $data['success'] = "Email sent to Student's email.";
                    } catch (Exception $e) {
                        $_SESSION['flash'] = [
                            'type' => 'error',
                            'message' => 'Failed to updated Interview'
                        ];
                        $data['errors'] = "Failed to send email. Error: {$mail->ErrorInfo}";
                    }
                }
                header('Location: http://localhost/Gradlink/public/company/Schedule/dashboard');
                exit;
            } else {
                $error = "There was an issue creating the Interview Schedule.";
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'There was an issue Re-Schedule the Interview'
                ];
                header(`Location: http://localhost/Gradlink/public/company/Schedule/editschedule/$advertisementId/$studentId`);
                $this->view('Company/CreateSchedule', ['error' => $error]);
                exit;
            }
        }




        $this->view('Company/editSchedule',['data' => $data, 'addata' => $addata,'unavailable_date'=>$unavailable_date,'interview_data'=>$interview_data]);
    }
}
