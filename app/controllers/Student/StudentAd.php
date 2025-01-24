<?php

class StudentAd{
    use BaseController;
    public function advertisement(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $model = new Student_AD;
        $data['AdDetails'] = $model -> getAdDetails();

        $student_advertisement = new student_advertisement;
        $data['AppliedCompanies'] = $student_advertisement ->where($arr,[], '', 'do_not_order');
        //show($data);

        if(isset($_POST['submit'])){
            $advertisementId = $_GET['advertisementId'];

            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileTempName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
        
            $fileExt = explode('.', $fileName);
            $fileActualName = strtolower(current($fileExt));
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('pdf');
        
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $base = preg_replace("/[^\w-]/", "_", $fileActualName);
                        $fileNameNew = $base .uniqid('', true). ".".$fileActualExt;
                        $fileDestination = __DIR__ . '/../../../public/assets/uploads/cv/'. $fileNameNew;
                        if(move_uploaded_file($fileTempName, $fileDestination)){
                            $isInsert1 = 1;
                            $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                            $data['AdvertisementId'] = $advertisementId;
                            $data['JobStatus'] = "Pending";
                            $data['CV'] = $fileNameNew;
                            $student_advertisement = new student_advertisement;
                            $isInsert2 = $student_advertisement -> insert($data);
                        }else{
                            $isInsert1 = 0;
                        }
                        if($isInsert1 && $isInsert2){
                            foreach($data['AdDetails'] as $ad){
                                if($ad -> advertisementId == $advertisementId){
                                    $position = $ad -> position;
                                    $Name = $ad -> Name;
                                    break;
                                }
                            }
                            $data['ActivityDescription'] = "Applied for " .$position . " at " . $Name;
                            $student_activity = new student_activity;
                            $isInsert4 = $student_activity -> insert($data);
                            if($isInsert4){
                                $_SESSION['isInsert'] = 1;
                            }
                        }else{                         
                            $_SESSION['isInsert'] = 0;
                        }
                    }else{
                        $_SESSION['isBig'] = 1;
                    }
                }else{
                    $_SESSION['isInsert'] = 0;
                }
            }else{
                $_SESSION['isTypeError'] = 1;
            }
            //show($data);
            header('location: ' . ROOT . '/Student/StudentAd/advertisement/'); 
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
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $advertisementId]);
        $student_advertisement = new student_advertisement;
        $data['AppliedCompanies'] = $student_advertisement ->where($arr,[], '', 'do_not_order');

        //show($data);
        $this-> view('Student/InternshipView', $data);
    }
    public function applyAdvertisement(){
        $advertisementId = $_GET['advertisementId'];
        $advertisement = new C_Advertisement;
        $data['AdDetails'] = $advertisement -> find(['AdvertisementId' => $advertisementId]);
        $company = new company;
        $data['companyDetails'] = $company -> findById($data['AdDetails'][0] -> CompanyId);
        //show($data);
        if(isset($_POST['submit'])){
            //show($_POST);
            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileTempName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
        
            $fileExt = explode('.', $fileName);
            $fileActualName = strtolower(current($fileExt));
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('pdf');
        
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 1000000){
                        $base = preg_replace("/[^\w-]/", "_", $fileActualName);
                        $fileNameNew = $base .uniqid('', true). ".".$fileActualExt;
                        $fileDestination = __DIR__ . '/../../../public/assets/uploads/cv/'. $fileNameNew;
                        if(move_uploaded_file($fileTempName, $fileDestination)){
                            $isInsert1 = 1;
                            $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                            $data['AdvertisementId'] =  $advertisementId;
                            $data['JobStatus'] = "Pending";
                            $data['CV'] = $fileNameNew;
                            $studentAd['Status'] = "Pending";
                            //show($data);
                            $student_advertisement = new student_advertisement;
                            $isInsert2 = $student_advertisement -> insert($data);
                            $student = new student;
                            $result = $student -> update($data['StudentId'], $studentAd, 'StudentId');
                            //show($result);
                            if($result['status'] === 'success'){
                                $isInsert3 = 1;
                            }else{
                                $isInsert3 = 0;
                            }
                        }else{
                            $isInsert1 = 0;
                        }
                        
                        if($isInsert1 && $isInsert2 && $isInsert3){      
                            $data['ActivityDescription'] = "Applied for " .$data['AdDetails'][0] -> position . " at " . $data['companyDetails'] -> Name;
                            //show($data);
                            $student_activity = new student_activity;
                            $isInsert4 = $student_activity -> insert($data);
                            if($isInsert4){
                                $_SESSION['isInsert'] = 1;
                            }
                        }else{                         
                            $_SESSION['isInsert'] = 0;
                        }
                    }else{
                        $_SESSION['isBig'] = 1;
                    }
                }else{
                    $_SESSION['isInsert'] = 0;
                }
            }else{
                $_SESSION['isTypeError'] = 1;
            }
            header('location: ' . ROOT . '/Student/StudentAd/advertisement/'); 
        }

    }
}