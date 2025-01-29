<?php

class StudentTT{
    use BaseController;
    public function techtalk(){
        $data =[];

        $session = new PDC_Session;
        $date = date('Y-m-d');
        $data['session'] = $session->findSessions($date);
        show($data['session'] . 'Sessions not found');
        //$this-> view('Student/TechTalk',$data);
    }
}