<?php

class Studentdash{
    use Controller;
    public function dashboard(){
        $data =[];
        $arr['UserId'] = $_SESSION['USER'] -> UserId;
        //show($_SESSION['USER']);

        $student = new Student;
        $email = new StudentEmail;
        

        $data['Student'] = $student -> first($arr);
        //show($data['Student']);
        $data['Email'] = $email -> first($arr);

        
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

