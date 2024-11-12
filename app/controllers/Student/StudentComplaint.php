<?php

class StudentComplain{
    use Controller;
    public function complaint(){

        $this-> view('Student/Complaint');
    }
}