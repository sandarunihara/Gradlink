<?php
    class student_activity
    {
        
        use Model;

        protected $table = 'student_activity';

        protected $allowedColumns = [

            'StudentId',
            'ActivityDescription',
        ];
    }