<?php
class DashboardSession
{
    use Controller;
    public function index()
{
    $model = new PDC_Session;
    $sessionData = $model->findall();
    $companies = $model->getAllCompaniesUpcoming(); // Add this new method
    
    $this->view('Coordinator/Session/dashboardSession', [
        'sessionData' => $sessionData,
        'companies' => $companies
    ]);
}

    public function completed()
    {
        $model = new PDC_Session;
        $sessionData = $model->findCompleted();
        $companies = $model->getAllCompaniesCompleted();
        $this->view('Coordinator/Session/dashboardSession', [
            'sessionData' => $sessionData,
            'companies' => $companies
        ]);
    }
        
    
}
