<?php

class PDC_Session {
    use Model;

    protected $table = 'session';

    public function validate($data) {
    $this->errors = [];

    //var_dump($data);

    //var_dump($data);

    if (empty($data['session_name'])) {
        $this->errors['session_name'] = "Session name is required";
    }
    if (empty($data['company_name'])) {
        $this->errors['company_name'] = "Company name is required";
    }
    if (empty($data['email'])) {
        $this->errors['email'] = "Email is required";
    }
    if (empty($data['contact_person'])) {
        $this->errors['contact_person'] = "Contact person is required";
    }
    if (empty($data['contact_number'])) {
        $this->errors['contact_number'] = "Contact number is required";
    }
    if (empty($data['hall_number'])) {
        $this->errors['hall_number'] = "Hall number is required";
    }
    if (empty($data['session_date'])) {
        $this->errors['session_date'] = "Session date is required";
    }
    if (empty($data['time_slot'])) {
        $this->errors['time_slot'] = "Time slot is required";
    }

    var_dump($this->errors);
    return empty($this->errors);
    }

    public function findall()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->query($query);
        return $result;
    }

    public function find($id){
        $query = "SELECT * FROM $this->table WHERE session_id = :id";
        $params = [':id' => $id];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }

    public function remove($id){
        $query = "DELETE FROM $this->table WHERE session_id = :id";
        $params = [':id' => $id];
        return $this->query($query, $params);
    }

    public function findby($column,$data){
        $query = "SELECT * FROM $this->table WHERE $column = :data LIMIT 1";
        $params = [':data' => $data];
        $result = $this->query($query, $params);
        return $result ? $result[0] : false;
    }

}