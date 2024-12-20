<?php

class StudentAppliedCompanies{
    use BaseController;
    public function AppliedCompanies(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        
        $student_advertisement = new student_advertisement;
        $data['student_applied_companies'] = $student_advertisement->findAppliedCompanies($arr['StudentId']);

        //show($data);
        $this-> view('Student/AppliedCompanies',$data);
    }  
    public function ViewAppliedCompanies($id){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $model = new C_Advertisement;
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $id]);
        $advertisementId = $id;
        //show($data);
        $this-> view('Student/ViewAppliedAdDash',$data);
    }

}

