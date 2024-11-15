<?php

class C_Dashboard
{
    use Model;

    protected $table1 = 'advertisement';
    protected $table2 = 'studentadvertisement';

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

    function find($data, $table)
    {
        $keys = array_keys($data);
        $query = "SELECT * FROM $table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        $query = trim($query, "AND "); // Trim the trailing "AND"

        $result = $this->query($query, $data);
        return $result;
    }

    function findId()
    {
        $query = "SELECT advertisementId FROM $this->table1";

        $result = $this->query($query);
        return $result;
    }

    function findreq($advertisementId)
    {
    // Prepare the SQL query with placeholders for parameters
    $query = "SELECT 
                        *
                    FROM 
                        studentadvertisement
                    JOIN 
                        student ON studentadvertisement.StudentId = student.StudentId
                    JOIN 
                        advertisement ON studentadvertisement.AdvertisementId = advertisement.advertisementId
                    WHERE 
                        advertisement.advertisementId = :advertisementId";

    // Bind the parameters and execute the query
    $params = [
        ':advertisementId' => $advertisementId
    ];

    $result = $this->query($query, $params); // Assuming `query` method handles the prepared statement
    return $result;
    }

}
