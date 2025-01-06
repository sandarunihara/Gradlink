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

        return $this->errors;
    }

    public function find($data) {
        // Check if $data is an associative array or a single value
        if (is_array($data)) {
            $keys = array_keys($data);
            $query = "SELECT * FROM advertisement WHERE ";
        
            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }
        
            $query = trim($query, "AND "); // Trim the trailing "AND"
            
            $result = $this->query($query, $data);
        } else {
            // Assume $data is a single ID (like CompanyId)
            $query = "SELECT * FROM advertisement WHERE advertisementId = :advertisementId";
            $result = $this->query($query, ['advertisementId' => $data]);
        }
    
        return $result;
    }
    

    function findall() {
        $query = "SELECT * FROM advertisement";
    
        $result = $this->query($query);
        return $result;
    }

    public function gethighestadid()
    {
       $query = "SELECT advertisementId FROM advertisement ORDER BY advertisementId DESC LIMIT 1";
       $result = $this->query($query);
        return $result ? $result[0]->advertisementId : null;
        
    }

    public function delete1($id, $id_column) {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
        
        // Execute the query
        $stmt = $this->query($query, $data);
        //show($stmt);
        if (is_array($stmt)) {
            $stmt = (object) $stmt;
        }

        if ($stmt && $stmt->rowCount() > 0) {
            return "Record deleted successfully.";
        } else {
            return 'false';
        }
    }
    
}
