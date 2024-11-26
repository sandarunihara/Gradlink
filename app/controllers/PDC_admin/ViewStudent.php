<?php

    class ViewStudent{
        use Controller;

        public function show($studentId) {
            $model = new student;
            $data = $model->find($studentId);
    
            if ($data) {
                $this->view('PDC_admin/Student/StudentView', ['student' => $data]);
            } else {
                echo "No data found";
            }
        }

        // public function remove($studentId){
        //     $model = new student;
        //     $data = $model->delete($studentId,'StudentId');
        //     if ($data) {
        //         redirect('PDC_admin/AdminStudentOverview/dashboard');
        //         exit;
        //     } else {
        //         echo "Error: Could not delete the session.";
        //     }
        // }

        public function edit($studentId)
        {
    
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
                //var_dump($_POST);
    
                $data = [
                    'StudentId' => $_POST['StudentId'],
                    'NIC' => $_POST['NIC'],
                    'Name' => $_POST['Name'],
                    'Email' => $_POST['Email'],
                    'DegreeName' => $_POST['DegreeName'],
                    'Status' => $_POST['Status']
                ];
    
                //var_dump(is_array($data));
    
                $model = new student;
                if($model->validate($data)){
                    $updatedStatus = $model->update($studentId,$data,'StudentId');
                    //var_dump($updatedStatus);
                    var_dump($updatedStatus['status']);
    
                    if($updatedStatus && $updatedStatus['status'] === 'success'){
                        redirect('PDC_admin/AdminStudentOverview/dashboard');
                        exit;
                    }
                    else{
                        echo "Error: Could not update the student.";
                    }
                }
                else{
                    echo "Error: Could not validate the data.";
                }
            }
            else{
                $model = new student;
                $data = $model->find($StudentId);
                if ($data) {
                    $this->view('PDC_admin/Student/StudentEdit', ['student' => $data]);
                } else {
                    echo "No data found";
                }
            }
        }

    }