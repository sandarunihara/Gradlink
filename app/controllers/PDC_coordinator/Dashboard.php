<?php
class Dashboard
{
    use Controller;
    public function index()
    {
        $this->view('Coordinator/Company/dashboard');
    }
}
