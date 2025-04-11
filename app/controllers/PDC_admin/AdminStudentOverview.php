<?php

class AdminStudentOverview{
    use Controller;
    public function dashboard(){
        $model = new student;
            $studentData = $model->findnotapplied();

            $this->view('PDC_admin/Student/StudentOverview', [
                'studentData' => $studentData,
                'activeTab' => 'Not-Applied'
            ]
        );
    } 
}
