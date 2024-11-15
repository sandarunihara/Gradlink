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
        
        $advertisementIds = []; // Array to store all advertisement IDs
        // Loop through the result set and collect advertisement IDs
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata=[];
        foreach($advertisementIds as $id){
            $data=$model->findreq($id);
            foreach ($data as $item) {
                if ($item->Jobstatus !== 'Shortlist'){
                    $reqdata[] = [
                        "StudentId"=>$item->StudentId,
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


    public function studentprofile($StudentId){
        // print_r($StudentId);
        $model=new C_Student;
        $data=$model->findbyId($StudentId);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_action'])) {
            print_r($_POST); // This should print the form POST data
            
        }
        
        $this-> view('Company/Studentpro' , ['data' => $data]);
    }


}

