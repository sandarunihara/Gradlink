<?php

    class PendingAdvertisement{
        use Controller;
        public function dashboard(){
            $this-> view('PDC_admin/Advertisement/PendingAdvertisement');
        } 
    }