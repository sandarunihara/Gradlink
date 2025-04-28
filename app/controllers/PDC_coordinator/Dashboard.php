<?php
class Dashboard
{
    use Controller;
    public function index()
    {
        $companyModel = new company;
        $studentModel = new Student;
        $advertisementModel = new C_Advertisement;
        $coordinatorModel = new Coordinator_Dash;
        $companyModel = new company;

        $totalCompanies = $companyModel->getTotalCount();
        $totalStudents = $studentModel->registeredCount();
        $totalAdvertisements = $advertisementModel->OngoingAdvertisementCount();
        $unreadComplaints = $coordinatorModel->unreadComplaintsCount();
        $readComplaints = $coordinatorModel->readComplaintsCount();
        $complaintCount = $readComplaints + $unreadComplaints;
        
        
        $jobRolesData = $coordinatorModel->jobRoles();
        $sessions = $coordinatorModel->getScheduledSessions();
        $roundModel = new Round;
        $round = $roundModel->getActiveRound();

        $totalApplications = $coordinatorModel->totalApplicationsCount();
        $recruitedCount = $coordinatorModel->recruitedCount();

        $pendingAdvertisements = $coordinatorModel->pendingAdvertisementCount();
        $pendingCompanies = $coordinatorModel->pendingCompanyCount();
        $pendingApprovals = $pendingAdvertisements + $pendingCompanies;

        $blockedCompanies = $coordinatorModel->blockedCompanyCount();
        $blockedStudents = $coordinatorModel->blockedStudentCount();

        if ($totalCompanies === null || $totalStudents === null || $totalAdvertisements === null) {
            $this->view('Coordinator/Company/dashboard');
            return;
        }

                        

        $dashboardData = [];
        $applicationGraph = [];
        $sessionData = [];

        $dashboardData = [
            'companyCount' => $totalCompanies ?? 0,
            'studentCount' => $totalStudents ?? 0,
            'ongoingAdvertisementCount' => $totalAdvertisements ?? 0,
            'unreadComplaints' => $unreadComplaints ?? 0,
            'resolvedComplaints' => $readComplaints ?? 0,
            'complaintCount' => $complaintCount ?? 0,
            'totalApplications' => $totalApplications ?? 0,
            'recruitedStudents' => $recruitedCount ?? 0,
            'pendingApprovals' => $pendingApprovals ?? 0,
            'pendingAdvertisements' => $pendingAdvertisements ?? 0,
            'pendingCompanies' => $pendingCompanies ?? 0,
            'blockedCompanies' => $blockedCompanies ?? 0,
            'blockedStudents' => $blockedStudents ?? 0,
        ];

            
        

        if (is_array($sessions)) { // Ensure $sessions is an array before looping
            foreach ($sessions as $session) {
                $sessionDate = new DateTime($session->session_date); // Use object property
                $formattedDate = $sessionDate->format('Y-m-d');

                $company = $companyModel->findById($session->CompanyId);
                $companyName = (!empty($company) && isset($company->Name)) ? $company->Name : 'Unknown Company';

                $sessionData[$formattedDate][] = [
                    'session_id' => $session->session_id,
                    'session_name' => $session->session_name,
                    'hall' => $session->hall_number,
                    'time' => $session->time_slot,
                    'description' => $session->description,
                    'Company' => $companyName,
                    'formattedDate' => $sessionDate
                ];

                // $sessionData[$formattedDate][] = $session->session_name; // Use object property
            }
        }

        // echo '<pre>';
        // print_r($sessionData);
        // echo '</pre>';

        $this->view('Coordinator/Company/dashboard', ['dashboardDetails' => $dashboardData, 'InternPositions' => $jobRolesData, 'sessions' => $sessionData, 'round' => $round]);
    }



}
