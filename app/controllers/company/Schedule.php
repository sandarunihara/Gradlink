<?php

class Schedule{
    use Controller;
    public function dashboard(){
        $interviewmodel=new interview_time_slot;
        $data=$interviewmodel->findall();
        $interviewdata=[];
        if(empty($data)){
            $this->view('Company/Schedule',['data'=>$interviewdata]);
            exit();
        }
        foreach($data as $item){
            $studentmodel=new C_Student;
            $studentdata=$studentmodel->findbyId($item->StudentId);
            $studentadvertisement=new student_advertisement;
            $studentaddata=$studentadvertisement->findstudentad($item->CompanyId,$item->StudentId);
            // print_r($studentaddata);
            $interviewdata[]=[
                'Position'=>$studentaddata[0]->position,
                'StudentName'=>$studentdata[0]->Name,
                'Date'=>$item->Date,
                'StartTime'=>$item->StartTime,
                'EndTime'=>$item->EndTime
            ];
        }

        

        $this-> view('Company/Schedule',['data'=>$interviewdata]);
    }
    
}

