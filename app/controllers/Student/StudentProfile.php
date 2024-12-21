<?php

class StudentProfile{
    use BaseController;
    public function profile(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $skill = new student_skill;
        $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');

        $certificate = new certificate;
        $data['Certificates'] = $certificate -> where($arr, [], '', 'do_not_order');

        $student = new student;
        $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];
        
        $this-> view('Student/Profile',$data);
    }
    public function profileEdit(){        
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $student = new student;
        $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];

        $skill = new student_skill;
        $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');

        if($_SERVER['REQUEST_METHOD'] == "POST"){    
            //show($_POST);
            $_SESSION['isUpdate'] = $student -> update($arr['StudentId'], $_POST, 'StudentId');
            //show($_SESSION);
            header('Location: '.ROOT.'/Student/StudentProfile/profile');
        }else{
            $this-> view('Student/ProfileEdit',$data);
        }
    }
}