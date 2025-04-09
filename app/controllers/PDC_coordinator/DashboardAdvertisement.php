<?php
class DashboardAdvertisement
{
    use Controller;

    public function active(){
        $model = new C_Advertisement;
        $data = $model->findallActivewithCompany();
        $this-> view('Coordinator/Advertisement/activeAdvertisements' , $data);
    }

    public function deactive(){
        $model = new C_Advertisement;
        $data = $model->findallDeactivewithCompany(); 
        $this->view('Coordinator/Advertisement/deactiveAdvertisements' , $data);
    }

    public function rejected(){
        $model = new C_Advertisement;
        $data = $model->findallRejectedwithCompany(); 
        $this->view('Coordinator/Advertisement/rejectedAdvertisements' , $data);
    }

    public function pending(){

        $model = new C_Advertisement;
        $data = $model->findAllPending();
        $this-> view('Coordinator/Advertisement/pendingAdvertisements' , $data);
    } 
}
