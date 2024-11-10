<?php

class StudentProfile{
    use Controller;
    public function profile(){
        $data =[];
        $arr['UserId'] = $_SESSION['USER'] -> UserId;

        $student = new Student;
        $email = new StudentEmail;
        $interestedArea = new StudentInterestedArea;
        $contactNum = new StudentContactNum;
        $github = new StudentGithub;
        $linkedin = new StudentLinkedin;
        $profilePic = new StudentProfilePic;

        $data['Student'] = $student -> first($arr);
        $data['Email'] = $email -> first($arr);
        $data['InterestedArea'] = $interestedArea -> first($arr);
        $data['ContactNum'] = $contactNum -> first($arr);
        $data['Github'] = $github -> first($arr);
        $data['Linkedin'] = $linkedin -> first($arr);
        $data['ProfilePic'] = $profilePic -> first($arr);


        $this-> view('Student/Profile',$data);
    }
    
}