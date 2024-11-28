<?php

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
