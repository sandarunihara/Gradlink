<?php

class StudentAppliedCompanies{
    use BaseController;
    use Model;
    public function AppliedCompanies(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        $data['Student'] = $student -> first($arr);
        
        $student_advertisement = new student_advertisement;
        $data['student_applied_companies'] = $student_advertisement->findAppliedCompanies($arr['StudentId']);

        if(!empty($data['student_applied_companies'])){
            for($i = 0; $i < count($data['student_applied_companies']); $i++){
                $createdAt = $data['student_applied_companies'][$i]->CreatedAt;
                $date = explode(" ", $createdAt);
                $data['student_applied_companies'][$i]->date = $date[0];

                if($data['student_applied_companies'][$i]->Jobstatus == 'Accept' || 
                    $data['student_applied_companies'][$i]->Jobstatus == 'Interview Marked' ||
                    $data['student_applied_companies'][$i]->Jobstatus == 'Interview Scheduled' ||
                    $data['student_applied_companies'][$i]->Jobstatus = 'Shortlisted' ||
                    $data['student_applied_companies'][$i]->Jobstatus = 'Interview Expired'){
                    
                        $data['student_applied_companies'][$i]->Jobstatus = 'Pending ';
                }
            }
        }
        //show($data);
        $this-> view('Student/AppliedCompanies',$data);
    }  
    public function ViewAppliedCompanies($id){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $model = new C_Advertisement;
        // Find the advertisement by ID
        $data = $model->find(['advertisementId' => $id]);
        $advertisementId = $id;
        //show($data);
        $this-> view('Student/ViewAppliedAdDash',$data);
    }
    function InternshipOffers(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student_advertisement = new student_advertisement;
        $data['student_applied_companies'] = $student_advertisement->findInternshipOfferDetails($arr['StudentId']);
        
        if(!empty($data['student_applied_companies'])){
            for($i = 0; $i < count($data['student_applied_companies']); $i++){
                $createdAt = $data['student_applied_companies'][$i]->CreatedAt;
                $date = explode(" ", $createdAt);
                $data['student_applied_companies'][$i]->date = $date[0];
            }
        }
        //show($data);
        $this-> view('Student/InternshipOffers',$data);
    }
    function studentReply(){
        $data = [];
        $advertisementId = $_GET['advertisementId'];
        $response = $_GET['response']; 
        
        $student_advertisement = new student_advertisement;
        
        if($response == 'accept'){
            try {
                $this->beginTransaction();
                $result = $student_advertisement->updateJobStatus($advertisementId,$_SESSION['USER'] -> StudentId, 'Recruit');
                if(!$result){
                    throw new Exception("Error accepting the offer.");
                }
                
                $data['Details'] = $student_advertisement->findAppliedCompaniesByAdvertisementId($_SESSION['USER'] -> StudentId, $advertisementId);
                
                $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                $data['ActivityDescription'] = "Accepted ".$data['Details'][0]->position ." offer from ".$data['Details'][0]->Name;
                $student_activity = new student_activity;
                $result3 = $student_activity->insert($data);
                if(!$result3){
                    throw new Exception("Error inserting data into student_activity table");
                }

                $action['actor_id'] = $_SESSION['USER'] -> StudentId;
                $action['actor_role'] = 'Student';
                $action['target_id'] = $advertisementId;
                $action['target_type'] = 'Advertisement';
                $action['action_type'] = 'Applied';

                $actionLog = new Action_logs;
                $isInsert3 = $actionLog ->insert($action);

                if(!$isInsert3){
                    throw new Exception("Error inserting data into action_logs table");
                }
                $_SESSION['success'] = "You have accepted the offer successfully.";
                // Commit transaction
                $this->commit(); 

                //show($data);
                redirect('Student/StudentDash/dashboard');
                return true;
            } catch (Exception $e) {
                $this->rollback();
                $_SESSION['errors'] = "Error deleting complaint: " . $e -> getMessage();
                //show($_SESSION);
                redirect('Student/StudentDash/dashboard');
                return false;
            }

        }
        if($response == 'reject'){
            try {
                $this->beginTransaction();
                $result = $student_advertisement->updateJobStatus($advertisementId,$_SESSION['USER'] -> StudentId, 'Reject');
                if(!$result){
                    throw new Exception("Error accepting the offer.");
                }
                $data['Details'] = $student_advertisement->findAppliedCompaniesByAdvertisementId($_SESSION['USER'] -> StudentId, $advertisementId);

                $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                $data['ActivityDescription'] = "Rejected ".$data['Details'][0]->position ." offer from ".$data['Details'][0]->Name;
                $student_activity = new student_activity;
                $result3 = $student_activity->insert($data);
                if(!$result3){
                    throw new Exception("Error inserting data into student_activity table");
                }
                $result2 =$student_advertisement->deleteAllOtherStudentApplications($_SESSION['USER'] -> StudentId);
                if(!$result2){
                    throw new Exception("Error deleting Ohter Applications.");
                }

                $action['actor_id'] = $_SESSION['USER'] -> StudentId;
                $action['actor_role'] = 'Student';
                $action['target_id'] = $advertisementId;
                $action['target_type'] = 'Advertisement';
                $action['action_type'] = 'Reject';

                $actionLog = new Action_logs;
                $isInsert3 = $actionLog ->insert($action);

                if(!$isInsert3){
                    throw new Exception("Error inserting data into action_logs table");
                }
                $_SESSION['success'] = "You have rejected the offer successfully.";
                // Commit transaction
                $this->commit(); 

                //show($data);
                redirect('Student/StudentDash/dashboard');
                return true;
            } catch (Exception $e) {
                $this->rollback();
                $_SESSION['errors'] = "Error deleting complaint: " . $e -> getMessage();
                //show($_SESSION);
                redirect('Student/StudentDash/dashboard');
                return false;
            }

        }
        redirect('Student/StudentDash/dashboard');
    }
}

