<?php

class StudentComplaint{
    use BaseController;
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
            $data['ComplaintId'] = "complaint_" . rand();
            $data['Topic'] = $_POST['topic'];
            $data['Description'] = $_POST['description'];
            $data['StudentId'] = $_SESSION['USER'] -> StudentId;
            $data['Status'] = "notReviewed";

            $student_advertisement = new student_advertisement;
            $data['CompanyId'] = $student_advertisement -> findRecruitCompany($arr['StudentId']);
            
            $complaint = new complaint;
            $_SESSION['isInsert1'] = $complaint -> insert($data);


            
            $pdc_coordinator = new pdc_coordinator;
            $active['active'] = 1;
            $data['CoordinatorId'] = $pdc_coordinator -> where($active, [], '', 'do_not_order')[0] -> CoordinatorId;
            
            $pdc_coordinator_complaint = new pdc_coordinator_complaint;
            $_SESSION['isInsert2'] = $pdc_coordinator_complaint -> insert($data);

            if($_SESSION['isInsert1'] && $_SESSION['isInsert2']){
                $_SESSION['isInsert'] = 1;
            }else{
                $_SESSION['isInsert'] = 0;
            }
            //show($data);
            header('location: ' . ROOT . '/Student/StudentComplaint/complaint/');
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
        header('location: ' . ROOT . '/Student/StudentComplaint/complaint/');
    }
}