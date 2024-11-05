<?php

class StudentComplain{
    use Controller;
    public function dashboard(){
        $this-> view('Student/Complain');
    }
}