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
            $count = $applyDetails->noOfAppliedCompanies($studentId);

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
                'noOfAppliedAds' => $count,
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
            //var_dump($_POST);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'StudentId' => $_POST['StudentId'],
                    'NIC' => $_POST['NIC'],
                    'Name' => $_POST['Name'],
                    'Email' => $_POST['Email'],
                    'ContactNum' => $_POST['ContactNum'],
                    'DegreeName' => $_POST['DegreeName'],
                    'Status' => $_POST['Status'],
                    'ShortDesc' => $_POST['ShortDesc'],
                ];

                $current = $model->find($studentId);

                $changedData = [];

                $fields = [
                    'StudentId',
                    'NIC',
                    'Name',
                    'Email',
                    'ContactNum',
                    'DegreeName',
                    'Status',
                    'ShortDesc'
                ];

                foreach($fields as $field){
                    if(isset($_POST[$field]) && $_POST[$field] != $current->$field){
                        $changedData[$field] = $_POST[$field];
                    }
                }

                if (empty($changedData)) {
                    $_SESSION['flash_message'] = [
                        'type' => 'info',
                        'message' => 'No changes were made'
                    ];
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                if ($model->validate($changedData , true)) {
                    $checkFields = array_intersect(['StudentId', 'NIC', 'Email', 'Name'], array_keys($changedData));
                    $conflict = false;
                    $conflictMessage = [];

                    //show($checkFields);

                    foreach ($checkFields as $field) {
                        $existing = $model->firstMatch([$field => $changedData[$field]]);
                        if ($existing && $existing->StudentId != $studentId) {
                            $conflict = true;
                            $conflictMessage[] = "The $field is already in use.";
                        }
                    }

                    // var_dump($conflictMessage);
                    // var_dump($conflict);    
                    // var_dump($existing);
                        
                if(!$conflict){
                    $updatedStatus = $model->update($studentId, $changedData, 'StudentId');
                        if ($updatedStatus && $updatedStatus['status'] === 'success'){
                            $_SESSION['flash_message'] = [
                                'type' => 'success',
                                'message' => 'Student successfully Updated'
                            ];

                            if(isset($changedData['StudentId'])){
                                $new = $changedData['StudentId'];
                                header('Location: ' . ROOT . '/PDC_admin/ViewStudent/show/' . $new);
                                exit;
                            };
                        }
                        else{
                            $_SESSION['flash_message'] = [
                                'type' => 'error',
                                'message' => 'Error: Could not update the student.'
                            ];
                        }
                }
                else{
                    $_SESSION['flash_message'] = [
                        'type' => 'error',
                        'message' => 'Student cannot be updated: ' . implode(', ', $conflictMessage)
                    ];
                }
            }
            else{
                $_SESSION['flash_message'] = [
                    'type' => 'error',
                    'message' => 'Validation failed for the provided data'
                ];
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
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