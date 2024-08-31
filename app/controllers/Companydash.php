<?php

class Companydash{
    use Controller;
    public function dashboard(){
        $this-> view('Company/companydashboard');
    }  


    public function renderoption($componentName, $componentProps = []){
        $fileName = "../app/views/Company/" . $componentName . ".view.php";
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            echo "Component not found";
        }
    }
 
}

