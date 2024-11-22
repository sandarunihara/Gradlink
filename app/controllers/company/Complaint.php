<?php

class Complaint
{
    use Controller;
    public function dashboard()
    {
        $this->view('Company/Complaint');
    }
}