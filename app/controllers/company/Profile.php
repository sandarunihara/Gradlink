<?php

class Profile
{
    use Controller;
    public function dashboard()
    {
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        $model = new company;
        $data = $model->first(['CompanyId' => $user->CompanyId]);
        $this->view('Company/Profile', ['data' => $data, 'user' => $user]);
    }

    public function edit()
    {
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        $model = new company;
        $all_company_data=$model->findAll([],[],'');
        $data = $model->first(['CompanyId' => $user->CompanyId]);
        foreach ($all_company_data as $key => $company) {
            if ($data->CompanyId == $company->CompanyId) {
                unset($all_company_data[$key]);
            }
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // show($_POST);
            if (isset($_FILES['profilephoto']) && $_FILES['profilephoto']['error'] == 0) {
                $ProfilepicName = $_FILES['profilephoto']['name'];
                $ProfilepicTempName = $_FILES['profilephoto']['tmp_name'];

                $baseName = strtolower(pathinfo($ProfilepicName, PATHINFO_FILENAME));
                $ext = strtolower(pathinfo($ProfilepicName, PATHINFO_EXTENSION));

                // Clean the base name: remove special characters, trim underscores
                $cleanBase = preg_replace("/[^a-z0-9_-]/", "_", $baseName);
                $cleanBase = trim($cleanBase, "_");

                // Add timestamp and random string for uniqueness
                $uniqueString = date('Ymd_His') . '_' . bin2hex(random_bytes(4)); // more unique than uniqid
                $newproName = $cleanBase . '_' . $uniqueString . '.' . $ext;
                $profilePictureDestination = __DIR__ . '/../../../public/assets/img/Company/' . $newproName;
                $uploadpropic = move_uploaded_file($ProfilepicTempName, $profilePictureDestination);

                if ($uploadpropic) {
                    $proimageBase64 = $newproName;
                } else {
                    $proimageBase64 = $data->profileimg;
                }
            } else {
                $proimageBase64 = $data->profileimg;
            }
            if (isset($_FILES['coverphoto']) && $_FILES['coverphoto']['error'] == 0) {
                $CoverpicName = $_FILES['coverphoto']['name'];
                $CoverpicTempName = $_FILES['coverphoto']['tmp_name'];

                $baseName = strtolower(pathinfo($CoverpicName, PATHINFO_FILENAME));
                $ext = strtolower(pathinfo($CoverpicName, PATHINFO_EXTENSION));

                // Clean the base name: remove special characters, trim underscores
                $cleanBase = preg_replace("/[^a-z0-9_-]/", "_", $baseName);
                $cleanBase = trim($cleanBase, "_");

                // Add timestamp and random string for uniqueness
                $uniqueString = date('Ymd_His') . '_' . bin2hex(random_bytes(4)); // more unique than uniqid
                $newcoverName = $cleanBase . '_' . $uniqueString . '.' . $ext;
                $coverPictureDestination = __DIR__ . '/../../../public/assets/img/Company/' . $newcoverName;
                $uploadcoverpic = move_uploaded_file($CoverpicTempName, $coverPictureDestination);

                if ($uploadcoverpic) {
                    $coverimageBase64 = $newcoverName;
                } else {
                    $coverimageBase64 = $data->coverimg;
                }
            } else {
                $coverimageBase64 = $data->coverimg;
            }

            $updatedata = [
                'Name' => $_POST['Name'] ?? '',
                'ContactPerson' => $_POST['ContactPerson'] ?? '',
                'ShortDesc' => $_POST['ShortDesc'] ?? '',
                'Email' => $_POST['Email'] ?? '',
                'ContactNum' => $_POST['ContactNum'] ?? '',
                'Website' => $_POST['Website'] ?? '',
                'Linkedin' => $_POST['Linkedin'] ?? '',
                'No' => $_POST['No'] ?? '',
                'Lane' => $_POST['Lane'] ?? '',
                'City' => $_POST['City'] ?? '',
                'District' => $_POST['District'] ?? '',
                'profileimg' => $proimageBase64 ?? '',
                'coverimg' => $coverimageBase64 ?? ''
            ];

            // show($updatedata);
            $result = $model->update($user->CompanyId, $updatedata, 'CompanyId');
            if ($result['status'] == 'success') {
                $_SESSION['USER'] = $model->first(['CompanyId' => $user->CompanyId]);
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Profile update Successfully'
                ];

                echo "<script>window.location.href = 'http://localhost/Gradlink/public/company/Profile/dashboard';</script>";
                exit;

                // header('Location: ../Profile/dashboard');
                // exit;
            } else {
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'There was an issue saving the data'
                ];
            }
        }

        $this->view('Company/EditProfile', ['data' => $data, 'user' => $user ,'all_company_data'=>$all_company_data]);
    }
}
