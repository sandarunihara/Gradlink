<?php

class ViewAdvertisement{

    use Controller;

    public function index($advertisementId) {
        $model = new C_Advertisement;
        $data = $model->findwithcompany($advertisementId);
        //var_dump($data);
        if ($data) {
            $this->view('PDC_admin/Advertisement/AdvertisementView', ['data' => $data]);
        } else {
            echo "No data found";
        }
    }
}