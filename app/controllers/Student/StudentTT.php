<?php

class StudentTT{
    use BaseController;
    public function techtalk(){
        $data =[];

        $this-> view('Student/TechTalk',$data);
    }
}