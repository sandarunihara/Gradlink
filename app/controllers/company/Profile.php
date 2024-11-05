<?php

class Profile{
    use Controller;
    public function dashboard(){
        $this-> view('Company/Profile');
    }
}