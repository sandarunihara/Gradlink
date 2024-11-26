<?php
    class AddStudent{
        use Controller;
        public function dashboard(){

            $model = new student;
            $data = $model->findall();

            if($data == false || empty($data)){
                $this->view('PDC_admin/Student/AddStudent');
            }
            else{
                $studentData = [];

                foreach($data as $student){
                    $studentData[] = [
                        'StudentId' => $student->StudentId,
                        'Name' => $student->Name,
                        'DegreeName' => $student->DegreeName,
                        'Status' => $student->Status,
                        'ShortDesc' => $student->ShortDesc,
                        'Email' => $student->Email,
                        'ContactNum' => $student->ContactNum,
                        'Github' => $student->Github,
                        'Linkedin' => $student->Linkedin
                    ];
                }
                $this->view('PDC_admin/Student/StudentOverview', ['studentData' => $studentData]);
            }
        }
        
        public function showAddForm() {
            $this->view('PDC_admin/Student/AddStudent');
        }

        public function submit(){
            $model = new student;
            $data = [
                'StudentId' => $_POST['StudentId'],
                'NIC' => $_POST['NIC'],
                'Name' => $_POST['Name'],
                'Email' => $_POST['Email'],
                'DegreeName' => $_POST['DegreeName'],
                'Status' => $_POST['Status']
            ];

            // $existingSession = $model->findBy('session_name', $data['session_name']);
            // if ($existingSession) {
            //     $_SESSION['error'] = "The session name already exists. Please choose a different one.";
            //     header("Location: " . ROOT . "/PDC_admin/AddSession/showAddForm");
            //     exit;
            // }

            // if (!preg_match('/^\+?[0-9]{10,15}$/', $data['contact_number'])) {
            //     $_SESSION['error'] = "Invalid phone number. It must be 10-15 digits long and can start with a '+'.";
            //     header("Location: " . ROOT . "/PDC_admin/AddSession/showAddForm");
            //     exit;
            // }

            // $query = "SELECT * FROM session WHERE session_date = :session_date AND time_slot = :time_slot AND hall_number = :hall_number";
            // $params = [
            //     ':session_date' => $data['session_date'],
            //     ':time_slot' => $data['time_slot'],
            //     ':hall_number' => $data['hall_number']
            // ];

            // $existingSession = $model->query($query, $params);
            // if ($existingSession) {
            //     $_SESSION['error'] = "A session already exists in the selected hall at the selected time. Please choose a different time or hall.";
            //     header("Location: " . ROOT . "/PDC_admin/AddSession/showAddForm");
            //     exit;
            // }

            //var_dump($data);
            if($model->validate($data)){
                $model->insert($data);
                redirect('PDC_admin/AddStudent/dashboard');
            }
            else{
                echo "Validation failed";
                $errors = $model->errors;
                $this->view('PDC_admin/Student/AddStudent', ['errors' => $errors]);
            }
        }
            
    }