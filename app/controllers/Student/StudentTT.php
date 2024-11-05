<?php

class StudentTT{
    use Controller;
    public function dashboard(){
        $this-> view('Student/TechTalk');
    }
}