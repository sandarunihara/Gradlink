<?php

class StudentProfile{
    use Controller;
    public function profile(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $skill = new student_skill;
        $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');

        $this-> view('Student/Profile',$data);
    }
    public function profileEdit(){        
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        $student = new student;
        $data['Student'] = $student -> first($arr);
        

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