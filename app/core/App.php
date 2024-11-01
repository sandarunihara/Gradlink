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
        $filename = "../app/controllers/" . ucfirst($URL[0]) . "/" . ucfirst($URL[1]) . ".php";
        if (file_exists($filename)) {
            require $filename; // Include the controller file
            $this->controller = ucfirst($URL[1]); // Set the controller
            unset($URL[0]); // Remove the controller file from the URL array
            unset($URL[1]); // Remove the controller from the URL array
        } else {
            // Load 404 controller if the specified controller does not exist
            $filename = "../app/controllers/_404.php";
            require $filename;
            $this->controller = "_404";
        }

        /* Instantiate the controller */
        $controller = new $this->controller();
        /* Select method */
        if (!empty($URL[2])) {
            if (method_exists($controller, $URL[2])) {
                $this->method = $URL[2]; // Set the method
                // print_r($URL[2]);
                unset($URL[2]);
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

// class APP {
//     private $controller = "Home"; // Default controller
//     private $method = "index"; // Default method

//     private function splitURL() {
//         $URL = $_GET['url'] ?? 'home';
//         $URL = explode("/", trim($URL, "/"));
//         return $URL;
//     }

//     public function loadController() {
//         $URL = $this->splitURL();
//         /* Select controller */
//         $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
//         if (file_exists($filename)) {
//             require $filename; // Include the controller file
//             $this->controller = ucfirst($URL[0]); // Set the controller
//             unset($URL[0]);
//         } else {
//             // Load 404 controller if the specified controller does not exist
//             $filename = "../app/controllers/_404.php";
//             require $filename;
//             $this->controller = "_404";
//         }

//         /* Instantiate the controller */
//         $controller = new $this->controller();

//         /* Select method */
//         if (!empty($URL[1])) {
//             if (method_exists($controller, $URL[1])) {
//                 $this->method = $URL[1]; // Set the method
//                 unset($URL[1]);
//             } else {
//                 // If the method does not exist, use the 404 controller's default method
//                 $this->controller = "_404";
//                 $controller = new $this->controller(); // Reinstantiate 404 controller
//                 $this->method = "index"; // Default to index method in 404 controller
//             }
//         }

//         /* Remaining parts of the URL are parameters */
//         $params = $URL ? array_values($URL) : [];

//         /* Call the controller method with parameters */
//         call_user_func_array([$controller, $this->method], $params);
//     }
// }
