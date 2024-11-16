<?php

    class AdminApplicationOverview{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Application/ApplicationOverview');
        }  
    }