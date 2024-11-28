<?php

class Companydash
{
    use BaseController;
    public function dashboard()
    {
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }

        $model = new C_Dashboard;
        $data = $model->find(['CompanyId' => $user->CompanyId], "advertisement");

        if (empty($data)) {

            $this->view('Company/Dashboard', ['data' => [], 'numOfStudents' => 0, 'numOfShortlistStudents' => 0, 'numOfAdvertisements' => 0]);
        } else {
            // $ad_model = new C_Advertisement;
            // $ad_data = $ad_model->findall();
            $numOfAdvertisements = count($data);

            $advertisementIds = []; // Array to store all advertisement IDs
            // // Loop through the result set and collect advertisement IDs
            foreach ($data as $item) {
                $advertisementIds[] = $item->advertisementId;
            }

            $studentIds = [];
            $shortliststudentIds = [];
            $reqdata = [];
            $shortliststudent = [];
            $hasShortlisted = false;
            $hasRecruited = false;
            foreach ($advertisementIds as $id) {
                $applystudent = $model->find(['advertisementId' => $id], 'studentadvertisement');
                if (!empty($applystudent)) {
                    if (is_array($applystudent) || is_object($applystudent)) {
                        foreach ($applystudent as $student) {
                            $studentIds[] = $student->StudentId;
                        }
                    }
                } else {
                    $ss = [];
                }
                $shortliststudent = $model->find(['advertisementId' => $id, 'Jobstatus' => 'Shortlist'], 'studentadvertisement');
                if (!empty($shortliststudent)) {
                    if (is_array($shortliststudent) || is_object($shortliststudent)) {
                        foreach ($shortliststudent as $student) {
                            $shortliststudentIds[] = $student->StudentId;
                        }
                    }
                } else {
                    $ss = [];
                }
                $data = $model->findreq($id);
                if (!empty($data)) {
                    if (is_array($data) || is_object($data)) {
                        foreach ($data as $item) {
                            if ($item->Jobstatus === 'Shortlist' || $item->Jobstatus === 'Interview Scheduled') {
                                $hasShortlisted = true;
                            }

                            if ($item->Jobstatus === 'Recruit') {
                                $hasRecruited = true;
                            }
                            $reqdata[] = [
                                'Name' => $item->Name,
                                'Position' => $item->position,
                                'Status' => $item->Jobstatus
                            ];
                        }
                    }
                } else {
                    $ss = [];
                }
            }
            $numOfapplyStudents = count($studentIds);
            $numOfshortlistStudents = count($shortliststudentIds);

            $_SESSION['hasShortlisted'] = $hasShortlisted;
            $_SESSION['hasRecruited'] = $hasRecruited;

            $this->view('Company/Dashboard', ['data' => $reqdata, 'numOfStudents' => $numOfapplyStudents, 'numOfShortlistStudents' => $numOfshortlistStudents, 'numOfAdvertisements' => $numOfAdvertisements]);
        }
    }

    public function calendar()
    {
        $this->view('Components/calendar');
    }



    public function renderoption($componentName, $componentProps = [])
    {
        $fileName = "../app/views/Company/" . $componentName . ".view.php";
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            echo "Component not found";
        }
    }
}
