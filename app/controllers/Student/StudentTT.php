<?php

class StudentTT{
    use Controller;
    public function techtalk(){
        $data =[];

        $this-> view('Student/TechTalk',$data);
    }
}