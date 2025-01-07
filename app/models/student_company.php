<?php

class student_company
{
    use Model;

    protected $table = 'student_company';

    protected $allowedColumns = [
        'StudentId',
        'CompanyId',
        'StartDate',
        'EndDate',
    ];

    public function findByStudentId($data) {
        // Check if $data is an associative array or a single value
        if (is_array($data)) {
            $keys = array_keys($data);
            $query = "SELECT * FROM student_company WHERE ";
        
            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }
        
            $query = trim($query, "AND "); // Trim the trailing "AND"
            
            $result = $this->query($query, $data);
        } else {
            // Assume $data is a single ID (like CompanyId)
            $query = "SELECT * FROM student_company WHERE StudentId = :StudentId";
            $result = $this->query($query, ['StudentId' => $data]);
        }
    
        return $result;
    }
}
