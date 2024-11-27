<?php

class AdminDashboardOverview{
    use BaseController;
    public function dashboard(){
        $this-> view('PDC_admin/Dashboard/DashboardOverview');
    } 
}
