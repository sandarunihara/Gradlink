<?php

class StudentAd{
    use Controller;
    public function advertisement(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        $student = new student;
        $data['Student'] = $student -> first($arr);

        $advertisement = new advertisement;
        //$data['Advertisements'] = $advertisement -> where();
        $this-> view('Student/Internship', $data);
    }
    public function advertisementView(){
        $this-> view('Student/InternshipView');
    }
}