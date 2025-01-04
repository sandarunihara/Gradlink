<?php
class ViewPendingAdvertisement
{
    use Controller;
    public function index()
    {
        $id = $_GET['id'] ?? null;
        if($id === null)
        {
            echo "Invalid or missing advertisement ID.";
            return;
        }

        $model = new C_Advertisement;
        $companyModel = new company;

        $data = $model->find(['advertisementId' => $id]);

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Advertisement/viewPendingAdvertisement');
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
                    'qualification' => $addetail->qualification,
                    'company_name' => $companyName,
                    'company_id' => $addetail->CompanyId,
                ];

            }
            $this->view('Coordinator/Advertisement/viewPendingAdvertisement', ['advertisementData' => $advertisementData]);

        }
    }
}
