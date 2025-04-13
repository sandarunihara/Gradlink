<?php

    class AdminApplicationOverview{
        use Controller;
        public function dashboard(){

            $model = new Student_advertisement;
            $data = $model->findall();
            //show($data);
            $this-> view('PDC_admin/Application/ApplicationOverview' , 
            [
                'data' => $data,
                'activeTab' => 'applications'
            ] 
            );
        }

        public function working(){
            $model = new Student_advertisement;
            $data = $model->findRecruitedList();
            //show($data);
            $this-> view('PDC_admin/Application/Working' , 
            [
                'data' => $data,
                'activeTab' => 'working-students'
            ] 
            );
        }

        public function show($studentId , $advertisementId){
            $model = new Student_advertisement;
            $data = $model->findstudentad($advertisementId, $studentId);

            $application = $data[0];
            $application = json_decode(json_encode($application), true);
            //show($application);

            $this-> view('PDC_admin/Application/ApplicationView' , ['application' => $application]);
        }
    }