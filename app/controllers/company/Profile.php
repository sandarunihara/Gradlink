<?php

class Profile{
    use Controller;
    public function dashboard(){
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        // print_r($user);
        // print_r($user->CompanyId);
        $this-> view('Company/Profile',['data' => $user]);
    }

    public function edit(){
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['profilephoto']) && $_FILES['profilephoto']['error'] == 0) {
                $imageData = file_get_contents($_FILES['profilephoto']['tmp_name']); // Get the image content
                $proimageBase64 = base64_encode($imageData); // Encode image content in base64
            }
            if (isset($_FILES['coverphoto']) && $_FILES['coverphoto']['error'] == 0) {
                $imageData = file_get_contents($_FILES['coverphoto']['tmp_name']); // Get the image content
                $coverimageBase64 = base64_encode($imageData); // Encode image content in base64
            }
        }
        
        $this-> view('Company/EditProfile',['data' => $user]);
    }
}