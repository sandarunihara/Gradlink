<?php

class AdminComplainOverview{
    use Controller;
    public function dashboard(){
        $this-> view('PDC_admin/Complain/ComplainOverview');
    }

    public function student(){
        $this-> view('PDC_admin/Complain/ComplainStudent');
    }
}
