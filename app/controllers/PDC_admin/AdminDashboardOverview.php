<?php

class AdminDashboardOverview{
    use Controller;
    public function dashboard(){
        $this-> view('PDC_admin/Dashboard/DashboardOverview');
    } 
}
