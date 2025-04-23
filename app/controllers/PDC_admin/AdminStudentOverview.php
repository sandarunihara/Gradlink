<?php

class AdminStudentOverview{
    use Controller;
    public function dashboard(){
        $model = new student;
            $studentData = $model->findregistered();

            $this->view('PDC_admin/Student/StudentOverview', [
                'studentData' => $studentData,
                'activeTab' => 'Registered-Students'
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

    public function notReg(){
        $model = new student;
        $studentData = $model->findNotReg();
        $this->view('PDC_admin/Student/StudentNotReg', [
            'studentData' => $studentData,
            'activeTab' => 'Not-Registered-Students'
        ]
    );
    }

    public function notApplied(){
        $model = new student;
        $studentData = $model->findnotapplied();
        $this->view('PDC_admin/Student/StudentNotApplied' , [
            'studentData' => $studentData,
            'activeTab' => 'Not-Applied-Students'
        ]);
    }
}
