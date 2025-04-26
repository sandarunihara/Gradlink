<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../app/libs/SMTP.php";
require "../app/libs/PHPMailer.php";
require "../app/libs/Exception.php";

class Signup
{
    use Controller;
    use Model;
    public function index()
    {
        //$this->view('createpassword');
        $this->view('roleSelection');
    }
    public function student()
    {   
        $this->view('studentSignup');
    }
    public function fetchStudentDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arr['StudentId'] = $_POST['studentId'];
            $_SESSION['student'] = $arr['StudentId'];
            
            $student_import = new studentimport;
            $studentNew = $student_import->where($arr, [], '', 'do_not_order')[0];
            
            $student = new student;
            $student = $student->checkStudentId($arr['StudentId']);

            header('Content-Type: application/json');
            if (!empty($studentNew)) {
                if($student){
                    echo json_encode(['success' => false, 'message' => 'Student already registered', 'registered' => 1]);
                    exit;
                }
                echo json_encode(['success' => true, 'student' => $studentNew, 'registered' => 0]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Student not found', 'registered' => 0]);
            }
            exit;
        }
    }

    public function getCompanynextId()
    {
        $Model = new company;
        $companyId = $Model->gethighestadid();
        if (!empty($companyId)) {
            // Extract the numeric part of the current highest companytId
            $numericPart = intval(substr($companyId, 1)); // Remove the prefix (e.g., 'c')
            $nextId = $numericPart + 1;

            // Determine the number of digits required for the new ID
            $paddingLength = max(3, strlen((string)$nextId));

            // Format the new companyId (e.g., 'c001', 'c1000', etc.)
            return 'C' . str_pad($nextId, $paddingLength, '0', STR_PAD_LEFT);
        } else {
            // Start from 'a001' if there are no existing entries
            return 'C001';
        }
    }

    public function company()
    {
        $Model = new company;
        $all_company_data=$Model->findAll([],[],'');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $admin_notification = new Admin_notification;

            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
                $ProfilepicName = $_FILES['profile_pic']['name'];
                $ProfilepicTempName = $_FILES['profile_pic']['tmp_name'];

                $baseName = strtolower(pathinfo($ProfilepicName, PATHINFO_FILENAME));
                $ext = strtolower(pathinfo($ProfilepicName, PATHINFO_EXTENSION));

                // Clean the base name: remove special characters, trim underscores
                $cleanBase = preg_replace("/[^a-z0-9_-]/", "_", $baseName);
                $cleanBase = trim($cleanBase, "_");

                // Add timestamp and random string for uniqueness
                $uniqueString = date('Ymd_His') . '_' . bin2hex(random_bytes(4)); // more unique than uniqid
                $newproName = $cleanBase . '_' . $uniqueString . '.' . $ext;
                $profilePictureDestination = __DIR__ . '/../../public/assets/img/Company/' . $newproName;
                $uploadpropic = move_uploaded_file($ProfilepicTempName, $profilePictureDestination);

                if ($uploadpropic) {
                    $proimageBase64 = $newproName;
                } else {
                    $proimageBase64 = '';
                }
            }
            if (isset($_FILES['cover_pic']) && $_FILES['cover_pic']['error'] == 0) {
                $CoverpicName = $_FILES['cover_pic']['name'];
                $CoverpicTempName = $_FILES['cover_pic']['tmp_name'];

                $baseName = strtolower(pathinfo($CoverpicName, PATHINFO_FILENAME));
                $ext = strtolower(pathinfo($CoverpicName, PATHINFO_EXTENSION));

                // Clean the base name: remove special characters, trim underscores
                $cleanBase = preg_replace("/[^a-z0-9_-]/", "_", $baseName);
                $cleanBase = trim($cleanBase, "_");

                // Add timestamp and random string for uniqueness
                $uniqueString = date('Ymd_His') . '_' . bin2hex(random_bytes(4)); // more unique than uniqid
                $newcoverName = $cleanBase . '_' . $uniqueString . '.' . $ext;
                $coverPictureDestination = __DIR__ . '/../../public/assets/img/Company/' . $newcoverName;
                $uploadcoverpic = move_uploaded_file($CoverpicTempName, $coverPictureDestination);

                if ($uploadcoverpic) {
                    $coveimageBase64 = $newcoverName;
                } else {
                    $coverimageBase64 = '$data->coverimg';
                }
            }
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $newcompanyId = $this->getCompanynextId();
            $data = [
                'CompanyId' => $newcompanyId,
                'Name' => $_POST['company_name'],
                'Email' => $_POST['email'],
                'ContactPerson' => $_POST['contact_person'],
                'ContactNum' => $_POST['contact_number'],
                'Website' => $_POST['website'],
                'ShortDesc' => $_POST['description'],
                'No' => $_POST['address_no'],
                'Lane' => $_POST['address_lane'],
                'City' => $_POST['address_city'],
                'District' => $_POST['address_district'],
                'Status' => 'Pending',
                'Linkedin' => $_POST['linkedin'],
                'profileimg' => $proimageBase64,
                'coverimg' => $coveimageBase64,
                'Password' => $password,
            ];

            $notification_data = [
                'type' => 'signup_company',
                'company_id' => $newcompanyId,
                'status' => 'Pending',
            ];

            // show($data);
            $result = $Model->insert($data);
            // show($notification_data);
            // $notify_result = $admin_notification->insert($notification_data);
            if ($result) {
                if (!empty($_POST['email'])) {
                    $email = $_POST['email'];
                    $Name = $_POST['company_name'];
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
                            $mail->Subject = 'Your Company User ID for GradLink Access';
                            $mail->Body = "
                                        Dear {$Name},<br><br>

                                        Welcome to <strong>GradLink</strong>!<br><br>

                                        Your Company User ID is: <strong>{$_POST['email']}</strong><br>
                                        Please use this User ID to log in to your company account on GradLink.<br><br>

                                        <p>Thank you for registering with us.</p>
                                        <p>Your account is pending approval by PDC.</p>
                                        <p><strong>Note:</strong> PDC will immediately review and approve your request. You will be notified once your account is activated.</p><br>

                                        If you have any questions or require assistance, feel free to contact our support team.<br><br>

                                        <hr>
                                        <small>&copy; " . date('Y') . " GradLink. All rights reserved.</small>
                                    ";

                            $mail->send();
                            $_SESSION['flash'] = [
                                'type' => 'success',
                                'message' => 'Your User ID sent to your email. Please check your inbox'
                            ];
                            // show("<script>window.location.href = 'http://localhost/Gradlink/public/login';</script>");
                            // echo "<script>window.location.href = 'http://localhost/Gradlink/public/login';</script>";
                            // exit;

                            // echo '<meta http-equiv="refresh" content="0;url=http://localhost/Gradlink/public/login">';
                            // exit;

                            if (ob_get_length()) {
                                ob_end_clean();
                            }
                            header('Location: http://localhost/Gradlink/public/login');
                            exit;

                            // Fallback for browsers that don't support header redirection
                            echo "<script>window.location.href = 'http://localhost/Gradlink/public/login';</script>";
                            // echo "If you are not redirected, <a href='http://localhost/Gradlink/public/login'>click here</a>.";
                            exit;

                            // header('Location: http://localhost/Gradlink/public/login');
                            // exit;
                        } catch (Exception $e) {
                            $_SESSION['flash'] = [
                                'type' => 'error',
                                'message' => "Failed to send email. Error: {$mail->ErrorInfo}"
                            ];
                        }
                    } else {
                        $_SESSION['flash'] = [
                            'type' => 'error',
                            'message' => "User email not found"
                        ];
                    }
                } else {
                    $_SESSION['flash'] = [
                        'type' => 'error',
                        'message' => "User email not found"
                    ];
                }
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => "Account registration failed. Please try again later"
                ];
                echo "<script>window.location.href = 'http://localhost/Gradlink/public/signup/company';</script>";
                exit;

                // header('Location: http://localhost/Gradlink/public/signup/company');
                // exit;
            }
        }

        $this->view('companySignup',['alldata'=>$all_company_data]);
    }


    public function createpassword()
    {
        $data = [];
        $user = null;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //show($_POST);
            if (isset($_POST['studentId'])) {
                $userId = $_POST['studentId'];
                $userNum = strlen($userId);

                switch ($userNum) {
                    case 9:
                        $user = new student;
                        $id_column = 'StudentId';

                        $_SESSION['user'] = ([
                            'StudentId' => $_POST['studentId'],
                            'Name' => $_POST['name'],
                            'Email' => $_POST['email'],
                            'NIC' => $_POST['nic'],
                            'ContactNum' => $_POST['contactNumber'],
                            'Github' => $_POST['github'],
                            'Linkedin' => $_POST['linkedin'],
                            'ShortDesc' => $_POST['shortDesc'],
                            'Skill' => $_POST['skill'],

                        ]);

                        if (strpos($_SESSION['user']['StudentId'], 'cs') !== false) {
                            $_SESSION['user']['DegreeName'] = 'Computer Science';
                        } elseif (strpos($_SESSION['user']['StudentId'], 'is') !== false) {
                            $_SESSION['user']['DegreeName'] = 'Information System';
                        } else {
                            $data['errors'] = "Invalid User ID";
                        }
                        if (isset($_POST['profilePicture'])) {
                            $base64 = $_POST['profilePicture'];

                            // Check if it's a valid base64 image string
                            if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
                                $imageType = strtolower($type[1]); // jpg, png, jpeg etc.
                                $base64 = substr($base64, strpos($base64, ',') + 1);
                                $base64 = base64_decode($base64);

                                if ($base64 === false) {
                                    $data['errors'] = "Invalid base64 image data.";
                                } else {
                                    $safeName = "profile_" . uniqid('', true) . "." . $imageType;
                                    $destination = __DIR__ . '/../../public/assets/img/Student/' . $safeName;

                                    if (file_put_contents($destination, $base64)) {
                                        $_SESSION['user']['ProfilePic'] = $safeName;
                                    } else {
                                        $data['errors'] = "Failed to save profile picture.";
                                    }
                                }
                            } else {
                                $data['errors'] = "Invalid image format.";
                            }
                        } else {
                            $data['errors'] = "No profile picture submitted.";
                        }

                        if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
                            $cvName = $_FILES['cv']['name'];
                            $cvTempName = $_FILES['cv']['tmp_name'];

                            $cvExt = strtolower(pathinfo($cvName, PATHINFO_EXTENSION));
                            $cvActualName = strtolower(pathinfo($cvName, PATHINFO_FILENAME));
                            $cvNewName = preg_replace("/[^\w-]/", "_", $cvActualName) . uniqid('', true) . "." . $cvExt;
                            $cvDestination = __DIR__ . '/../../public/assets/uploads/cv/' . $cvNewName;

                            if (move_uploaded_file($cvTempName, $cvDestination)) {
                                $_SESSION['user']['cv'] = $cvNewName;
                            } else {
                                $data['errors'] = "Failed to upload cv.";
                            }
                        }
                        $_SESSION['user']['Status'] = 'NotApplied';
                        $_SESSION['user']['completed'] = 0;
                        $_SESSION['user']['noOfAppliedAds'] = 0;
                        $_SESSION['user']['registered'] = 1;
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
            } elseif (isset($_POST['verifyOtp'])) {
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
                                $skill = new student_skill;
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

                        $skills = array_map('trim', explode(",", $_SESSION['user']['Skill']));
                        try {
                            $this->beginTransaction(); // Start transaction
                            $result1 = $user->insert($_SESSION['user'], $id_column);
                            if (!$result1) {
                                throw new Exception("Failed to insert student table data.");
                            }
                            $result2 = $skill->insertSkill($id, $skills);
                            //show($skills);
                            if (!$result2) {
                                throw new Exception("Failed to insert student skill data.");
                            }
                            // Unset and destroy the session
                            if ($result1 && $result2) {
                                session_unset();
                                session_destroy();
                                $data['success'] = "Password created successfully. Please login.";
                                redirect('login');
                                exit;
                            } else {
                                $data['errors'] = "Failed to create password. Please try again.";
                            }
                            $this->commit(); // Commit transaction
                            return true;
                        } catch (Exception $e) {
                            $this->rollback(); // Rollback transaction on error
                            $data['errors'] = "Transaction failed: " . $e->getMessage();
                            return $data['errors'];
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
