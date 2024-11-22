<?php

class Messages{
    use Controller;
    public function dashboard(){
        $this-> view('Company/Messages');
    }

    public function techtalk(){
        $this-> view('Company/TechTalk',['user' => $_SESSION['USER']]);
    }

    public function pdc_message(){
        $this-> view('Company/Pdc_message',['user' => $_SESSION['USER']]);
    }
}