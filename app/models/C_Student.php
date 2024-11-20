<?php 

class C_Student{
    use Model;

    protected $table = 'student';
    function findbyId($StudentId)
    {
        $query = "SELECT * FROM $this->table WHERE StudentId = :StudentId";
    
        // Prepare the query
        $result = $this->query($query, ['StudentId' => $StudentId]);
        return $result;
    }

    
}