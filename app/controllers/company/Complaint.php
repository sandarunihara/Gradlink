<?php

class Complaint
{
    use Controller;
    public function dashboard()
    {
        $this->view('Company/Complaint');
    }
    public function viewComplaint()
    {
        $this->view('Company/ViewComplaint');
    }
    public function addComplaint()
    {
        $this->view('Company/AddComplaint');
    }
}