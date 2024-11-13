<?php

class StudentComplaint{
    use Controller;
    public function complaint(){

        $data['StudentId'] = $_SESSION['USER'] -> StudentId;
        
        $complaint = new complaint;
        
        $data = $complaint -> where($data);
        //$this-> view('Student/Complaint');

    }
    public function newComplaint(){
        $this-> view('Student/NewComplaint');

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $data = [];
            $data['StudentId'] = $_SESSION['USER'] -> StudentId;
            $data['Topic'] = $_POST['topic'];
            $data['Description'] = $_POST['description'];
            $data['Status'] = "notReviewed";
            
            $complaint = new complaint;
            $result = $complaint -> insert($data);
            
            if($result){
                echo "Complaint added successfully";
            }else{
                echo "Complaint not added";
            }

        }
    }
}