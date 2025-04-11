<?php

    class PendingCompany{
        use Controller;
        public function dashboard(){
            $model = new company;
            $companyData = $model->findAllPending();
            $this->view('PDC_admin/Company/CompanyPending', [
                'companyData' => $companyData,
                'activeTab' => 'pending-companies'
            ]);
        } 
    }