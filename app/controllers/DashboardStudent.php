<?php
class DashboardStudent
{
    use Controller;
    public function index()
    {
        $this->view('Coordinator/Student/dashboardStudent');
    }
}
