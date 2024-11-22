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
        if ($data) {
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

            $this->view('Coordinator/Company/viewCompany', ['companyData' => $companyData]);
        } else {
            echo "No data found";
        }
    }

    public function edit($id)
    {
        print_r($id);

        $model = new company;
        $data = $model->findById($id);
        // print_r($data);

        if (!$data) {
            $this->view('Coordinator/Company/error', ['message' => 'Company not found.']);
            return;
        }
        $companyId = $id;

        if ($data) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // $model = new company;
                // print_r($_POST);
                // echo '<pre>';
                // print_r($_POST);
                // echo '</pre>';
                $updatedData = [
                    'company_name' => $_POST['company_name'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'contact_number' => $_POST['contact_number'] ?? '',
                    'address_no' => $_POST['address_no'] ?? '',
                    'address_lane' => $_POST['address_lane'] ?? '',
                    'address_city' => $_POST['address_city'] ?? '',
                    'address_district' => $_POST['address_district'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'website' => $_POST['website'] ?? '',
                    'linkedin' => $_POST['linkedin'] ?? '',
                ];

                $dbColumns = [
                    'company_name'     => 'Name',
                    'email'            => 'Email',
                    'contact_number'   => 'ContactNum',
                    'address_no'       => 'No',
                    'address_lane'     => 'Lane',
                    'address_city'     => 'City',
                    'address_district' => 'District',
                    'description'      => 'ShortDesc',
                    'website'          => 'Website',
                    'linkedin'         => 'Linkedin'
                ];

                $mappedData = [];
                foreach ($updatedData as $formField => $value) {
                    if (isset($dbColumns[$formField])) {
                        $mappedData[$dbColumns[$formField]] = $value;
                    }
                }
                // echo '<pre>';
                // print_r($mappedData);
                // echo '</pre>';
                if ($model->validate($updatedData)) {
                    $result = $model->update($companyId, $mappedData, 'CompanyId');
                    print_r($result);

                    if($result){
                        // Redirect to the same page after successful submission
                        header("Location: "  . ROOT . "/PDC_coordinator/viewCompany?id=$id");
                        exit;
                    }
                    else{
                        echo "There was an issue saving company details.";
                    }
                } else {
                    $data['errors'] = $model->errors;
                    // print_r($data['errors']);
                }
            }

            $this->view('Coordinator/Company/viewCompany', [
                'companyData' => $data,
                'errors' => $data['errors'] ?? []
            ]);
        } else {
            echo "Company not found.";
        }
    }
}
