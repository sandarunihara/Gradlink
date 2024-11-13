<?php

class Companydash
{
    use Controller;
    public function dashboard()
    {
        $user = "";
        if (isset($_SESSION['USER'])) {
            $user = $_SESSION['USER'];
        }
        $model = new C_Dashboard;
        $data = $model->findId();
        
        $advertisementIds = []; // Array to store all advertisement IDs
        // Loop through the result set and collect advertisement IDs
        foreach ($data as $item) {
            $advertisementIds[] = $item->advertisementId;
        }
        
        $studentIds=[];
        $shortliststudentIds=[];
        $reqdata=[];
        foreach($advertisementIds as $id){
            $applystudent=$model->find(['advertisementId'=>$id],'studentadvertisement');
            foreach($applystudent as $student){
                $studentIds[]=$student->RegNumber;
            }
            $data=$model->findreq($id);
            foreach ($data as $item) {
                $reqdata[] = [
                    'Name' => $item->Name,
                    'Position' => $item->position,
                    'Status' => $item->Jobstatus
                ];
            }
        }
        $numOfapplyStudents = count($studentIds);


        $shortliststudent=$model->find(['Jobstatus'=>'shortlist'],'studentadvertisement');
            foreach($shortliststudent as $student){
                $shortliststudentIds[]=$student->RegNumber;
            }
            $numOfshortlistStudents = count($shortliststudentIds);

            $ad_model=new C_Advertisement;
            $ad_data=$ad_model->findall();
            // finddata($companyid) 
            $numOfAdvertisements = count($ad_data);



        $this->view('Company/Dashboard', ['data' => $reqdata, 'numOfStudents' => $numOfapplyStudents, 'numOfShortlistStudents' => $numOfshortlistStudents, 'numOfAdvertisements' => $numOfAdvertisements]);
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
