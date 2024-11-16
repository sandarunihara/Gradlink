<?php

    class BlockCompany{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Company/CompanyBlock');
        } 
    }