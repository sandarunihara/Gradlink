<?php

class Advertisements{
    use Controller;
    public function dashboard(){
        $this-> view('Company/Advertisements');
    }
    public function create(){
        $this-> view('Company/CreateAdvertisement');
    }
}