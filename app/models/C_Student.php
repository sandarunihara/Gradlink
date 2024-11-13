<?php 

class C_Student{
    use Model;

    protected $table = 'student';
    function findbyId($RegNumber)
    {
        $query = "SELECT * FROM $this->table WHERE RegNumber = $RegNumber";

        $result = $this->query($query);
        return $result;
    }

    
}