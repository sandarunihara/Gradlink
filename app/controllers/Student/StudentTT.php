<?php

class StudentTT{
    use BaseController;
    public function techtalk(){
        $data =[];

        $session = new PDC_Session;
        $date = date('Y-m-d');
        $data['session'] = $session->findSessions($date);

        // $company = new Company;
        // foreach($data['session'] as $key => $value){
        //     $companyId = $value->CompanyId;
        //     $data['session'][$key]->companyName = $company->where('CompanyID', $companyId)->CompanyName;
        // }

        // $data['Complaints'] = $complaint -> where($arr,[], '', 'do_not_order');

        //show($date);
        // show($data);
        $this-> view('Student/TechTalk',$data);
    }
}