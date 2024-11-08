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
                    break;
                case 4:
                    $user = new Company;
                    break;
                case 5:
                    $user = new PDCAssistant;
                    break;
                case 12:
                    $user = new PDCCoordinator;
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
					redirect('home');
				}
			}

			$user->errors['UserId'] = "Wrong UserId or password";

			$data['errors'] = $user->errors;
		}

		$this->view('login',$data);
	}

}
