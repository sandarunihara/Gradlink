<?php

class StudentProgress{
    use BaseController;
    public function progressReport(){
        $data = [];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        $progress_doc = new progress_doc;
        $data['ProgressDocs'] = $progress_doc -> where($arr,[], '', 'do_not_order');
        if(isset($_GET['isInsert'])){
            $data['isInsert'] = $_GET['isInsert'];
        }

        //show($data);
        $this-> view('Student/ProgressReport', $data);
    }
    public function addProgressReport(){
        if(isset($_POST['submit'])){
            $file = $_FILES['file'];
            //show($file);
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
                        $fileDestination = __DIR__ . '/../../../public/assets/uploads/progress_docs/'. $fileNameNew;

                        if(move_uploaded_file($fileTempName, $fileDestination)){
                            $isInsert1 = 1;
                            $data['Name'] = $fileNameNew;
                            $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                            $data['Status'] = "notReviewed";
                            $progress_doc = new progress_doc;
                            $isInsert2 = $progress_doc -> insert($data);
                        }else{
                            $isInsert1 = 0;
                        }
                        
                        //show($data);
                        $data['ActivityDescription'] = "Uploaded a Progress Report";
                        $student_activity = new student_activity;
                        $isInsert3 = $student_activity -> insert($data);
                        
                        if($isInsert1 && $isInsert2 && $isInsert3){
                            $_SESSION['isInsert'] = 1;
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
            header('location: ' . ROOT . '/Student/StudentProgress/progressReport/'); 
        }
    }

}