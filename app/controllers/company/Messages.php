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
}