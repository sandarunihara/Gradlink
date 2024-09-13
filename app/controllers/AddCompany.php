<?php
class AddCompany
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Company/addCompany');
    }
}

