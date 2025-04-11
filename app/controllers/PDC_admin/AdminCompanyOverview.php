<?php

class AdminCompanyOverview {
    use Controller;

    public function dashboard() {
        $model = new company;
        $companyData = $model->findAllOngoing();

        $this->view('PDC_admin/Company/CompanyOverview', [
            'companyData' => $companyData,
            'activeTab' => 'company-list'
        ]);
    }
}
