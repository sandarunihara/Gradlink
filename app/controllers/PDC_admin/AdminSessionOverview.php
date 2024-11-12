<?php

    class AdminSessionOverview{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/SessionOverview');
        }
    }