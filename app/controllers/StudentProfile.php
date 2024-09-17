<?php

class StudentProfile{
    use Controller;
    public function dashboard(){
        $this-> view('Student/Profile');
    }
}