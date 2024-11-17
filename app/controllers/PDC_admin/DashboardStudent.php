<?php

    class DashboardStudent{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Dashboard/DashboardStudent');
        } 
    }