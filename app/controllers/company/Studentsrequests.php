<?php

class StudentsRequests{
    use Controller;
    public function dashboard(){

        $model = new C_Dashboard;
        $data = $model->findId(); // we want to get using advertisementId from advertisment table where using company id
        
        $advertisementIds = []; // Array to store all advertisement IDs
        // Loop through the result set and collect advertisement IDs
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        
        $reqdata=[];
        foreach($advertisementIds as $id){
            $data=$model->findreq($id);
            foreach ($data as $item) {
                if ($item->Jobstatus !== 'shortlist'){
                    $reqdata[] = [
                        "RegNumber"=>$item->RegNumber,
                        'Student Name' => $item->Name,
                        'Student Degree'=>$item->DegreeName,
                        'Position' => $item->position,
                        'Action' => $item->Jobstatus
                    ];
                }
            }
            // print_r($data);
        }
        $this-> view('Company/StudentsRequests', ['data' => $reqdata]);
    }  


    public function studentprofile($RegNumber){
        $model=new C_Student;
        $data=$model->findbyId($RegNumber);
        // print_r($data);
        $this-> view('Company/Studentpro' , ['data' => $data]);
    }


}

