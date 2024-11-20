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
        $data = $model->first(['CompanyId'=>$user->CompanyId]);
        $this->view('Company/Profile', ['data' => $data]);
    }

    public function edit()
    {
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        $model = new company;
        $data = $model->first(['CompanyId'=>$user->CompanyId]);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['profilephoto']) && $_FILES['profilephoto']['error'] == 0) {
                $imageData = file_get_contents($_FILES['profilephoto']['tmp_name']); // Get the image content
                $proimageBase64 = base64_encode($imageData); // Encode image content in base64
            }else{
                $proimageBase64 = $data->profileimg;
            }
            if (isset($_FILES['coverphoto']) && $_FILES['coverphoto']['error'] == 0) {
                $imageData = file_get_contents($_FILES['coverphoto']['tmp_name']); // Get the image content
                $coverimageBase64 = base64_encode($imageData); // Encode image content in base64
            }else{
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
            
            
            $result = $model->update($user->CompanyId, $updatedata, 'CompanyId');
            if ($result['status'] == 'success') {
                header('Location: ../Profile/dashboard');
                exit;
            } else {
                echo "There was an issue saving the data.";
            }
        }


        $this->view('Company/EditProfile', ['data' => $data]);
    }
}
