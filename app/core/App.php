<?php

class APP {
    private $controller = "Home"; // Default controller
    private $method = "index"; // Default method

    private function splitURL() {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, "/"));
        return $URL;
    }

    public function loadController() {
        $URL = $this->splitURL();
        /* Select controller */
        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require $filename; // Include the controller file
            $this->controller = ucfirst($URL[0]); // Set the controller
            unset($URL[0]);
        } else {
            // Load 404 controller if the specified controller does not exist
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        /* Instantiate the controller */
        $controller = new $this->controller();

        /* Select method */
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1]; // Set the method
                unset($URL[1]);
            } else {
                // If the method does not exist, use the 404 controller's default method
                $this->controller = "_404";
                $controller = new $this->controller(); // Reinstantiate 404 controller
                $this->method = "index"; // Default to index method in 404 controller
            }
        }

        /* Remaining parts of the URL are parameters */
        $params = $URL ? array_values($URL) : [];

        /* Call the controller method with parameters */
        call_user_func_array([$controller, $this->method], $params);
    }
}



// <?php
//     class APP{
//         private $controller = "Home";
//         private $method = "index";

//         private function splitURL(){
//             $URL =$_GET['url'] ?? 'home';
//             $URl = explode("/", trim($URL, "/"));
//             //show($URl);
//             return $URl;
//         }
//         public function loadController(){
//             $URL = $this->splitURL();

//             /*select controller*/
//             $filename ="../app/controllers/".ucfirst($URL[0]).".php";
//             if(file_exists($filename)){
//                 require $filename;
//                 $this->controller = ucfirst($URL[0]);
//                 unset($URL[0]);
//             }else{
//                 $filename ="../app/controller/_404.php";
//                 require $filename;
//                 $this->controller = "_404";
//             }
//             /*select method*/
//             if(!empty($URL[1])){
//                 if(method_exists($this->controller, $URL[1])){
//                     $this->method = $URL[1];
//                     unset($URL[1]);
//                 }
//             }
//             $controller = new $this->controller;
//             //show($URL);
//             call_user_func_array([$controller, $this->method], $URL);
//         }
//     }