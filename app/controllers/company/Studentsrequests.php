<?php

class StudentsRequests
{
    use Controller;
    public function dashboard()
    {

        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $model = new C_Dashboard;
        $admodel = new C_Advertisement;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");

        $advertisementIds = [];
        if (empty($data)) {
            $this->view('Company/StudentsRequests', ['data' => [], 'removedlist' => []]);
            exit();
        }
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata = [];
        $removedlist = [];
        $hasShortlisted = false;
        $hasRecruited = false;
        // show($advertisementIds);
        foreach ($advertisementIds as $id) {
            // show($id);
            $data = $model->findreq($id);

            if (!empty($data)) {
                foreach ($data as $item) {

                    if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled' || $item->Jobstatus === 'Interview Marked' || $item->Jobstatus == 'Interview Expired') {
                        $hasShortlisted = true;
                    }

                    if ($item->Jobstatus === 'Recruit' || $item->Jobstatus === 'Accept') {
                        $hasRecruited = true;
                    }
                    $isrecriute = $model->find(['StudentId' => $item->StudentId, 'Jobstatus' => 'Recruit'], 'studentadvertisement') ?: [];
                    $isaccept = $model->find(['StudentId' => $item->StudentId, 'Jobstatus' => 'Accept'], 'studentadvertisement') ?: [];
                    $isrecriuted=array_merge($isrecriute,$isaccept);
                    
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
                                        'Action' => $item->Jobstatus,
                                        'Skills' => $item->Skills
                                    ];
                                } else {
                                    $removedlist[] = [
                                        "StudentId" => $item->StudentId,
                                        'AdvertisementId' => $item->advertisementId,
                                        'Student Name' => $item->Name,
                                        'Student Degree' => $item->DegreeName,
                                        'Position' => $item->position,
                                        'Action' => $item->Jobstatus,
                                        'Skills' => $item->Skills
                                    ];
                                }
                            } else {
                                $reqdata[] = [
                                    "StudentId" => $item->StudentId,
                                    'AdvertisementId' => $item->advertisementId,
                                    'Student Name' => $item->Name,
                                    'Student Degree' => $item->DegreeName,
                                    'Position' => $item->position,
                                    'Action' => $item->Jobstatus,
                                    'Skills' => $item->Skills
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
                            'Action' => $item->Jobstatus,
                            'Skills' => $item->Skills
                        ];
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
        // show($isaccept);
        // Store the flags in session
        $_SESSION['hasShortlisted'] = $hasShortlisted;
        $_SESSION['hasRecruited'] = $hasRecruited;
        $this->view('Company/StudentsRequests', ['data' => $reqdata, 'removedlist' => $removedlist, 'hasShortlisted' => $hasShortlisted, 'hasRecruited' => $hasRecruited]);
    }

    // public function deletedatarow($advertisementId, $StudentId)
    // {
    //     $model = new C_Dashboard;
    //     $result=$model->update($StudentId, $advertisementId, ['Jobstatus' => 'Trash']);
    //     if ($result['status']) {
    //         // Redirect to the same page after successful submission
    //         $success = "Student Request deleted successfully.";
    //         header('Location: http://localhost/Gradlink/public/company/StudentsRequests/dashboard');
    //         exit;
    //     } else {
    //         $error = "There was an issue deleting the Student Request.";
    //         $this->view('Company/StudentsRequests', ['error' => $error,'data' => $result]);
    //         exit;
    //     }
    // }

    public function studentprofile($advertisementId, $StudentId)
    {

        $userid=$_SESSION["USER"]->CompanyId;
        // Get filter parameters from URL
        $position = $_GET['position'] ?? 'all';
        $status = $_GET['status'] ?? 'all';
        $skill = $_GET['skill'] ?? '';

        // Create back URL with filters
        $backUrl = ROOT . "/Company/StudentsRequests/dashboard?" . http_build_query([
            'position' => $position,
            'status' => $status,
            'skill' => $skill
        ]);
        // show($backUrl);

        $action_log=new Action_logs;
        $model = new C_Student;
        $data = $model->findbyId($StudentId);

        $updatemodel = new C_Dashboard;
        $studentad_data = $updatemodel->find(['StudentId' => $StudentId, 'advertisementId' => $advertisementId], 'studentadvertisement');
        $data[0]->adCV=$studentad_data[0]->CV;
        $studentJobstatus = $studentad_data[0]->Jobstatus;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_action'])) {
            $updatedata = [
                'Jobstatus' => $_POST['submit_action']
            ];
            $result = $updatemodel->update($StudentId, $advertisementId, $updatedata);
            if ($result['status']) {
                $action_data=[
                    'actor_id'=>$userid,
                    'actor_role'=>'company',
                    'target_id'=>$StudentId,
                    'target_type'=>'student',
                    'action_type'=>$_POST['submit_action']
                ];
                $action_log->insert($action_data);
                if ($_POST['submit_action'] === 'Shortlist') {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'Student Status updated'
                    ];
                    header("Location: $backUrl");
                    exit;
                } else {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'Student Status updated'
                    ];
                    header("Location: $backUrl");
                    exit;
                }
                // Redirect to the same page after successful submission
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'There was an issue update the Student Status'
                ];
                $error = "There was an issue update the Student Job Status.";
                $this->view('Company/Studentpro', ['data' => $data, 'studentJobstatus' => $studentJobstatus, 'url' => $backUrl]);
                exit;
            }
        }

        $this->view('Company/Studentpro', ['data' => $data, 'url' => $backUrl, 'studentJobstatus' => $studentJobstatus]);
    }


    // public function filterstudents()
    // {
    //     $this->view('Company/FilterStudents');
    // }
}
