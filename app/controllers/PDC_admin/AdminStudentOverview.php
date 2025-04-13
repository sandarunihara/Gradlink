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

    public function recruited(){
        $model = new student;
        $studentData = $model->findRecruited();
        $this->view('PDC_admin/Student/StudentRecruited', [
            'studentData' => $studentData,
            'activeTab' => 'recruited-Students'
        ]
    );
    }

    public function rejected(){
        $model = new student;
        $studentData = $model->findRejected();
        $this->view('PDC_admin/Student/StudentRejected', [
            'studentData' => $studentData,
            'activeTab' => 'rejected-Students'
        ]
    );
    }
}
