<?php

    class PendingCompany{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Company/CompanyPending');
        } 
    }