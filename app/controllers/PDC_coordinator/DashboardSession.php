<?php
class DashboardSession
{
    use Controller;
    public function upcoming()
    {
        $model = new PDC_Session;
        $sessionData = $model->findall();
        $this->view('Coordinator/Session/dashboardSession', ['sessionData' => $sessionData]);
    }

    public function completed()
    {
        $model = new PDC_Session;
        $sessionData = $model->findCompleted();
        $this->view('Coordinator/Session/dashboardSession', ['sessionData' => $sessionData]);
    }

    
}
