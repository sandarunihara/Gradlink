<?php

class StudentProfile{
    use Controller;
    public function profile(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $interestedArea = new student_interest_area;
        $studentProfilePic = new student_profile_pic;


        $data['Student'] = $student -> first($arr);
        $data['InterestedArea'] = $interestedArea -> first($arr);
        $data['studentProfilePic'] = $studentProfilePic -> first($arr);
    
        $this-> view('Student/Profile',$data);
    }
    public function profileEdit(){        
        $data =[];

        if($_SERVER['REQUEST_METHOD'] == "POST"){    
            $arr['UserId'] = $_SESSION['USER'] -> StudentId;
            //$contactNum = new StudentContactNum;
            
            
            show($_POST);
            $data['Result'] = $contactNum -> update($arr['StudentId'], $_POST, 'UserId');
            //$this -> view('Student/ProfileEdit',$data);
            show($data);
        }

        $this-> view('Student/ProfileEdit');

    }
}