<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "../app/libs/SMTP.php";
    require "../app/libs/PHPMailer.php";
    require "../app/libs/Exception.php";

    class Signup
    {
        use Controller;

        public function index()
        {
            //$this->view('createpassword');
            $this->view('roleSelection');
        }
        public function student()
        {
            $this->view('studentSignup');
        }
        public function createpassword(){
            $data = [];
            $user = null;
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                if (isset($_POST['userId'])) {
                    //show($_POST);
                    $userId = $_POST['userId'];
                    $userNum = strlen($userId);
    
                    switch ($userNum) {
                        case 9:
                            $user = new student;
                            $id_column = 'StudentId';
    
                            $_SESSION['user'] =([
                                'StudentId' => $_POST['userId'],
                                'Name' => $_POST['fname'] . ' ' . $_POST['lname'],
                                'Email' => $_POST['email'],
                                'NIC' => $_POST['NIC'],
                                'ContactNum' => $_POST['contactNumber'],
                                'Github' => $_POST['github'],
                                'Linkedin' => $_POST['linkedin'],
                                'ShortDesc' => $_POST['shortDesc'],
                                'Skill' => $_POST['skill'],

                            ]);

                            if(strpos ($_SESSION['user']['StudentId'], 'cs') !== false ){
                                $_SESSION['user']['DegreeName'] = 'Computer Science';
                            }elseif(strpos ($_SESSION['user']['StudentId'], 'is') !== false){
                                $_SESSION['user']['DegreeName'] = 'Information System';
                            }else{
                                $data['errors'] = "Invalid User ID";
                            }
                            $profilePictureName = $_FILES['profilePicture']['name'];
                            $profilePictureTempName = $_FILES['profilePicture']['tmp_name'];

                            $profilePictureExt = strtolower(pathinfo($profilePictureName, PATHINFO_EXTENSION));
                            $profilePictureActualName = strtolower(pathinfo($profilePictureName, PATHINFO_FILENAME));
                            $profilePictureNewName = preg_replace("/[^\w-]/", "_", $profilePictureActualName) . uniqid('', true) . "." . $profilePictureExt;
                            $profilePictureDestination = __DIR__ . '/../../public/assets/img/Student/' . $profilePictureNewName;

                            if (move_uploaded_file($profilePictureTempName, $profilePictureDestination)) {
                                $_SESSION['user']['ProfilePic'] = $profilePictureNewName;
                            } else {
                                $data['errors'] = "Failed to upload profile picture.";
                            }

                            $cvName = $_FILES['cv']['name'];
                            $cvTempName = $_FILES['cv']['tmp_name'];

                            $cvExt = strtolower(pathinfo($cvName, PATHINFO_EXTENSION));
                            $cvActualName = strtolower(pathinfo($cvName, PATHINFO_FILENAME));
                            $cvNewName = preg_replace("/[^\w-]/", "_", $cvActualName) . uniqid('', true) . "." . $cvExt;
                            $cvDestination = __DIR__ . '/../../public/assets/uploads/cv/' . $cvNewName;

                            if (move_uploaded_file($cvTempName, $cvDestination)) {
                                $_SESSION['user']['cv'] = $cvNewName;
                            } else {
                                $data['errors'] = "Failed to upload profile picture.";
                            }
                            $_SESSION['user']['block'] = 1;
                            $_SESSION['user']['completed'] = 0;
                            $_SESSION['user']['noOfAppliedAds'] = 0;
                            $_SESSION['user']['registered'] = 0;
                            //show($_SESSION['user']);
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
                    if ($user && empty($data['errors'])) {
                        $_SESSION['USER_ID'] = $userId;
                        $otp = random_int(100000, 999999);
                        $email = $_SESSION['user']['Email'];
                        $Name = $_SESSION['user']['Name'];
                        if (!empty($email)) {
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
                                $mail->Body = "Dear {$Name},<br>Your OTP is: <strong>{$otp}</strong>. Please use this to verify your email.";
    
                                $mail->send();
                                $_SESSION['OTP'] = $otp;
                                $data['success'] = "OTP sent to your email. Please check your inbox.";
                            } catch (Exception $e) {
                                $data['errors'] = "Failed to send email. Error: {$mail->ErrorInfo}";
                            }
                        } else {
                            $data['errors'] = "User email not found.";
                        }
                    }
                }elseif (isset($_POST['verifyOtp'])) {
                    //show($_POST);
                    if (!empty($_POST['otp'])  && is_array($_POST['otp'])) {
                        $userId = $_SESSION['USER_ID'];
                        $userNum = strlen($userId);
    
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
    
                        $data['user'] = $_SESSION['user'];
    
                        $otp = implode('', $_POST['otp']);
                        if (!empty($otp)) {
                            if ($otp == $_SESSION['OTP']) {
                                $data['success'] = "OTP verified successfully. Proceed to create a password.";
                                $_SESSION['user']['otp'] = true;
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
                            $_SESSION['user']['Password'] = $password;
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
                            $_SESSION['user']['Password'] = password_hash($password, PASSWORD_DEFAULT);
                            //show($_SESSION);
                            // $imagedata = file_get_contents(ROOT . '/assets/img/defaultpro.png');
                            // $imageBase64 = base64_encode($imagedata);
                            // $imgresult= $user->update($id, ['profileimg' => $imageBase64], $id_column);
                            // show($imageBase64);
                            //$results = $user->update($id, ['Password' => password_hash($password, PASSWORD_DEFAULT)], $id_column);
                            
                            //show($_SESSION['user']);
                            $result = $user->insert($_SESSION['user'], $id_column);
                            //show($result);
                            // Unset and destroy the session
                            if ($result === true) {
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
            $data['user'] = $_SESSION['user'];
            //show($data);
            $this->view('createpassword', $data);
        }
    }