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

        if (empty($totalCompanies) || empty($totalStudents) || empty($totalAdvertisements)) {
            $this->view('Coordinator/Company/dashboard');
        } elseif (empty($pendingCSCount)) {
            $this->view('Coordinator/Company/dashboard');
        } else {
            $dashboardData = [];
            $applicationGraph = [];

            $dashboardData = [
                'companyCount' => $totalCompanies ?? 0,
                'studentCount' => $totalStudents ?? 0,
                'ongoingAdvertisementCount' => $totalAdvertisements ?? 0,
            ];

            $applicationGraph = [
                'pendingCSCount' => $pendingCSCount ?? 0,
            ];

            // echo '<pre>';
            // print_r($applicationGraph);
            // echo '</pre>';

            $this->view('Coordinator/Company/dashboard', ['dashboardDetails' => $dashboardData, 'applicationAnalysis' => $applicationGraph]);
        }


    }
}
