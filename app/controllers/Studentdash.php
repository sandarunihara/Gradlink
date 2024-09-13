<?php

class Studentdash{
    use Controller;
    public function dashboard(){
        $this-> view('Student/Dashboard');
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

