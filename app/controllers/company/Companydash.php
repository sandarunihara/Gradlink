<?php

class Companydash
{
    use BaseController;
    public function dashboard()
    {
        $user = "";
        $barchartdata = [];
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $actionlogmodel=new Action_logs;
        $blockreson='';
        if($user->Status == 'Blocked'){
            $blockreson=$actionlogmodel->findDetailsforblockcompany($user->CompanyId,'block')[0]->reason;
        }

        
        // show($_SESSION);
        $model = new C_Dashboard;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");


        // foreach($alldata as $advertisement){
        //     if($advertisement->status != 'Trash'){
        //         $data[]=$advertisement;
        //     }
        // }

        if (empty($data)) {
            $hasShortlisted = false;
            $hasRecruited = false;
            $_SESSION['hasShortlisted'] = $hasShortlisted;
            $_SESSION['hasRecruited'] = $hasRecruited;
            $this->view('Company/Dashboard', ['data' => [], 'numOfStudents' => 0, 'numOfShortlistStudents' => 0, 'numOfAdvertisements' => 0,'numOfcurrentmothAD'=>0,'lastmonthcount'=>0, 'barchartdata' => [], 'studentstatuschart' => [], 'countedadstatus' => [], 'monthlyCounts' => [] , 'Status'=>$user->Status ,'blockreson'=>$blockreson]);
        } else {
            // $ad_model = new C_Advertisement;
            // $ad_data = $ad_model->findall();
            // show($data);
            $numOfAdvertisements = count($data);
            
            $allStatuses = ["Active", "Deactive", "Pending", "Rejected"];
            $advertisementIds = [];
            $currentmothadvertisments=[];
            foreach ($data as $item) {
                $advertisementIds[] = $item->advertisementId;
                $adstatus[] = $item->status;
                if(date('Y-m', strtotime($item->created_at)) == date('Y-m')){
                    $currentmothadvertisments[]=$item;
                }
            }
            if(!empty($currentmothadvertisments)){
                $numOfcurrentmothAD=count($currentmothadvertisments);
            }else{
                $numOfcurrentmothAD=0;
            }
            

            $countedadstatus = array_count_values($adstatus);
            foreach ($allStatuses as $status) {
                if (!isset($countedadstatus[$status])) {
                    $countedadstatus[$status] = 0;
                }
            }



            $studentIds = [];
            $shortliststudentIds = [];
            $pendingstudentIds = [];
            $recruitstudentIds = [];
            $rejectstudentIds = [];
            $reqdata = [];
            $shortliststudent = [];
            $hasShortlisted = false;
            $hasRecruited = false;
            foreach ($advertisementIds as $id) {
                $applystudent = $model->find(['advertisementId' => $id], 'studentadvertisement');
                $addata2 = $model->find(['advertisementId' => $id], "advertisement");

                $applystudent2[] = $model->find(['advertisementId' => $id], 'studentadvertisement');
                if (!empty($applystudent)) {
                    $co = count($applystudent);
                } else {
                    $co = 0;
                }
                $chart = [
                    'label' => $addata2[0]->position,
                    'count' => $co
                ];
                $barchartdata[] = $chart;
                if (!empty($applystudent)) {
                    if (is_array($applystudent) || is_object($applystudent)) {
                        foreach ($applystudent as $student) {
                            $studentIds[] = $student->StudentId;
                        }
                    }
                } else {
                    $ss = [];
                }
                $shortliststudent = $model->find(['advertisementId' => $id, 'Jobstatus' => 'Shortlist'], 'studentadvertisement');
                $pendingstudent = $model->find(['advertisementId' => $id, 'Jobstatus' => 'Pending'], 'studentadvertisement');
                $recruitstudent = $model->find(['advertisementId' => $id, 'Jobstatus' => 'Recruit'], 'studentadvertisement');
                $rejectstudent = $model->find(['advertisementId' => $id, 'Jobstatus' => 'Reject'], 'studentadvertisement');
                if (!empty($shortliststudent)) {
                    if (is_array($shortliststudent) || is_object($shortliststudent)) {
                        foreach ($shortliststudent as $student) {
                            $shortliststudentIds[] = $student->StudentId;
                        }
                    }
                } else {
                    $ss = [];
                }
                if (!empty($pendingstudent)) {
                    if (is_array($pendingstudent) || is_object($pendingstudent)) {
                        foreach ($pendingstudent as $student) {
                            $pendingstudentIds[] = $student->StudentId;
                        }
                    }
                } else {
                    $ss = [];
                }
                if (!empty($recruitstudent)) {
                    if (is_array($recruitstudent) || is_object($recruitstudent)) {
                        foreach ($recruitstudent as $student) {
                            $recruitstudentIds[] = $student->StudentId;
                        }
                    }
                } else {
                    $ss = [];
                }
                if (!empty($rejectstudent)) {
                    if (is_array($rejectstudent) || is_object($rejectstudent)) {
                        foreach ($rejectstudent as $student) {
                            $rejectstudentIds[] = $student->StudentId;
                        }
                    }
                } else {
                    $ss = [];
                }
                $data = $model->findreq($id);
                if (!empty($data)) {
                    if (is_array($data) || is_object($data)) {
                        foreach ($data as $item) {
                            if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled' || $item->Jobstatus == 'Interview Expired') {
                                $hasShortlisted = true;
                            }

                            if ($item->Jobstatus === 'Recruit') {
                                $hasRecruited = true;
                            }
                            $reqdata[] = [
                                'Name' => $item->Name,
                                'Position' => $item->position,
                                'Status' => $item->Jobstatus
                            ];
                        }
                    }
                } else {
                    $ss = [];
                }
            }
            // show($applystudent2);
            $monthlyCounts = [];
            $dates = [];

            // Extract all available dates
            foreach ($applystudent2 as $applications) {
                if (is_array($applications)) {
                    foreach ($applications as $student) {
                        $dates[] = strtotime($student->CreatedAt); // Convert dates to timestamps
                    }
                }
            }

            // If there are no dates, return an empty array
            if (empty($dates)) {
                $dates = [];
            }

            sort($dates); // Sort the dates in ascending order
            if(!empty($dates)){
                $earliestDate = $dates[0]; // Earliest date
            }else{
                $earliestDate=time();
            }
            $today = time();
            $latestDate = $today; // Latest date


            // Calculate the number of unique months in the dataset
            $currentDate = $earliestDate;
            $uniqueMonths = [];
            while ($currentDate < $latestDate) {
                $key = date("Y M", $currentDate); // Get year and month as a key
                $uniqueMonths[$key] = true;
                $currentDate = strtotime("+1 month", $currentDate); // Move to the next month
            }
            $latestMonthKey = date("Y M", $latestDate);
            $uniqueMonths[$latestMonthKey] = true;
            // show($uniqueMonths);
            // If less than 12 unique months, extend backward
            while (count($uniqueMonths) < 12) {
                $earliestDate = strtotime("-1 month", $earliestDate);
                $key = date("Y M", $earliestDate);
                $uniqueMonths[$key] = true;
            }

            // Generate a full 12-month period
            $uniqueMonths = array_reverse($uniqueMonths); // Reverse to add months from earliest to latest
            $monthlyCounts = array_fill_keys(array_keys($uniqueMonths), 0);
            // show($monthlyCounts);

            foreach ($applystudent2 as $applications) {
                if (is_array($applications)) {
                    foreach ($applications as $student) {
                        $yearMonthKey = date("Y M", strtotime($student->CreatedAt));

                        if (isset($monthlyCounts[$yearMonthKey])) {
                            $monthlyCounts[$yearMonthKey]++;
                        }
                    }
                }
            }
            uksort($monthlyCounts, function ($a, $b) {
                return strtotime($a) - strtotime($b);
            });
            $lastmonthcount = end($monthlyCounts);
            // Interview Schedule rerender
            $TodayDate = date('Y-m-d');
            $interviewmodel = new interview_time_slot;
            $admodal = new C_Advertisement;
            $appliedadmodal = new C_Dashboard;
            $interviewdata = [];
            foreach ($advertisementIds as $id) {
                $interview_para = [
                    'advertisementId' => $id
                ];
                $interviewdata[] = $interviewmodel->find($interview_para);
            }
            if (!empty($interviewdata)) {
                foreach ($interviewdata as $adinterview) {
                    if (!empty($adinterview)) {
                        foreach ($adinterview as $inter) {
                            if ($inter->Date < $TodayDate) {
                                $adkeys=[
                                    'StudentId'=>$item->StudentId,
                                    'advertisementId'=>$item->advertisementId
                                ];
                                $da=$appliedadmodal->find($adkeys,'studentadvertisement');
                                if($da[0]->Jobstatus == 'Interview Scheduled'){
                                    $appliedadmodal->update($item->StudentId,$item->advertisementId,['Jobstatus'=>'Interview Expired']);
                                }
                                if($da[0]->Jobstatus == 'Reject' || $da[0]->Jobstatus == 'Recruit'){
                                    $interviewmodel->delete($item->InterviewId,'InterviewId');
                                }
                            }
                        }
                    }
                }
            }





            $numOfapplyStudents = count($studentIds);
            $numOfshortlistStudents = count($shortliststudentIds);
            $numOfpendingStudents = count($pendingstudentIds);
            $numOfrecruitStudents = count($recruitstudentIds);
            $numOfrejectStudents = count($rejectstudentIds);

            $studentstatuschart = [
                ['label' => 'Shortlist', 'count' => $numOfshortlistStudents],
                ['label' => 'Pending', 'count' => $numOfpendingStudents],
                ['label' => 'Recruit', 'count' => $numOfrecruitStudents],
                ['label' => 'Reject', 'count' => $numOfrejectStudents]
            ];


            $_SESSION['hasShortlisted'] = $hasShortlisted;
            $_SESSION['hasRecruited'] = $hasRecruited;

            $this->view('Company/Dashboard', ['data' => $reqdata, 'numOfStudents' => $numOfapplyStudents, 'numOfShortlistStudents' => $numOfshortlistStudents, 'numOfAdvertisements' => $numOfAdvertisements, 'numOfcurrentmothAD'=>$numOfcurrentmothAD,'lastmonthcount'=>$lastmonthcount , 'barchartdata' => $barchartdata, 'studentstatuschart' => $studentstatuschart, 'countedadstatus' => $countedadstatus, 'monthlyCounts' => $monthlyCounts , 'Status'=>$user->Status,'blockreson'=>$blockreson]);
            // $this->view('Company/Dashboard', ['data' => [], 'numOfStudents' => 0, 'numOfShortlistStudents' => 0, 'numOfAdvertisements' => 0,'numOfcurrentmothAD'=>0, 'barchartdata' => [], 'studentstatuschart' => [], 'countedadstatus' => [], 'monthlyCounts' => [] , 'Status'=>$user->Status]);

        }
    }

    public function calendar()
    {
        $this->view('Company/Calendar');
    }



    public function renderoption($componentName, $componentProps = [])
    {
        $fileName = "../app/views/Company/" . $componentName . ".view.php";
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            echo "Component not found";
        }
    }
}
