<?php 
class Login
{
	use Controller;

	public function index()
	{
		$data = [];
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            $userNum = strlen($_POST['userId']);
            
            switch($userNum){
                case 9:
                    $user = new Student;
					$path = 'Student/StudentDash/Dashboard';
                    break;
                case 4:
                    $user = new Company;
					$path = 'Company/CompanyDash/Dashboard';
                    break;
                case 5:
                    $user = new PDCAssistant;
					$path = 'PDCAssistant/PDCAssistantDash/Dashboard';
                    break;
                case 12:
                    $user = new PDCCoordinator;
					$path = 'PDCCoordinator/PDCCoordinatorDash/Dashboard';
                    break;
                default:
                    
            }


			$arr['UserId'] = $_POST['userId'];

			$row = $user->first($arr);
			
			if($row)
			{
				if($row->PASSWORD === $_POST['password'])
				{
					$_SESSION['USER'] = $row;
					redirect($path);
				}
			}

			$user->errors['UserId'] = "Wrong UserId or password";

			$data['errors'] = $user->errors;
		}

		$this->view('login',$data);
	}

}
