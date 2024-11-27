<?php

class ViewSession {
    use Controller;

    public function show($sessionId) {
        $model = new PDC_Session;
        $data = $model->find($sessionId);

        if ($data) {
            $this->view('PDC_admin/Session/SessionView', ['session' => $data]);
        } else {
            echo "No data found";
        }
    }

    public function remove($sessionId)
    {
        $model = new PDC_Session;
        $data = $model->delete($sessionId,'session_id');
        if ($data) {
            redirect('PDC_admin/AdminSessionOverview/dashboard');
            exit;
        } else {
            echo "Error: Could not delete the session.";
        }
    }

    public function edit($sessionId)
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            //var_dump($_POST);
            $model = new PDC_Session;
            $errors = [];

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

            //var_dump(is_array($data));

            $model = new PDC_Session;
            if($model->validate($data)){
                $updatedStatus = $model->update($sessionId,$data,'session_id');

                if($updatedStatus && $updatedStatus['status'] === 'success'){
                    redirect('PDC_admin/AdminSessionOverview/dashboard');
                    exit;
                }
                else{
                    $errors['general'] = "Error: Could not update the student.";
                }    
            }
            else{
                $errors = $model->errors;
            }
        }
        $data = $model->find($sessionId);
            if (!$data) {
                $errors['general'] = "No student data found for the given ID.";
            }
            $this->view('PDC_admin/Session/SessionView', ['session' => $data, 'errors' => $errors]);
        
        }
}