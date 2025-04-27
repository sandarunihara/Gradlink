<?php

class AdminProfileOverview{
    use Controller;
    public function dashboard(){

        $model =  new pdc_assistant;
        $adds = new C_Advertisement;
        $company = new company;
        $students = new student;

        $addcount = $adds->findAllPendingcount();
        $comcount = $company->pendingCount();
        $stdcount = $students->notAppliedCount();

        $user = $model->findById($_SESSION['USER'] -> AssistantId);


        //show($_SESSION['USER'] -> AssistantId);

        $data = [
            $user,$addcount,$comcount,$stdcount
        ];

        //show($data[0]);
        $this-> view('PDC_admin/Profile/ProfileOverview' , 
        ['data' => $data]
    );
    }

    public function edit($AssistantId){
        $model = new pdc_assistant;
        //show($_POST);
        $data = [
            'Name' => $_POST['fullName'],
            'Email' => $_POST['email'],
            'contact_number' => $_POST['contactNumber'],
            'dob' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'address' => $_POST['address'],
        ];
        //show($data);
        $updatedStatus = $model->update($AssistantId, $data, 'AssistantId');
        if ($updatedStatus && $updatedStatus['status'] === 'success'){
            $_SESSION['flash_message'] = [
                'type' => 'success',
                'message' => 'successfully Updated'
            ];
        }
        else{
            $_SESSION['flash_message'] = [
                'type' => 'error',
                'message' => 'Error: Could not update.'
            ];
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // public function changePassword(){
    //     $_SESSION['flash_message'] = [
    //         'type' => 'success',
    //         'message' => 'password changed successfully  '
    //     ];
    //     header('Location: ' . ROOT . '/PDC_admin/AdminProfileOverview/dashboard');
    //     exit;
    // }

    
}