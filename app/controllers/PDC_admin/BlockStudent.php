<?php

    class BlockStudent{
        use Controller;
        public function dashboard(){
            $model = new student;
            $studentData = $model->findAllBlocked();
            $this-> view('PDC_admin/Student/StudentBlock' , [
                'studentData' => $studentData,
                'activeTab' => 'Blocked-Students'
            ]);
        }
}