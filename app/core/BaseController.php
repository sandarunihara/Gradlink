<?php 
Trait BaseController{
    use Controller;
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Ensure the user is logged in
        if (!isset($_SESSION['USER'])) {
            $data ['errorsInBase'] = "You must be logged in to access this page";
            redirect("login", $data);
            exit;
        }
        // Role-based access control
        $path =$_SESSION['PATH'];
        $currentRole = strtolower(explode('/', $path)[0]);
        //show($currentRole);
        $controller = strtolower(explode('/', $_SERVER['REQUEST_URI'])[3]);
        //show($controller);
        if ($controller !== $currentRole) {
            redirect("login");
            exit;
        }
        
    }
}
