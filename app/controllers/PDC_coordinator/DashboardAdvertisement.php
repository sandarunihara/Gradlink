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

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Advertisement/dashboardAdvertisement');
        }
        else {
            $advertisementData = [];

            foreach($data as $addetail)
            {
                $company = $companyModel->findById($addetail->CompanyId);
                $companyName = (!empty($company) && isset($company[0]->Name)) ? $company[0]->Name : 'Unknown Company';
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
}
