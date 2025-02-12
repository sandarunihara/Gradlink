<?php
class ViewStudent
{
    use Controller;
    public function index()
    {

        $id = $_GET['id'] ?? null;

        if ($id == null) {
            echo 'This Student does not exist';
            return;
        }

        $model = new Student();
        $student = $model->find($id);

        if ($student) {
            $studentData = [
                'student_id' => $student->StudentId,
                'student_name' => $student->Name,
                'nic' => $student->NIC,
                'degree' => $student->DegreeName,
                'description' => $student->ShortDesc,
                'email' => $student->Email,
                'contact_no' => $student->ContactNum,
                'gitlink' => $student->Github,
                'linkedin' => $student->Linkedin,
            ];
            $this->view('Coordinator/Student/viewStudent', ['studentData' => $studentData]);
        }
        else {
            echo "No data found";
        }

       
    }
}
