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
        // echo '<pre>';
        //         print_r($data);
        //         echo '</pre>';
        
        if ($data) {
            // $companyData = [];

            // foreach ($data as $companydetail) {
            //     $companyData[] = [
            //         'company_id' => $companydetail->CompanyId,
            //         'company_name' => $companydetail->Name,
            //         'email' => $companydetail->Email,
            //         'contact_person' => $companydetail->ContactPerson,
            //         'contact_number' => $companydetail->ContactNum,
            //         'address_no' => $companydetail->No,
            //         'address_lane' => $companydetail->Lane,
            //         'address_city' => $companydetail->City,
            //         'address_district' => $companydetail->District,
            //         'description' => $companydetail->ShortDesc,
            //         'website' => $companydetail->Website,
            //         'linkedin' => $companydetail->Linkedin
            //     ];
            // }

            $companyData = [
                'company_id' => $data->CompanyId,
                'company_name' => $data->Name,
                'email' => $data->Email,
                'contact_person' => $data->ContactPerson,
                'contact_number' => $data->ContactNum,
                'address_no' => $data->No,
                'address_lane' => $data->Lane,
                'address_city' => $data->City,
                'address_district' => $data->District,
                'description' => $data->ShortDesc,
                'website' => $data->Website,
                'linkedin' => $data->Linkedin
            ];
            
            // echo json_encode($companyData);
            
            $this->view('Coordinator/Company/viewCompany', ['companyData' => $companyData]);
            
            // echo json_encode($companyData);

            // $this->view('Coordinator/Company/viewCompany', ['companyData' => $companyData]);
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
                    'company_id' => $companyId,
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
                    'company_id' => 'CompanyId',
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
                    // If validation passes, proceed to update the database
                    $result = $model->update($companyId, $mappedData, 'CompanyId');
                
                    if ($result) {
                        // Redirect to the same page after successful update
                        header("Location: "  . ROOT . "/PDC_coordinator/viewCompany?id=$id");
                        exit;
                    } else {
                        echo "There was an issue saving company details.";
                    }
                } else {
                    // If validation fails, capture the errors and show them in the view
                    $data['errors'] = $model->errors; // Get validation errors
                    $data['companyData'] = $updatedData; // Preserve the submitted data
                
                    $this->view('PDC_coordinator/Company/viewCompany', [
                        'companyData' => $updatedData,
                        'errors' => $data['errors'],
                        'id' => $id, // Pass the ID explicitly if needed
                    ]);
                }
                
            }

            
        } else {
            echo "Company not found.";
        }
    }
    public function delete($id)
    {
        $model = new company;
        $data = $model->findById($id);
        if (!empty($data)) {
            $result = $model->delete($id, 'CompanyId');
            if ($result) {
                header("Location: "  . ROOT . "/PDC_coordinator/dashboardCompany");
                // echo ($result);
            } else {
                echo "Error: Could not delete the company";
            }
        } else {
            echo "Not such company";
        }
    }
}
