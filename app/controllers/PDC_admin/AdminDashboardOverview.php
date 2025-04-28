<?php

class AdminDashboardOverview{
    use Controller;
    public function dashboard(){

        $studentModel = new Student;
        $regStdCount = $studentModel->registeredCount();
        $workingStdCount = $studentModel->workingCount();
        //$rejectedStdCount = $studentModel->rejectedCount();
        //$appliedStdCount = $studentModel->appliedCount();
        $notAppliedStdCount = $studentModel->notAppliedCount();
        //$weeklyStudent = $studentModel->getWeeklyStudent();
        //$weeklyRecruitment = $studentModel->getWeeklyRecruitedStudent();

        $companyModel = new Company;
        $regCompCount = $companyModel->registeredCount();
        // $weeklyCompany = $companyModel->getWeeklyCompany();
        $pendingCom = $companyModel->pendingCount();
        $pendingCompanies = $companyModel->findAllPending();

        $advertisementModel = new C_Advertisement;
        $topAdd = $advertisementModel->topAdvertisement();
        $topCom = $advertisementModel->topCompanyByAdd();
        $adds = $advertisementModel->findallActivewithCompanyByDate();

        //show($adds);
        //$weeklyAdvertisement = $advertisementModel->getWeeklyAdvertisement();
        $pendingAds = $advertisementModel->findAllPendingcount();
        $activeAds = $advertisementModel->OngoingAdvertisementCount();

        $sessions = new PDC_Session;
        $session = $sessions->sessionCount();

        $unregSession = new PDC_Unreg_Session;
        $unregSessionCount = $unregSession->unregSessionCount();

        $activeSession = $session + $unregSessionCount;
        
        //show($activeSession);

        $roundModel = new Round;
        $round = $roundModel->getActiveRound();


        $importStudent = new StudentImport;
        $importcount = $importStudent->getCount();

        $notification = new Admin_notification;
        $allNotifications = $notification->notificationCount();

        $adNotifications = $notification->countAdv();
        $pdcNotifications = $notification->countPdc();

        //show($allNotifications);

        $data = [
            'cards'=> [
                'registeredStdCount' => $regStdCount,
                'workingStdCount' => $workingStdCount,
                'registeredCompCount' => $regCompCount,
                'notAppliedStdCount' => $notAppliedStdCount,
            ],
            'table' =>[],
            'company' => [],
            'round' => $round,
            'pendingCom' => $pendingCom,
            'pendingAds' => $pendingAds,
            'pendingCompanies' => $pendingCompanies,
            'activeSession' => $activeSession,
            'importcount' => $importcount,
            'activeAds' => $activeAds,
            'allNotifications' => $allNotifications,
            'adNotifications' => $adNotifications,
            'pdcNotifications' => $pdcNotifications,
        ];

        //show($adds);

        for ($i = 0; $i <= 2; $i++) {
            if (!isset($adds[$i])) continue;
            if (!is_object($adds[$i])) continue;
        
            $data['table'][$i] = [
                'advertisementId' => $adds[$i]->advertisementId ?? null,
                'position' => $adds[$i]->position ?? null,
                'deadline' => $adds[$i]->deadline ?? null,
                'workingMode' => $adds[$i]->workingMode ?? null,
                'companyName' => $adds[$i]->Name ?? null,
                'profileimg' => $adds[$i]->profileimg ?? null
            ];
        }

        for ($i = 0; $i <= 1; $i++){
            if (!isset($topCom[$i])) continue;
            if (!is_object($topCom[$i])) continue;

            $data['company'][$i] = [
                'CompanyId' => $topCom[$i]->CompanyId ?? null,
                'companyName' => $topCom[$i]->Name ?? null,
                'profileimg' => $topCom[$i]->profileimg ?? null,
                'email' => $topCom[$i]->Email ?? null,
            ];
        }

        $this-> view('PDC_admin/Dashboard/DashboardOverview' , $data);
    } 
}
