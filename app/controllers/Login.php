<?php
class Login
{
	use Controller;

	public function index()
	{
		$data = [];

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$userNum = strlen($_POST['userId']);
		
			switch ($userNum) {
				case 9:
					$user = new student;
					$arr['StudentId'] = $_POST['userId'];
					$path = 'Student/StudentDash/dashboard';
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
					$path = 'PDC_coordinator/DashboardCompany';
					break;
				default:
					$user = null;
			}

			if ($user) {
				$row = $user->first($arr);
				if ($row && $row->Password === $_POST['password']) {
					// Set session for the user
					session_start();
					$_SESSION['USER'] = $row;
					$_SESSION['PATH'] = $path;

					// print_r($_POST['remember_me']);
					// Check if "Remember Me" is selected
					if (!empty($_POST['remember_me'])) {
						$cookieValue = base64_encode(json_encode([
							'userId' => $_POST['userId'],
							'password' => $_POST['password'],
						]));
						// print_r($cookieValue);
						setcookie('USER_LOGIN', $cookieValue, time() + (30 * 24 * 60 * 60), "/"); // Cookie valid for 30 days
					} else {
						print_r($_POST['remember_me']);
						// If "Remember Me" is not checked, ensure any previous cookies are cleared
						if (isset($_COOKIE['USER_LOGIN'])) {
							setcookie('USER_LOGIN', '', time() - 3600, "/"); // Expire the cookie
						}
					}

					redirect($path);
				} else {
					if (empty($data['errors'])) { // Ensure it's set only once
						$data['errors'] = "Wrong UserId or Password";
					}
				}
			} else {
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
		$data = [];
		$user = null;

		// Handle POST requests
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Check if user ID is provided
			if (isset($_POST['userId'])) {
				$userId = $_POST['userId'];
				$userNum = strlen($userId);

				// Determine user type and dashboard path based on user ID length
				switch ($userNum) {
					case 9:
						$user = new student;
						$searchKey = ['StudentId' => $userId];
						$id_column = 'StudentId';
						break;
					case 4:
						$user = new company;
						$searchKey = ['CompanyId' => $userId];
						$id_column = 'CompanyId';
						break;
					case 5:
						$user = new pdc_assistant;
						$searchKey = ['AssistantId' => $userId];
						$id_column = 'AssistantId';
						break;
					case 12:
						$user = new pdc_coordinator;
						$searchKey = ['CoordinatorId' => $userId];
						$id_column = 'CoordinatorId';
						break;
					default:
						$data['errors'] = "Invalid User ID";
						break;
				}

				// Fetch user data if valid
				if ($user && empty($data['errors'])) {
					$row = $user->first($searchKey);
					if ($row && $row->Password === null) {
						$data['rowdata'] = $row;
						$_SESSION['USER_ID'] = $userId;
						// $_SESSION['rowdata'] = $row;
					} else {
						$data['errors'] = "User already has a password";
						// redirect('login');
					}
				}
			}
			// Check if password and confirm password are provided
			elseif (isset($_POST['password'], $_POST['confirmpassword'])) {
				$password = $_POST['password'];
				$confirmpassword = $_POST['confirmpassword'];
				if ($password === $confirmpassword) {
					if (isset($_SESSION['USER_ID'])) {
						$id = $_SESSION['USER_ID'];

						$userNum = strlen($id);

						// Determine user type and dashboard path based on user ID length
						switch ($userNum) {
							case 9:
								$user = new student;
								$id_column = 'StudentId';
								break;
							case 4:
								$user = new company;
								$id_column = 'CompanyId';
								break;
							case 5:
								$user = new pdc_assistant;
								$id_column = 'AssistantId';
								break;
							case 12:
								$user = new pdc_coordinator;
								$id_column = 'CoordinatorId';
								break;
							default:
								$data['errors'] = "Invalid User ID";
								break;
						}

						// $results = $user->update($id, ['Password' => password_hash($password, PASSWORD_DEFAULT)], $id_column);
						$results = $user->update($id, ['Password' => $password], $id_column);
						
						session_unset();
						session_destroy();
						if ($results['status'] === 'success') {
							$data['success'] = "Password created successfully. Please login.";
							redirect('login');
							// $this->view('login', $data);
							exit;
						} else {
							$data['errors'] = "Failed to create password. Please try again.";
						}
						// Redirect to the login page
					} else {
						$data['errors'] = "User session data is missing. Please try again.";
					}
				} else {
					$data['errors'] = "Passwords do not match";
				}
			}
		}

		// Load the view with error or success messages
		$this->view('createpassword', $data);
	}
}

	









// $emails = 'sandarunihara56@gmail.com';

		// //  // Generate a random 6-digit OTP
		//  $otp = rand(100000, 999999);

		// //  // Store the OTP in the session for verification
		// //  session_start();
		// //  $_SESSION['otp'] = $otp;
 
		// //  // Send OTP via email
		// //  $subject = "Your OTP Code";
		// //  $message = "Your OTP code is: $otp";
		// //  $headers = "From: sandarulaptop56@gmail.com"; // Replace with your sender's email
 
		// //  if (mail($emails, $subject, $message, $headers)) {
		// // 	 echo "OTP sent to $emails. Please enter it below.";
		// //  } else {
		// // 	 echo "Failed to send OTP. Please try again.";
		// //  }