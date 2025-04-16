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
        if(isset($_SESSION['success'])){
            $data['success'] = $_SESSION['success'];
        }
        if(isset($_SESSION['errors'])){
            $data['errors'] = $_SESSION['errors'];
        }

        //show($data);
        $this-> view('Student/ProgressReport', $data);
    }
    public function addProgressReport(){
        $data = [];
        if($_SERVER['REQUEST_METHOD'] == "POST"){
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
        
            $base = preg_replace("/[^\w-]/", "_", $fileActualName);
            $fileNameNew = $base .uniqid('', true). ".".$fileActualExt;
            $fileDestination = __DIR__ . '/../../../public/assets/uploads/progress_docs/'. $fileNameNew;

            try {
                // Start transaction
                $this->beginTransaction(); 

                if(move_uploaded_file($fileTempName, $fileDestination)){
                    $data['Name'] = $fileNameNew;
                    $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                    $data['Status'] = "notReviewed";
                    $progress_doc = new progress_doc;
                    $isInsert1 = $progress_doc -> insert($data);

                    if($isInsert1){
                        $data['ActivityDescription'] = "Uploaded a Progress Report";
                        $student_activity = new student_activity;
                        $isInsert2 = $student_activity -> insert($data);
                    }

                    if($isInsert1 && $isInsert2){
                        $data['success'] = "Progress report added successfully";
                        $_SESSION['success'] = $data['success'];
                    }else{
                        throw new Exception("File upload failed.");
                    }

                }else{
                    throw new Exception("File upload failed.");
                }

                //show($data);
                // Commit transaction
                $this->commit(); 
                return true;

            } catch (Exception $e) {
                $this->rollback(); // Rollback transaction on error
                $data['errors'] = "Transaction failed: " . $e->getMessage();
                $_SESSION['errors'] = $data['errors'];
                return false;                        
            }
            show($data);
            redirect('Student/StudentProgress/progressReport');
        }
    }
}