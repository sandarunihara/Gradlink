<?php
class Dashboard
{
    use Controller;
    public function index()
    {
        $companyModel = new company;
        $studentModel = new Student;

        $totalCompanies = $companyModel->getTotalCount();
        $totalStudents = $studentModel->count();

        if (empty($totalCompanies)) {
            $this->view('Coordinator/Company/dashboard');
        }else{
            $dashboardData = [];

            $dashboardData = [
                'companyCount' => $totalCompanies ?? 0,
                'studentCount'=> $totalStudents ??0,
            ];


            $this->view('Coordinator/Company/dashboard', ['dashboardDetails'=> $dashboardData]);
        }

        
    }
}
