<?php

class AdminStudentOverview{
    use Controller;
    public function dashboard(){
        $model = new student;
            $studentData = $model->findall();

            $this->view('PDC_admin/Student/StudentOverview', ['studentData' => $studentData]);
    } 
}
