<?php

class StudentProfile{
    use BaseController;
    use Model;
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
            try {
                $this->beginTransaction();

                $result1 = $student -> update($arr['StudentId'], $_POST, 'StudentId');
                
                if($result1['status'] !== "success"){
                    throw new Exception("Error updating student profile");
                }

                $skill = new student_skill;
                $data['Skills'] = $skill -> where($arr, [], '', 'do_not_order');

                if(!empty($data['Skills'])){
                    $studentSkills = trim($_POST['Skill'], ",");
                    $studentSkillsArray = explode(",", $studentSkills);

                    $isDelete = $skill -> delete($arr['StudentId'], 'StudentId');

                    if(!$isDelete){
                        throw new Exception("Error deleting student skills");
                    }
                }
                if(!empty($_POST['Skill'])){
                    $isInsert2 = $skill -> insertSkill($data['StudentId'] ,$studentSkillsArray);
                    if(!$isInsert2){
                        throw new Exception("Error inserting student skills");
                    }
                }
                
                $data['ActivityDescription'] = "Updated your Profile";
                $student_activity = new student_activity;
                $isInsert3 = $student_activity -> insert($data);

                if(!$isInsert3){
                    throw new Exception("Error inserting data into student_activity table");
                }
                $_SESSION['success'] = "Profile updated successfully";
                $this->commit();
                redirect('Student/StudentProfile/profile');
                return true;
            } catch (Exception $e) {
                $this->rollback(); // Rollback transaction on error
                $_SESSION['errors'] = "Transaction failed: " . $e->getMessage();
                
                redirect('Student/StudentProfile/profile');
                return false;            
            }
        }else{
            //show($data);
            $this-> view('Student/ProfileEdit',$data);
        }
    }
}