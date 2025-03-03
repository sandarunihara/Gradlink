<?php
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
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //show($_POST);
                //show($_FILES);
                $profilePicture = $_FILES['profilePicture'];
                $cv = $_FILES['cv'];
            }else{
                $this->view('studentSignup');
            }
        }
    }