<?php

class C_Student
{
    use Model;

    protected $table = 'student';
    function findbyId($StudentId)
    {
        $query = "SELECT 
            $this->table.*,
            GROUP_CONCAT(student_skill.Skill SEPARATOR ', ') AS Skills
        FROM $this->table
        LEFT JOIN 
            student_skill ON $this->table.StudentId = student_skill.StudentId
        
        WHERE $this->table.StudentId = :StudentId";

        // Prepare the query
        $result = $this->query($query, ['StudentId' => $StudentId]);
        return $result;
    }
}
