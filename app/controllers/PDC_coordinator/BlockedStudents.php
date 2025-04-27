<?php
class BlockedStudents
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $model = new Student;
        $data = $model->findAllBlocked();

        if($data == false || empty($data)){
            $this->view('Coordinator/Student/blockedStudents');
        }
        else{
            $blockedStudentData = [];

            foreach ($data as $studentDetail) {
                $blockedStudentData[] = [
                    'student_id' => $studentDetail->StudentId,
                    'student_name' => $studentDetail->Name,
                    'nic' => $studentDetail->NIC,
                    'degree' => $studentDetail->DegreeName,
                    'student_email' => $studentDetail->Email,
                    'contact_no' => $studentDetail->ContactNum,
                    'comment' => $studentDetail->reason,
                ];
            }
        $this->view('Coordinator/Student/blockedStudents', ['blockedStudentData' => $blockedStudentData]);

        }

    }
}

