<?php
    class AddSession{
        use Controller;
        public function dashboard(){

            $model = new PDC_Session;
            $data = $model->findall();

            if($data == false || empty($data)){
                $this->view('PDC_admin/Session/AddSession');
            }
            else{
                $sessionData = [];

                foreach($data as $session){
                    $sessionData[] = [
                        'session_id' => $session->session_id,
                        'session_name' => $session->session_name,
                        'company_name' => $session->company_name,
                        'email' => $session->email,
                        'contact_person' => $session->contact_person,
                        'contact_number' => $session->contact_number,
                        'hall_number' => $session->hall_number,
                        'session_date' => $session->session_date,
                        'time_slot' => $session->time_slot
                    ];
                }
                $this->view('PDC_admin/Session/SessionOverview', ['sessionData' => $sessionData]);
            }
        }
        
        public function showAddForm() {
            $this->view('PDC_admin/Session/AddSession');
        }

        public function submit(){
            $model = new PDC_Session;
            $data = [
                'session_name' => $_POST['session_name'],
                'company_name' => $_POST['company_name'],
                'email' => $_POST['email'],
                'contact_person' => $_POST['contact_person'],
                'contact_number' => $_POST['contact_number'],
                'hall_number' => $_POST['hall_number'],
                'session_date' => $_POST['session_date'],
                'time_slot' => $_POST['time_slot']
            ];


            $query = "SELECT * FROM session WHERE session_date = :session_date AND time_slot = :time_slot AND hall_number = :hall_number";
            $params = [
                ':session_date' => $data['session_date'],
                ':time_slot' => $data['time_slot'],
                ':hall_number' => $data['hall_number']
            ];

            $existingSession = $model->query($query, $params);
            if ($existingSession) {
                $_SESSION['error'] = "A session already exists in the selected hall at the selected time. Please choose a different time or hall.";
                $this->view('PDC_admin/Session/AddSession', [
                    'errors' => $_SESSION['error'],
                    'old_data' => $data
                ]);
                return;
            }

            if($model->validate($data)){
                $model->insert($data);
                redirect('PDC_admin/AddSession/dashboard');
            }
            else{
                $this->view('PDC_admin/Session/AddSession', [
                    'errors' => $model->errors,
                    'old_data' => $data
                ]);
            }
        }
            
    }