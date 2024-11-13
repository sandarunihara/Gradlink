<?php

class StudentProfile{
    use Controller;
    public function profile(){
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student = new student;
        //$email = new StudentEmail;
        $interestedArea = new student_interest_area;
        // $contactNum = new StudentContactNum;
        // $github = new StudentGithub;
        // $linkedin = new StudentLinkedin;
        // $profilePic = new StudentProfilePic;
        // $qualification = new Qualification;
        // $experience = new Experience;
        // $certificate = new Certificate;


        $data['Student'] = $student -> first($arr);
        //$data['Email'] = $email -> first($arr);
        $data['InterestedArea'] = $interestedArea -> first($arr);
        // $data['ContactNum'] = $contactNum -> first($arr);
        // $data['Github'] = $github -> first($arr);
        // $data['Linkedin'] = $linkedin -> first($arr);
        // $data['ProfilePic'] = $profilePic -> first($arr);
        

        //where function should come here but its not working
        // show($arr);
        // echo gettype($arr);
        // $data['Qualification'] = $qualification -> where($arr);
        // $data['Experience'] = $experience -> where($arr);
        // $data['Certificate'] = $certificate -> where($arr);


        $this-> view('Student/Profile',$data);
    }
    public function profileEdit(){        
        $data =[];

        if($_SERVER['REQUEST_METHOD'] == "POST"){    
            $arr['UserId'] = $_SESSION['USER'] -> StudentId;
            //$contactNum = new StudentContactNum;
            
            
            show($_POST);
            $data['Result'] = $contactNum -> update($arr['StudentId'], $_POST, 'UserId');
            //$this -> view('Student/ProfileEdit',$data);
            show($data);
        }

        $this-> view('Student/ProfileEdit');

    }
}