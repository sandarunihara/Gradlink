<?php

class PDC_Session
{
    use Model;

    protected $table = 'session';

    protected $allowedColumns = [

		'session_id',
		'session_name',
		'hall_number',
		'session_date',
		'time_slot',
        'description',
        'CompanyId',
        'deleted',
        'message_read',
        'created_at'
	];

    public function validate($data)
    {
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

    public function getAvailableTimeSlotsAndDates($hall_number){
        $query = "SELECT session_date, time_slot 
                  FROM $this->table 
                  WHERE hall_number = :hall_number
                  AND deleted = 0
                  ;";
                  
        $params = [':hall_number' => $hall_number];
        $result = $this->query($query, $params);
        return $result ? $result : [];
    }

    public function getAvailableHallAndTimeSlots($session_date){
        $query = "SELECT hall_number, time_slot 
                  FROM $this->table 
                  WHERE session_date = :session_date
                  AND session_date >= CURDATE() AND deleted = 0
                  ;";
                  
        $params = [':session_date' => $session_date];
        $result = $this->query($query, $params);
        return $result ? $result : [];
    }

    public function findall()
    {
        $query = "SELECT c.*,s.* 
                  FROM $this->table s
                  JOIN company c ON s.CompanyId = c.CompanyID
                  WHERE s.session_date >= CURDATE() AND s.deleted = 0
                  ";
        $result = $this->query($query);
        return $result;
    }

    public function findCompleted(){
        $query = "SELECT c.*,s.* 
                  FROM $this->table s
                  JOIN company c ON s.CompanyId = c.CompanyID
                  WHERE s.session_date < CURDATE() AND s.deleted = 0
                  ";
        $result = $this->query($query);
        return $result;
    }

    public function findUnregistered(){
        $query = "SELECT * 
                  FROM $this->table 
                  WHERE session_date >= CURDATE()
                  AND CompanyId IS NULL
                  ";

        $result = $this->query($query);
        return $result;
    }

    public function find($id)
    {
        $query = "SELECT c.*,s.*
                 FROM session s 
                 JOIN company c ON s.CompanyId = c.CompanyID
                 WHERE s.session_id = :id
                 ;";
        $params = [':id' => $id];
        $result = $this->query($query , $params);
        return $result ? $result[0] : false;
    }

    public function remove($id)
    {
        $query = "DELETE FROM $this->table WHERE session_id = :id";
        $params = [':id' => $id];
        return $this->query($query, $params);
    }

    public function findby($column, $data)
    {
        $query = "SELECT * FROM $this->table WHERE $column = :data LIMIT 1";
        $params = [':data' => $data];
        $result = $this->query($query, $params);
        return $result ? $result[0] : false;
    }

    public function findSessions($date)
    {
        $query = "SELECT * FROM session WHERE session_date = :date OR session_date > :date";
        $params = [':date' => $date];
        $result = $this->query($query, $params);
        return $result ? $result : false;
    }

    public function findSessionWithCompany()
    {
        $query = "SELECT session.*, company.Name 
        FROM 
        session 
        JOIN company ON session.CompanyId = company.CompanyId";
        $result = $this->query($query);
        return $result ? $result : false;
    }
}
