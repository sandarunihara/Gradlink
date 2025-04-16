<?php
class DashboardComplaints
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Complain/dashboardComplaints');
    }
}

