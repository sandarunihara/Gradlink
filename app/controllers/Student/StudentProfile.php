<?php

class StudentProfile{
    use Controller;
    public function profile(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $skill = new student_skill;
        $studentProfilePic = new student_profile_pic;


        $data['Student'] = $student -> first($arr);
        $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');
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