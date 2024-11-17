<?php

class Studentdash{
    use Controller;
    public function dashboard(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        //show($_SESSION['USER']);

        $student = new student;
        $data['Student'] = $student -> first($arr);

        $interview_time_slot = new interview_time_slot;
        $interviews = $interview_time_slot -> where($arr, [], '', 'do_not_order');
        $data['numOfInterviews'] = count($interviews);

        $student_advertisement = new student_advertisement;
        $arr['JobStatus'] = 'Applied';
        $companies = $student_advertisement -> where($arr, [], '', 'do_not_order');
        $data['numOfCompanies'] = count($companies);
        
        $this-> view('Student/Dashboard',$data);
    }  


    public function renderoption($componentName, $componentProps = []){
        $fileName = "../app/views/Student/" . $componentName . ".view.php";
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            echo "Component not found";
        }
    }
 
}

