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
        $companyData = $model->findById($id);
        // echo '<pre>';
        //         print_r($data);
        //         echo '</pre>';
        
        


        if ($companyData) {
            
            $this->view('Coordinator/Company/viewCompany', ['companyData' => $companyData]);
            
        } else {
            echo "No data found";
        }
    }

    }
