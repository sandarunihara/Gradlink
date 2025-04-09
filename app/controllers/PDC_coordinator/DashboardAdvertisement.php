<?php
class DashboardAdvertisement
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");

        $model = new C_Advertisement;
        $companyModel = new company;

        $data = $model->find(['status' => "Active"]);

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Advertisement/dashboardAdvertisement');
        } else {
            $advertisementData = [];

            foreach ($data as $addetail) {

                $company = $companyModel->findById($addetail->CompanyId);
                $companyName = (!empty($company) && isset($company->Name)) ? $company->Name : 'Unknown Company';
                // $companyName = $company[0]->Name;

                $advertisementData[] = [
                    'advertisement_id' => $addetail->advertisementId,
                    'position' => $addetail->position,
                    'description' => $addetail->description,
                    'interns' => $addetail->numOfInterns,
                    'mode' => $addetail->workingMode,
                    'start_date' => $addetail->startdate,
                    'end_date' => $addetail->deadline,
                    'company_name' => $companyName
                ];
            }

            $this->view('Coordinator/Advertisement/dashboardAdvertisement', ['advertisementData' => $advertisementData]);
        }
    }

    public function dashboard(){
        $model = new C_Advertisement;
        $data = $model->findallActivewithCompany();
        $this-> view('PDC_admin/Advertisement/AdvertisementOverview' , $data);
    }

    public function deactive(){
        $model = new C_Advertisement;
        $data = $model->findallDeactivewithCompany(); 
        $this->view('PDC_admin/Advertisement/DeactiveAdvertisement' , $data);
    }

    public function rejected(){
        $model = new C_Advertisement;
        $data = $model->findallRejectedwithCompany(); 
        $this->view('PDC_admin/Advertisement/RejectedAdvertisement' , $data);
    }

    public function pending(){

        $model = new C_Advertisement;
        $data = $model->findAllPending();
        $this-> view('PDC_admin/Advertisement/PendingAdvertisement' , $data);
    } 
}
