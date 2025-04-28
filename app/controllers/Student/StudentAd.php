<?php

class StudentAd{
    use BaseController;
    use Model;
    public function advertisement(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $round = new Round;
        $currentRoundDetails = $round -> getActiveRound();
        $model = new Student_AD;
        $data['AdDetails'] = $model -> getAdDetails();

        $student_advertisement = new student_advertisement;
        $data['AppliedCompanies'] = $student_advertisement ->where($arr,[], '', 'do_not_order');

        if(isset($data['AppliedCompanies']) && !empty($data['AppliedCompanies'])){
            $data['cv'] = $student_advertisement -> findresumes($_SESSION['USER'] -> StudentId);
        }
        $student = new student;
        $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];
        $noOfAppliedAds = $data['Student'] -> noOfAppliedAds;
    
        if(!empty($data['AdDetails'])){
            $i = 0;
            foreach ($data['AdDetails'] as $adDetail) {
                $data['differentRoles'][$i] = $adDetail-> position;
                $i++;
            }
            $data['differentRoles'] = array_unique($data['differentRoles']);
            sort($data['differentRoles']);
        }
        if ($currentRoundDetails -> roundId != 1 && $currentRoundDetails -> roundId != 2){
            $data['AdDetails'] = 0;
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            try {
                //show($_POST);
                $advertisementId = $_GET['advertisementId'];
                $position = $_GET['position'];

                $this->beginTransaction(); 

                $round = new Round;
                $currentRoundDetails = $round -> getActiveRound();
                if ($currentRoundDetails -> roundId == 1 && $noOfAppliedAds >= $currentRoundDetails->vacancy){
                    throw new Exception("You have reached the limit of applications in this round.");
                }
                $student_advertisement = new student_advertisement;
                $advertisement = new C_Advertisement;

                $slectedRoleDetails = $student_advertisement ->where($arr, [], 'CreatedAt', 'asc');
                if(!empty($slectedRoleDetails)){
                    $new['AdvertisementId'] = $slectedRoleDetails[0] -> AdvertisementId;
                    $selectedPosition = $advertisement -> where($new, [], '', 'do_not_order')[0] -> position;
                    $selectedPosition = strtolower(str_replace(' ', '', $selectedPosition));
                    if($currentRoundDetails -> roundId == 1 && $selectedPosition != $position && $slectedRoleDetails[0] -> Jobstatus != 'Recruit'){
                        throw new Exception("You have already applied for a different position in this round.");
                    }
                }
                if(!($currentRoundDetails -> roundId == 1 || $currentRoundDetails -> roundId == 2)){
                    throw new Exception("The application process is currently unavailable. Please wait for the round to begin.");
                }
                foreach($slectedRoleDetails as $slectedRoleDetail){
                    if($slectedRoleDetail->Jobstatus == 'Recruit'){
                        $new['AdvertisementId'] = $slectedRoleDetail->AdvertisementId;
                        $selectedJob = $advertisement->where($new, [], '', 'do_not_order')[0]->position;
                        throw new Exception("You have already been recruited for the position of " . $selectedJob . ". You cannot apply for another position.");
                    }
                }

                if(array_key_exists('cvId', $_POST)){ 
                    
                    $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
                    $student = new student;
                    $arr['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];

                    $data2['StudentId'] = $arr['Student'] -> StudentId;
                    $data2['AdvertisementId'] = $advertisementId;
                    $data2['JobStatus'] = "Pending";
                    $data2['CV'] = $_POST['cvId'];
                    $student_advertisement = new student_advertisement;
                    $isInsert2 = $student_advertisement -> insert($data2);

                    if(!$isInsert2){
                        throw new Exception("Error inserting data into student_advertisement table");
                    }
                }else{
                    //show($_FILES);
                    $file = $_FILES['file'];
                    $fileName = $_FILES['file']['name'];
                    $fileTempName = $_FILES['file']['tmp_name'];
                    $fileSize = $_FILES['file']['size'];
                    $fileError = $_FILES['file']['error'];
                    $fileType = $_FILES['file']['type'];
                    $fileExt = explode('.', $fileName);
                    $fileActualName = strtolower(current($fileExt));
                    $fileActualExt = strtolower(end($fileExt));
                
                    $base = preg_replace("/[^\w-]/", "_", $fileActualName);
                    $fileNameNew = $base .uniqid('', true). ".".$fileActualExt;
                    $fileDestination = __DIR__ . '/../../../public/assets/uploads/cv/'. $fileNameNew;
                    
                    if(move_uploaded_file($fileTempName, $fileDestination)){
                        $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                        $data['AdvertisementId'] = $advertisementId;
                        $data['JobStatus'] = "Pending";
                        $data['CV'] = $fileNameNew;
                        $student_advertisement = new student_advertisement;
                        $isInsert2 = $student_advertisement -> insert($data);
        
                        if(!$isInsert2){
                            throw new Exception("Error inserting data into student_advertisement table");
                        }
                    }else{
                        throw new Exception("File upload failed.");
                    }
    
                }
                
                $data1['noOfAppliedAds'] = $noOfAppliedAds + 1;
                $isUpdate = $student -> update($arr['StudentId'], $data1, 'StudentId');

                if ($isUpdate['status'] !== "success"){
                    throw new Exception("Error updating noOfAppliedAds in student table");
                }

                foreach($data['AdDetails'] as $ad){
                    if($ad -> advertisementId == $advertisementId){
                        $position = $ad -> position;
                        $Name = $ad -> Name;
                        break;
                    }
                }
                $data['ActivityDescription'] = "Applied for " .$position . " at " . $Name;
                $student_activity = new student_activity;
                $isInsert3 = $student_activity -> insert($data);
                if(!$isInsert3){
                    throw new Exception("Error inserting data into student_activity table");
                }
                
                $action['actor_id'] = $_SESSION['USER'] -> StudentId;
                $action['actor_role'] = 'Student';
                $action['target_id'] = $advertisementId;
                $action['target_type'] = 'Advertisement';
                $action['action_type'] = 'Applied';

                $actionLog = new Action_logs;
                $isInsert3 = $actionLog ->insert($action);

                if(!$isInsert3){
                    throw new Exception("Error inserting data into action_logs table");
                }
                $_SESSION['success'] = "Application submitted successfully";
                // Commit transaction
                $this->commit(); 

                //show($data);
                redirect('Student/StudentAd/advertisement');
                return true;
            } catch (Exception $e) {
                $this->rollback(); // Rollback transaction on error
                $_SESSION['errors'] = "Transaction failed: " . $e->getMessage();

                redirect('Student/StudentAd/advertisement');
                return false;  
            }
        }else{
            //show($data);
            $this-> view('Student/Internship', $data);        
        }
    }
    public function viewAdvertisement(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $advertisementId = $_GET['advertisementId'];
        $model = new C_Advertisement;
        //show($advertisementId);
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $advertisementId]);
        $student_advertisement = new student_advertisement;
        $data['AppliedCompanies'] = $student_advertisement ->where($arr,[], '', 'do_not_order');
        if(isset($data['AppliedCompanies']) && !empty($data['AppliedCompanies'])){
            $data['cv'] = $student_advertisement -> findresumes($_SESSION['USER'] -> StudentId);
        }
        //show($data);
        $this-> view('Student/InternshipView', $data);
    }
}