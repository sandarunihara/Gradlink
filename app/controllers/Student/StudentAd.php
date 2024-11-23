<?php

class StudentAd{
    use Controller;
    public function advertisement(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $advertisement = new advertisement;
        //$data['Advertisements'] = $advertisement -> where();
        $this-> view('Student/Internship', $data);
    }
}