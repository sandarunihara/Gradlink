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
            $action = new Action_logs;
            $progress = new Progress_doc;

            $data = $model->findstudentad($advertisementId, $studentId);

            $companyId = $data[0]->CompanyId;

            $assistantId = $_SESSION['USER']->AssistantId; 

            $actionData = $action->getAdvertisementTimeline($advertisementId , $studentId , $companyId);

            $progressData = $progress->findstudent($studentId);

            //show($actionData);

            $application = $data[0];

            $applicationData = [
                'application' => $application,
                'actionData' => $actionData,
                'progressData' => $progressData
            ];

            //show($applicationData);

            $application = json_decode(json_encode($application), true);
            //show($application);

            $this-> view('PDC_admin/Application/ApplicationView' , ['applicationData' => $applicationData]);
            
        }
    }