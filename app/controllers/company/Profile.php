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
        // print_r($user);
        // print_r($user->CompanyId);
        $this-> view('Company/EditProfile',['data' => $user]);
    }
}