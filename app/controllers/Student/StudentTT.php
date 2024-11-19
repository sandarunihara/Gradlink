<?php

class StudentTT{
    use Controller;
    public function techtalk(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        $student = new student;
        $data['Student'] = $student -> first($arr);

        $techtalk_slot = new techtalk_slot;
        $data['TechTalks'] = $techtalk_slot -> findall('', 'do_not_order');
        //show($data);
        $this-> view('Student/TechTalk',$data);
    }
}