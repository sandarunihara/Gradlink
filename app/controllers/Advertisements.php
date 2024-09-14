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

        if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
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
            
            if ($model->validate($_POST)) {
                $result = $model->insert($data);
                if ($result) {
                    $entereddata = $model->find($data);
                    $id= $entereddata[0]->id;
                    header('Location: ../Advertisements/send?id=' . urlencode($id));
                    exit;
                } else {
                    echo "There was an issue saving the advertisement.";
                }
            }else{
                $data['errors'] = $model->errors;
                print_r($data['errors']);
            }
    
        }

        $this->view('Company/CreateAdvertisement');
    }


    
    public function send(){
        if (isset($_GET['id'])) {
            $model = new C_Advertisement;
            $id = $_GET['id'];
    
            $data = $model->find(['id' => $id]);
    
            if (!empty($data)) {
                $this->view('Company/SendAdvertisements', ['data' => $data]);
            } else {
                echo "No advertisement found.";
            }
        } else {
            echo "No id specified.";
        }
    }
    public function edit(){
        $this-> view('Company/EditAdvertisements');
    }
    
}