<?php
class DashboardStudent
{
    use Controller;
    public function index()
    {
        $model = new Student;
        $data = $model->findall();

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Student/dashboardStudent');
        } else {
            $studentData = [];

            foreach ($data as $studentDetail) {
                $studentData[] = [
                    'student_id' => $studentDetail->StudentId,
                    'student_name' => $studentDetail->Name,
                    'nic' => $studentDetail->NIC,
                    'degree' => $studentDetail->DegreeName,
                    'student_email' => $studentDetail->Email,
                    'contact_no' => $studentDetail->ContactNum
                ];
            }
            $this->view('Coordinator/Student/dashboardStudent', ['studentData' => $studentData]);
        }
    }
}
