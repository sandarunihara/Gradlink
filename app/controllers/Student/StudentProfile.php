<?php

class StudentProfile{
    use Controller;
    public function profile(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $skill = new student_skill;
        $certificate = new certificate;
        $experience = new experience;
        $qualification = new qualification;
        $studentProfilePic = new student_profile_pic;



        $data['Student'] = $student -> first($arr);
        $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');
        $data['Certificates'] = $certificate -> where($arr, [], '', 'do_not_order');
        $data['Experiences'] = $experience -> where($arr, [], '', 'do_not_order');
        $data['Qualifications'] = $qualification -> where($arr, [], '', 'do_not_order');
        $data['studentProfilePic'] = $studentProfilePic -> first($arr);
    
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
                $this-> view('Student/ProfileEdit',$data);
            }
            
        }else{
            $this-> view('Student/ProfileEdit',$data);
        }
    }
}