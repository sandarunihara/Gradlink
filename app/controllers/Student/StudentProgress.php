<?php

class StudentProgress{
    use Controller;
    public function dashboard(){
        $this-> view('Student/ProgressReport');
    }
}