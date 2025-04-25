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

        $message_coodinator=0;
        $company_notmodel=new Company_notifications;
        // show($user->CompanyId);
        $coordinatorID='200212601985';
        $message_data=$company_notmodel->getChat($user->CompanyId,$coordinatorID);
        // show($message_data);
        if(!empty($message_data)){
            $message_coodinator=1;
        }else{
            $message_coodinator=0;
        }
        $i=0;
        if(!empty($message_data)){
            foreach($message_data as $message){
                if($message->read_status === 0 && $message->actor_id ==='200212601985'){
                    $i=$i+1;
                }
            }
        }
        // show($message_data);
        $this-> view('Company/Messages',['data'=>$data ,'message_coodinator'=>$message_coodinator ,'message_count'=>$i]);
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
        // $coordinatorModel=new pdc_coordinator;
        // $coordinatorName=$coordinatorModel->
        $coordinatorID='200212601985';
        $coordinator_message=new Company_notifications;

        $coordinator_message->markAsRead($coordinatorID,$companyID);

        $message=$coordinator_message->getChat($companyID,$coordinatorID);

        // show($message);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['companymessage'])) {

            $result=$coordinator_message->sendMessage($companyID,$coordinatorID,$_POST['companymessage']);
            if($result){
                header('Location: http://localhost/Gradlink/public/company/Messages/coordinatormessage');
            }
            // show($result);
        }

        $this->view("company/coordinatormessage" ,['data'=>$message]);
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