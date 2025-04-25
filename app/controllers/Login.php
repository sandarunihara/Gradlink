<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";
require_once "../app/libs/update_round_status.php";


class Login
{
	use Controller;

	public function index()
	{
		$data = [];

		//show($_POST);

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$userNum = strlen($_POST['userId']);
			// show($_POST['userId']);
			if(filter_var(($_POST['userId']), FILTER_VALIDATE_EMAIL)){
				$user = new company;
					$arr['Email'] = $_POST['userId'];
					$path = 'company/Companydash/Dashboard';
			}else{
				switch ($userNum) {
					case 9:
						$user = new student;
						$arr['StudentId'] = $_POST['userId'];
						$path = 'Student/StudentDash/dashboard';
						break;
					// case filter_var(($_POST['userId']), FILTER_VALIDATE_EMAIL):
					// 	$user = new company;
					// 	$arr['Email'] = $_POST['userId'];
					// 	$path = 'company/Companydash/Dashboard';
					// 	break;
					case 5:
						$user = new pdc_assistant;
						$arr['AssistantId'] = $_POST['userId'];
						$path = 'PDC_admin/AdminDashboardOverview/dashboard';
						break;
					case 12:
						$user = new pdc_coordinator;
						$arr['CoordinatorId'] = $_POST['userId'];
						$path = 'PDC_coordinator/Dashboard';
						break;
					default:
						$user = null;
				}
			}
			if ($user) {
				$row = $user->first($arr);
				if($row ->block){
					$data['errors'] = "Your account is blocked. Please contact the administrator.";
					$this->view('login', $data);
					return;
				}
				$roundData = new round;
				$round = $roundData->getActiveRound();
				//time zone
				date_default_timezone_set('Asia/Colombo');
				$currentDateTime = date('Y-m-d H:i:s');

				if ($row && password_verify($_POST['password'], $row->Password)) {
					RoundStatusUpdater::update();

					// Set session for the user
					session_start();
					$_SESSION['USER'] = $row;
					$_SESSION['PATH'] = $path;
					$_SESSION['ROUNDID'] = $round->roundId;
					$_SESSION['logintime'] = $currentDateTime;

					if (!empty($_POST['remember_me'])) {
						$cookieValue = base64_encode(json_encode([
							'userId' => $_POST['userId'],
							'password' => $_POST['password'],
						]));
						// print_r($cookieValue);
						setcookie('USER_LOGIN', $cookieValue, time() + (20 * 60), "/"); // Cookie valid for 30 days
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

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['userId'])) {
				$userId = $_POST['userId'];
				$userNum = strlen($userId);

				if(filter_var(($_POST['userId']), FILTER_VALIDATE_EMAIL)){
					$user = new company;
						$searchKey = ['Email' => $_POST['userId']];
						// show($searchKey);
						$id_column = 'CompanyId';
				}else{
					switch ($userNum) {
						case 9:
							$user = new student;
							$searchKey = ['StudentId' => $userId];
							$id_column = 'StudentId';
							break;
						// case 4:
						// 	$user = new company;
						// 	$searchKey = ['CompanyId' => $userId];
						// 	$id_column = 'CompanyId';
						// 	break;
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

				}



				if ($user && empty($data['errors'])) {
					$row = $user->first($searchKey);
					if ($row) {
						$data['rowdata'] = $row;
						// show($row);
						$_SESSION['USER_ID'] = $row->CompanyId;

						$otp = random_int(100000, 999999);

						if (!empty($row->Email)) {
							$email = $row->Email;
							try {
								$mail = new PHPMailer(true);
								$mail->isSMTP();
								$mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
								$mail->SMTPAuth = true;
								$mail->Username = 'sandarunihara15@gmail.com'; // Your email
								$mail->Password = 'gwko wgdm ffqx fzcm'; // Your app password
								$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
								$mail->Port = 587;
								$mail->setFrom('sandarunihara15@gmail.com', 'UCSC Gradlink');
								$mail->addAddress($email);
								$mail->isHTML(true);
								$mail->Subject = 'Your OTP for Password Creation';
								$mail->Body = "Dear {$row->Name},<br>Your OTP is: <strong>{$otp}</strong>. Please use this to verify your email.";

								$mail->send();
								$_SESSION['OTP'] = $otp;
								$data['success'] = "OTP sent to your email. Please check your inbox.";
							} catch (Exception $e) {
								$data['errors'] = "Failed to send email. Error: {$mail->ErrorInfo}";
							}
						} else {
							$data['errors'] = "User email not found.";
						}
					} else {
						$data['errors'] = "Invalid User ID or Email";
						// redirect('login');
					}
				}
			} elseif (isset($_POST['verifyOtp'])) {
				if (!empty($_POST['otp'])  && is_array($_POST['otp'])) {
					$userId = $_SESSION['USER_ID'];
					$userNum = strlen($userId);

					
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

					


					if ($user && empty($data['errors'])) {
						$row = $user->first($searchKey);
					}

					$data['rowdata'] = $row;

					$otp = implode('', $_POST['otp']);
					if (!empty($otp)) {
						if ($otp == $_SESSION['OTP']) {
							$data['success'] = "OTP verified successfully. Proceed to create a password.";
							$data['rowdata']->otp = true;
						} else {
							$data['errors'] = "Invalid OTP. Please try again.";
						}
					} else {
						$data['errors'] = "OTP is required.";
					}
				} else {
					$data['errors'] = "OTP is required.";
				}
			} elseif (isset($_POST['password'], $_POST['confirmpassword'])) {
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



						// $imagedata = file_get_contents(ROOT . '/assets/img/defaultpro.png');
						// $imageBase64 = base64_encode($imagedata);
						// $imgresult= $user->update($id, ['profileimg' => $imageBase64], $id_column);
						// show($imageBase64);
						$results = $user->update($id, ['Password' => password_hash($password, PASSWORD_DEFAULT)], $id_column);

						// Unset and destroy the session
						if ($results['status'] === 'success') {
							session_unset();
							session_destroy();
							$data['success'] = "Password created successfully. Please login.";
							$user->update($id, ['Status' => 'Ongoing'], $id_column);
							redirect('login');
							exit;
						} else {
							$data['errors'] = "Failed to create password. Please try again.";
						}
					} else {
						$data['errors'] = "User session data is missing. Please try again.";
					}
				} else {
					$data['errors'] = "Passwords do not match";
				}
			}
		}

		// Load the view with error or success messages
		$this->view('createnewpassword', $data);
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