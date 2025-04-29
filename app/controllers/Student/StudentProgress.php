<?php

class StudentProgress{
    use BaseController;
    use Model;
    public function progressReport(){
        $data = [];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        $progress_doc = new progress_doc;
        $data['ProgressDocs'] = $progress_doc -> where($arr,[], '', 'do_not_order');

        $student_advertisement = new student_advertisement;
        $slectedRoleDetails = $student_advertisement->where($arr, [], 'CreatedAt', 'asc');
        
        $advertisement = new C_Advertisement;
        foreach($slectedRoleDetails as $slectedRoleDetail){
            if($slectedRoleDetail->Jobstatus == 'Recruit'){
                $advertisementId['AdvertisementId'] = $slectedRoleDetail->AdvertisementId;
                $selectedJob = $advertisement->where($advertisementId, [], '', 'do_not_order')[0]->position;
                $data['recruit'] = 1;
            }
        }
        if(isset($_SESSION['success'])){
            $data['success'] = $_SESSION['success'];
        }
        if(isset($_SESSION['errors'])){
            $data['errors'] = $_SESSION['errors'];
        }

        $this-> view('Student/ProgressReport', $data);
    }
    public function addProgressReport(){
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            try {
                $this->beginTransaction(); 

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
                $fileDestination = __DIR__ . '/../../../public/assets/uploads/progress_docs/'. $fileNameNew;

                if(move_uploaded_file($fileTempName, $fileDestination)){
                    $data['Name'] = $fileNameNew;
                    $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                    $data['Status'] = "notReviewed";
                    $progress_doc = new progress_doc;
                    $isInsert1 = $progress_doc -> insert($data);

                    if(!$isInsert1){
                        throw new Exception("Error inserting data into progress_doc table");
                    }
                    $data['ActivityDescription'] = "Uploaded a Progress Report";
                    $student_activity = new student_activity;
                    $isInsert2 = $student_activity -> insert($data);

                    if(!$isInsert2){
                        throw new Exception("Error inserting data into student_activity table");
                    }
                    
                }else{
                    throw new Exception("File upload failed.");
                }

                $_SESSION['success'] = "Progress report added successfully";

                redirect('Student/StudentProgress/progressReport');
                
                $this->commit(); 
                return true;

            } catch (Exception $e) {
                $this->rollback(); 
                $_SESSION['errors'] = "Transaction failed: " . $e->getMessage();
                redirect('Student/StudentProgress/progressReport');
                return false;                        
            }
        }
    }
}