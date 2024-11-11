<?php

class AdminCompanyOverview{
    use Controller;
    public function dashboard(){
        $this-> view('PDC_admin/Company/CompanyOverview');
    }
}
