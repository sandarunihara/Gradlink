<?php
class ViewStudent
{
    use Controller;
    public function index()
    {

        $studentId = $_GET['id'] ?? null;

        if ($studentId == null) {
            echo 'This Student does not exist';
            return;
        }

        $model = new student;
        $applyDetails = new student_advertisement;
        $company = new company;
        $studentData = $model->find($studentId);
        //$id = $studentData[0] -> StudentId;
        $studentapply = $applyDetails->findAppliedCompanies($studentId);
        //var_dump($studentapply);
        $count = $applyDetails->noOfAppliedCompanies($studentId);

        $data = [
            'StudentId' => $studentData->StudentId,
            'Name' => $studentData->Name,
            'NIC' => $studentData->NIC,
            'DegreeName' => $studentData->DegreeName,
            'Status' => $studentData->Status,
            'Email' => $studentData->Email,
            'ContactNum' => $studentData->ContactNum,
            'Github' => $studentData->Github,
            'Linkedin' => $studentData->Linkedin,
            'noOfAppliedAds' => $count,
            'applications' => [],
            'block' => $studentData->block

        ];


        if (is_array($studentapply) || is_object($studentapply)) {
            foreach ($studentapply as $apply) {
                $data['applications'][] = [
                    'Jobstatus' => $apply->Jobstatus,
                    'CreatedAt' => $apply->CreatedAt,
                    'position' => $apply->position,
                    'ComName' => $apply->Name,
                    'CompanyLogo' => $apply->profileimg
                ];
            }
        } else {
            $studentapply = [];
        }

        $this->view('Coordinator/Student/viewStudent', $data);
    }
}
