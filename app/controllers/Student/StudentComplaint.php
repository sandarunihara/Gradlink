<?php

class StudentComplaint{
    use BaseController;
    use Model;
    public function complaint(){
        $data = [];

        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $complaint = new complaint;
        $data['Complaints'] = $complaint -> where($arr,[], '', 'do_not_order');
        $this-> view('Student/Complaint', $data);

    }
    public function newComplaint(){
        $data = [];

        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            try {
                $this->beginTransaction();

                $data['ComplaintId'] = "complaint_" . rand();
                $data['Topic'] = $_POST['topic'];
                $data['Description'] = $_POST['description'];
                $data['StudentId'] = $_SESSION['USER'] -> StudentId;
                $data['Status'] = "notReviewed";
    
                $student_advertisement = new student_advertisement;
                $data['CompanyId'] = $student_advertisement -> findRecruitCompany($arr['StudentId']);
                
                $complaint = new complaint;
                $isInsert1 = $complaint -> insert($data);
                
                if(!$isInsert1){
                    throw new Exception("Error inserting data into complaint table");
                }
                $pdc_coordinator = new pdc_coordinator;
                $active['active'] = 1;
                $data['CoordinatorId'] = $pdc_coordinator -> where($active, [], '', 'do_not_order')[0] -> CoordinatorId;
                
                $pdc_coordinator_complaint = new pdc_coordinator_complaint;
                $isInsert2 = $pdc_coordinator_complaint -> insert($data);
                
                if(!$isInsert2){
                    throw new Exception("Error inserting data into pdc_coordinator_complaint table");
                }
                $data['ActivityDescription'] = "Added a new complaint";
                $student_activity = new student_activity;
                $isInsert3 = $student_activity -> insert($data);
    
                if(!$isInsert3){
                    throw new Exception("Error inserting data into student_activity table");
                }
                
                $_SESSION['success'] = "Complaint added successfully";
                
                $this->commit();
                
                redirect('Student/StudentComplaint/complaint');
                return true;
            } catch (Exception $e) {
                $this->rollback();
                $_SESSION['errors'] = "Transaction failed: " . $e->getMessage();
                
                redirect('Student/StudentComplaint/complaint');
                return false;
            }
        }else{
            $this-> view('Student/NewComplaint', $data);
        }
    }
    public function viewComplaint($complaintId){
        $data = [];
        $arr['ComplaintId'] = $complaintId;
       
        $complaint = new complaint;
        $data['Complaint'] = $complaint -> first($arr);

        $createdDate = (explode(' ', $data['Complaint'] -> CreatedAt))[0];
        $createdTime = (explode(' ', $data['Complaint'] -> CreatedAt))[1];
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $createdDateTime = new DateTime($createdDate . ' ' . $createdTime);
        $currentDateTime = new DateTime($currentDate . ' ' . $currentTime);

        $interval = $createdDateTime -> diff($currentDateTime);
        if($data['Complaint'] -> Status == "notReviewed" && $createdDate == $currentDate){
            if($interval -> i <= 30){
                $data['Complaint'] -> Delete = 1;
            }else{
                $data['Complaint'] -> Delete = 0;
            }
        }else{
            $data['Complaint'] -> Delete = 0;
        }
        $this-> view('Student/ComplaintView', $data);
    }
    public function deleteComplaint(){
        $complaintId = $_GET['complaintId'];
        $data = [];

        try {
            $this->beginTransaction();

            $complaint = new complaint;
            $isDelete1 = $complaint -> delete($complaintId, 'ComplaintId');

            if($isDelete1){
                throw new Exception("Error deleting complaint");
            }
            $pdc_coordinator_complaint = new pdc_coordinator_complaint;
            $isDelete2 = $pdc_coordinator_complaint -> delete($complaintId, 'ComplaintId');

            if($isDelete2){
                throw new Exception("Error deleting complaint from pdc_coordinator_complaint table");
            }

            $student_activity = new student_activity;
            $data['ActivityDescription'] = "Deleted a complaint";
            $isInsert = $student_activity -> insert($data);

            if(!$isInsert){
                throw new Exception("Error inserting data into student_activity table");
            }
            $_SESSION['success'] = "Complaint deleted successfully";

            $this->commit();
            redirect('Student/StudentComplaint/complaint');
            return true;

        } catch (Exception $e) {
            $this->rollback();
            $_SESSION['errors'] = "Error deleting complaint: " . $e -> getMessage();
            redirect('Student/StudentComplaint/complaint');
            return false;
        }
    }
}