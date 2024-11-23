<?php
class ViewPendingCompany
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");

        $id = $_GET['id'] ?? null;
        if ($id === null) {
            echo "invalid id or missing company id";
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

            $this->view('Coordinator/Company/viewPendingCompany', ['companyData' => $companyData]);
        } else {
            echo "No data found";
        }
    }

    public function edit($id)
    {
        $model = new company;
        $data = $model->findById($id);

        if (!$data) {
            $this->view('PDC_coordinator/Company/error', ['message' => 'Company not found.']);
            return;
        }
        $companyId = $id;

        if ($data) {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $updatedData = [
                    'company_name' => $_POST['company_name'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'contact_number' => $_POST['contact_number'] ?? '',
                    'contact_person' => $_POST['contact_person'] ?? '',
                ];

                $dbColumns = [
                    'company_name' => 'Name',
                    'email' => 'Email',
                    'contact_number' => 'ContactNum',
                    'contact_person' => 'ContactPerson',
                ];

                $mappedData = [];
                foreach ($updatedData as $formField => $value) {
                    if (isset($dbColumns[$formField])) {
                        $mappedData[$dbColumns[$formField]] = $value;
                    }
                }

                if ($model->validatePendingCompany($updatedData)) {
                    $result = $model->update($companyId, $mappedData, 'CompanyId');
                    print_r($result);

                    if ($result) {
                        header("Location: "  . ROOT . "/PDC_coordinator/viewPendingCompany?id=$id");
                        exit;
                    } else {
                        echo "There was an issue saving company details.";
                    }
                } else {
                    $data['errors'] = $model->errors;
                    // print_r($data['errors']);
                }
            }
            $this->view('PDC_coordinator/Company/viewPendingCompany', [
                'companyData' => $data,
                'errors' => $data['errors'] ?? []
            ]);
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
                header("Location: "  . ROOT . "/PDC_coordinator/pendingCompanyList");

            } else {
                echo "Error: Could not delete the company";
            }
        } else {
            echo "Not such company";
        }
    }
}
