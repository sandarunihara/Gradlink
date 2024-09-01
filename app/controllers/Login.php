<?php
class Login
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('login');
    }
}
