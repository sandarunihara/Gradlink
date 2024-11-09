<?php

class Authentication{
    use Controller;
    public function login(){
        $this-> view('company/Authentication');
    }
    public function register(){
        $this-> view('company/Registration');
    }
    public function dashboard(){
        $this-> view('company/Dashboard');
    }
    public function profile(){
        $this-> view('company/Profile');
    }
    public function edit(){
        $this-> view('company/EditProfile');
    }
    public function changepassword(){
        $this-> view('company/ChangePassword');
    }
    public function logout(){
        $this-> view('company/Logout');
    }
}