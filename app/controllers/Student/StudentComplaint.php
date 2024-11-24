<?php

class StudentComplaint{
    use Controller;
    public function complaint(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $complaint = new complaint;
        $data['Complaints'] = $complaint -> where($arr,[], '', 'do_not_order');

        $this-> view('Student/Complaint', $data);

    }
    public function newComplaint(){
        $data = [];
        $this-> view('Student/NewComplaint', $data);

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $data['Date'] = $_POST['date'];
            $data['Topic'] = $_POST['topic'];
            $data['Description'] = $_POST['description'];
            $data['StudentId'] = $_SESSION['USER'] -> StudentId;
            $data['Status'] = "notReviewed";
            
            $complaint = new complaint;
            $result = $complaint -> insert($data);
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
            if(!($interval -> h >= 1)){
                if($interval -> i <= 30){
                    $data['Complaint'] -> Delete = 1;
                }else{
                    $data['Complaint'] -> Delete = 0;
                }
            }else{
                $data['Complaint'] -> Delete = 0;
            }
        }else{
            $data['Complaint'] -> Delete = 0;
        }
        $this-> view('Student/ComplaintView', $data);
    }
    public function deleteComplaint($complaintId){
        $complaint = new complaint;
        $result = $complaint -> delete($complaintId, 'ComplaintId');
        echo $result. 'but complaint is deleted';
    }
}