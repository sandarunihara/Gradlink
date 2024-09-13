<?php

class Advertisements{
    use Controller;
    public function dashboard(){
        $this-> view('Company/Advertisements');
    }
    public function create(){
        $this-> view('Company/CreateAdvertisement');
    }
    public function send(){
        $this-> view('Company/SendAdvertisements');
    }
    public function edit(){
        $this-> view('Company/EditAdvertisements');
    }
    
}