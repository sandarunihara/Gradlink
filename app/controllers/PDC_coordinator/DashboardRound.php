<?php

class DashboardRound
{
    use Controller;
    public function index()
    {
        $this->view('Coordinator/Round/dashboardRound');
    }
}