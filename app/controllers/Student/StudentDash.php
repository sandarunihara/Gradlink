<?php

class Studentdash{
    use BaseController;
    public function dashboard(){
        $data =[];
                
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

