<?php

class StudentComplaint{
    use Controller;
    public function complaint(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $complaint = new complaint;
        $student = new student;
        
        $data['Complaints'] = $complaint -> where($arr,[], 'Date', 'do_not_order');
        //show($data['Complaints']);
        //show($data['Complaints'][0] -> Status);

        $data['Student'] = $student -> first($arr);
        $this-> view('Student/Complaint', $data);

    }
    public function newComplaint(){
        $data = [];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        $student = new student;
        $data['Student'] = $student -> first($arr);
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
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;
        $student = new student;
        $data['Student'] = $student -> first($arr);        
        
        $arr1['ComplaintId'] = $complaintId;
       
        $complaint = new complaint;
        $data['Complaint'] = $complaint -> first($arr1);
        
        $pdc_coordinator_complaint = new pdc_coordinator_complaint;
        $data['CoordinatorComplaint'] = $pdc_coordinator_complaint -> where($arr1, [], 'Date', 'do_not_order');
        
        $this-> view('Student/ViewComplaint', $data);
    }
    public function deleteComplaint($complaintId){
        $complaint = new complaint;
        $pdc_coordinator_complaint = new pdc_coordinator_complaint;

        //has error when try to delete a with foreign key constraints
        // $result = $complaint -> delete($complaintId, 'ComplaintId');
        // echo $result;
        echo "has error when try to delete a with foreign key constraints";
    }
}