<?php
class ViewPendingCompany
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Company/viewPendingCompany');
    }
}
