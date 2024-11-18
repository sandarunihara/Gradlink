<?php
class ViewCompany
{
    use Controller;
    public function index()
    { // load the company details by ID

        $id = $_GET['id'] ?? null;
        // $this->view('Coordinator/Company/viewCompany');
        if ($id === null) {
            echo "Invalid or missing company ID.";
            return;
        }
        $model = new company;
        $data = $model->findById($id);
        if($data)
        {
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
                    'linkedin' => $companydetail->Linkedin
                ];
            }
            
            $this->view('Coordinator/Company/viewCompany' , ['companyData'=> $companyData]);
        }
        else{
            echo "No data found";
        }
    }
}
