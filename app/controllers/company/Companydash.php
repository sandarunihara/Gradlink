<?php

class Companydash{
    use Controller;
    public function dashboard(){
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        $this-> view('Company/Dashboard');
    }  

    public function calendar(){
        $this-> view('Components/calendar');
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

