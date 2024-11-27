<?php

class StudentAd{
    use BaseController;
    public function advertisement(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $model = new Student_AD;
        $data['AdDetails'] = $model -> getAdDetails();
        $this-> view('Student/Internship', $data);
    }
    public function viewAdvertisement($id){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $model = new C_Advertisement;
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $id]);
        $advertisementId = $id;

        $this-> view('Student/InternshipView', $data);
    }
}