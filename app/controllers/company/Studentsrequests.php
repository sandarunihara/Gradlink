<?php

class StudentsRequests{
    use Controller;
    public function dashboard(){

        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        
        $model = new C_Dashboard;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");
        
        $advertisementIds = [];
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata=[];
        foreach($advertisementIds as $id){
            $data=$model->findreq($id);
            foreach ($data as $item) {
                if ($item->Jobstatus !== 'Shortlist' && $item->Jobstatus !== 'Recruit'){
                    $reqdata[] = [
                        "StudentId"=>$item->StudentId,
                        'AdvertisementId' => $item->advertisementId,
                        'Student Name' => $item->Name,
                        'Student Degree'=>$item->DegreeName,
                        'Position' => $item->position,
                        'Action' => $item->Jobstatus
                    ];
                }
            }
        }
        $this-> view('Company/StudentsRequests', ['data' => $reqdata]);
    }  


    public function studentprofile($advertisementId,$StudentId){
        // print_r($StudentId);
        $model=new C_Student;
        $data=$model->findbyId($StudentId);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_action'])) {
            // print_r($_POST); // This should print the form POST data
            $model = new C_Dashboard;
            $updatedata = [
                'Jobstatus' => $_POST['submit_action']
            ];
            $result = $model->update($StudentId, $advertisementId, $updatedata);
            if ($result['status']) {
                // Redirect to the same page after successful submission
                $success= "Student Job Status updated successfully.";
                // $this-> view('Company/Studentpro' , ['data' => $data,'success'=>$success]);
                header('Location: http://localhost/Gradlink/public/company/StudentsRequests/dashboard' );
                exit;
            } else {
                $error= "There was an issue update the Student Job Status.";
                $this-> view('Company/Studentpro' , ['data' => $data,'error'=>$error,'url'=>'http://localhost/Gradlink/public/company/StudentsRequests/dashboard']);
                exit;
            }
        }

        
        $this-> view('Company/Studentpro' , ['data' => $data,'url'=>'http://localhost/Gradlink/public/company/StudentsRequests/dashboard']);
    }


}

