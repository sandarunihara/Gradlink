<?php
class DashboardAdvertisement
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Advertisement/dashboardAdvertisement');
    }
}

