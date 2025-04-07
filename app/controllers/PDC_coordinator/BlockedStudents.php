<?php
class BlockedStudents
{
    use Controller;
    public function index()
    {
        // redirect("company-dashboard");
        // $model = new company;
        // $data = $model->findAllBlocked();

        // if($data == false || empty($data)){
        //     $this->view('Coordinator/Company/blockedStudents');
        // }
        // else{
        //     $blockedCompanyData = [];

        //     foreach ($data as $companydetail) {
        //         $blockedCompanyData[] = [
        //             'company_id' => $companydetail->CompanyId,
        //             'company_name' => $companydetail->Name,
        //             'email' => $companydetail->Email,
        //             'contact_person' => $companydetail->ContactPerson,
        //             'contact_number' => $companydetail->ContactNum,
        //             'comment' => $companydetail->commentBlock,
        //             'status' => $companydetail->Status,
        //         ];
        //     }
        // $this->view('Coordinator/Company/blockedStudents', ['blockedCompanyData' => $blockedCompanyData]);

        // }

        $this->view('Coordinator/Student/blockedStudents');
    }
}

