<?php

class RecruitStudents
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
            $this->view('Company/RecruitStudents', ['data' => []]);
            exit();
        }

        $advertisementIds = []; // Array to store all advertisement IDs
        // Loop through the result set and collect advertisement IDs
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata = [];
        $hasShortlisted = false;
        $hasRecruited = false;
        foreach ($advertisementIds as $id) {
            $data = $model->findreq($id);
            // if (empty($data)) {
            //     $_SESSION['hasShortlisted'] = $hasShortlisted;
            //     $_SESSION['hasRecruited'] = $hasRecruited;
            //     $this->view('Company/RecruitStudents', ['data' => $reqdata]);
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
                    if ($item->Jobstatus == 'Recruit') {

                        $notReviewed = [];
                        $notReviewedstatus = false;
                        $report_modal = new progress_doc;
                        $result = $report_modal->find($item->StudentId);
                        if (!empty($result)) {
                            foreach ($result as $report) {
                                if ($report->Status == 'notReviewed') {
                                    $notReviewed[] = $report;
                                }
                            }
                        }

                        if (!empty($notReviewed)) {
                            $notReviewedstatus = true;
                        }

                        $reqdata[] = [
                            "StudentId" => $item->StudentId,
                            'AdvertisementId' => $item->advertisementId,
                            'Student Name' => $item->Name,
                            'Student Degree' => $item->DegreeName,
                            'Position' => $item->position,
                            'Action' => $item->Jobstatus,
                            'NotReviewedstatus' => $notReviewedstatus,
                            'ProfilePic'=>$item->ProfilePic
                        ];
                    }
                }
            }
            // show($reqdata);

        }
        $_SESSION['hasShortlisted'] = $hasShortlisted;
        $_SESSION['hasRecruited'] = $hasRecruited;
        $this->view('Company/RecruitStudents', ['data' => $reqdata]);
    }

    public function studentprofile($advertisementId, $StudentId)
    {
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $model = new C_Student;
        $data = $model->findbyId($StudentId);
        $updatemodel = new C_Dashboard;
        $studentad_data = $updatemodel->find(['StudentId' => $StudentId, 'advertisementId' => $advertisementId], 'studentadvertisement');
        $data[0]->adCV=$studentad_data[0]->CV;
        $studentJobstatus = $studentad_data[0]->Jobstatus;

        $notReviewed = [];
        $Reviewed = [];
        $report_modal = new progress_doc;
        $result = $report_modal->find($StudentId);
        if (!empty($result)) {
            foreach ($result as $report) {
                if ($report->Status == 'notReviewed') {
                    $notReviewed[] = $report;
                } else {
                    $Reviewed[] = $report;
                }
            }
        }
        // show($Reviewed);
        // show($user->CompanyId);
        $report_reply_modal = new progress_doc_reply;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_submit_action'])) {
            // show($_POST);
            $status = [
                'Status' => $_POST['report_submit_action']
            ];
            $progress_report_reply = [
                "DocumentId" => $_POST['DocumentId'],
                "Reply" => $_POST['report-comment'],
                "ReplyDate" => date('Y-m-d'),
                "CompanyId" => $user->CompanyId
            ];
            // show($progress_report_reply);


            $update_report = $report_modal->update($_POST['DocumentId'], $status, 'DocumentId');
            $update_report_reply = $report_reply_modal->insert($progress_report_reply);

            // show($update_report);
            if ($update_report['status'] == 'success' && $update_report_reply == true) {
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Report reply update successfully'
                ];
                header("Location: http://localhost/Gradlink/public/company/RecruitStudents/studentprofile/$advertisementId/$StudentId");
                exit;
            }else{
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'There was an issue update report reply'
                ];
                header("Location: http://localhost/Gradlink/public/company/RecruitStudents/studentprofile/$advertisementId/$StudentId");
                exit;
            }
        }

        $this->view('Company/Studentpro', ['data' => $data, 'url' => 'http://localhost/Gradlink/public/company/RecruitStudents/dashboard', 'studentJobstatus' => $studentJobstatus, 'notReviewed' => $notReviewed, 'Reviewed' => $Reviewed]);
    }
}
