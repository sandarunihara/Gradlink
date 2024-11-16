
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
                    $user = new student;
					$arr['StudentId'] = $_POST['userId'];
					$path = 'Student/StudentDash/Dashboard';
                    break;
                case 4:
                    $user = new company;
					$arr['CompanyId'] = $_POST['userId'];
					$path = 'company/Companydash/Dashboard';
                    break;
                case 5:
                    $user = new pdc_assistant;
					$arr['AssistantId'] = $_POST['userId'];
					$path = 'PDC_admin/AdminDashboardOverview/Dashboard';
                    break;
                case 12:
                    $user = new pdc_coordinator;
					$arr['CoordinatorId'] = $_POST['userId'];
					$path = 'PDCCoordinator/PDCCoordinatorDash/Dashboard';
                    break;
                default:
                    
            }



			$row = $user->first($arr);
			{
				if($row->Password === $_POST['password'])
				{
					$_SESSION['USER'] = $row;
					// set a cookie for remembering the user
					// setcookie('loginId', $row->loginId, time() + 3600, "/");
					redirect($path);
				}
			}

			$user->errors['UserId'] = "Wrong UserId or password";

			$data['errors'] = $user->errors;
		}

		$this->view('login',$data);
	}

}
