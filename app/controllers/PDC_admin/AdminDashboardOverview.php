<?php

class AdminDashboardOverview{
    use BaseController;
    public function dashboard(){

        $std = new student;
        $stdcount = $std->count();

        $this-> view('PDC_admin/Dashboard/DashboardOverview' , ['stdcount' => $stdcount]);
    } 
}
