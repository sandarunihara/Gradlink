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
        $this-> view('Student/NewComplaint');

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $data = [];
            $data['StudentId'] = $_SESSION['USER'] -> StudentId;
            $data['Date'] = $_POST['date'];
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