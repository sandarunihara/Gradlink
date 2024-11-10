<?php
    class Student
    {
        
        use Model;

        protected $table = 'student';

        protected $allowedColumns = [

            'UserId',
            'Name',
            'DegreeName',
            'Status',
            'ShortDesc'
        ];
    }