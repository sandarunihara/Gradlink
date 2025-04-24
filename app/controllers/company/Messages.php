<?php

class Messages{
    use Controller;
    public function dashboard(){

        $user=$_SESSION["USER"];

        $model=new PDC_Session;
        $result=$model->findall();
        $data=[];
        if(!empty($result)){
            foreach($result as $session){
                if($session->CompanyId == $user->CompanyId){
                    $session->detail='Techtalk';
                    $data[]=$session;
                }
            }
        }
        // show($data);
        $this-> view('Company/Messages',['data'=>$data]);
    }

    public function techtalk(){

        
        $this-> view('Company/TechTalk',['user' => $_SESSION['USER']]);
    }

    public function pdc_message($sessionId){
        $model=new PDC_Session;
        $result=$model->find($sessionId);
        $data=[];
        if(!empty($result)){
            $data=$result;
            $updatedata=[
                'message_read'=>1
            ];
            $re=$model->update($sessionId,$updatedata,'session_id');
        }else{
            header('location:http://localhost/Gradlink/public/company/Messages/dashboard');
            exit;
        }

        $this-> view('Company/Pdc_message',['user' => $_SESSION['USER'],'data'=>$data]);
    }

    public function coordinatormessage(){
        $companyID=$_SESSION['USER']->CompanyId;
        $coordinatorModel=new pdc_coordinator;
        // $coordinatorName=$coordinatorModel->
        $coordinatorID='200212601985';
        $coordinator_message=new Company_notifications;
        // $message=$coordinator_message->getChatMessages($coo)

        // show($companyID);
        $this->view("company/coordinatormessage");
    }

    public function getunread() {
        $user = $_SESSION["USER"];
        $model = new PDC_Session;
        $result = $model->findall();
        $data = [];
    
        if (!empty($result)) {
            foreach ($result as $session) {
                if ($session->CompanyId == $user->CompanyId && $session->message_read == 0) {
                    $session->detail = 'Techtalk';
                    $data[] = $session;
                }
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
    
}