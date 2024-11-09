<?php
    class Home{
        use Controller;
        public function index(){
            $this-> view('home');
        }   
        public function loginuserrole(){
            $this-> view('users');
        } 
        public function reguserrole(){
            $this-> view('users');
        } 
        public function login(){

             // Check if a 'role' parameter was passed in the URL
            $role = isset($_GET['role']) ? $_GET['role'] : null;

            $this-> view('login');
        }
        public function register(){
            $this-> view('register');
        }
    }