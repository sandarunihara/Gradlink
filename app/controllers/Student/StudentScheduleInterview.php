<?php

class StudentScheduleInterview{
    use Controller;
    public function Interview(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        $this-> view('Student/ScheduleInterviews', $data);
    }  


}

