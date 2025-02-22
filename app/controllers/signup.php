<?php
    class Signup
    {
        use Controller;

        public function index()
        {
            $this->view('createpassword');
            //$this->view('roleSelection');
        }
        public function student()
        {
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                show($_POST);
            }else{
                $this->view('studentSignup');
            }
        }
    }