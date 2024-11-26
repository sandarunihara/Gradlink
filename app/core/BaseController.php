<?php 
Trait BaseController{
    use Controller;
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure the user is logged in
        if (!isset($_SESSION['USER'])) {
            redirect("login");
            exit;
        }

        // Role-based access control
        $currentRoleDetails = $_SESSION['USER'];
        if(isset($currentRoleDetails->StudentId)){
            $currentRole = "Student";
        }
        if(isset($currentRoleDetails->CompanyId)){
            $currentRole = "Company";
        }
        if(isset($currentRoleDetails->AssistantId)){
            $currentRole = "Assistant";
        }
        if(isset($currentRoleDetails->CoordinatorId)){
            $currentRole = "Coordinator";
        }
        $requestingUserArray = explode('/', trim($_SERVER['REQUEST_URI'], '/'))  ;    
        $requestingUser = $requestingUserArray[2];
        if ($currentRole !== $requestingUser) {
            redirect("login");
            exit;
        }
    }
}
