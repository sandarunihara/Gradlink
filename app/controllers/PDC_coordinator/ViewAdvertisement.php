<?php

class ViewAdvertisement{

    use Controller;

    public function index() {

        $advertisementId = $_GET['id'] ?? null;
        if ($advertisementId === null) {
            echo "Invalid or missing advertisement ID.";
            return;
        }

        $model = new C_Advertisement;
        $data = $model->findwithcompany($advertisementId);
        //var_dump($data);
        if ($data) {
            $this->view('Coordinator/Advertisement/viewAdvertisement', ['data' => $data]);
        } else {
            echo "No data found";
        }
        
        
    }
}