<?php
class CompanyStatistics
{
    use Controller;
    public function index()
    {
        $coordinatorModel = new Coordinator_Dash;

        $companyLocationData = $coordinatorModel->companyLocations();
        $companyStatusData = $coordinatorModel->countByCompanyStatus();
        // redirect("company-dashboard");
        
        if ($companyLocationData === null || $companyStatusData === null) {
            $this->view('Coordinator/Company/companyStatistics');
            return;

        }
        
        $this->view('Coordinator/Company/companyStatistics', ['companyLocations'=> $companyLocationData, 'companyStatus'=> $companyStatusData]);
    }
}

