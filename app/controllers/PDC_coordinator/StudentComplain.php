<?php
class StudentComplain
{
    use Controller;
    public function index()
    {
        $this->view('Coordinator/Complain/studentComplain');
    }
}