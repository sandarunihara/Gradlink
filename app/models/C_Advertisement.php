<?php

class C_Advertisement{
    use Model;
    
    protected $table = 'advertisement';

    public function validate($data)
    {
        $this->errors = [];
        if (empty($data['position'])) {
            $this->errors['position'] = "position is required";
        } 
        if (empty($data['description'])) {
            $this->errors['description'] = "description is required";
        }
        if (empty($data['qualifications'])) {
            $this->errors['qualifications'] = "qualifications is required";
        }
        if (empty($data['period'])) {
            $this->errors['period'] = "period is required";
        }
        if (empty($data['interns'])) {
            $this->errors['interns'] = "interns is required";
        }
        if (empty($data['worktype'])) {
            $this->errors['worktype'] = "worktype is required";
        }
        if (empty($data['deadline'])) {
            $this->errors['deadline'] = "deadline is required";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    function find($data) {
        $keys = array_keys($data);
        $query = "SELECT * FROM advertisement WHERE ";
    
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }
    
        $query = trim($query, "AND "); // Trim the trailing "AND"
        
        $result = $this->query($query, $data);
        return $result;
    }

    function findall() {
        $query = "SELECT * FROM advertisement";
    
        $result = $this->query($query);
        return $result;
    }

    
}
