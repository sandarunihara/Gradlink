
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
                    $user = new student_password;
					$arr['StudentId'] = $_POST['userId'];
					$path = 'Student/StudentDash/Dashboard';
                    break;
                case 4:
                    $user = new company_password;
					$arr['CompanyId'] = $_POST['userId'];
					$path = 'Company/CompanyDash/Dashboard';
                    break;
                case 5:
                    $user = new pdc_assistant_password;
					$arr['AssistantId'] = $_POST['userId'];
					$path = 'PDCAssistant/PDCAssistantDash/Dashboard';
                    break;
                case 12:
                    $user = new pdc_coordinator_password;
					$arr['CoordinatorId'] = $_POST['userId'];
					$path = 'PDCCoordinator/PDCCoordinatorDash/Dashboard';
                    break;
                default:
                    
            }



			$row = $user->first($arr);
			
			if($row)
			{
				if($row->Password === $_POST['password'])
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
