<?php
    class Signup
    {
        use Controller;

        public function index()
        {
            $this->view('roleSelection');
        }
        public function student()
        {
            $this->view('studentSignup');
        }
    }