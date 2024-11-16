<?php

    class DashboardCompany{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Dashboard/DashboardCompany');
        } 
    }