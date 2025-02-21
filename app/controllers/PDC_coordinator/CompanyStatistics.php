<?php
class CompanyStatistics
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Company/companyStatistics');
    }
}

