<?php
class interview_time_slot
{

    use Model;

    protected $table = 'interview_time_slot';

    protected $allowedColumns = [
        'StudentId',
        'CompanyId',
        'advertisementId',
        'Date',
        'StartTime',
        'EndTime'
    ];

    function find($data)
    {
        $keys = array_keys($data);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        $query = trim($query, "AND "); // Trim the trailing "AND"
        $result = $this->query($query, $data);
        return $result;
    }

    function findall() {
        $query = "SELECT * FROM $this->table";
    
        $result = $this->query($query);
        return $result;
    }
    function findInterviews($studentId) {
		$query = "SELECT 
                    interview_time_slot.Date AS InterviewDate,
                    interview_time_slot.StartTime AS StartTime,
                    advertisement.position AS Position, 
                    company.Name AS CompanyName
              FROM 
                    interview_time_slot
              JOIN 
                    advertisement ON interview_time_slot.advertisementId = advertisement.advertisementId
              JOIN 
                    company ON advertisement.CompanyId = company.CompanyId
              WHERE 
                    interview_time_slot.StudentId = :StudentId
              ORDER BY 
                    interview_time_slot.Date ASC
              LIMIT 10 OFFSET 0";
        $params = [
            ':StudentId' => $studentId
        ];
        $result = $this->query($query, $params);

        return $result;
    }
    public function deleteinterview($conditions) {
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
