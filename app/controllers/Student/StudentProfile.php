<?php

class StudentProfile{
    use BaseController;
    public function profile(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $skill = new student_skill;
        $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');

        // $certificate = new certificate;
        // $data['Certificates'] = $certificate -> where($arr, [], '', 'do_not_order');

        $student = new student;
        $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];
        
        //show($data);
        $this-> view('Student/Profile',$data);
    }
    public function profileEdit(){        
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        $data['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $student = new student;
        $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];

        $skill = new student_skill;
        $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');

        if($_SERVER['REQUEST_METHOD'] == "POST"){    
            //show($_POST);
            $result1 = $student -> update($arr['StudentId'], $_POST, 'StudentId');
            
            $studentSkills = trim($_POST['Skill'], ",");
            $studentSkillsArray = explode(",", $studentSkills);

            $isDelete = $skill -> delete($arr['StudentId'], 'StudentId');
            $isUpdate2 = $skill -> insertSkill($data['StudentId'] ,$studentSkillsArray);
            
            if ($result1['status'] === "success") {
                $isUpdate1 = 1;
            }else{
                $isUpdate1 = 0;
            }

            $data['ActivityDescription'] = "Updated your Profile";
            $student_activity = new student_activity;
            $isUpdate3 = $student_activity -> insert($data);
            
            if($isUpdate1 && $isUpdate2){
                if($isUpdate3){
                    $_SESSION['isUpdate'] = 1;
                }else{
                    $_SESSION['isUpdate'] = 0;
                }
            }else{
                $_SESSION['isUpdate'] = 0;
            }
            //show($_SESSION);
            header('Location: '.ROOT.'/Student/StudentProfile/profile');
        }else{
            $this-> view('Student/ProfileEdit',$data);
        }
    }
}