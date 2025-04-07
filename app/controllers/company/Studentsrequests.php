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
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");

        $advertisementIds = [];
        if (empty($data)) {
            $this->view('Company/StudentsRequests', ['data' => []]);
            exit();
        }
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata = [];
        $hasShortlisted = false;
        $hasRecruited = false;
        // show($advertisementIds);
        foreach ($advertisementIds as $id) {
            // show($id);
            $data = $model->findreq($id);
            // show($data);
            // if (empty($data)) {
            //     $_SESSION['hasShortlisted'] = $hasShortlisted;
            //     $_SESSION['hasRecruited'] = $hasRecruited;
            //     $this->view('Company/StudentsRequests', ['data' => $reqdata]);
            //     exit();
            // }
            if (!empty($data)) {
                foreach ($data as $item) {

                    if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled') {
                        $hasShortlisted = true;
                    }

                    if ($item->Jobstatus === 'Recruit') {
                        $hasRecruited = true;
                    }

                    // if($item->Companyrowstatus != 0){
                    $reqdata[] = [
                        "StudentId" => $item->StudentId,
                        'AdvertisementId' => $item->advertisementId,
                        'Student Name' => $item->Name,
                        'Student Degree' => $item->DegreeName,
                        'Position' => $item->position,
                        'Action' => $item->Jobstatus,
                        'Skills' =>$item->Skills
                    ];
                    // }
                }
            }
        }
        // show($reqdata);
        // Store the flags in session
        $_SESSION['hasShortlisted'] = $hasShortlisted;
        $_SESSION['hasRecruited'] = $hasRecruited;
        $this->view('Company/StudentsRequests', ['data' => $reqdata, 'hasShortlisted' => $hasShortlisted, 'hasRecruited' => $hasRecruited]);
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
        // Get filter parameters from URL
        $position = $_GET['position'] ?? 'all';
        $status = $_GET['status'] ?? 'all';
        $skill=$_GET['skill'] ?? '';

        // Create back URL with filters
        $backUrl = ROOT . "/Company/StudentsRequests/dashboard?" . http_build_query([
            'position' => $position,
            'status' => $status,
            'skill'=>$skill
        ]);
        // show($backUrl);

        $model = new C_Student;
        $data = $model->findbyId($StudentId);

        $updatemodel = new C_Dashboard;
        $studentad_data = $updatemodel->find(['StudentId' => $StudentId, 'advertisementId' => $advertisementId], 'studentadvertisement');
        $studentJobstatus = $studentad_data[0]->Jobstatus;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_action'])) {
            $updatedata = [
                'Jobstatus' => $_POST['submit_action']
            ];
            $result = $updatemodel->update($StudentId, $advertisementId, $updatedata);
            if ($result['status']) {
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
