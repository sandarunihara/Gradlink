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
    
            $model = new student; // Initialize the student model
            $errors = []; // Initialize errors array

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

                // Validate and update student details
                if ($model->validate($data)) {
                    $updatedStatus = $model->update($studentId, $data, 'StudentId');

                    if ($updatedStatus && $updatedStatus['status'] === 'success') {
                        redirect('PDC_admin/AdminStudentOverview/dashboard');
                        exit;
                    } else {
                        $errors['general'] = "Error: Could not update the student.";
                    }
                } else {
                    $errors = $model->errors; // Pass validation errors from the model
                }
            }

            // Fetch existing student data if it's a GET request or validation failed
            $data = $model->find($studentId);
            if (!$data) {
                $errors['general'] = "No student data found for the given ID.";
            }

            // Pass the student data and errors to the view
            $this->view('PDC_admin/Student/StudentView', ['student' => $data, 'errors' => $errors]);

        }

    }