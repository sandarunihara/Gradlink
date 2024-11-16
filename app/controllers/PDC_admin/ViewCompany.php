<?php

    class ViewCompany{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Company/CompanyView');
        } 
    }