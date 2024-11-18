<?php

class StudentAppliedCompanies{
    use Controller;
    public function AppliedCompanies(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);

        $student_advertisement = new student_advertisement;
        
        $this-> view('Student/AppliedCompanies',$data);
    }  


}

