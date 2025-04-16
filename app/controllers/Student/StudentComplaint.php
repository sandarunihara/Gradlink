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
                
                // Commit transaction
                $this->commit();
                return true;
            } catch (Exception $e) {
                $this->rollback(); // Rollback transaction on error
                $_SESSION['errors'] = "Transaction failed: " . $e->getMessage();
                return false;
            }
            
            //show($data);
            redirect('Student/StudentComplaint/complaint');
        }else{
            $this-> view('Student/NewComplaint', $data);
        }
    }
    public function viewComplaint($complaintId){
        $data = [];
        $arr['ComplaintId'] = $complaintId;
       
        $complaint = new complaint;
        $data['Complaint'] = $complaint -> first($arr);

        if($data['Complaint'] -> Status === "reviewed"){
            $pdc_coordinator_complaint = new pdc_coordinator_complaint;
            $data['CoordinatorComplaint'] = $pdc_coordinator_complaint -> first($arr);
        }
        //set up the delete button
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
        //show($data);
        $this-> view('Student/ComplaintView', $data);
    }
    public function deleteComplaint(){
        $complaintId = $_GET['complaintId'];
        $data = [];
        $complaint = new complaint;
        $_SESSION['isDelete'] = $complaint -> delete($complaintId, 'ComplaintId');
        redirect('Student/StudentComplaint/complaint');
    }
}