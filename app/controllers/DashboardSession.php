<?php
class DashboardSession
{
    use Controller;
    public function index()
    {
        $this->view('Coordinator/Session/dashboardSession');
    }
}
