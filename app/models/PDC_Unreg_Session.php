<?php 

class PDC_Unreg_Session{
    use Model;

    protected $table = 'unregistered_session';
    protected $allowedColumns = [
        'session_id',
        'session_name',
        'hall_number',
        'session_date',
        'time_slot',
        'description',
        'other_company_name',
        'email',
        'contact_number',
        'contact_person',
        'deleted'
    ];

    public function validate($data){
        $this->errors = [];
        if (empty($data['session_name']) || strlen($data['session_name']) < 3) {
            $this->errors['session_name'] = "Session name must be at least 3 characters long.";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email address.";
        }
        if (!preg_match('/^\+?[0-9]{10,15}$/', $data['contact_number'])) {
            $this->errors['contact_number'] = "Invalid contact number.";
        }
        if (empty($data['hall_number'])) {
            $this->errors['hall_number'] = "Hall number is required.";
        }
        if (empty($data['session_date']) || strtotime($data['session_date']) < time()) {
            $this->errors['session_date'] = "Session date must be a valid future date.";
        }
        if (empty($data['time_slot'])) {
            $this->errors['time_slot'] = "Time slot is required.";
        }
        return empty($this->errors);
    }

    public function findAll(){
        $query = "SELECT * FROM $this->table WHERE deleted = 0";
        $result = $this->query($query);
        return $result ? $result : [];
    }

    public function getAvailableHallAndTimeSlots($session_date){
        $query = "SELECT hall_number, time_slot 
                  FROM $this->table 
                  WHERE session_date = :session_date
                  AND session_date >= CURDATE() AND deleted = 0
                  ";
                  
        $params = [':session_date' => $session_date];
        $result = $this->query($query, $params);
        return $result ? $result : [];
    }

    public function find($sessionId){
        $query = "SELECT * FROM $this->table WHERE session_id = :session_id";
        $params = [':session_id' => $sessionId];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }



}

