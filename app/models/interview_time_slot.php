<?php
class interview_time_slot
{

    use Model;

    protected $table = 'interview_time_slot';

    protected $allowedColumns = [
        'StudentId',
        'CompanyId',
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
}
