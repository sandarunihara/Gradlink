<?php

class StudentAppliedCompanies{
    use Controller;
    public function AppliedCompanies(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        
        $company = new company;
        $student_advertisement = new student_advertisement;
        $advertisement = new advertisement;

        $this-> view('Student/AppliedCompanies',$data);
    }  


}

