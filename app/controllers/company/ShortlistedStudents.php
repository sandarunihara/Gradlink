<?php

class ShortlistedStudents{
    use Controller;
    public function dashboard(){

        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        
        $model = new C_Dashboard;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");
        if (empty($data)) {
            $this->view('Company/ShortlistedStudents', ['data' => []]);
            exit();
        }
        
        $advertisementIds = []; // Array to store all advertisement IDs
        // Loop through the result set and collect advertisement IDs
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        $reqdata=[];
        $hasShortlisted = false;
        $hasRecruited = false;
        foreach($advertisementIds as $id){
            $data=$model->findreq($id);
            if (empty($data)) {
                $this->view('Company/ShortlistedStudents', ['data' => []]);
                exit();
            }
            foreach ($data as $item) {
                if ($item->Jobstatus === 'Shortlist') {
                    $hasShortlisted = true;
                }
                if ($item->Jobstatus === 'Recruit') {
                    $hasRecruited = true;
                }
                if ($item->Jobstatus == 'Shortlist' ){
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
        
        $_SESSION['hasShortlisted'] = $hasShortlisted;
        $_SESSION['hasRecruited'] = $hasRecruited;
        $this-> view('Company/ShortlistedStudents', ['data' => $reqdata]);
    }

    public function studentprofile($advertisementId,$StudentId){
        // print_r($StudentId);
        $model=new C_Student;
        $data=$model->findbyId($StudentId);
        // print_r($data);
        $updatemodel = new C_Dashboard;
        $studentad_data=$updatemodel->find(['StudentId'=>$StudentId,'advertisementId'=>$advertisementId],'studentadvertisement');
        $studentJobstatus=$studentad_data[0]->Jobstatus;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_action'])) {
            // print_r($_POST['submit_action']);
            $updatedata = [
                'Jobstatus' => $_POST['submit_action']
            ];
            $studentdata = [
                'Status' => $_POST['submit_action']
            ];
            $result = $updatemodel->update($StudentId, $advertisementId, $updatedata);
            $studentUpdate=$model->update($StudentId, $studentdata,'StudentId');
            if ($result['status']) {
                // Redirect to the same page after successful submission
                $success= "Student Job Status updated successfully.";
                // $this-> view('Company/Studentpro' , ['data' => $data,'success'=>$success]);
                header('Location: http://localhost/Gradlink/public/company/RecruitStudents/dashboard' );
                exit;
            } else {
                $error= "There was an issue update the Student Job Status.";
                $this-> view('Company/Studentpro' , ['data' => $data,'error'=>$error,'url'=>'http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard','studentJobstatus'=>$studentJobstatus]);
                exit;
            }
        }

        $this-> view('Company/Studentpro' , ['data' => $data,'url'=>'http://localhost/Gradlink/public/company/ShortlistedStudents/dashboard','studentJobstatus'=>$studentJobstatus]);

    }
}