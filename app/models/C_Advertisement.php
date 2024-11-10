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
        if (empty($data['qualification'])) {
            $this->errors['qualification'] = "qualification is required";
        }
        if (empty($data['numOfInterns'])) {
            $this->errors['numOfInterns'] = "interns is required";
        }
        if (empty($data['workingMode'])) {
            $this->errors['workingMode'] = "worktype is required";
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
