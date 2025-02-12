<?php

class Companydash
{
    use BaseController;
    public function dashboard()
    {
        $user = "";
        $barchartdata=[];
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $model = new C_Dashboard;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");

        if (empty($data)) {
            $hasShortlisted = false;
            $hasRecruited = false;
            $_SESSION['hasShortlisted'] = $hasShortlisted;
            $_SESSION['hasRecruited'] = $hasRecruited;
            $this->view('Company/Dashboard', ['data' => [], 'numOfStudents' => 0, 'numOfShortlistStudents' => 0, 'numOfAdvertisements' => 0,'barchartdata'=>[]]);
        } else {
            // $ad_model = new C_Advertisement;
            // $ad_data = $ad_model->findall();
            $numOfAdvertisements = count($data);

            $advertisementIds = []; // Array to store all advertisement IDs
            foreach ($data as $item) {
                $advertisementIds[] = $item->advertisementId;
            }
            // show($barchartlabel);
            // show($advertisementIds);


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
                // show($applystudent);
                // show($id);
                if(!empty($applystudent)){
                    $co=count($applystudent);
                }else{
                    $co=0;
                }
                $chart=[
                    'label'=>$id,
                    'count'=>$co
                ];
                $barchartdata[]=$chart;
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
                            if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled') {
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
            $numOfapplyStudents = count($studentIds);
            $numOfshortlistStudents = count($shortliststudentIds);
            $numOfpendingStudents = count($pendingstudentIds);
            $numOfrecruitStudents = count($recruitstudentIds);
            $numOfrejectStudents = count($rejectstudentIds);

            $studentstatuschart=[
                ['label'=>'Shortlist','count'=>$numOfshortlistStudents],
                ['label'=>'Pending','count'=>$numOfpendingStudents],
                ['label'=>'Recruit','count'=>$numOfrecruitStudents],
                ['label'=>'Reject','count'=>$numOfrejectStudents]
            ];

            
            $_SESSION['hasShortlisted'] = $hasShortlisted;
            $_SESSION['hasRecruited'] = $hasRecruited;
            
            $this->view('Company/Dashboard', ['data' => $reqdata, 'numOfStudents' => $numOfapplyStudents, 'numOfShortlistStudents' => $numOfshortlistStudents, 'numOfAdvertisements' => $numOfAdvertisements ,'barchartdata'=>$barchartdata,'numOfpendingStudents'=>$numOfpendingStudents,'numOfrecruitStudents'=>$numOfrecruitStudents,'numOfrejectStudents'=>$numOfrejectStudents,'studentstatuschart'=>$studentstatuschart]);
        }
    }

    public function calendar()
    {
        $this->view('Components/calendar');
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
