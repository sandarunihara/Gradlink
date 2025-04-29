<?php

class StudentScheduleInterview{
    use BaseController;
    public function Interview(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);

        $interview_time_slot = new interview_time_slot;
        $data['interview_time_slot'] = $interview_time_slot->findInterviews($arr['StudentId']);
        $this-> view('Student/ScheduleInterviews', $data);
    }  


}

