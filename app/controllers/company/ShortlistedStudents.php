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

        $admodel = new C_Advertisement;
        $model = new C_Dashboard;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");

        if (empty($data)) {
            $this->view('Company/ShortlistedStudents', ['data' => [],'removedlist'=>[]]);
            exit();
        }

        $advertisementIds = [];
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata = [];
        $removedlist=[];
        $hasShortlisted = false;
        $hasRecruited = false;
        foreach ($advertisementIds as $id) {
            $data = $model->findreq($id);
            // if (empty($data)) {
            //     $_SESSION['hasShortlisted'] = $hasShortlisted;
            //     $_SESSION['hasRecruited'] = $hasRecruited;
            //     $this->view('Company/ShortlistedStudents', ['data' => $reqdata]);
            //     exit();
            // }
            if (!empty($data)) {
                foreach ($data as $item) {
                    if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled' || $item->Jobstatus == 'Interview Expired') {
                        $hasShortlisted = true;
                    }
                    if ($item->Jobstatus === 'Recruit') {
                        $hasRecruited = true;
                    }
                    if ($item->Jobstatus == 'Shortlist' || $item->Jobstatus == 'Interview Scheduled'|| $item->Jobstatus == 'Interview Expired' ) {
                        $isrecriuted=$model->find(['StudentId'=>$item->StudentId ,'Jobstatus'=>'Recruit'],'studentadvertisement');
                        if (!empty($isrecriuted)) {
                            foreach ($isrecriuted as $students) {
                                if (!empty($students)) {
                                    $adcomapny = $admodel->find(['advertisementId' => $students->AdvertisementId]);
                                    if ($adcomapny[0]->CompanyId == $user->CompanyId) {
                                        $reqdata[] = [
                                            "StudentId" => $item->StudentId,
                                            'AdvertisementId' => $item->advertisementId,
                                            'Student Name' => $item->Name,
                                            'Student Degree' => $item->DegreeName,
                                            'Position' => $item->position,
                                            'Action' => $item->Jobstatus
                                        ];
                                    } else {
                                        $removedlist[] = [
                                            "StudentId" => $item->StudentId,
                                            'AdvertisementId' => $item->advertisementId,
                                            'Student Name' => $item->Name,
                                            'Student Degree' => $item->DegreeName,
                                            'Position' => $item->position,
                                            'Action' => $item->Jobstatus
                                        ];
                                    }
                                } else {
                                    $reqdata[] = [
                                        "StudentId" => $item->StudentId,
                                        'AdvertisementId' => $item->advertisementId,
                                        'Student Name' => $item->Name,
                                        'Student Degree' => $item->DegreeName,
                                        'Position' => $item->position,
                                        'Action' => $item->Jobstatus
                                    ];
                                }
                            }
                        } else {
                            $reqdata[] = [
                                "StudentId" => $item->StudentId,
                                'AdvertisementId' => $item->advertisementId,
                                'Student Name' => $item->Name,
                                'Student Degree' => $item->DegreeName,
                                'Position' => $item->position,
                                'Action' => $item->Jobstatus
                            ];
                        }
                    }
                }
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && $_POST['submit'] == 'close') {
            foreach ($removedlist as $removeapplication) {
                $paradata = [
                    'StudentId' => $removeapplication['StudentId'],
                    'AdvertisementId' => $removeapplication['AdvertisementId']
                ];
                $responce = $model->deletead($paradata);
                if ($responce) {
                    header("Location: http://localhost/Gradlink/public/company/StudentsRequests/dashboard?position=all&status=all&skill=");
                    exit();
                }
            }
        }
        // show($removedlist);
        $_SESSION['hasShortlisted'] = $hasShortlisted;
        $_SESSION['hasRecruited'] = $hasRecruited;
        $this->view('Company/ShortlistedStudents', ['data' => $reqdata,'removedlist'=>$removedlist]);
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
        $interviewdata = $interviewmodel->find(['StudentId' => $StudentId, 'advertisementId' => $advertisementId]);
        if (!empty($interviewdata)) {
            $interviewschedule = 1;
        } else {
            $interviewschedule = 0;
        }
        // show($interviewdata);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_action'])) {
            $updatedata = [
                'Jobstatus' => $_POST['submit_action']
            ];
            $studentdata = [
                'Status' => $_POST['submit_action']
            ];
            // show($updatedata);
            $isrecriuted=$updatemodel->find(['StudentId'=>$StudentId ,'Jobstatus'=>'Recruit'],'studentadvertisement');
            if(!empty($isrecriuted)){
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Recruitment unsuccessful! the student has already been recruited by another company'
                ];
                header('Location: http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard');
                exit;
            }else{
                $result = $updatemodel->update($StudentId, $advertisementId, $updatedata);
                // $studentUpdate = $model->update($StudentId, $studentdata, 'StudentId');
                if ($result['status']) {
                    if ($_POST['submit_action'] != 'Reject') {
                        $success = "Student Job Status updated successfully.";
                        if (!empty($data[0]->Email) && !empty($companydata->Email)) {
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
                                $mail->setFrom($companydata->Email, $companydata->Name);
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
                                                                <h1>Welcome to {$companydata->Name}!</h1>
                                                            </div>
                                                            <div class='content'>
                                                                <p>Dear {$data[0]->Name},</p>
                                                                <p>We are thrilled to inform you that you have been selected for an internship at <strong>{$companydata->Name}</strong>. This role offers you a unique opportunity to learn, grow, and contribute to our team.</p>
                                                                <p>Details regarding your onboarding process and responsibilities will be shared soon. If you have any immediate questions, please don't hesitate to contact us at <strong>{$companydata->ContactNum}</strong>.</p>
                                                                <p>We are excited to welcome you aboard and look forward to a fruitful collaboration.</p>
                                                                <p>Warm regards,</p>
                                                                <p><strong>{$companydata->Name}</strong></p>
                                                            </div>
                                                            <div class='footer'>
                                                                <p>&copy; {$companydata->Name} | All rights reserved.</p>
                                                            </div>
                                                        </div>
                                                    </body>
                                                </html>";
    
                                $mail->send();
                                $_SESSION['flash'] = [
                                    'type' => 'success',
                                    'message' => 'Student has been recruited and notified successfully'
                                ];
                                header('Location: http://localhost/Gradlink/public/company/RecruitStudents/dashboard');
                                exit;
                            } catch (Exception $e) {
                                $_SESSION['flash'] = [
                                    'type' => 'error',
                                    'message' => "Failed to send email. Error: {$mail->ErrorInfo}"
                                ];
                                $this->view('Company/Studentpro', ['data' => $data, 'adId' => $advertisementId, 'url' => 'http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard', 'studentJobstatus' => $studentJobstatus, 'interviewschedule' => $interviewschedule]);
                                exit;
                            }
                        } else {
                            $_SESSION['flash'] = [
                                'type' => 'error',
                                'message' => "Email not found"
                            ];
                            $this->view('Company/Studentpro', ['data' => $data, 'adId' => $advertisementId, 'url' => 'http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard', 'studentJobstatus' => $studentJobstatus, 'interviewschedule' => $interviewschedule]);
                            exit;
                        }
                    } else {
                        $_SESSION['flash'] = [
                            'type' => 'success',
                            'message' => 'Student Status updated'
                        ];
                        header('Location: http://localhost/Gradlink/public/company/StudentsRequests/dashboard');
                        exit;
                    }
                } else {
                    $_SESSION['flash'] = [
                        'type' => 'error',
                        'message' => "There was an issue update the Student Status Pleace Try again!"
                    ];
                    $this->view('Company/Studentpro', ['data' => $data, 'adId' => $advertisementId, 'url' => 'http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard', 'studentJobstatus' => $studentJobstatus, 'interviewschedule' => $interviewschedule]);
                    exit;
                }
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
        $model = new interview_time_slot;
        $interview_para = [
            'StudentId' => $studentId
        ];
        $student_before_shedule = $model->find($interview_para);
        $unavailable_date = [];
        if (!empty($student_before_shedule)) {
            foreach ($student_before_shedule as $interviewdate) {
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

            $isrecriuted=$updatemodel->find(['StudentId'=>$studentId ,'Jobstatus'=>'Recruit'],'studentadvertisement');
            if(!empty($isrecriuted)){
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Recruitment unsuccessful! the student has already been recruited by another company'
                ];
                header('Location: http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard');
                exit;
            }else{
                $updateresult = $updatemodel->update($studentId, $advertisementId, $updatedata);
                $result = $model->insert($data);
                if ($result && $updateresult['status']) {
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
                            $mail->Subject = "Details of Your Scheduled Interview with {$companydata->Name}";
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
                                                            <p>This is to inform you about the details of your scheduled interview for a potential internship at <strong>{$companydata->Name}</strong>.</p>
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
                                'message' => 'Interview is scheduled and student has been notified'
                            ];
                        } catch (Exception $e) {
                            $_SESSION['flash'] = [
                                'type' => 'error',
                                'message' => "Failed to send email. Error: {$mail->ErrorInfo}"
                            ];
                        }
                    }
                    header('Location: http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard');
                    exit;
                } else {
                    $_SESSION['flash'] = [
                        'type' => 'error',
                        'message' => "There was an issue creating the Interview Schedule."
                    ];
                    $error = "There was an issue creating the Interview Schedule.";
                    $this->view('Company/CreateSchedule', ['data' => $data, 'addata' => $addata, 'unavailable_date' => $unavailable_date, 'error' => $error]);
                    exit;
                }

            }
        }
        $this->view('Company/CreateSchedule', ['data' => $data, 'addata' => $addata, 'unavailable_date' => $unavailable_date]);
    }

    public function getInterviewSchedules()
    {
        $companyID = $_SESSION['USER']->CompanyId;
        $advertisementModel = new C_Advertisement;
        $interviewmodel = new interview_time_slot;
        $student = new student;
        $advertisementData = $advertisementModel->find(['CompanyId' => $companyID]);
        $advertisementID = [];
        $interview_data = [];
        $events = [];
        if (!empty($advertisementData)) {
            foreach ($advertisementData as $advertisement) {
                $interview_data[] = $interviewmodel->find(['advertisementId' => $advertisement->advertisementId]);
            }
            if (!empty($interview_data)) {
                foreach ($interview_data as $eachAD) {
                    if (!empty($eachAD)) {
                        foreach ($eachAD as $interview) {
                            $studentName = $student->find($interview->StudentId)->Name;
                            $advertisementposition = $advertisementModel->find(['advertisementId' => $interview->advertisementId])[0]->position;
                            $events[] = [
                                'title' => $advertisementposition,
                                'position' => $advertisementposition,
                                'StudentName' => $studentName,
                                'StudentId' => $interview->StudentId,
                                'advertisementId' => $interview->advertisementId,
                                'start' => $interview->Date . 'T' . $interview->StartTime,
                                'end' => $interview->Date . 'T' . $interview->EndTime,
                                'color' => '#3788d8'
                            ];
                        }
                    }
                }
            }
        }
        header('Content-Type: application/json');
        echo json_encode($events);
        exit;
    }
}
