<?php
class Dashboard
{
    use Controller;
    public function index()
    {
        $companyModel = new company;
        $totalCompanies = $companyModel->getTotalCount();
        if (empty($totalCompanies)) {
            $this->view('Coordinator/Company/dashboard');
        }else{
            $dashboardData = [];

            $dashboardData = [
                'companyCount' => $totalCompanies ?? 0,
            ];


            $this->view('Coordinator/Company/dashboard', ['dashboardDetails'=> $dashboardData]);
        }

        
    }
}
