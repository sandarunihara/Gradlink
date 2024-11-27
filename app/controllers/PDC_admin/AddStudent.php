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
                'Status' => $_POST['Status'],
                'ContactNum' => $_POST['ContactNum'],
            ];

            if($model->validate($data)){
                $model->insert($data);
                redirect('PDC_admin/AddStudent/dashboard');
            }
            else{
                $errors = $model->errors;
                $this->view('PDC_admin/Student/AddStudent', [
                    'errors' => $model->errors,
                    'old_data' => $data
                ]);
            }
        }
            
    }