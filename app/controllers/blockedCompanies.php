<?php
class BlockedCompanies
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('blockedCompanies');
    }
}

