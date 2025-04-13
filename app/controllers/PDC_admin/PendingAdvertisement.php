<?php

    class PendingAdvertisement{
        use Controller;
        public function dashboard(){

            $model = new C_Advertisement;

            $data = $model->findAllPending();

            $this-> view('PDC_admin/Advertisement/PendingAdvertisement' , [
            'data' => $data,
            'activeTab' => 'pending-list']
        );
        } 
    }