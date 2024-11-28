<?php

class StudentProgress{
    use BaseController;
    public function progressReport(){
        $data = [];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        $this-> view('Student/ProgressReport', $data);
    }
}