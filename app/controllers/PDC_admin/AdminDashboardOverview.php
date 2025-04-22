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
        $weeklyStudent = $studentModel->getWeeklyStudent();
        $weeklyRecruitment = $studentModel->getWeeklyRecruitedStudent();

        $companyModel = new Company;
        $regCompCount = $companyModel->registeredCount();
        $weeklyCompany = $companyModel->getWeeklyCompany();
        $pendingCom = $companyModel->pendingCount();

        $advertisementModel = new C_Advertisement;
        $topAdd = $advertisementModel->topAdvertisement();
        $topCom = $advertisementModel->topCompanyByAdd();
        $adds = $advertisementModel->findallActivewithCompany();
        $weeklyAdvertisement = $advertisementModel->getWeeklyAdvertisement();

        $roundModel = new Round;
        $round = $roundModel->getActiveRound();

        //show($round);

        //show($weeklyRecruitment);
        //var_dump($round);
        $weeklyRecru = [];
        for ($i = 0; $i < count($weeklyRecruitment) - 1 ; $i++) {
            $current = $weeklyRecruitment[$i]->count;
            $previous = $weeklyRecruitment[$i + 1]->count;

            if ($previous == 0 || $previous == null) {
                echo "cyrtvubn";
                $change = $current > 0 ? 100 : 0;
            } else {
                $change = (($current - $previous) / $previous) * 100;
            }

            $weeklyRecru[] = [
                'week' => "Week " . $weeklyRecruitment[$i]->week,
                'count' => $current,
                'change' => round($change, 2),
                'trend' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'same')
            ];
        }

        //show($weeklyRecru);

        $weekStd = [];
        for ($i = 0; $i < count($weeklyStudent) - 1 ; $i++) {
            $current = $weeklyStudent[$i]->count;
            $previous = $weeklyStudent[$i + 1]->count;

            if ($previous == 0 || $previous == null) {
                $change = $current > 0 ? 100 : 0;
            } else {
                $change = (($current - $previous) / $previous) * 100;
            }

            $weekStd[] = [
                'week' => "Week " . $weeklyStudent[$i]->week,
                'count' => $current,
                'change' => round($change, 2),
                'trend' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'same')
            ];
        }

        $weekCom = [];
        for ($i = 0; $i < count($weeklyCompany) - 1 ; $i++) {
            $current = $weeklyCompany[$i]->count;
            $previous = $weeklyCompany[$i + 1]->count;

            if ($previous == 0 || $previous == null) {
                $change = $current > 0 ? 100 : 0;
            } else {
                $change = (($current - $previous) / $previous) * 100;
            }

            $weekCom[] = [
                'week' => "Week " . $weeklyCompany[$i]->week,
                'count' => $current,
                'change' => round($change, 2),
                'trend' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'same')
            ];
        }

        $weeklyAdd = [];
        for ($i = 0; $i < count($weeklyAdvertisement) - 1 ; $i++) {
            $current = $weeklyAdvertisement[$i]->count;
            $previous = $weeklyAdvertisement[$i + 1]->count;

            if ($previous == 0) {
                $change = $current > 0 ? 100 : 0;
            } else {
                $change = (($current - $previous) / $previous) * 100;
            }

            $weeklyAdd[] = [
                'week' => "Week " . $weeklyAdvertisement[$i]->week,
                'count' => $current,
                'change' => round($change, 2),
                'trend' => $change > 0 ? 'up' : ($change < 0 ? 'down' : 'same')
            ];
        }


        //show($weeklyStudent);

        //show($weekStd);

        $data = [
            'cards'=> [
                'registeredStdCount' => $regStdCount,
                'workingStdCount' => $workingStdCount,
                'registeredCompCount' => $regCompCount,
                'rejectedStdCount' => $rejectedStdCount,
                'appliedStdCount' => $appliedStdCount,
                'notAppliedStdCount' => $notAppliedStdCount,
            ],
            'table' =>[],
            'company' => [],
            'weekStd' => $weekStd,
            'weekCom' => $weekCom,
            'weeklyAdd' => $weeklyAdd,
            'round' => $round,
            'recuitedStd' => $weeklyRecru,
            'pendingCom' => $pendingCom,
        ];

        for($i = 0 ; $i <= 2 ; $i++){
            $data['table'][$i] = [
                'advertisementId' => $adds[$i]->advertisementId,
                'position' => $adds[$i]->position,
                'deadline' => $adds[$i]->deadline,
                'workingMode' => $adds[$i]->workingMode,
                'companyName' => $adds[$i]->Name,
            ];

            $data['company'][$i] = [
                'CompanyId' => $topCom[$i]->CompanyId,
                'companyName' => $topCom[$i]->Name,
                'profileimg' => $topCom[$i]->profileimg,
                'email' => $topCom[$i]->Email,
            ];
        };

        // show($topCom);
        // show($data['company']);

        //var_dump($data['table'][0]['companyName']);
        //show($data);

        $this-> view('PDC_admin/Dashboard/DashboardOverview' , $data);
    } 
}
