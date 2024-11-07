<?php
class pendingCompanyList
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Company/pendingCompanyList');
    }
}
