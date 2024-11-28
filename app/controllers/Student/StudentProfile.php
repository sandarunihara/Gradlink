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
        if($_SERVER['REQUEST_METHOD'] == "POST"){    
            //show($_POST['Github']);
            $data['Result'] = $student -> update($arr['StudentId'], $_POST, 'StudentId');
            
            if($data['Result']['status'] == 'success'){
                //show($data['Result']);
                    header('Location: '.ROOT.'/Student/StudentProfile/profile');
                }
            
        }else{
            $this-> view('Student/ProfileEdit',$data);
        }
    }
}