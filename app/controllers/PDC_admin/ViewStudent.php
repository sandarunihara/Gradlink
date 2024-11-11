<?php

    class ViewStudent{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Student/StudentView');
        } 
    }