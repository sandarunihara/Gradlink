<?php

class StudentProgress{
    use Controller;
    public function progressReport(){
        $data = [];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        $this-> view('Student/ProgressReport', $data);
    }
    public function newReport(){
        $data = [];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        $this-> view('Student/NewProgressReport', $data);
    }
}