<?php
class DashboardSession
{
    use Controller;
    public function index()
    {
        $model = new PDC_Session;
        $sessionData = $model->findSessionWithCompany();
        $this->view('Coordinator/Session/dashboardSession', ['sessionData' => $sessionData]);
    }
}
