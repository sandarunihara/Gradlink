<?php

class AdminAdvertisementOverview{
    use Controller;
    public function dashboard(){
        $model = new C_Advertisement;

        $data = $model->findallActivewithCompany();

        //var_dump($data);
        $this-> view('PDC_admin/Advertisement/AdvertisementOverview' , 
        [
            'data' => $data,
            'activeTab' => 'advertisement-list'
        ] 
        );
    }

    public function deactive(){
        $model = new C_Advertisement;
        $data = $model->findallDeactivewithCompany(); 
        $this->view('PDC_admin/Advertisement/DeactiveAdvertisement' , [ 
        'data' => $data,
        'activeTab' => 'deactive-list']
    );
    }

    public function rejected(){
        $model = new C_Advertisement;
        $data = $model->findallRejectedwithCompany(); 
        $this->view('PDC_admin/Advertisement/RejectedAdvertisement' , [
        'data' => $data,
        'activeTab' => 'rejected-list']
    );
    }
}
