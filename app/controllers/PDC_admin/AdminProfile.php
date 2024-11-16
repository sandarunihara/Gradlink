<?php

class AdminProfileOverview{
    use Controller;
    public function dashboard(){
        $this-> view('PDC_admin/Profile/ProfileOverview');
    } 
}