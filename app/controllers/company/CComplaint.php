<?php

class CComplaint
{
    use Controller;

    public function dashboard()
    {

        $model=new complaint;
        $complaints=[
            'CompanyId'=>$_SESSION['USER']->CompanyId
        ];
        $data = $model -> where($complaints,[], '', 'do_not_order');
        // show($data);
        $this->view('Company/Complaint',['data'=>$data]);
    }

    public function viewComplaint()
    {
        $this->view('Company/ViewComplaint');
    }

    public function addComplaint()
    {
        $model=new complaint;

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $complaintdata=[
                'ComplaintId'=> "complaint_" . rand(),
                'Topic'=>$_POST['topic'],
                'Description'=>$_POST['description'],
                'CompanyId'=>$_SESSION['USER']->CompanyId,
                'Status'=>"notReviewed"
            ];
            $result=$model->insert($complaintdata);
            if($result == true){
                $_SESSION['flash'] = [
                    'type' => 'success',
                    'message' => 'Your complaint has been recorded. Thank you for reaching out!'
                ];
                header('Location: http://localhost/Gradlink/public/company/CComplaint/dashboard');
                exit;
            }else{
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Failed to submit your complaint. Please try again later'
                ];
                header('Location: http://localhost/Gradlink/public/company/CComplaint/addComplaint');
                exit;
            }

        }
        
        $this->view('Company/AddComplaint');
    }
}