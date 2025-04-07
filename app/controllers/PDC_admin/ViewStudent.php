<?php

    class ViewStudent{
        use Controller;

        public function show($studentId) {
            $model = new student;
            $applyDetails = new student_advertisement;
            $company = new company;
            $studentData = $model->find($studentId);
            //$id = $studentData[0] -> StudentId;
            $studentapply = $applyDetails->findAppliedCompanies($studentId);
            //var_dump($studentapply);

            $data = [
                'StudentId'=> $studentData -> StudentId,
                'Name'=> $studentData -> Name,
                'NIC'=> $studentData -> NIC,
                'DegreeName'=> $studentData -> DegreeName,
                'Status'=> $studentData -> Status,
                'Email'=> $studentData -> Email,
                'ContactNum'=> $studentData -> ContactNum,
                'Github'=> $studentData -> Github,
                'Linkedin'=> $studentData -> Linkedin,
                'applications'=> []
                
            ];

            
            if (is_array($studentapply) || is_object($studentapply)) {
                foreach ($studentapply as $apply) {
                    $data['applications'][] = [
                        'Jobstatus' => $apply->Jobstatus,
                        'CreatedAt' => $apply->CreatedAt,
                        'position' => $apply->position,
                        'ComName' => $apply->Name,
                        'CompanyLogo' => $apply->profileimg
                    ];
                }
            } else {
                $studentapply = [];
            }
            
            $this-> view('PDC_admin/Student/StudentView' , $data);
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
            $model = new student;
            $errors = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'StudentId' => $_POST['StudentId'],
                    'NIC' => $_POST['NIC'],
                    'Name' => $_POST['Name'],
                    'Email' => $_POST['Email'],
                    'ContactNum' => $_POST['ContactNum'],
                    'DegreeName' => $_POST['DegreeName'],
                    'Status' => $_POST['Status']
                ];


                if ($model->validate($data)) {
                    $updatedStatus = $model->update($studentId, $data, 'StudentId');

                    if ($updatedStatus && $updatedStatus['status'] === 'success') {
                        redirect('PDC_admin/AdminStudentOverview/dashboard');
                        exit;
                    } else {
                        $errors['general'] = "Error: Could not update the student.";
                    }
                } else {
                    $errors = $model->errors;
                }
            }

            $data = $model->find($studentId);
            if (!$data) {
                $errors['general'] = "No student data found for the given ID.";
            }

            $this->view('PDC_admin/Student/StudentView', ['student' => $data, 'errors' => $errors]);

        }

        public function block($studentId){
            $model = new student;
            $studentData = $model->find($studentId);
            if($studentData->Status != 'Blocked'){
                $data = [
                    'Status' => 'Blocked'
                ];
                $updatedStatus = $model->update($studentId, $data, 'StudentId');
                if($updatedStatus && $updatedStatus['status'] === 'success'){
                    redirect('PDC_admin/BlockStudent/dashboard');
                    exit;
                }
                else{
                    echo "Error: Could not block the student.Already Blocked";
                }
            }
        }

        public function unblock($studentId){
            $model = new student;
            $studentData = $model->find($studentId);
            if($studentData->Status == 'Blocked'){
                $data = [
                    'Status' => 'Not Applied'
                ];
                $updatedStatus = $model->update($studentId, $data, 'StudentId');
                if($updatedStatus && $updatedStatus['status'] === 'success'){
                    redirect('PDC_admin/AdminStudentOverview/dashboard');
                    exit;
                }
                else{
                    echo "Error: Could not unblock the student.";
                }
            }
        }

    }