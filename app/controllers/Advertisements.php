<?php

class Advertisements{
    use Controller;
    public function dashboard(){

        $model = new C_Advertisement;
    
            $data = $model->findall();
            if (!empty($data)) {
                $this->view('Company/Advertisements', ['data' => $data]);
            } else {
                $message="No advertisement found.";
                $this-> view('Company/Advertisements');
            }
    }


    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new C_Advertisement;
    
            $data = [
                'position' => $_POST['position'] ?? '',
                'description' => $_POST['description'] ?? '',
                'qualifications' => $_POST['qualifications'] ?? '',
                'period' => $_POST['period'] ?? '',
                'interns' => $_POST['interns'] ?? '',
                'worktype' => $_POST['worktype'] ?? '',
                'deadline' => $_POST['deadline'] ?? ''
            ];
            
    
            // Validate and insert the data into the database
            if ($model->validate($_POST)) {
                $result = $model->insert($data);
                if ($result) {
                    header('Location: ../Advertisements/dashboard'); // Redirect to the dashboard after successful submission
                    exit;
                } else {
                    echo "There was an issue saving the advertisement.";
                }
            } else {
                $data['errors'] = $model->errors;
                // Handle validation errors
                print_r($data['errors']);
            }
        }
    
        $this->view('Company/CreateAdvertisement');
    }


    
    public function send($id){
        
        $model = new C_Advertisement;
    
        // Find the advertisement by ID
        $data = $model->find(['id' => $id]);
        if ($data) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $model = new C_Advertisement;
        
                $updatedata = [
                    'position' => $_POST['position'] ?? '',
                    'description' => $_POST['description'] ?? '',
                    'qualifications' => $_POST['qualifications'] ?? '',
                    'period' => $_POST['period'] ?? '',
                    'interns' => $_POST['interns'] ?? '',
                    'worktype' => $_POST['worktype'] ?? '',
                    'deadline' => $_POST['deadline'] ?? ''
                ];
            }
            // Pass the data data to the view
            $this->view('Company/SendAdvertisements', ['data' => $data]);
        } else {
            echo "Advertisement not found.";
        }
    }



    public function edit(){
        $this-> view('Company/EditAdvertisements');
    }

}



// if (isset($_GET['id'])) {
        //     $model = new C_Advertisement;
        //     $id = $_GET['id'];
    
        //     $data = $model->find(['id' => $id]);
    
        //     if (!empty($data)) {
        //         $this->view('Company/SendAdvertisements', ['data' => $data]);
        //     } else {
        //         echo "No advertisement found.";
        //     }
        // } else {
        //     echo "No id specified.";
        // }