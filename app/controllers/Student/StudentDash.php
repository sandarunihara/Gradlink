<?php

class Studentdash{
    use Controller;
    public function dashboard(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        //show($_SESSION['USER']);

        $student = new student;
        //$email = new studentEmail;
        

        $data['Student'] = $student -> first($arr);
        //$data['Email'] = $email -> first($arr);

        
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

