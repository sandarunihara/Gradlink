<?php

class StudentAd{
    use BaseController;
    use Model;
    public function advertisement(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $model = new Student_AD;
        $data['AdDetails'] = $model -> getAdDetails();

        $student_advertisement = new student_advertisement;
        $data['AppliedCompanies'] = $student_advertisement ->where($arr,[], '', 'do_not_order');

        $student = new student;
        $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];
        $noOfAppliedAds = $data['Student'] -> noOfAppliedAds;
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            try {
                $advertisementId = $_GET['advertisementId'];
                $this->beginTransaction(); 

                $round = new round;
                $currentRound = $round -> getRound();
                if ($currentRound == 1 && $noOfAppliedAds >= 5){
                    throw new Exception("You have reached the limit of 5 applications in this round.");
                }

                if(array_key_exists('use_default_cv', $_POST)){ 
                    
                    $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
                    $student = new student;
                    $arr['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];

                    $data2['StudentId'] = $arr['Student'] -> StudentId;
                    $data2['AdvertisementId'] = $advertisementId;
                    $data2['JobStatus'] = "Pending";
                    $data2['CV'] = $arr['Student'] -> cv;
                    $student_advertisement = new student_advertisement;
                    $isInsert2 = $student_advertisement -> insert($data2);

                    if(!$isInsert2){
                        throw new Exception("Error inserting data into student_advertisement table");
                    }
                }else{
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
            //show($_SESSION['USER']);
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

        //show($data);
        $this-> view('Student/InternshipView', $data);
    }

    //delete this function if not errors 
    // public function applyAdvertisement(){
    //     $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

    //     $advertisementId = $_GET['advertisementId'];
    //     $advertisement = new C_Advertisement;
    //     $data['AdDetails'] = $advertisement -> find(['AdvertisementId' => $advertisementId]);
    //     $company = new company;
    //     $data['companyDetails'] = $company -> findById($data['AdDetails'][0] -> CompanyId);

    //     $student = new student;
    //     $data['Student'] = $student -> where($arr, [], '', 'do_not_order')[0];
    //     $noOfAppliedAds = $data['Student'] -> noOfAppliedAds;

    //     //show($data);
    //     if($_SERVER['REQUEST_METHOD'] == "POST"){
    //         try {
    //             $round = new round;
    //             $currentRound = $round -> getRound();
    //             if ($currentRound == 1 && $noOfAppliedAds >= 5){
    //                 $_SESSION['isLimit'] = 1;
    //                 redirect('Student/StudentAd/advertisement');
    //                 exit;
    //             }else{
    //                 $_SESSION['isLimit'] = 0;
    //             }
    //         } catch (\Throwable $th) {
    //             //throw $th;
    //         }
    //         //show($_POST);
    //         $file = $_FILES['file'];
    //         $fileName = $_FILES['file']['name'];
    //         $fileTempName = $_FILES['file']['tmp_name'];
    //         $fileSize = $_FILES['file']['size'];
    //         $fileError = $_FILES['file']['error'];
    //         $fileType = $_FILES['file']['type'];
        
    //         $fileExt = explode('.', $fileName);
    //         $fileActualName = strtolower(current($fileExt));
    //         $fileActualExt = strtolower(end($fileExt));
    //         $allowed = array('pdf');
        
    //         if(in_array($fileActualExt, $allowed)){
    //             if($fileError === 0){
    //                 if($fileSize < 1000000){
    //                     $base = preg_replace("/[^\w-]/", "_", $fileActualName);
    //                     $fileNameNew = $base .uniqid('', true). ".".$fileActualExt;
    //                     $fileDestination = __DIR__ . '/../../../public/assets/uploads/cv/'. $fileNameNew;
    //                     if(move_uploaded_file($fileTempName, $fileDestination)){
    //                         $isInsert1 = 1;
    //                         $data['StudentId'] = $_SESSION['USER'] -> StudentId;
    //                         $data['AdvertisementId'] =  $advertisementId;
    //                         $data['JobStatus'] = "Pending";
    //                         $data['CV'] = $fileNameNew;
    //                         $studentAd['Status'] = "Pending";
    //                         //show($data);
    //                         $student_advertisement = new student_advertisement;
    //                         $isInsert2 = $student_advertisement -> insert($data);

    //                         $result = $student -> update($data['StudentId'], $studentAd, 'StudentId');
    //                         if($result['status'] === 'success'){
    //                             $isInsert3 = 1;
    //                         }else{
    //                             $isInsert3 = 0;
    //                         }
    //                         $data1['noOfAppliedAds'] = $noOfAppliedAds + 1;
    //                         $isUpdate = $student -> update($arr['StudentId'], $data1, 'StudentId');
            
    //                         if ($isUpdate['status'] === "success"){
    //                             $isUpdate = 1;
    //                         }else{
    //                             $isUpdate = 0;
    //                         }
    //                     }else{
    //                         $isInsert1 = 0;
    //                     }
                        
    //                     if($isInsert1 && $isInsert2 && $isInsert3 && $isUpdate){      
    //                         $data['ActivityDescription'] = "Applied for " .$data['AdDetails'][0] -> position . " at " . $data['companyDetails'] -> Name;
    //                         //show($data);
    //                         $student_activity = new student_activity;
    //                         $isInsert4 = $student_activity -> insert($data);
    //                         if($isInsert4){
    //                             $_SESSION['isInsert'] = 1;
    //                         }
    //                     }else{                         
    //                         $_SESSION['isInsert'] = 0;
    //                     }
    //                 }else{
    //                     $_SESSION['isBig'] = 1;
    //                 }
    //             }else{
    //                 $_SESSION['isInsert'] = 0;
    //             }
    //         }else{
    //             $_SESSION['isTypeError'] = 1;
    //         }
    //         redirect('Student/StudentAd/advertisement');
    //     }

    // }
}