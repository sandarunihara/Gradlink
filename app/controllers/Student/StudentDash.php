<?php

class Studentdash{
    use BaseController;
    public function dashboard(){
        
        $data =[];
        $arr['StudentId'] = $_SESSION['USER'] -> StudentId;

        $student_advertisement = new student_advertisement;
        $data['student_applied_companies'] = $student_advertisement->findAppliedCompanies($arr['StudentId']);
        
        $student_activity = new student_activity;
        $data['student_activities'] = $student_activity->findLeatest($arr['StudentId']);

        $data['numOfAppliedCompanies'] = 0;
        $data['intenshipOffers'] = 0;
        if(empty($data['student_applied_companies'])){
            $data['numOfAppliedCompanies'] = 0;
        }else{
            foreach ($data['student_applied_companies'] as $company) {
                if($company->Jobstatus == "Accept"){
                    $data['intenshipOffers']++;
                }
                if ($company->Jobstatus == "Pending" || $company->Jobstatus == "Shortlisted") {
                    $data['numOfAppliedCompanies']++;
                }
            }
        }

        $interview_time_slot = new interview_time_slot;
        $data['interview_time_slot'] = $interview_time_slot->findInterviews($arr['StudentId']);
        if (!empty($data['interview_time_slot'])) {
            $dateString = $data['interview_time_slot'][0] -> InterviewDate;
            $monthNumber = substr($dateString, 5, 2);
            $month = DateTime::createFromFormat('!m', $monthNumber);
            $data['monthName'] = $month->format('F');
            $date = DateTime::createFromFormat('Y-m-d', $dateString);
            $data['day'] = $date->format('jS');
        }

        $interviewData = $interview_time_slot->findInterviews($arr['StudentId']);

        $sessionModel = new PDC_Session;
        $sessionData = $sessionModel->findAllUpcomingSessions();

        //show($data);
        $this-> view('Student/Dashboard',['data'=> $data, 'interviewData' => $interviewData, 'sessionData' => $sessionData]);
    }  
}

