<?php

class ShortlistedStudents{
    use Controller;
    public function dashboard(){

        $data = [
            ['Student Name' => 'Alice Smith', 'Student Degree' => 'CS', 'Position' => 'Software Engineer', 'Action' => 'Recruit'],
            ['Student Name' => 'John Doe', 'Student Degree' => 'IS', 'Position' => 'QA', 'Action' => 'Reject'],
            ['Student Name' => 'Emma Johnson', 'Student Degree' => 'CS', 'Position' => 'Web Development', 'Action' => 'Pending'],
            ['Student Name' => 'Michael Brown', 'Student Degree' => 'IS', 'Position' => 'Software Engineer', 'Action' => 'Recruit'],
            ['Student Name' => 'Olivia Taylor', 'Student Degree' => 'CS', 'Position' => 'QA', 'Action' => 'Reject'],
            ['Student Name' => 'Liam Wilson', 'Student Degree' => 'IS', 'Position' => 'Web Development', 'Action' => 'Pending'],
            ['Student Name' => 'Sophia Anderson', 'Student Degree' => 'CS', 'Position' => 'Software Engineer', 'Action' => 'Recruit'],
            ['Student Name' => 'Noah Thomas', 'Student Degree' => 'IS', 'Position' => 'QA', 'Action' => 'Reject'],
            ['Student Name' => 'Ava Martin', 'Student Degree' => 'CS', 'Position' => 'Web Development', 'Action' => 'Pending'],
            ['Student Name' => 'William Clark', 'Student Degree' => 'IS', 'Position' => 'Software Engineer', 'Action' => 'Recruit'],
            ['Student Name' => 'Mia Lewis', 'Student Degree' => 'CS', 'Position' => 'QA', 'Action' => 'Reject'],
            ['Student Name' => 'James Walker', 'Student Degree' => 'IS', 'Position' => 'Web Development', 'Action' => 'Pending'],
            ['Student Name' => 'Amelia Harris', 'Student Degree' => 'CS', 'Position' => 'Software Engineer', 'Action' => 'Recruit'],
            ['Student Name' => 'Lucas Robinson', 'Student Degree' => 'IS', 'Position' => 'QA', 'Action' => 'Reject'],
            ['Student Name' => 'Isabella Scott', 'Student Degree' => 'CS', 'Position' => 'Web Development', 'Action' => 'Pending']
        ];
        

        $this-> view('Company/ShortlistedStudents', ['data' => $data]);
    }
}