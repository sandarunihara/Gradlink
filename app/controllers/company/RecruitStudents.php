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
            if (empty($data)) {
                $_SESSION['hasShortlisted'] = $hasShortlisted;
                $_SESSION['hasRecruited'] = $hasRecruited;
                $this->view('Company/RecruitStudents', ['data' => $reqdata]);
                exit();
            }
            foreach ($data as $item) {
                if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled') {
                    $hasShortlisted = true;
                }
                if ($item->Jobstatus === 'Recruit') {
                    $hasRecruited = true;
                }
                if ($item->Jobstatus == 'Recruit') {
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

        $_SESSION['hasShortlisted'] = $hasShortlisted;
        $_SESSION['hasRecruited'] = $hasRecruited;
        $this->view('Company/RecruitStudents', ['data' => $reqdata]);
    }

    public function studentprofile($advertisementId, $StudentId)
    {
        $model = new C_Student;
        $data = $model->findbyId($StudentId);
        $updatemodel = new C_Dashboard;
        $studentad_data = $updatemodel->find(['StudentId' => $StudentId, 'advertisementId' => $advertisementId], 'studentadvertisement');
        $studentJobstatus = $studentad_data[0]->Jobstatus;

        $this->view('Company/Studentpro', ['data' => $data, 'url' => 'http://localhost/Gradlink/public/company/RecruitStudents/dashboard', 'studentJobstatus' => $studentJobstatus]);
    }
}
