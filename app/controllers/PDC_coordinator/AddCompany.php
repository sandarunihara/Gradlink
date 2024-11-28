<?php
class AddCompany
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        $this->view('Coordinator/Company/addCompany');
    }

    public function getnextId()
    {
        $model = new company();
        $companyIdPrev = $model->gethighestadid();
        if (!empty($companyIdPrev)) {
            // Extract the numeric part of the current highest advertisementId
            $numericPart = intval(substr($companyIdPrev, 1)); // Remove the prefix (e.g., 'a')
            $nextId = $numericPart + 1;

            // Determine the number of digits required for the new ID
            $paddingLength = max(3, strlen((string)$nextId));

            // Format the new advertisementId (e.g., 'a001', 'a1000', etc.)
            return 'C' . str_pad($nextId, $paddingLength, '0', STR_PAD_LEFT);
        } else {
            // Start from 'a001' if there are no existing entries
            return 'c001';
        }
    }

    public function create()
    {
        $model = new company;
        $companyId = $this->getnextId();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'companyId' => $companyId,
                'company_name' => $_POST['company_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'contact_number' => $_POST['contact_number'] ?? '',
                'contact_person' => $_POST['contact_person'] ?? '',
                'status' => "Pending",
            ];

            $dbColumns = [
                'companyId' => 'CompanyId',
                'company_name' => 'Name',
                'email' => 'Email',
                'contact_number' => 'ContactNum',
                'contact_person' => 'ContactPerson',
                'status' => 'Status',
            ];

            $mappedData = [];
            foreach ($data as $formField => $value) {
                if (isset($dbColumns[$formField])) {
                    $mappedData[$dbColumns[$formField]] = $value;
                }
            }

            if ($model->validatePendingCompany($data)) {
                $arr = [];
                $arr['Name'] = $mappedData['Name'];
                $arr['Email'] = $mappedData['Email'];

                $result1 = $model->where($arr, [], '', 'do_not_order');
                // echo $result1;
                if (empty($result1)) {
                    //no same company
                    $result = $model->insert($mappedData);
                    if ($result) {
                        echo "<script>
                                alert('Company added successfully.');
                                window.location.href = '" . ROOT . "/pdc_coordinator/pendingCompanyList';
                              </script>";
                              
                    } else {
                        echo "<script>alert('Problem in inserting.');
                                window.location.href = 'pdc_coordinator/pendingCompanyList';
                        </script>";
                    }
                } else {
                    echo "<script>alert('Company is already registered.');</script>";
                }
            } else {
                echo "Validation failed";
                $errors = $model->errors;
                $this->view('pdc_coordinator/addCompany', ['errors' => $errors]);
            }
        } else {
            echo "Error";
        }
    }
}
