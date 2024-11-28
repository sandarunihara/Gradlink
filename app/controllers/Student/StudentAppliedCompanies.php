<?php

class StudentAppliedCompanies{
    use BaseController;
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
    public function ViewAppliedCompanies($id){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $model = new C_Advertisement;
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $id]);
        $advertisementId = $id;
        $this-> view('Student/ViewAppliedAd',$data);
    }

}

