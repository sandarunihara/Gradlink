<?php

    class PendingStudent{
        use Controller;
        public function dashboard(){
            $model = new student;
            $applyDetails = new student_advertisement;
            $studentData = $model->findAllPending();
            //var_dump($studentData);   

            $this-> view('PDC_admin/Student/StudentPending' , ['studentData' => $studentData]);
            // $id = $studentData[0] -> StudentId;

            // $studentapply = $applyDetails->findAppliedCompanies($id);
            // //var_dump($studentapply);

            // $data = [
            //     'StudentId'=> $studentData[0] -> StudentId,
            //     'Name'=> $studentData[0] -> Name,
            //     'NIC'=> $studentData[0] -> NIC,
            //     'DegreeName'=> $studentData[0] -> DegreeName,
            //     'Status'=> $studentData[0] -> Status,
            //     'Email'=> $studentData[0] -> Email,
            //     'ContactNum'=> $studentData[0] -> ContactNum,
            //     'Github'=> $studentData[0] -> Github,
            //     'Linkedin'=> $studentData[0] -> Linkedin,
            //     'applications'=> []
                
            // ];  

            // foreach($studentapply as $apply){
            //     $data['applications'][] = [
            //         'Jobstatus'=> $studentapply[0] -> Jobstatus,
            //         'CreatedAt'=> $studentapply[0] -> CreatedAt,
            //         'position'=> $studentapply[0] -> position,
            //         'ComName'=> $studentapply[0] -> Name,

            //     ];
            }
            
            
}