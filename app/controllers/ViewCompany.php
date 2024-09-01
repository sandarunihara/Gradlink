<?php
class ViewCompany
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('viewCompany');
    }
}
