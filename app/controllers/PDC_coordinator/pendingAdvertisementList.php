<?php
class pendingAdvertisementList
{
    use Controller;
    public function index()
    {
        $model = new C_Advertisement;
        $companyModel = new company;

        $data = $model->find(['status' => "Pending"]);

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Advertisement/pendingAdvertisementList');
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
            $this->view('Coordinator/Advertisement/pendingAdvertisementList', ['advertisementData' => $advertisementData]);
        }
    }
}

