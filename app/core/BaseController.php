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
        //show($_SESSION['user']);
        $currentRole = $_SESSION['user'];
        $requestingUserArray = explode('/', trim($_SERVER['REQUEST_URI'], '/'))  ;    
        $requestingUser = strtolower($requestingUserArray[2]);
        //show($requestingUser);
        if ($currentRole !== $requestingUser) {
            $data ['errorsInBase'] = "You do not have permission to access this page";
            redirect("login", $data);
            exit;
        }
    }
}
