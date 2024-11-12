<?php
class DashboardCompany
{
    use Controller;
    public function index()
    {
        $this->view('Coordinator/Company/dashboardCompany');
    }
}
