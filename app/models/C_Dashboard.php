<?php

class C_Dashboard
{
    use Model;

    protected $table1 = 'advertisement';
    protected $table = 'studentadvertisement';

    protected $allowedColumns = ['StudentId', 'CompanyId', 'AdvertisementId', 'CV', 'Interview_mark', 'Jobstatus', 'CreatedAt'];

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
            studentadvertisement.*,
            student.*,
            advertisement.*,
            GROUP_CONCAT(student_skill.Skill SEPARATOR ', ') AS Skills
          FROM 
            studentadvertisement
          JOIN 
            student ON studentadvertisement.StudentId = student.StudentId
          JOIN 
            advertisement ON studentadvertisement.AdvertisementId = advertisement.advertisementId
          LEFT JOIN 
            student_skill ON student.StudentId = student_skill.StudentId
          WHERE 
            advertisement.advertisementId = :advertisementId
          GROUP BY 
            student.StudentId";


        // Bind the parameters and execute the query
        $params = [
            ':advertisementId' => $advertisementId
        ];

        $result = $this->query($query, $params); // Assuming `query` method handles the prepared statement
        return $result;
    }


    function findapplicant($companyID)
    {
        // SQL query to fetch student applications along with student and company info
        $query = "
        SELECT 
            sa.StudentId,
            s.Name AS StudentName,
            s.DegreeName,
            s.Email AS StudentEmail,
            s.ContactNum AS StudentContact,
            s.NIC,
            sa.cv AS UploadedCV,
            sa.AdvertisementId,
            a.position,
            sa.Jobstatus,
            sa.CreatedAt AS ApplicationDate,
            sa.Interview_mark,
            c.Name AS CompanyName
        FROM 
            studentadvertisement sa
        JOIN 
            student s ON sa.StudentId = s.StudentId
        JOIN 
            advertisement a ON sa.AdvertisementId = a.advertisementId
        JOIN 
            company c ON a.CompanyId = c.CompanyId
        WHERE 
            c.CompanyId = :companyID
    ";

        // Bind the parameter and execute the query
        $params = [
            ':companyID' => $companyID
        ];

        $result = $this->query($query, $params); // Assuming `query` handles prepared statements
        return $result;
    }


    public function update($id1, $id2, $data, $id_columns = ['StudentId', 'AdvertisementId'])
    {
        try {
            // Remove unwanted data if specified
            if (!empty($this->allowedColumns)) {
                foreach ($data as $key => $value) {
                    if (!in_array($key, $this->allowedColumns)) {
                        unset($data[$key]);
                    }
                }
            }

            $keys = array_keys($data);
            $query = "UPDATE $this->table SET ";

            foreach ($keys as $key) {
                $query .= $key . " = :$key, ";
            }

            $query = trim($query, ", ");

            // Build the WHERE clause with both keys
            $query .= " WHERE {$id_columns[0]} = :{$id_columns[0]} AND {$id_columns[1]} = :{$id_columns[1]}";

            // Add the IDs to the data array
            $data[$id_columns[0]] = $id1;
            $data[$id_columns[1]] = $id2;

            // Execute the query
            $this->query($query, $data);
            // Return success message if update is successful
            return [
                'status' => true,
                'message' => 'Record updated successfully.'
            ];
        } catch (Exception $e) {
            // Catch any errors and return an error message
            return [
                'status' => false,
                'message' => 'Failed to update record: ' . $e->getMessage()
            ];
        }
    }

    public function deletead($conditions)
    {
        // Build the WHERE clause dynamically from the $conditions array
        $whereClauses = [];
        foreach ($conditions as $column => $value) {
            $whereClauses[] = "$column = :$column";
        }

        $whereSQL = implode(' AND ', $whereClauses);
        $query = "DELETE FROM $this->table WHERE $whereSQL";

        // Execute the query and check if successful
        $success = $this->query($query, $conditions);
        if (!$success) {
            return true;
        } else {
            return false;
        }
    }
}
