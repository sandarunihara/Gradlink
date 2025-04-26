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
        
        $studentAd = new student_advertisement;
        $data['cv'] = $studentAd -> findresumes($arr['StudentId']);
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
                    $isDelete = $skill -> delete($arr['StudentId'], 'StudentId');
                    if(!$isDelete){
                        throw new Exception("Error deleting student skills");
                    }
                }
                if(!empty($_POST['Skill'])){
                    $studentSkills = trim($_POST['Skill'], ",");
                    $studentSkillsArray = explode(",", $studentSkills);
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
    function changeProfilePicture(){
        $data = [];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        $student = new student;
        $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];
        
        if (isset($_POST['profilePicture'])) {
            $base64 = $_POST['profilePicture'];
        
            // Check if it's a valid base64 image string
            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                $imageType = strtolower($type[1]); // jpg, png, jpeg etc.
                $base64 = substr($base64, strpos($base64, ',') + 1);
                $base64 = base64_decode($base64);
        
                if ($base64 === false) {
                    $_SESSION['errors'] = "Invalid base64 image data.";
                } else {
                    if (isset($_SESSION['USER']->ProfilePic) && !empty($_SESSION['USER']->ProfilePic)) {
                        $oldPic = __DIR__ . '/../../../public/assets/img/Student/' . $_SESSION['USER']->ProfilePic;
                        if (file_exists($oldPic)) {
                            unlink($oldPic);
                        }
                    }

                    $safeName = "profile_" . uniqid('', true) . "." . $imageType;
                    $destination = __DIR__ . '/../../../public/assets/img/Student/' . $safeName;
        
                    if (file_put_contents($destination, $base64)) {
                        $profile['ProfilePic'] = $safeName;
                        $_SESSION['USER']->ProfilePic = $safeName;
                        $result1 = $student -> update($arr['StudentId'], $profile, 'StudentId');
                        if($result1['status'] !== "success"){
                            $_SESSION['errors'] = "Error updating student profile";
                        }else{
                            $_SESSION['success'] = "Profile picture updated successfully";
                        }
                    } else {
                        $_SESSION['errors'] = "Failed to save profile picture.";
                    }
                }
            } else {
                $_SESSION['errors'] = "Invalid image format.";
            }
        } else {
            $_SESSION['errors'] = "No profile picture submitted.";
        }
        redirect('Student/StudentProfile/profile');
    }
}