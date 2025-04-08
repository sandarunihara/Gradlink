<?php

class AdminDashboardOverview{
    use Controller;
    public function dashboard(){

        $studentModel = new Student;
        $regStdCount = $studentModel->registeredCount();
        $workingStdCount = $studentModel->workingCount();
        $rejectedStdCount = $studentModel->rejectedCount();
        $appliedStdCount = $studentModel->appliedCount();
        $notAppliedStdCount = $studentModel->notAppliedCount();

        $companyModel = new Company;
        $regCompCount = $companyModel->registeredCount();

        $advertisementModel = new C_Advertisement;
        $topAdd = $advertisementModel->topAdvertisement();
        $topCom = $advertisementModel->topCompanyByAdd();

        $roundModel = new Round;
        $round = $roundModel->getRound();

        //var_dump($round);

        $data = [
            'cards'=> [
                'registeredStdCount' => $regStdCount,
                'workingStdCount' => $workingStdCount,
                'registeredCompCount' => $regCompCount,
                'rejectedStdCount' => $rejectedStdCount,
                'appliedStdCount' => $appliedStdCount,
                'notAppliedStdCount' => $notAppliedStdCount,
                'round' => $round
            ],
            'table' =>[],
            'company' => []
        ];

        foreach($topAdd as $advertisement){
            $data['table'][] = [
                'advertisementId' => $advertisement->advertisementId,
                'position' => $advertisement->position,
                'deadline' => $advertisement->deadline,
                'workingMode' => $advertisement->workingMode,
                'companyName' => $advertisement->Name,
            ];
        }

        foreach($topCom as $company){
            $data['company'][] = [
                'CompanyId' => $company->CompanyId,
                'Name' => $company->Name,
                'profileimg' => $company->profileimg,
            ];
        }

        //var_dump($data['table'][0]['companyName']);

        $this-> view('PDC_admin/Dashboard/DashboardOverview' , $data);
    } 
}
