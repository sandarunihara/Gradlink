<?php

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
        // show($interviewdata);
        // $data=$interviewmodel->findall();
        // show($data);
        $interviewdata = [];
        foreach ($data as $item) {
            if (!empty($item)) {
                foreach ($item as $item) {
                    $studentmodel = new C_Student;
                    $studentdata = $studentmodel->findbyId($item->StudentId);
                    $studentadvertisement = new student_advertisement;
                    $studentaddata = $studentadvertisement->findstudentad($item->advertisementId, $item->StudentId);
                    $interviewdata[] = [
                        'Position' => $studentaddata[0]->position,
                        'StudentName' => $studentdata[0]->Name,
                        'Date' => $item->Date,
                        'StartTime' => $item->StartTime,
                        'EndTime' => $item->EndTime
                    ];
                }
            }
        }

        $this->view('Company/Schedule', ['data' => $interviewdata]);
    }
}
