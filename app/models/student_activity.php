<?php
    class student_activity
    {
        
        use Model;

        protected $table = 'student_activity';

        protected $allowedColumns = [

            'StudentId',
            'ActivityDescription',
        ];
        function findLeatest($studentId){
            $query = "SELECT * FROM student_activity WHERE StudentId = :StudentId ORDER BY Date DESC LIMIT 3";
            $result = $this->query($query, ['StudentId' => $studentId]);
            return $result;
        }
    }