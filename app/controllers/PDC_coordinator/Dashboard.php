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

        $totalCompanies = $companyModel->getTotalCount();
        $totalStudents = $studentModel->count();
        $totalAdvertisements = $advertisementModel->OngoingAdvertisementCount();

        $pendingCSCount = $coordinatorModel->pendingCSCount();
        $rejectedCSCount = $coordinatorModel->rejectedCSCount();
        $recruitedCSCount = $coordinatorModel->recruitedCSCount();

        if ($totalCompanies === null || $totalStudents === null || $totalAdvertisements === null) {
            $this->view('Coordinator/Company/dashboard');
            return;
        }

        if ($pendingCSCount === null || $rejectedCSCount === null || $recruitedCSCount === null) {
            $this->view('Coordinator/Company/dashboard');
            return;
        }
         
            $dashboardData = [];
            $applicationGraph = [];

            $dashboardData = [
                'companyCount' => $totalCompanies ?? 0,
                'studentCount' => $totalStudents ?? 0,
                'ongoingAdvertisementCount' => $totalAdvertisements ?? 0,
            ];

            $applicationGraph = [
                'pendingCSCount' => $pendingCSCount ?? 0,
                'rejectedCSCount' => $rejectedCSCount ?? 0,
                'recruitedCSCount'=> $recruitedCSCount ?? 0,
                
            ];

            // echo '<pre>';
            // print_r($applicationGraph);
            // echo '</pre>';

            $this->view('Coordinator/Company/dashboard', ['dashboardDetails' => $dashboardData, 'applicationAnalysis' => $applicationGraph]);
        }


    
}
