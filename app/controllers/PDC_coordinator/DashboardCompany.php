<?php
class DashboardCompany
{
    use Controller;
    public function index()
    {
        // $this->view('Coordinator/Company/dashboardCompany');

        $model = new company;
        $data = $model->findAllOngoing();

        if ($data == false || empty($data)) {
            $this->view('Coordinator/Company/dashboardCompany');
        } else {
            $companyData = [];

            foreach ($data as $companydetail) {
                $companyData[] = [
                    'company_id' => $companydetail->CompanyId,
                    'company_name' => $companydetail->Name,
                    'email' => $companydetail->Email,
                    'contact_person' => $companydetail->ContactPerson,
                    'contact_number' => $companydetail->ContactNum,
                    'address_no' => $companydetail->No,
                    'address_lane' => $companydetail->Lane,
                    'address_city' => $companydetail->City,
                    'address_district' => $companydetail->District,
                    'description' => $companydetail->ShortDesc,
                    'website' => $companydetail->Website,
                    'linkedin' => $companydetail->Linkedin,
                    'status' => $companydetail->Status,
                ];
            }
            $this->view('Coordinator/Company/dashboardCompany', ['companyData' => $companyData]);
        }
    }
}
