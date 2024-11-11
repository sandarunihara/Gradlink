<?php

class AdminStudentOverview{
    use Controller;
    public function dashboard(){
        $this-> view('PDC_admin/Student/StudentOverview');
    } 
}
