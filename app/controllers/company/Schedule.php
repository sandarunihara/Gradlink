<?php

class Schedule{
    use Controller;
    public function dashboard(){
        $this-> view('Company/Schedule');
    }
    public function Create(){
        $this-> view('Company/CreateSchedule');
    }
}

