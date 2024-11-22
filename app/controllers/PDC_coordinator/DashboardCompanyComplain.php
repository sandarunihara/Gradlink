<?php
class DashboardCompanyComplain
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Complain/dashboardCompanyComplain');
    }
}

