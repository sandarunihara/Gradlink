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
					$path = 'PDC_admin/AdminDashboardOverview/dashboard';
                    break;
                case 12:
                    $user = new pdc_coordinator;
					$arr['CoordinatorId'] = $_POST['userId'];
					$path = 'PDCCoordinator/PDCCoordinatorDash/Dashboard';
                    break;
                default:
                    $user = null;
            }

			if ($user) {
				$row = $user->first($arr);
				if ($row && $row->Password === $_POST['password']) {
					// Set session for the user
					$_SESSION['USER'] = $row;

					// print_r($_POST['remember_me']);
					// Check if "Remember Me" is selected
					if (!empty($_POST['remember_me'])) {
						$cookieValue = base64_encode(json_encode([
							'userId' => $_POST['userId'],
							'password' => $_POST['password'],
						]));
						// print_r($cookieValue);
						setcookie('USER_LOGIN', $cookieValue, time() + (30*24*60*60), "/"); // Cookie valid for 30 days
					}else {
						print_r($_POST['remember_me']);
						// If "Remember Me" is not checked, ensure any previous cookies are cleared
						if (isset($_COOKIE['USER_LOGIN'])) {
							setcookie('USER_LOGIN', '', time() - 3600, "/"); // Expire the cookie
						}
					}

					redirect($path);
				}else {
					if (empty($data['errors'])) { // Ensure it's set only once
						$data['errors'] = "Wrong UserId or Password";
					}
				}
			}else {
				if (empty($data['errors'])) { // Ensure it's set only once
					$data['errors'] = "Wrong UserId or Password";
				}
			}

			// // $user->errors['UserId'] = "Wrong UserId or passwords";
			// $data['errors'] = "Wrong UserId or passwords";
		} else {
			// Check if the "USER_LOGIN" cookie is set
			if (isset($_COOKIE['USER_LOGIN'])) {
				$cookieData = json_decode(base64_decode($_COOKIE['USER_LOGIN']), true);
				if ($cookieData) {
					$_POST['userId'] = $cookieData['userId'];
					$_POST['password'] = $cookieData['password'];
				}
			}
		}
		$this->view('login', $data);
	}

	public function createpassword()
	{
		$emails = 'sandarunihara56@gmail.com';

		//  // Generate a random 6-digit OTP
		 $otp = rand(100000, 999999);

		//  // Store the OTP in the session for verification
		//  session_start();
		//  $_SESSION['otp'] = $otp;
 
		//  // Send OTP via email
		//  $subject = "Your OTP Code";
		//  $message = "Your OTP code is: $otp";
		//  $headers = "From: sandarulaptop56@gmail.com"; // Replace with your sender's email
 
		//  if (mail($emails, $subject, $message, $headers)) {
		// 	 echo "OTP sent to $emails. Please enter it below.";
		//  } else {
		// 	 echo "Failed to send OTP. Please try again.";
		//  }

		$this->view('createpassword');
	}
}
