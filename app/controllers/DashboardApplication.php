<?php
class DashboardApplication
{
    use Controller;
    public function index()
    {
        $this->view('Coordinator/Application/dashboardApplication');
    }
}
