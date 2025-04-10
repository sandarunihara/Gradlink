<?php

class ViewAdvertisement{

    use Controller;

    public function index() {

        $id = $_GET['id'] ?? null;
        if ($id === null) {
            echo "Invalid or missing advertisement ID.";
            return;
        }
        
        $model = new C_Advertisement;
        $data = $model->findwithcompany($id);

        if ($data) {
            $this->view('Coordinator/Advertisement/viewAdvertisement', ['data' => $data]);
        } else {
            echo "No data found";
        }
    }
}